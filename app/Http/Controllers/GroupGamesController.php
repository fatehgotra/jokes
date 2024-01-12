<?php

namespace App\Http\Controllers;

use App\Models\GroupGrogWheelQues;
use App\Models\GroupGuessCelebrity;
use App\Models\GroupGuessCelebrityQues;
use App\Models\GroupGuessLocation;
use App\Models\GroupGuessLocationQues;
use App\Models\GroupGuessVoice;
use App\Models\GroupGuessVoiceQues;
use App\Models\GroupMembers;
use App\Models\GroupQues;
use App\Models\Groups;
use App\Models\GroupScores;
use App\Models\LeaderBoard;
use App\Models\LocalTrivia;
use App\Models\LocalTriviaQues;
use App\Models\User;
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
            'groupValid',
            'GrogWheel'
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


    //////////////////////GAMES FUNCTIONS


    public function GuessTheLoc()
    {
        $groupGuessLocation = GroupGuessLocation::first();

        $user = Auth::guard('group_user')->user();

        
        $_questions = GroupGuessLocationQues::where('status', 1)->inRandomOrder()->limit($groupGuessLocation->game_question_limit)->get();
        
        $leaders = GroupScores::with('group')->where('game', 'group_location')->where('score','>=',$groupGuessLocation->qualified_score)->where('status',1)->get();
        
        $check = GroupQues::where([ 'group_id' =>  $user->group_id, 'game' => 'group_location'])->first();

        $questions = [];

    if( !$check ){
       
       

        if (count($_questions) > 0) {
            foreach ($_questions as $k => $q) {

                $questions[] = [
                    'numb' => ($k + 1),
                    'id'   => $q->id,
                    'gid'  => $groupGuessLocation->id,
                    'question' => $q->question,
                    'answer' => (int)filter_var($q->correct_option, FILTER_SANITIZE_NUMBER_INT),
                    'image'     => $q->image,
                    'options' => [

                        $q->option_1,
                        $q->option_2,
                        $q->option_3,
                        $q->option_4,
                    ],
                ];

                GroupQues::create([

                    'group_id' => $groupGuessLocation->id,
                    'ques_id'  => $q->id,
                    'game'     => 'group_location',
                    'current_que' => ($k == 0) ? $q->id : '',
                    'selected_option' => '',
                    'answer_by'=>'',
                ]);
            }
        }

     } else{
            //////////////////
         
            $current = GroupQues::where(['game' => 'group_location','group_id' => $groupGuessLocation->id])->where('current_que','!=','')->first();
          
            $gques = GroupQues::where(['game' => 'group_location','group_id' => $groupGuessLocation->id])
                                ->where('id','>=',$current->id)
                                ->get()
                                ->pluck('ques_id');
            

            foreach( $gques as $k => $q){


                $qs = GroupGuessLocationQues::find($q);

                $questions[] = [
                    'numb' => ($k + 1),
                    'id'   => $q,
                    'gid'  => $groupGuessLocation->id,
                    'question' => $qs->question,
                    'answer' => (int)filter_var($qs->correct_option, FILTER_SANITIZE_NUMBER_INT),
                    'image'     => $qs->image,
                    'options' => [

                        $qs->option_1,
                        $qs->option_2,
                        $qs->option_3,
                        $qs->option_4,
                    ],
                ];

            }

    }
        
        return view('pages.group_games.guess_location', compact('groupGuessLocation', 'questions','leaders'));

    }

    public function GuessVoice(){

        $groupGuessLocation = GroupGuessVoice::first();

        $user = Auth::guard('group_user')->user();

        
        $_questions = GroupGuessVoiceQues::where('status', 1)->inRandomOrder()->limit($groupGuessLocation->game_question_limit)->get();
        
        $leaders = GroupScores::with('group')->where('game', 'group_guess_voice')->where('score','>=',$groupGuessLocation->qualified_score)->where('status',1)->get();
        
        $check = GroupQues::where([ 'group_id' =>  $user->group_id, 'game' => 'group_guess_voice'])->first();

        $questions = [];

    if( !$check ){
       
       

        if (count($_questions) > 0) {
            foreach ($_questions as $k => $q) {

                $questions[] = [
                    'numb' => ($k + 1),
                    'id'   => $q->id,
                    'gid'  => $groupGuessLocation->id,
                    'question' => $q->question,
                    'answer' => (int)filter_var($q->correct_option, FILTER_SANITIZE_NUMBER_INT),
                    'file'     => $q->file,
                    'options' => [

                        $q->option_1,
                        $q->option_2,
                        $q->option_3,
                        $q->option_4,
                    ],
                ];

                GroupQues::create([

                    'group_id' => $groupGuessLocation->id,
                    'ques_id'  => $q->id,
                    'game'     => 'group_guess_voice',
                    'current_que' => ($k == 0) ? $q->id : '',
                    'selected_option' => '',
                    'answer_by'=>'',
                ]);
            }
        }

     } else{
            //////////////////
         
            $current = GroupQues::where(['game' => 'group_guess_voice','group_id' => $groupGuessLocation->id])->where('current_que','!=','')->first();
          
            $gques = GroupQues::where(['game' => 'group_guess_voice','group_id' => $groupGuessLocation->id])
                                ->where('id','>=',$current->id)
                                ->get()
                                ->pluck('ques_id');
            

            foreach( $gques as $k => $q){


                $qs = GroupGuessLocationQues::find($q);

                $questions[] = [
                    'numb' => ($k + 1),
                    'id'   => $q,
                    'gid'  => $groupGuessLocation->id,
                    'question' => $qs->question,
                    'answer' => (int)filter_var($qs->correct_option, FILTER_SANITIZE_NUMBER_INT),
                    'file'     => $qs->file,
                    'options' => [

                        $qs->option_1,
                        $qs->option_2,
                        $qs->option_3,
                        $qs->option_4,
                    ],
                ];

            }

    }
        
        return view('pages.group_games.guess-the-voice', compact('groupGuessLocation', 'questions','leaders'));

    }

   
    public function GuessCelebrity(){

        $groupGuessLocation = GroupGuessCelebrity::first();

        $user = Auth::guard('group_user')->user();

        
        $_questions = GroupGuessCelebrityQues::where('status', 1)->inRandomOrder()->limit($groupGuessLocation->game_question_limit)->get();
        
        $leaders = GroupScores::with('group')->where('game', 'group_guess_celebrity')->where('score','>=',$groupGuessLocation->qualified_score)->where('status',1)->get();
        
        $check = GroupQues::where([ 'group_id' =>  $user->group_id, 'game' => 'group_guess_celebrity'])->first();

        $questions = [];

    if( !$check ){
       
       

        if (count($_questions) > 0) {
            foreach ($_questions as $k => $q) {

                $questions[] = [
                    'numb' => ($k + 1),
                    'id'   => $q->id,
                    'gid'  => $groupGuessLocation->id,
                    'question' => $q->question,
                    'answer' => (int)filter_var($q->correct_option, FILTER_SANITIZE_NUMBER_INT),
                    'image'     => $q->image,
                    'options' => [

                        $q->option_1,
                        $q->option_2,
                        $q->option_3,
                        $q->option_4,
                    ],
                ];

                GroupQues::create([

                    'group_id' => $groupGuessLocation->id,
                    'ques_id'  => $q->id,
                    'game'     => 'group_guess_celebrity',
                    'current_que' => ($k == 0) ? $q->id : '',
                    'selected_option' => '',
                    'answer_by'=>'',
                ]);
            }
        }

     } else{
            //////////////////
         
            $current = GroupQues::where(['game' => 'group_guess_celebrity','group_id' => $groupGuessLocation->id])->where('current_que','!=','')->first();
          
            $gques = GroupQues::where(['game' => 'group_guess_celebrity','group_id' => $groupGuessLocation->id])
                                ->where('id','>=',$current->id)
                                ->get()
                                ->pluck('ques_id');
            

            foreach( $gques as $k => $q){


                $qs = GroupGuessCelebrityQues::find($q);

                $questions[] = [
                    'numb' => ($k + 1),
                    'id'   => $q,
                    'gid'  => $groupGuessLocation->id,
                    'question' => $qs->question,
                    'answer' => (int)filter_var($qs->correct_option, FILTER_SANITIZE_NUMBER_INT),
                    'image'     => $qs->image,
                    'options' => [

                        $qs->option_1,
                        $qs->option_2,
                        $qs->option_3,
                        $qs->option_4,
                    ],
                ];

            }

    }
        
        return view('pages.group_games.guess_the_celebrity', compact('groupGuessLocation', 'questions','leaders'));

    }

    public function GrogWheel(){

        $_questions = GroupGrogWheelQues::all();
        $questions = [];

        if( isset($_questions) ){
            foreach( $_questions as $q){
                $questions[] = [
                    'label' => $q->name,
                    'value' => $q->id,
                    'question' => $q->task
                ];
            }
        }

        return view('pages.group_games.grog-spin-wheel',compact('questions'));
    }
    public function ThisThat(){

        return view('pages.group_games.this-or-that');
    }
    public function DoDrink(){

        return view('pages.group_games.do-or-drink');
    }


    ///////////////Tracking Functions

    public function trackResult(Request $request){


        $result = GroupQues::where(['group_id' => $request->gid,'ques_id' => $request->id])->first();

        $result->answer_by = !is_null($request->email)  && $result->answer_by != "" ? candidate_name( $request->email ) : "";

        return response()->json([
            'result' => $result
        ]);

    }

    public function updateCurrent( Request $request){

        $last = GroupQues::where([

            'group_id' =>$request->gid,
            'game'     => $request->game,
        ])->get()->last();

       
        GroupQues::where([

            'group_id' =>$request->gid,
            'game'     => $request->game,
        ])->update([
            'current_que' => '',
        ]);

        GroupQues::where([

            'group_id' =>$request->gid,
            'game'     => $request->game,
            'ques_id'  => $request->id
        ])->update([
            'current_que' => $request->id,
        ]);


        return response()->json(['response' => 'current updated']);
    }

    public function gameResult( Request $request ){

        $correct = GroupQues::where([

            'group_id' => $request->gid,
            'game'     => $request->game,
            'correct'  => 1

        ])->count();
        
        GroupScores::updateorCreate(
            [
                'group_id' => $request->gid,
                'game'     => $request->game,
            ],
            [
                'group_id' => $request->gid,
                'game'     => $request->game,
                'score'    => $correct,
                'status'   => 1,
                'image'    => '',   
            ]
        );
        
        GroupQues::where([

            'group_id' =>$request->gid,
            'game'     => $request->game,

        ])->delete();

    }

    public function storeResult(Request $request){

        $result = GroupQues::where(['group_id' => $request->gid,'ques_id' => $request->id])->update([
            'answer_by' => $request->email,
            'selected_option' => $request->selected,
            'correct' => $request->correct,
        ]);

        return response()->json([
            'response' => $result
        ]);

    }

   
    
}
