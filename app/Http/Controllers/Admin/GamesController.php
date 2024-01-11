<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupGrogWheel;
use App\Models\GroupGrogWheelQues;
use App\Models\GroupGuessCelebrity;
use App\Models\GroupGuessCelebrityQues;
use App\Models\GroupGuessLocation;
use App\Models\GroupGuessLocationQues;
use App\Models\GroupGuessVoice;
use App\Models\GroupGuessVoiceQues;
use App\Models\GuessLocalCelb;
use App\Models\GuessLocalCelbQues;
use App\Models\GuessTheVoice;
use App\Models\GuessTheVoiceQues;
use App\Models\Jokes;
use App\Models\JokesCategory;
use App\Models\LocalTrivia;
use App\Models\LocalTriviaQues;
use App\Models\TrueFalse;
use App\Models\TrueFalseQues;
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
            'lifeline' => 'required',
            'rules' => 'required',
            'qualified_score' => 'required',
            'game_question_limit' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter game name',
            'question_limit.required' => 'Please enter question time limit',
            'description.required' => 'please enter description',
            'game_question_limit.required' => 'Please set no. of question per game',
            'lifeline.required' => 'Please enter number of lifelines',
            'qualified_score.required' => 'Please enter qualified score',
            'rules.required' => 'Please add rules',

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

    /* Guess The Local Celebrity */

    public function guessLocalCelebrity()
    {

        $game = GuessLocalCelb::first();

        return view('admin.games.guess-local-celebrity.setup', compact('game'));
    }

    public function storeGuessLocalCelebrity(Request $request)
    {


        $rules = [
            'name' => 'required',
            'question_limit' => 'required',
            'description' => 'required',
            'lifeline' => 'required',
            'rules' => 'required',
            'qualified_score' => 'required',
            'game_question_limit' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter game name',
            'question_limit.required' => 'Please enter question time limit',
            'description.required' => 'please enter description',
            'game_question_limit.required' => 'Please set no. of question per game',
            'lifeline.required' => 'Please enter number of lifelines',
            'qualified_score.required' => 'Please enter qualified score',
            'rules.required' => 'Please add rules',

        ];

        $this->validate($request, $rules, $messages);

        GuessLocalCelb::updateOrCreate(
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

    public function guessLocalCelebrityQuestions()
    {

        $game = GuessLocalCelb::first();

        $questions = GuessLocalCelbQues::all();

        return view('admin.games.guess-local-celebrity.question-list', compact('game', 'questions'));
    }

    public function addGuessLocalCelebrityQuestion()
    {

        $game = LocalTrivia::first();

        return view('admin.games.guess-local-celebrity.add-question', compact('game'));
    }

    public function editGuessLocalCelebrityQuestion($id)
    {

        $game = GuessLocalCelb::first();

        $question = GuessLocalCelbQues::find($id);

        return view('admin.games.guess-local-celebrity.edit-question', compact('game', 'question'));
    }

    public function storeGuessLocalCelebrityQuestion(Request $request)
    {

        $rules = [

            'question' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'image'    => 'required',
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

        GuessLocalCelbQues::create([

            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
            'image'          =>  $request->file('image') ? "data:image/png;base64," . base64_encode(file_get_contents($request->file('image')))  : '',

        ]);

        return redirect()->route('admin.guess-local-celebrity-questions')->with('success', 'Question added for game');
    }

    public function updateGuessLocalCelebrityQuestion(Request $request)
    {

        $rules = [

            'question' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'image'    => 'required',
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

        $img = GuessLocalCelbQues::find($request->id)->image;

        GuessLocalCelbQues::where('id', $request->id)->update([

            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
            'image'          =>  $request->file('image') ? "data:image/png;base64," . base64_encode(file_get_contents($request->file('image')))  : $img,

        ]);

        return redirect()->route('admin.guess-local-celebrity-questions')->with('success', 'Question updated successfully');
    }

    public function deleteGuessLocalCelebrityQuestion(Request $request)
    {

        GuessLocalCelbQues::find($request->id)->delete();

        return redirect()->route('admin.guess-local-celebrity-questions')->with('success', 'Question deleted successfully!');
    }

    /* Guess The Voice */

    public function guessTheVoice()
    {

        $game = GuessTheVoice::first();

        return view('admin.games.guess-the-voice.setup', compact('game'));
    }

    public function storeGuessTheVoice(Request $request)
    {


        $rules = [
            'name' => 'required',
            'question_limit' => 'required',
            'description' => 'required',
            'lifeline' => 'required',
            'rules' => 'required',
            'qualified_score' => 'required',
            'game_question_limit' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter game name',
            'question_limit.required' => 'Please enter question time limit',
            'description.required' => 'please enter description',
            'game_question_limit.required' => 'Please set no. of question per game',
            'lifeline.required' => 'Please enter number of lifelines',
            'qualified_score.required' => 'Please enter qualified score',
            'rules.required' => 'Please add rules',

        ];

        $this->validate($request, $rules, $messages);

        GuessTheVoice::updateOrCreate(
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

    public function guessTheVoiceQuestions()
    {

        $game = GuessTheVoice::first();

        $questions = GuessTheVoiceQues::all();

        return view('admin.games.guess-the-voice.question-list', compact('game', 'questions'));
    }

    public function addGuessTheVoiceQuestion()
    {

        $game = GuessTheVoice::first();

        return view('admin.games.guess-the-voice.add-question', compact('game'));
    }

    public function editGuessTheVoiceQuestion($id)
    {

        $game = GuessTheVoice::first();

        $question = GuessTheVoiceQues::find($id);

        return view('admin.games.guess-the-voice.edit-question', compact('game', 'question'));
    }

    public function storeGuessTheVoiceQuestion(Request $request)
    {


        $rules = [

            'text' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'file'     => 'required',
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

        $gv = GuessTheVoiceQues::create([

            'text' => $request->text,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
        ]);

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $filename = time() . '.mp3';
            $file->move('audios', $filename);

            GuessTheVoiceQues::where('id', $gv->id)->update([
                'file' => $filename
            ]);
        }

        return redirect()->route('admin.guess-the-voice-questions')->with('success', 'Question added for game');
    }

    public function updateGuessTheVoiceQuestion(Request $request)
    {

        $rules = [

            'text' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'file'     => 'required',
            'correct_option' => 'required',

        ];

        $messages = [

            'text.required' => 'Please enter question',
            'option_1.required' => 'Please set first option',
            'option_2.required' => 'Please set second option',
            'option_3.required' => 'Please set third option',
            'option_4.required' => 'Please set fourth option',
            'correct_option.required' => 'Please choose correct option',
        ];

        $this->validate($request, $rules, $messages);

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $filename = time() . '.mp3';
            $file->move('audios', $filename);

            GuessTheVoiceQues::where('id', $request->id)->update([
                'file' => $filename
            ]);
        }


        LocalTriviaQues::where('id', $request->id)->update([

            'text' => $request->text,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,

        ]);

        return redirect()->route('admin.guess-the-voice-questions')->with('success', 'Question updated successfully');
    }

    public function deleteGuessTheVoiceQuestion(Request $request)
    {

        LocalTriviaQues::find($request->id)->delete();

        return redirect()->route('admin.guess-the-voice-questions')->with('success', 'Question deleted successfully!');
    }

    /*True False */

    public function trueFalse()
    {

        $game = TrueFalse::first();

        return view('admin.games.true-false.setup', compact('game'));
    }

    public function storeTrueFalse(Request $request)
    {


        $rules = [
            'name' => 'required',
            'question_limit' => 'required',
            'description' => 'required',
            'lifeline' => 'required',
            'rules' => 'required',
            'qualified_score' => 'required',
            'game_question_limit' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter game name',
            'question_limit.required' => 'Please enter question time limit',
            'description.required' => 'please enter description',
            'game_question_limit.required' => 'Please set no. of question per game',
            'lifeline.required' => 'Please enter number of lifelines',
            'qualified_score.required' => 'Please enter qualified score',
            'rules.required' => 'Please add rules',

        ];

        $this->validate($request, $rules, $messages);

        TrueFalse::updateOrCreate(
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

    public function trueFalseQuestions()
    {

        $game = TrueFalse::first();

        $questions = TrueFalseQues::all();

        return view('admin.games.true-false.question-list', compact('game', 'questions'));
    }

    public function addTrueFalseQuestion()
    {

        $game = TrueFalse::first();

        return view('admin.games.true-false.add-question', compact('game'));
    }

    public function editTrueFalseQuestion($id)
    {

        $game = TrueFalse::first();

        $question = TrueFalseQues::find($id);

        return view('admin.games.true-false.edit-question', compact('game', 'question'));
    }

    public function storeTrueFalseQuestion(Request $request)
    {

        $rules = [

            'statement' => 'required',
            'correct_option' => 'required',

        ];

        $messages = [

            'statement.required' => 'Please enter statement',
            'correct_option.required' => 'Please choose correct option',
        ];

        $this->validate($request, $rules, $messages);

        TrueFalseQues::create([

            'statement' => $request->statement,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
            'image'          =>  $request->file('image') ? "data:image/png;base64," . base64_encode(file_get_contents($request->file('image')))  : '',

        ]);

        return redirect()->route('admin.true-false-questions')->with('success', 'Question added for game');
    }

    public function updateTrueFalseQuestion(Request $request)
    {

        $rules = [

            'statement' => 'required',
            'correct_option' => 'required',

        ];

        $messages = [

            'statement.required' => 'Please enter statement',
            'correct_option.required' => 'Please choose correct option',
        ];

        $this->validate($request, $rules, $messages);

        $img = TrueFalseQues::find($request->id)->image;

        TrueFalseQues::where('id', $request->id)->update([

            'statement' => $request->statement,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
            'image'          =>  $request->file('image') ? "data:image/png;base64," . base64_encode(file_get_contents($request->file('image')))  : $img,

        ]);

        return redirect()->route('admin.true-false-questions')->with('success', 'Question updated successfully');
    }

    public function deleteTrueFalseQuestion(Request $request)
    {

        TrueFalseQues::find($request->id)->delete();

        return redirect()->route('admin.true-false-questions')->with('success', 'Question deleted successfully!');
    }


    //GroupGAMES

    public function groupGuessLocation()
    {

        $game = GroupGuessLocation::first();

        return view('admin.games.group.guess-the-location.setup', compact('game'));
    }


    public function storeGroupGuessLocation(Request $request)
    {


        $rules = [
            'name' => 'required',
            'question_limit' => 'required',
            'description' => 'required',
            'lifeline' => 'required',
            'rules' => 'required',
            'qualified_score' => 'required',
            'game_question_limit' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter game name',
            'question_limit.required' => 'Please enter question time limit',
            'description.required' => 'please enter description',
            'game_question_limit.required' => 'Please set no. of question per game',
            'lifeline.required' => 'Please enter number of lifelines',
            'qualified_score.required' => 'Please enter qualified score',
            'rules.required' => 'Please add rules',

        ];

        $this->validate($request, $rules, $messages);

        GroupGuessLocation::updateOrCreate(
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

    public function groupGuessLocationQues()
    {

        $game = GroupGuessLocation::first();

        $questions = GroupGuessLocationQues::all();

        return view('admin.games.group.guess-the-location.question-list', compact('game', 'questions'));
    }

    public function addGroupGuessLocationQues()
    {

        $game = GroupGuessLocation::first();

        return view('admin.games.group.guess-the-location.add-question', compact('game'));
    }

    public function editGroupGuessLocationQues($id)
    {

        $game = GroupGuessLocation::first();

        $question = GroupGuessLocationQues::find($id);

        return view('admin.games.group.guess-the-location.edit-question', compact('game', 'question'));
    }

    public function storeGroupGuessLocationQues(Request $request)
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

        GroupGuessLocationQues::create([

            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
            'image'          =>  $request->file('image') ? "data:image/png;base64," . base64_encode(file_get_contents($request->file('image')))  : '',

        ]);

        return redirect()->route('admin.group-guess-location-questions')->with('success', 'Question added for game');
    }

    public function updateGroupGuessLocationQues(Request $request)
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

        $img = GroupGuessLocationQues::find($request->id)->image;

        GroupGuessLocationQues::where('id', $request->id)->update([

            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
            'image'          =>  $request->file('image') ? "data:image/png;base64," . base64_encode(file_get_contents($request->file('image')))  : $img,

        ]);

        return redirect()->route('admin.group-guess-location-questions')->with('success', 'Question updated successfully');
    }

    public function deleteGroupGuessLocationQues(Request $request)
    {

        GroupGuessLocationQues::find($request->id)->delete();

        return redirect()->route('admin.group-guess-location-questions')->with('success', 'Question deleted successfully!');
    }

    /*GROUP GUESS CELEBRITY */

    public function groupGuessCelebrity()
    {

        $game = GroupGuessCelebrity::first();

        return view('admin.games.group.guess-the-celebrity.setup', compact('game'));
    }


    public function storeGroupGuessCelebrity(Request $request)
    {


        $rules = [
            'name' => 'required',
            'question_limit' => 'required',
            'description' => 'required',
            'lifeline' => 'required',
            'rules' => 'required',
            'qualified_score' => 'required',
            'game_question_limit' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter game name',
            'question_limit.required' => 'Please enter question time limit',
            'description.required' => 'please enter description',
            'game_question_limit.required' => 'Please set no. of question per game',
            'lifeline.required' => 'Please enter number of lifelines',
            'qualified_score.required' => 'Please enter qualified score',
            'rules.required' => 'Please add rules',

        ];

        $this->validate($request, $rules, $messages);

        GroupGuessCelebrity::updateOrCreate(
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

    public function groupGuessCelebrityQues()
    {

        $game = GroupGuessCelebrity::first();

        $questions = GroupGuessCelebrityQues::all();

        return view('admin.games.group.guess-the-celebrity.question-list', compact('game', 'questions'));
    }

    public function addGroupGuessCelebrityQues()
    {

        $game = GroupGuessCelebrity::first();

        return view('admin.games.group.guess-the-celebrity.add-question', compact('game'));
    }

    public function editGroupGuessCelebrityQues($id)
    {

        $game = GroupGuessCelebrity::first();

        $question = GroupGuessCelebrityQues::find($id);

        return view('admin.games.group.guess-the-celebrity.edit-question', compact('game', 'question'));
    }

    public function storeGroupGuessCelebrityQues(Request $request)
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

        GroupGuessCelebrityQues::create([

            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
            'image'          =>  $request->file('image') ? "data:image/png;base64," . base64_encode(file_get_contents($request->file('image')))  : '',

        ]);

        return redirect()->route('admin.group-guess-celebrity-questions')->with('success', 'Question added for game');
    }

    public function updateGroupGuessCelebrityQues(Request $request)
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

        $img = GroupGuessCelebrityQues::find($request->id)->image;

        GroupGuessCelebrityQues::where('id', $request->id)->update([

            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
            'image'          =>  $request->file('image') ? "data:image/png;base64," . base64_encode(file_get_contents($request->file('image')))  : $img,

        ]);

        return redirect()->route('admin.group-guess-celebrity-questions')->with('success', 'Question updated successfully');
    }

    public function deleteGroupGuessCelebrityQues(Request $request)
    {

        GroupGuessCelebrityQues::find($request->id)->delete();

        return redirect()->route('admin.group-guess-location-questions')->with('success', 'Question deleted successfully!');
    }

    /** GROUP GUESS THE VOICE */

    public function groupGuessVoice()
    {

        $game = GroupGuessVoice::first();

        return view('admin.games.group.guess-the-voice.setup', compact('game'));
    }


    public function storeGroupGuessVoice(Request $request)
    {


        $rules = [
            'name' => 'required',
            'question_limit' => 'required',
            'description' => 'required',
            'lifeline' => 'required',
            'rules' => 'required',
            'qualified_score' => 'required',
            'game_question_limit' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter game name',
            'question_limit.required' => 'Please enter question time limit',
            'description.required' => 'please enter description',
            'game_question_limit.required' => 'Please set no. of question per game',
            'lifeline.required' => 'Please enter number of lifelines',
            'qualified_score.required' => 'Please enter qualified score',
            'rules.required' => 'Please add rules',

        ];

        $this->validate($request, $rules, $messages);

        GroupGuessVoice::updateOrCreate(
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

    public function groupGuessVoiceQues()
    {

        $game = GroupGuessVoice::first();

        $questions = GroupGuessVoiceQues::all();

        return view('admin.games.group.guess-the-voice.question-list', compact('game', 'questions'));
    }

    public function addGroupGuessVoiceQues()
    {

        $game = GroupGuessVoice::first();

        return view('admin.games.group.guess-the-voice.add-question', compact('game'));
    }

    public function editGroupGuessVoiceQues($id)
    {

        $game = GroupGuessVoice::first();

        $question = GroupGuessVoiceQues::find($id);

        return view('admin.games.group.guess-the-voice.edit-question', compact('game', 'question'));
    }

    public function storeGroupGuessVoiceQues(Request $request)
    {

        $rules = [

            'question' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'file'    => 'required',
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

        $gv = GroupGuessVoiceQues::create([

            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,

        ]);


        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $filename = time() . '.mp3';
            $file->move('audios', $filename);

            GuessTheVoiceQues::where('id', $gv->id)->update([
                'file' => $filename
            ]);
        }

        return redirect()->route('admin.group-guess-voice-questions')->with('success', 'Question added for game');
    }

    public function updateGroupGuessVoiceQues(Request $request)
    {

        $rules = [

            'question' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'file'     => 'required',
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

        $img = GroupGuessVoiceQues::find($request->id)->image;

        GroupGuessVoiceQues::where('id', $request->id)->update([

            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_option' => $request->correct_option,
            'status'         =>  $request->status,
            'image'          =>  $request->file('image') ? "data:image/png;base64," . base64_encode(file_get_contents($request->file('image')))  : $img,

        ]);


        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $filename = time() . '.mp3';
            $file->move('audios', $filename);

            GuessTheVoiceQues::where('id', $request->id)->update([
                'file' => $filename
            ]);
        }

        return redirect()->route('admin.group-guess-voice-questions')->with('success', 'Question updated successfully');
    }

    public function deleteGroupGuessVoiceQues(Request $request)
    {

        GroupGuessVoiceQues::find($request->id)->delete();

        return redirect()->route('admin.group-guess-voice-questions')->with('success', 'Question deleted successfully!');
    }

    /** GROUP GROG WHEEl */

    public function groupGrogWheel()
    {

        $game = GroupGrogWheel::first();

        return view('admin.games.group.group-grog-wheel.setup', compact('game'));
    }


    public function storeGroupGrogWheel(Request $request)
    {


        $rules = [
            'name' => 'required',
            'description' => 'required',
            'game_question_limit' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter game name',
            'description.required' => 'please enter description',
            'game_question_limit.required' => 'Please set no. of question per game',
        ];

        $this->validate($request, $rules, $messages);

        GroupGuessVoice::updateOrCreate(
            ['id' => $request->game_id],
            [
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'game_question_limit' => $request->game_question_limit
            ]
        );

        return redirect()->back()->with('success', 'Game setup updated');
    }

    public function GroupGrogWheelQues()
    {

        $game = GroupGrogWheel::first();

        $questions = GroupGrogWheelQues::all();

        return view('admin.games.group.group-grog-wheel.question-list', compact('game', 'questions'));
    }

    public function addGroupGrogWheelQues()
    {

        $game = GroupGrogWheel::first();

        return view('admin.games.group.group-grog-wheel.add-question', compact('game'));
    }

    public function editGroupGrogWheelQues($id)
    {

        $game = GroupGrogWheel::first();

        $question = GroupGrogWheelQues::find($id);

        return view('admin.games.group.group-grog-wheel.edit-question', compact('game', 'question'));
    }

    public function storeGroupGrogWheelQues(Request $request)
    {

        $rules = [

            'name' => 'required',
            'task' => 'required',

        ];

        $messages = [

            'name.required' => 'Please enter name',
            'task.required' => 'Please enter task',
        ];

        $this->validate($request, $rules, $messages);

        $gv = GroupGrogWheelQues::create([

            'name'   => $request->name,
            'task' =>  $request->task,

        ]);

        return redirect()->route('admin.group-grog-wheel-questions')->with('success', 'Question added for game');
    }

    public function updateGroupGrogWheelQues(Request $request)
    {

        $rules = [

            'task' => 'required',
            'name' => 'required',
        ];

        $messages = [

            'name.required' => 'Please enter name',
            'task.required' => 'Please enter task',
        ];

        $this->validate($request, $rules, $messages);

        GroupGrogWheelQues::where('id', $request->id)->update([

            'name' => $request->name,
            'task' => $request->task,
        ]);

        return redirect()->route('admin.group-grog-wheel-questions')->with('success', 'Question updated successfully');
    }

    public function deleteGroupGrogWheelQues(Request $request)
    {

        GroupGrogWheelQues::find($request->id)->delete();

        return redirect()->route('admin.group-grog-wheel-questions')->with('success', 'Question deleted successfully!');
    }
}
