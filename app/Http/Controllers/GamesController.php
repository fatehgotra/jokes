<?php

namespace App\Http\Controllers;

use App\Models\GroupGuessLocation;
use App\Models\GuessTheVoice;
use App\Models\Jokes;
use App\Models\JokesCategory;
use App\Models\LeaderBoard;
use App\Models\LocalTrivia;
use App\Models\LocalTriviaQues;
use App\Models\TrueFalse;
use App\Models\TrueFalseQues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:user')->except('home');
    }
    public function home()
    {

        $jokes_category = JokesCategory::where('status', 1)->get();
        
        /* solo */
        $localtrivia = LocalTrivia::where('status', 1)->first();
        $truefalse = TrueFalse::where('status', 1)->first();
        $guessTheVoice = GuessTheVoice::where('status',1)->first();

        $groupGuessLocation = GroupGuessLocation::where('status', 1)->first();

        return view('index', compact('jokes_category', 'localtrivia','truefalse','groupGuessLocation','guessTheVoice'));
    }
    public function index()
    {

        return view('games.landing');
    }
    public function breakout()
    {
        return view('games.breakout');
    }
    public function matching()
    {
        return view('games.matching');
    }
    public function tictactoe()
    {
        return view('games.tictactoe');
    }
    public function rockpaper()
    {
        return view('games.rockpaper');
    }
    public function planetDefence()
    {
        return view('games.planetdefence');
    }

    public function viewTriviaGame()
    {

        $localtrivia = LocalTrivia::first();

        $_questions = LocalTriviaQues::where('status', 1)->inRandomOrder()->limit($localtrivia->game_question_limit)->get();
        
        $leaders = LeaderBoard::with('user')->where('game', 'local-trivia')->where('score','>=',$localtrivia->qualified_score)->where('status',1)->get();

        $questions = [];


        if (count($_questions) > 0) {
            foreach ($_questions as $k => $q) {

                $questions[] = [
                    'numb' => ($k + 1),
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
            }
        }

        return view('pages.games.local-trivia', compact('localtrivia', 'questions','leaders'));
    }

    public function viewGuessVoice()
    {

        $localtrivia = LocalTrivia::first();

        $_questions = LocalTriviaQues::where('status', 1)->inRandomOrder()->limit($localtrivia->game_question_limit)->get();
        
        $leaders = LeaderBoard::with('user')->where('game', 'local-trivia')->where('score','>=',$localtrivia->qualified_score)->where('status',1)->get();

        $questions = [];


        if (count($_questions) > 0) {
            foreach ($_questions as $k => $q) {

                $questions[] = [
                    'numb' => ($k + 1),
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
            }
        }

        return view('pages.games.local-trivia', compact('localtrivia', 'questions','leaders'));
    }

    public function viewTrueFalseGame()
    {

        $truefalse = TrueFalse::first();

        $_questions = TrueFalseQues::where('status', 1)->inRandomOrder()->limit($truefalse->game_question_limit)->get();
        
        $leaders = LeaderBoard::with('user')->where('game', 'true-false')->where('score','>=',$truefalse->qualified_score)->where('status',1)->get();

        $questions = [];


        if (count($_questions) > 0) {
            foreach ($_questions as $k => $q) {

                $questions[] = [
                    'numb' => ($k + 1),
                    'question' => $q->statement,
                    'answer'   => $q->correct_option,
                    'image'    => $q->image,
                    'options' => [
                       'true',
                       'false'
                    ],
                ];
            }
        }

        return view('pages.games.true-false', compact('truefalse', 'questions','leaders'));
    }


    public function saveLeader(Request $request)
    {

        LeaderBoard::updateOrCreate([
            'user_id' =>Auth::guard('user')->id(),
            'game'    => $request->game,
        ],[
            'user_id' => Auth::guard('user')->id(),
            'game' => $request->game,
            'score' => $request->score,
        ]);

    
        return response()->json([
            'success' => true,
            'message' => 'score recorded'
        ]);
    }

    public function enableLeader(Request $request){
       
        LeaderBoard::where([
            'user_id' =>Auth::guard()->id(),
            'game'    =>$request->game,
        ])->update([
            'status' => 1
        ]);

        return redirect()->back()->with('success','Thanks, Your score is submitted.');
    }

}
