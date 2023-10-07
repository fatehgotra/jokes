<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jokes;
use App\Models\JokesCategory;
use App\Models\LocalTrivia;
use App\Models\LocalTriviaQues;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function localTrivia()
    {

        $game = LocalTrivia::first();

        return view('admin.games.local-trivia.setup', compact('game'));
    }

    public function storeTrivia(Request $request)
    {

     
        $rules = [
            'name' => 'required',
            'question_limit' => 'required',
            'description' => 'required',
            'lifeline' =>'required',
            'rules' =>'required',
            'qualified_score' => 'required',
            'game_question_limit' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter game name',
            'question_limit.required' => 'Please enter question time limit',
            'description.required' => 'please enter description',
            'game_question_limit.required' => 'Please set no. of question per game',
            'lifeline.required' =>'Please enter number of lifelines',
            'qualified_score.required' => 'Please enter qualified score',
            'rules.required' =>'Please add rules',
            
        ];

        $this->validate($request, $rules, $messages);

        LocalTrivia::updateOrCreate(
            ['id' => $request->game_id],
            [
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'ques_time_limit' => $request->question_limit,
                'lifelines' => $request->lifeline,
                'qualified_score' => $request->qualified_score,
                'rules' => $request->rules,
                'game_question_limit' => $request->game_question_limit
            ]
        );

        return redirect()->back()->with('success', 'Game setup updated');
    }

    public function triviaQuestions()
    {

        $game = LocalTrivia::first();

        $questions = LocalTriviaQues::all();

        return view('admin.games.local-trivia.question-list', compact('game', 'questions'));
    }

    public function addTriviaQuestion()
    {

        $game = LocalTrivia::first();

        return view('admin.games.local-trivia.add-question', compact('game'));
    }

    public function editTriviaQuestion($id)
    {

        $game = LocalTrivia::first();

        $question = LocalTriviaQues::find($id);

        return view('admin.games.local-trivia.edit-question', compact('game', 'question'));
    }

    public function storeTriviaQuestion(Request $request)
    {

        $rules = [

            'question' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'correct_option' => 'required',

        ];

        $messages = [

            'question.required' => 'Please enter question',
            'option_1.required' => 'Please set first option',
            'option_2.required' => 'Please set second option',
            'option_3.required' => 'Please set third option',
            'option_4.required' => 'Please set fourth option',
            'correct_option.required' => 'Please choose correct option',
        ];

        $this->validate($request, $rules, $messages);

        LocalTriviaQues::create([

            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
            'image'          =>  $request->file('image') ? "data:image/png;base64," . base64_encode(file_get_contents($request->file('image')))  : '',

        ]);

        return redirect()->route('admin.trivia-questions')->with('success', 'Question added for game');
    }

    public function updateTriviaQuestion(Request $request)
    {
   
        $rules = [

            'question' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'correct_option' => 'required',

        ];

        $messages = [

            'question.required' => 'Please enter question',
            'option_1.required' => 'Please set first option',
            'option_2.required' => 'Please set second option',
            'option_3.required' => 'Please set third option',
            'option_4.required' => 'Please set fourth option',
            'correct_option.required' => 'Please choose correct option',
        ];

        $this->validate($request, $rules, $messages);

        $img = LocalTriviaQues::find($request->id)->image;

        LocalTriviaQues::where('id', $request->id)->update([

            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
            'image'          =>  $request->file('image') ? "data:image/png;base64," . base64_encode(file_get_contents($request->file('image')))  : $img,

        ]);

        return redirect()->route('admin.trivia-questions')->with('success', 'Question updated successfully');
    }

    public function deleteTriviaQuestion(Request $request)
    {

        LocalTriviaQues::find($request->id)->delete();

        return redirect()->route('admin.trivia-questions')->with('success', 'Question deleted successfully!');
    }
}
