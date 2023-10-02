<?php

namespace App\Http\Controllers;

use App\Models\Jokes;
use App\Models\JokesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JokesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:admin')->except('front','viewJoke', 'editJoke', 'deleteJoke', 'index','addJoke');
    }
    public function index(Request $request)
    {

        $status = $request->status;

        $jokes = Jokes::with('category')->where('user_id', Auth::guard('user')->id());

        $jokes_categories = JokesCategory::where('status',1)->get();

        if ($status == 'published') {

            $jokes = $jokes->where('status', 1);
        }

        if ($status == 'unpublished') {

            $jokes = $jokes->where('status', 0);
        }

        $jokes = $jokes->orderBy('id', 'desc')->get();

        return view('user.jokes', compact('jokes','jokes_categories'));
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

        $jokes_categories = JokesCategory::where('status',1)->get();

        $jokes = Jokes::with('user','category');

        if ($status == 'published') {

            $jokes = $jokes->where('status', 1);
        }

        if ($status == 'unpublished') {

            $jokes = $jokes->where('status', 0);
        }

        $jokes = $jokes->orderBy('id', 'desc')->get();

        return view('admin.jokes.index', compact('jokes','jokes_categories'));
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

        Jokes::where('id', $request->id)->update(['joke' => $request->joke,'category_id'=>$request->category_id]);

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

    public function adminJokesCategories(){

        $categories = JokesCategory::all();

        return view('admin.jokes.categories.index',compact('categories'));
    }

    public function addJokeCategory(Request $request){
       
        JokesCategory::create([
            'category' => $request->category,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success','Category added succesfully!');
    }

    public function editJokeCategory(Request $request){

       
        JokesCategory::where('id',$request->editId)->update([
            'category' => $request->category,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success','Category updated succesfully!');
    }

    public function deleteCategory(Request $request){

       
        JokesCategory::find($request->id)->delete();

        return redirect()->back()->with('success','Category deleted succesfully!');
    }

    public function front(Request $request){
        
        $jokeUsers = Jokes::where('status',1)->get();

        $jokes = Jokes::where('status',1);

        if( !is_null($request->c) ){
            $jokes = $jokes->where('category_id',$request->c);
        }
        if( !is_null($request->a) ){
            $jokes = $jokes->where('user_id',$request->a);
        }
        
        $jokes = $jokes->paginate(10);

        $jokes_categories = JokesCategory::where('status',1)->get();
        
        $_users = [];

        if( count($jokeUsers) > 0 ):
        foreach( $jokeUsers as $joke ):
         $_users[] = $joke->user;
        endforeach;
        endif;

        $users = array_unique($_users);
        

        return view('pages.jokes',compact('jokes','jokes_categories','users'));
    }

}
