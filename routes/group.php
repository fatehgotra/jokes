<?php

use App\Http\Controllers\GamesController;
use App\Http\Controllers\GroupGamesController;
use App\Http\Controllers\JokesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'group', 'as' => 'group.'], function () {

    Route::middleware('IsGroup')->group(function () {

        Route::get('group-login',   [GroupGamesController::class, 'groupLogin'])->name('group-login');
        Route::post('group-login',   [GroupGamesController::class, 'groupValid'])->name('group-login');
        Route::get('group-signup',  [GroupGamesController::class, 'groupSignup'])->name('group-signup');
        Route::post('signup-1',     [GroupGamesController::class, 'signUpStep1'])->name('signup-1');
        Route::post('signup-2',     [GroupGamesController::class, 'signUpStep2'])->name('signup-2');
        Route::get('group-members', [GroupGamesController::class, 'groupMembers'])->name('group-members');
        Route::post('group-logout', [GroupGamesController::class, 'logout'])->name('group-logout');
        Route::get('guess-the-location', [GroupGamesController::class, 'GuessTheLoc'])->name('guess-the-location');
        Route::get('grog-spin-the-wheel', [GroupGamesController::class, 'GrogWheel'])->name('grog-spin-the-wheel');
        Route::get('guess-the-voice', [GroupGamesController::class, 'GuessVoice'])->name('guess-the-voice');
        Route::get('guess-local-celebrity', [GroupGamesController::class, 'GuessCelebrity'])->name('guess-local-celebrity');
        Route::get('this-or-that', [GroupGamesController::class, 'ThisThat'])->name('this-or-that');
        Route::get('do-or-drink', [GroupGamesController::class, 'DoDrink'])->name('do-or-drink');
    });
});
