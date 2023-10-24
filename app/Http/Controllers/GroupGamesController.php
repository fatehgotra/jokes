<?php

namespace App\Http\Controllers;

use App\Models\GroupMembers;
use App\Models\Groups;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GroupGamesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:group_user')->except(
            'groupLogin',
            'groupSignup',
            'groupMembers',
            'signUpStep1',
            'signUpStep2',
            'groupValid'
        );
    }

    public function groupLogin()
    {
        $groups = Groups::all();

        return view('group-login', compact('groups'));
    }

    public function groupSignup()
    {

        return view('group-signup');
    }

    public function groupMembers()
    {

        return view('group-members');
    }

    public function groupValid(Request $request)
    {

        $this->validate($request, [
            'group' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('group_user')->attempt(['email' => $request->email, 'group_id' => $request->group, 'password' => $request->password])) {

            return redirect()->intended(back());

        } else {

            return redirect()->back()->with('error', 'Sorry, invalid credentials please try again.');
        }
    }


    public function signUpStep1(Request $request)
    {

        $rules = [
            'name' => 'required',
            'password' => 'required|min:8|confirmed'
        ];

        $message = [
            'name.required' => 'Please enter group name',
            'password.required' => 'Please set your group password',
            'password.min:8'    => 'Password must be more than 8 characters',
            'password.confirmed' => 'The confirmed password mismatched'
        ];

        $this->validate($request, $rules, $message);

        // if (!Auth::guard('user')->id()) {

        //     return redirect()->route('user.login')->with('error', 'Please login first as user to proceed.');
        // }

        $ch = Groups::where('name', $request->name)->first();

        if (!is_null($ch)) {

            return redirect()->back()->with('error', 'This group name already exist. Please choose another.');
        }

        $s1 = [

            'name' => $request->name,
            'password' => $request->password,
            'creator'  => Auth::guard('user')->id()

        ];

        session()->put('step1', $s1);

        return redirect()->route('group.group-members');
    }

    public function signUpStep2(Request $request)
    {


        // if (!Auth::guard('user')->id()) {
        //     return redirect()->back()->with('error', 'Please login first as user to proceed.');
        // }

        if (!session()->get('step1')) {

            return redirect()->route('group.group-login')->with('error', 'Please create group first.');
        }


        $gv = session()->get('step1');

        $g = Groups::create([
            'name' => $gv['name'],
            'creator' => $request->email_1,
        ]);



        if (!is_null($request->email_1)) {

            GroupMembers::create([

                'group_id' => $g->id,
                'email' => $request->email_1,
                'display_name' => $request->display_name_1,
                'password' => Hash::make($gv['password']),
            ]);
        }

        if (!is_null($request->email_2)) {

            GroupMembers::create([

                'group_id' => $g->id,
                'email' => $request->email_2,
                'display_name' => $request->display_name_2,
                'password' =>  Hash::make($gv['password']),
            ]);
        }

        if (!is_null($request->email_3)) {

            GroupMembers::create([

                'group_id' => $g->id,
                'email' => $request->email_3,
                'display_name' => $request->display_name_3,
                'password' =>  Hash::make($gv['password']),
            ]);
        }

        if (!is_null($request->email_4)) {

            GroupMembers::create([

                'group_id' => $g->id,
                'email' => $request->email_4,
                'display_name' => $request->display_name_4,
                'password' =>  Hash::make($gv['password']),
            ]);
        }
        Auth::guard('user')->logout();
        Auth::guard('group_user')->logout();

        if (Auth::guard('group_user')->attempt(['email' => $request->email_1, 'group_id' => $g->id, 'password' => ($gv['password'])])) {

            return redirect()->route('home')->with('success', 'Group created successfully, you can play now with members.');
        }

        return redirect()->route('home')->with('error', 'Something went wrong! Please try again.');
    }

    public function logout()
    {

        Auth::guard('group_user')->logout();

        return redirect()->route('home')->with('success', 'Logged out successfully from group.');
    }

    public function GuessTheLoc()
    {
        return view('pages.group_games.guess_location');
    }

    public function GrogWheel(){

        return view('pages.group_games.grog-spin-wheel');
    }
    public function GuessCelebrity(){

        return view('pages.group_games.guess_the_celebrity');
    }
    public function GuessVoice(){

        return view('pages.group_games.guess-the-voice');
    }
    public function ThisThat(){

        return view('pages.group_games.this-or-that');
    }
    public function DoDrink(){

        return view('pages.group_games.do-or-drink');
    }
    
}
