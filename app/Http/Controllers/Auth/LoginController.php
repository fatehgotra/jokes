<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Jokes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth:user')->except(['logout', 'login', 'showLoginForm', 'showSignupForm', 'signup']);
    }

    public function showLoginForm()
    {

        return view('user.auth.login');
    }

    public function showSignupForm()
    {

        return view('user.auth.signup');
    }

    public function dashboard()
    {
        $jokes = Jokes::where('user_id',Auth::guard('user')->id())->get();
        
        return view('user.dashboard', compact('jokes'));
    }


    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!is_null($user) && $user->status == 0) {

            return redirect()->back()->with('error', 'Sorry your account is disabled.');
        }
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => ($request->password)], $request->remember)) {

            return redirect()->intended(route('user.dashboard'));
        } else {

            return $this->sendFailedLoginResponse($request);
        }
    }

    public function signup(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'rawpass' => $request->password,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login')->with('success', 'Thanks for register with us ! Please login');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if (Auth::guard('user')->check()) {

            if (Auth::guard('admin')->check()) {

                Auth::guard('user')->logout();
                return redirect()->intended(route('admin.dashboard'));
            }
            Auth::guard('user')->logout();

            return redirect()->route('user.login');
        }
    }
}
