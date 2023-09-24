<?php

namespace App\Http\Controllers;

use App\Models\Jokes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JokesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:admin')->except('viewJoke', 'editJoke', 'deleteJoke', 'index','addJoke');
    }
    public function index(Request $request)
    {

        $status = $request->status;

        $jokes = Jokes::where('user_id', Auth::guard('user')->id());

        if ($status == 'published') {

            $jokes = $jokes->where('status', 1);
        }

        if ($status == 'unpublished') {

            $jokes = $jokes->where('status', 0);
        }

        $jokes = $jokes->orderBy('id', 'desc')->get();

        return view('user.jokes', compact('jokes'));
    }

    public function addJoke(Request $request){

        Jokes::create([
            'user_id' => Auth::guard('user')->id(),
            'joke'    => $request->joke,
            'status'  => 0,
        ]);

        return redirect()->back()->with('success','Thanks, Joke is added successfully, Please wait for publish it.');
    }



    public function adminJokes(Request $request)
    {

        $status = $request->status;

        $jokes = Jokes::with('user');

        if ($status == 'published') {

            $jokes = $jokes->where('status', 1);
        }

        if ($status == 'unpublished') {

            $jokes = $jokes->where('status', 0);
        }

        $jokes = $jokes->orderBy('id', 'desc')->get();

        return view('admin.jokes.index', compact('jokes'));
    }

    public function viewJoke($id)
    {

        $joke  =  Jokes::find($id);

        return response()->json([
            'joke' => $joke
        ]);
    }

    public function editJoke(Request $request)
    {

        Jokes::where('id', $request->id)->update(['joke' => $request->joke]);

        return redirect()->back()->with('success', 'Joke update successfully!!');
    }

    public function markJoke(Request $request)
    {

        Jokes::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Joke status changed successfully!!');
    }

    public function deleteJoke(Request $request)
    {

        Jokes::find($request->id)->delete();

        return redirect()->back()->with('success', 'Joke deleted successfully!!');
    }
}
