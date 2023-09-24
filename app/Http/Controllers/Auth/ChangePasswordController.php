<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\User;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function changePasswordForm()
    {
        $id         = Auth::user()->id;
        $user       = User::find($id);
        return view('user.settings.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $id         =  Auth::user()->id;

        $this->validate($request, [
            'current_password'  => 'required',
            'new_password'          => 'required|min:8|confirmed',

        ]);

        $user       = User::find($id);
      
        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->rawpass = $request->new_password;
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('user.password.form')->with('success', 'Password changed successfully!');

        } else {

            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        return redirect()->route('user.password.form')->with('success', 'Password changed successfully');
    }

}
