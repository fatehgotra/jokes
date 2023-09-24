<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ApprovalHistory;
use App\Models\Country;
use App\Models\User;
use App\Notifications\AdminItselfNotify;
use App\Notifications\ApprovalNotification;
use App\Notifications\DeclineNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $users            = User::query();

        $filter_status    = $request->status;

        if ($filter_status == 'active') {

            $users        = $users->where('status', 1);
        }

        if ($filter_status == 'inactive') {

            $users        = $users->where('status', 0);
        }

        $users = $users->get();

        return view('admin.users.index', compact('users'));
    }

    public function userlogin($id)
    {

        $user = User::find($id);

        $credentials = array('email' => $user->email, 'password' => $user->rawpass);
        if (Auth::guard('user')->attempt($credentials, true)) {
            return redirect()->intended(route('user.dashboard'));
        }
    }

    public function addUser(Request $request){
     
    
       $this->validate($request ,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'status' => 'required',

        ]);
      

        User::create([
            'name'  =>$request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password'=> Hash::make($request->password),
            'rawpass' => $request->password,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success','User added successfully!!');
    }

    public function deleteUser(Request $request){
     
        User::find( $request->id )->delete();

        return redirect()->back()->with('success','User deleted successfully!!');
    }

    public function markuser( Request $request){

        User::where('id',$request->id)->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success','Status changed successfully!!');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries  = Country::get();
        return view('admin.users.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'string', 'min:6'],
            'phone'                 => ['required', 'max:255'],
            'country'               => ['required', 'string', 'max:255']
        ];

        $messages = [
            'name.required'                         => 'Please enter user name.',
            'email.required'                        => 'Please enter user email address.',
            'password.required'                     => 'Please choose user password.',
            'phone.required'                        => 'Please enter phone or mobile number.',
            'country.required'                      => 'Please choose country.'
        ];

        $this->validate($request, $rules, $messages);

        $user                   = User::create([
            'name'                  => $request->name,
            'surname'               => $request->surname,
            'email'                 => $request->email,
            'phone'                => $request->phone,
            'country'               => $request->country,
            'password'              => Hash::make($request->password)
        ]);

        return redirect()->route('admin.volunteers.index')->with('success', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user            = User::find($id);
        $countries       = Country::get();
        return view('admin.users.view', compact('user', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user                   = User::find($id);
        $countries              = Country::get();
        return view('admin.users.edit', compact('user', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password'              => ['required', 'string', 'min:6'],
            'phone'                 => ['required', 'max:255'],
            'country'               => ['required', 'string', 'max:255']
        ];

        $messages = [
            'name.required'                         => 'Please enter user name.',
            'email.required'                        => 'Please enter user email address.',
            'password.required'                     => 'Please choose user password.',
            'phone.required'                        => 'Please enter phone or mobile number.',
            'country.required'                      => 'Please choose country.'
        ];

        $this->validate($request, $rules, $messages);

        $user                   = User::find($id);
        $user->name             = $request->name;
        $user->phone            = $request->phone;
        $user->email            = $request->email;
        if (isset($request->password)) {
            $user->password     = Hash::make($request->password);
        }
        $user->country          = $request->country;
        $user->save();
        return redirect()->route('admin.volunteers.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.volunteers.index')->with('success', 'User deleted successfully!');
    }

    public function changeStatus(Request $request, $id)
    {
        $user = User::find($id);


        $admins = Admin::where('branch', 'like', '%' . $user->branch . '%');


        $roles = Auth::guard('admin')->user()->getRoleNames()->toArray();


        if (in_array('hq', $roles)) {

            User::find($id)->update([
                'status'        => $request->status,
                'approved_by'   => 'HQ',
                'approver_id'   => Auth::guard('admin')->id(),
                'decline_reason' => $request->has('reason') ? $request->reason : null
            ]);

            ApprovalHistory::create([
                'user_id'       => $id,
                'status'        => $request->status,
                'approved_by'   => 'HQ',
                'approver_id'   => Auth::guard('admin')->id()
            ]);

            if ($request->status == 'approve') {
                $user = User::find($id);
                $user->notify(new ApprovalNotification('hq'));
                return redirect()->back()->with('success', 'Volunteer approved successfully!');
            } else {
                $user = User::find($id);
                $user->notify(new DeclineNotification('hq'));
                return redirect()->back()->with('success', 'Volunteer declined successfully!');
            }
        } elseif (in_array('division-manager', $roles)) {

            User::find($id)->update([
                'status'        => $request->status,
                'approved_by'   => 'Division Manager',
                'approver_id'   => Auth::guard('admin')->id(),
                'decline_reason' => $request->has('reason') ? $request->reason : null
            ]);

            ApprovalHistory::create([
                'user_id'       => $id,
                'status'        => $request->status,
                'approved_by'   => 'Division Manager',
                'approver_id'   => Auth::guard('admin')->id()
            ]);

            if ($request->status == 'approve') {

                ApprovalHistory::create([
                    'user_id'       => $id,
                    'status'        => 'pending',
                    'approved_by'   => 'HQ',
                    'approver_id'   => null
                ]);

                $user = User::find($id);

                $user->notify(new ApprovalNotification('division-manager'));

                $admins = $admins->whereHas(
                    'roles',
                    function ($q) {
                        $q->where('name', 'hq');
                    }
                )->get();

                if (count($admins) > 0) {

                    foreach ($admins as $ad) {

                        $ad->notify(new AdminItselfNotify($user));
                    }
                }

                return redirect()->back()->with('success', 'Volunteer approved successfully!');
            } else {
                $user = User::find($id);
                $user->notify(new DeclineNotification('division-manager'));
                return redirect()->back()->with('success', 'Volunteer declined successfully!');
            }

            $admins = $admins->get();
        } elseif (in_array('branch-level', $roles)) {


            User::find($id)->update([
                'status'        => $request->status,
                'approved_by'   => 'Branch Level',
                'approver_id'   => Auth::guard('admin')->id(),
                'decline_reason' => $request->has('reason') ? $request->reason : null
            ]);

            ApprovalHistory::create([
                'user_id'       => $id,
                'status'        => $request->status,
                'approved_by'   => 'Branch Level',
                'approver_id'   => Auth::guard('admin')->id()
            ]);

            if ($request->status == 'approve') {
                ApprovalHistory::create([
                    'user_id'       => $id,
                    'status'        => 'pending',
                    'approved_by'   => 'Division Manager',
                    'approver_id'   => null
                ]);
                $user = User::find($id);
                $user->notify(new ApprovalNotification('branch-level'));

                $admins = $admins->whereHas(
                    'roles',
                    function ($q) {
                        $q->where('name', 'division-manager');
                    }
                )->get();

                if (count($admins) > 0) {

                    foreach ($admins as $ad) {

                        $ad->notify(new AdminItselfNotify($user));
                    }
                }

                return redirect()->back()->with('success', 'Volunteer approved successfully!');
            } else {
                $user = User::find($id);
                $user->notify(new DeclineNotification('branch-level'));
                return redirect()->back()->with('success', 'Volunteer declined successfully!');
            }
        } else {
            abort(403);
        }
    }

    public function approvalHistory($id)
    {
        $approval_history   = ApprovalHistory::where('user_id', $id)->orderBy('id', 'desc')->get();
        $user               = User::find($id);
        return view('admin.users.approval-history', compact('approval_history', 'user'));
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->route('admin.volunteers.index')->with('success', 'Volunteer password has been reset successfully!');
    }
}
