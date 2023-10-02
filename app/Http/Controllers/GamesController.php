<?php

namespace App\Http\Controllers;

use App\Models\Jokes;
use App\Models\JokesCategory;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function home()
    {

        $_jokes = Jokes::with('user')->where('status', 1)->inRandomOrder()->take(10)->get();

        $jokes_category = JokesCategory::where('status',1)->get();

        $jokes = [];
        

        if (count($_jokes)) {
            foreach ($_jokes as $j) {
                $jokes[] = [
                    'label' => $j->user->name,
                    'value' => $j->joke,
                ];
            }
        }
        
        return view('index', compact('jokes','jokes_category'));
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
}
