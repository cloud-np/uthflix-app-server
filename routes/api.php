<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// use App\Http\Controllers\SeriMoviesController;
// use App\Http\Controllers\GernesController;
// use App\Http\Controllers\UsersController;
// Route::post('/users/findUserByEmail', [UsersController::class, 'indexWithEmail']);

// Route::get('/', function () {
//     // return "hello Laravel";
//     return view('index');
// });

// // Series routes.
// Route::get('/series', [SeriMoviesController::class, 'index']);
// Route::get('/series/{id}', [SeriMoviesController::class, 'show']);

// // Series routes.
// Route::get('/gernes', [GernesController::class, 'index']);
// Route::get('/gernes/{id}', [GernesController::class, 'show']);

// // Users routes.
// // Route::get('/users', [UsersController::class, 'index']);
// Route::get('/users/id={id}', [UsersController::class, 'show']);