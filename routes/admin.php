<?php

use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\MyAccountController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GamesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\JokesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

  /*
    |--------------------------------------------------------------------------
    | Authentication Routes | LOGIN | REGISTER
    |--------------------------------------------------------------------------
    */

  Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
  Route::post('login', [LoginController::class, 'login'])->name('login.submit');
  Route::post('logout', [LoginController::class, 'logout'])->name('logout');

  Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
  Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
  Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
  Route::post('password/update', [ResetPasswordController::class, 'reset'])->name('password.update');


  /*
    |--------------------------------------------------------------------------
    | Dashboard Route
    |--------------------------------------------------------------------------
    */
  Route::get('dashboard',  [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


  /*
    |--------------------------------------------------------------------------
    | Settings > My Account Route
    |--------------------------------------------------------------------------
    */
  Route::resource('my-account', MyAccountController::class);

  /*
    |--------------------------------------------------------------------------
    | Settings > Change Password Route
    |--------------------------------------------------------------------------
    */
  Route::get('change-password', [ChangePasswordController::class, 'changePasswordForm'])->name('password.form');

  Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');

  /*
    |--------------------------------------------------------------------------
    | Settings > Users Route
    |--------------------------------------------------------------------------
    */

  Route::get('users', [UserController::class, 'index'])->name('users.index');
  Route::get('userlogin/{id}', [UserController::class, 'userlogin'])->name('userlogin');
  Route::post('adduser', [UserController::class, 'addUser'])->name('adduser');
  Route::post('deleteUser', [UserController::class, 'deleteUser'])->name('deleteUser');
  Route::post('markuser', [UserController::class, 'markuser'])->name('markuser');

  /*
    |--------------------------------------------------------------------------
    | Settings > Jokes Route
    |--------------------------------------------------------------------------
    */
  Route::get('jokes', [JokesController::class, 'adminJokes'])->name('jokes');
  Route::get('view-joke/{id}', [JokesController::class, 'viewJoke'])->name('view-joke');
  Route::post('edit-joke', [JokesController::class, 'editJoke'])->name('edit-joke');
  Route::post('mark-joke', [JokesController::class, 'markJoke'])->name('mark-joke');
  Route::post('delete-joke', [JokesController::class, 'deleteJoke'])->name('delete-joke');
  Route::get('jokes-categories', [JokesController::class, 'adminJokesCategories'])->name('jokes.categories');

  /*
    |--------------------------------------------------------------------------
    | Settings > Joke Category Route
    |--------------------------------------------------------------------------
    */

  Route::post('add_category', [JokesController::class, 'addJokeCategory'])->name('add_category');
  Route::post('edit_category', [JokesController::class, 'editJokeCategory'])->name('edit_category');
  Route::post('delete_category', [JokesController::class, 'deleteCategory'])->name('delete_category');

  /*
    |--------------------------------------------------------------------------
    | Settings > Joke Category Route
    |--------------------------------------------------------------------------
    */
  /* Local Trivia */

  Route::get('local-trivia', [GamesController::class, 'localTrivia'])->name('local-trivia');
  Route::post('store-trivia', [GamesController::class, 'storeTrivia'])->name('store-trivia');
  Route::get('trivia-questions', [GamesController::class, 'triviaQuestions'])->name('trivia-questions');
  Route::get('add-trivia-question', [GamesController::class, 'addTriviaQuestion'])->name('add-trivia-question');
  Route::post('store-trivia-question', [GamesController::class, 'storeTriviaQuestion'])->name('store-trivia-question');
  Route::get('edit-trivia-question/{id}', [GamesController::class, 'editTriviaQuestion'])->name('edit-trivia-question');
  Route::post('update-trivia-question', [GamesController::class, 'updateTriviaQuestion'])->name('update-trivia-question');
  Route::post('delete-trivia-question', [GamesController::class, 'deleteTriviaQuestion'])->name('delete-trivia-question');

  /* True false Game */

  Route::get('true-false', [GamesController::class, 'trueFalse'])->name('true-false');
  Route::post('store-true-false', [GamesController::class, 'storeTrueFalse'])->name('store-true-false');
  Route::get('true-false-questions', [GamesController::class, 'trueFalseQuestions'])->name('true-false-questions');
  Route::get('add-true-false-question', [GamesController::class, 'addTrueFalseQuestion'])->name('add-true-false-question');
  Route::post('store-true-false--question', [GamesController::class, 'storeTrueFalseQuestion'])->name('store-true-false-question');
  Route::get('edit-true-false-question/{id}', [GamesController::class, 'editTrueFalseQuestion'])->name('edit-true-false-question');
  Route::post('update-true-false-question', [GamesController::class, 'updateTrueFalseQuestion'])->name('update-true-false-question');
  Route::post('delete-true-false-question', [GamesController::class, 'deleteTrueFalseQuestion'])->name('delete-true-false-question');

  /* Guess The Voice */

  Route::get('guess-the-voice', [GamesController::class, 'guessTheVoice'])->name('guess-the-voice');
  Route::post('store-guess-the-voice', [GamesController::class, 'storeGuessTheVoice'])->name('store-guess-the-voice');
  Route::get('guess-the-voice-questions', [GamesController::class, 'guessTheVoiceQuestions'])->name('guess-the-voice-questions');
  Route::get('add-guess-the-voice-question', [GamesController::class, 'addGuessTheVoiceQuestion'])->name('add-guess-the-voice-question');
  Route::post('store-guess-the-voice-question', [GamesController::class, 'storeGuessTheVoiceQuestion'])->name('store-guess-the-voice-question');
  Route::get('edit-guess-the-voice-question/{id}', [GamesController::class, 'editGuessTheVoiceQuestion'])->name('edit-guess-the-voice-question');
  Route::post('update-guess-the-voice-question', [GamesController::class, 'updateGuessTheVoiceQuestion'])->name('update-guess-the-voice-question');
  Route::post('delete-guess-the-voice-question', [GamesController::class, 'deleteGuessTheVoiceQuestion'])->name('delete-guess-the-voice-question');

  /* Guess The Local Celebrity */

  Route::get('guess-local-celebrity', [GamesController::class, 'guessLocalCelebrity'])->name('guess-local-celebrity');
  Route::post('store-guess-local-celebrity', [GamesController::class, 'storeGuessLocalCelebrity'])->name('store-guess-local-celebrity');
  Route::get('guess-local-celebrity-questions', [GamesController::class, 'guessLocalCelebrityQuestions'])->name('guess-local-celebrity-questions');
  Route::get('add-guess-local-celebrity-question', [GamesController::class, 'addGuessLocalCelebrityQuestion'])->name('add-guess-local-celebrity-question');
  Route::post('store-guess-local-celebrity-question', [GamesController::class, 'storeGuessLocalCelebrityQuestion'])->name('store-guess-local-celebrity-question');
  Route::get('edit-guess-local-celebrity-question/{id}', [GamesController::class, 'editGuessLocalCelebrityQuestion'])->name('edit-guess-local-celebrity-question');
  Route::post('update-guess-local-celebrity-question', [GamesController::class, 'updateGuessLocalCelebrityQuestion'])->name('update-guess-local-celebrity-question');
  Route::post('delete-guess-local-celebrity-question', [GamesController::class, 'deleteGuessLocalCelebrityQuestion'])->name('delete-guess-local-celebrity-question');


  /*
    |--------------------------------------------------------------------------
    | Group Games
    |--------------------------------------------------------------------------
    */

  /* Guess The Location */

  Route::get('group-guess-location', [GamesController::class, 'groupGuessLocation'])->name('group-guess-location');
  Route::post('store-group-guess-location', [GamesController::class, 'storegroupGuessLocation'])->name('store-group-guess-location');
  Route::get('group-guess-location-questions', [GamesController::class, 'groupGuessLocationQues'])->name('group-guess-location-questions');
  Route::get('add-group-guess-location-question', [GamesController::class, 'addGroupGuessLocationQues'])->name('add-group-guess-location-question');
  Route::post('store-group-guess-location-question', [GamesController::class, 'storeGroupGuessLocationQues'])->name('store-group-guess-location-question');
  Route::get('edit-group-guess-location-question/{id}', [GamesController::class, 'editGroupGuessLocationQues'])->name('edit-group-guess-location-question');
  Route::post('update-group-guess-location-question', [GamesController::class, 'updateGroupGuessLocationQues'])->name('update-group-guess-location-question');
  Route::post('delete-group-guess-location-question', [GamesController::class, 'deleteGroupGuessLocationQues'])->name('delete-group-guess-location-question');


  /* Guess The Celebrity */

  Route::get('group-guess-celebrity', [GamesController::class, 'groupGuessCelebrity'])->name('group-guess-celebrity');
  Route::post('store-group-guess-celebrity', [GamesController::class, 'storegroupGuessCelebrity'])->name('store-group-guess-celebrity');
  Route::get('group-guess-celebrity-questions', [GamesController::class, 'groupGuessCelebrityQues'])->name('group-guess-celebrity-questions');
  Route::get('add-group-guess-celebrity-question', [GamesController::class, 'addGroupGuessCelebrityQues'])->name('add-group-guess-celebrity-question');
  Route::post('store-group-guess-celebrity-question', [GamesController::class, 'storeGroupGuessCelebrityQues'])->name('store-group-guess-celebrity-question');
  Route::get('edit-group-guess-celebrity-question/{id}', [GamesController::class, 'editGroupGuessCelebrityQues'])->name('edit-group-guess-celebrity-question');
  Route::post('update-group-guess-celebrity-question', [GamesController::class, 'updateGroupGuessCelebrityQues'])->name('update-group-guess-celebrity-question');
  Route::post('delete-group-guess-celebrity-question', [GamesController::class, 'deleteGroupGuessCelebrityQues'])->name('delete-group-guess-celebrity-question');

  /* Guess The Voice */

  Route::get('group-guess-voice', [GamesController::class, 'groupGuessVoice'])->name('group-guess-voice');
  Route::post('store-group-guess-voice', [GamesController::class, 'storeGroupGuessVoice'])->name('store-group-guess-voice');
  Route::get('group-guess-voice-questions', [GamesController::class, 'GroupGuessVoiceQues'])->name('group-guess-voice-questions');
  Route::get('add-group-guess-voice-question', [GamesController::class, 'addGroupGuessVoiceQues'])->name('add-group-guess-voice-question');
  Route::post('store-group-guess-voice-question', [GamesController::class, 'storeGroupGuessVoiceQues'])->name('store-group-guess-voice-question');
  Route::get('edit-group-guess-voice-question/{id}', [GamesController::class, 'editGroupGuessVoiceQues'])->name('edit-group-guess-voice-question');
  Route::post('update-group-guess-voice-question', [GamesController::class, 'updateGroupGuessVoiceQues'])->name('update-group-guess-voice-question');
  Route::post('delete-group-guess-voice-question', [GamesController::class, 'deleteGroupGuessVoiceQues'])->name('delete-group-guess-voice-question');

  /*Group Grog wheel */

  Route::get('group-grog-wheel', [GamesController::class, 'groupGrogWheel'])->name('group-grog-wheel');
  Route::post('store-group-grog-wheel', [GamesController::class, 'storeGroupGrogWheel'])->name('store-group-grog-wheel');
  Route::get('group-grog-wheel-questions', [GamesController::class, 'GroupGrogWheelQues'])->name('group-grog-wheel-questions');
  Route::get('add-group-grog-wheel-question', [GamesController::class, 'addGroupGrogWheelQues'])->name('add-group-grog-wheel-question');
  Route::post('store-group-grog-wheel-question', [GamesController::class, 'storeGroupGrogWheelQues'])->name('store-group-grog-wheel-question');
  Route::get('edit-group-grog-wheel-question/{id}', [GamesController::class, 'editGroupGrogWheelQues'])->name('edit-group-grog-wheel-question');
  Route::post('update-group-grog-wheel-question', [GamesController::class, 'updateGroupGrogWheelQues'])->name('update-group-grog-wheel-question');
  Route::post('delete-group-grog-wheel-question', [GamesController::class, 'deleteGroupGrogWheelQues'])->name('delete-group-grog-wheel-question');

});
