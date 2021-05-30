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
// use App\Http\Controllers\SeriMovieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GerneController;

Route::get('/', function () {
    // return "hello Laravel";
    return view('index');
});

// Series routes.
// Route::get('/series', [SeriMovieController::class, 'index']);
// Route::get('/series/{id}', [SeriMovieController::class, 'show']);

// Series routes.
Route::get('/gernes', [GerneController::class, 'index']);
Route::get('/gernes/{id}', [GerneController::class, 'show']);

// Users routes.
// Route::get('/users', [UsersController::class, 'index']);
// Route::get('/users/id={id}', [UsersController::class, 'show']);
Route::get('/users/findUserByEmail', [UserController::class, 'indexWithEmail']);
Route::post('/users/register', [UserController::class, 'store']);
Route::post('/users/update', [UserController::class, 'update']);
Route::post('/users/login', [UserController::class, 'login']);
Route::post('/users/delete', [UserController::class, 'delete']);
Route::post('/users/get-users', [UserController::class, 'get_users']);