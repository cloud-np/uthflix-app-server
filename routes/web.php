<?php

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
use App\Http\Controllers\SeriMoviesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GernesController;

Route::get('/', function () {
    // return "hello Laravel";
    return view('index');
});

// Series routes.
Route::get('/series', [SeriMoviesController::class, 'index']);
Route::get('/series/{id}', [SeriMoviesController::class, 'show']);

// Series routes.
Route::get('/gernes', [GernesController::class, 'index']);
Route::get('/gernes/{id}', [GernesController::class, 'show']);

// Users routes.
// Route::get('/users', [UsersController::class, 'index']);
// Route::get('/users/id={id}', [UsersController::class, 'show']);
Route::post('/users/findUserByEmail', [UsersController::class, 'indexWithEmail']);