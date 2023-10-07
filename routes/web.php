<?php

use App\Http\Controllers\GamesController;
use App\Http\Controllers\JokesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GamesController::class, 'home']);

Route::get('games', [GamesController::class, 'index'])->name('games');
Route::get('breakout', [GamesController::class, 'breakout'])->name('breakout');
Route::get('tic-tac-toe', [GamesController::class, 'tictactoe'])->name('tic-tac-toe');
Route::get('matching', [GamesController::class, 'matching'])->name('matching');
Route::get('rock-paper-scissor', [GamesController::class, 'rockpaper'])->name('rock-paper-scissor');
Route::get('planet-defence', [GamesController::class, 'planetDefence'])->name('planet-defence');


/* JOKES ROUTE */

Route::get('jokes', [JokesController::class, 'front'])->name('jokes');

// Route::get('/dashboard', function () {
//     return view('admin.auth.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

//require __DIR__ . '/auth.php';


Route::get('game-trivia', [GamesController::class, 'viewTriviaGame'])->name('game-trivia');
Route::post('save-leader',[GamesController::class,'saveLeader'])->name('save-leader');
Route::post('enable-leader',[GamesController::class,'enableLeader'])->name('enable-leader');

