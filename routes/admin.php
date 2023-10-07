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

  Route::get('local-trivia', [GamesController::class, 'localTrivia'])->name('local-trivia');
  Route::post('store-trivia', [GamesController::class, 'storeTrivia'])->name('store-trivia');
  Route::get('trivia-questions', [GamesController::class, 'triviaQuestions'])->name('trivia-questions');
  Route::get('add-trivia-question', [GamesController::class, 'addTriviaQuestion'])->name('add-trivia-question');
  Route::post('store-trivia-question', [GamesController::class, 'storeTriviaQuestion'])->name('store-trivia-question');
  Route::get('edit-trivia-question/{id}', [GamesController::class, 'editTriviaQuestion'])->name('edit-trivia-question');
  Route::post('update-trivia-question', [GamesController::class, 'updateTriviaQuestion'])->name('update-trivia-question');
  Route::post('delete-trivia-question', [GamesController::class, 'deleteTriviaQuestion'])->name('delete-trivia-question');
});
