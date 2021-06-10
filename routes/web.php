<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CrewMembersController;
use App\Http\Controllers\EpisodesController;
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
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\SeriMoviesController;
use App\Http\Controllers\VideosController;

Route::get('/', function () {
    // return "hello Laravel";
    return view('index');
});

// SeriMovies
Route::post('/serimovies/register', [SeriMoviesController::class, 'store']);
Route::post('/serimovies/update', [SeriMoviesController::class, 'update']);
Route::post('/serimovies/delete', [SeriMoviesController::class, 'delete']);
Route::get('/serimovies/get-movies', [SeriMoviesController::class, 'get_movies']);
Route::get('/serimovies/by-name/{name}', [SeriMoviesController::class, 'serimovies_by_name']);
Route::get('/serimovies/get-series', [SeriMoviesController::class, 'get_series']);
Route::get('/serimovies/reviews/{id}', [SeriMoviesController::class, 'get_reviews']);
Route::post('/serimovies/by-dates', [SeriMoviesController::class, 'get_by_dates']);
// SeriMovies-Seasons
Route::post('/serimovies/season/register', [SeriMoviesController::class, 'register_season']);
Route::post('/serimovies/season/delete', [SeriMoviesController::class, 'delete_season']);

// Genres 
Route::get('/genres/get-genres', [GenresController::class, 'get_genres']);
Route::post('/genres/serimovies-genres', [GenresController::class, 'get_serimovies_genres']);
Route::post('/genres/by-name', [GenresController::class, 'genres_by_name']);
Route::post('/genres/by-names', [GenresController::class, 'genres_by_names']);
Route::post('/genres/delete', [GenresController::class, 'delete']);
Route::post('/genres/register', [GenresController::class, 'register']);

// Video 
Route::post('/videos/fetch-videos-from-serimovie', [VideosController::class, 'fetch_videos_from_serimovie']);
Route::get('/videos/id/{id}', [VideosController::class, 'show']);

// Episodes
Route::get('/episodes/id/{id}', [EpisodesController::class, 'show']);
Route::post('/episodes/delete', [EpisodesController::class, 'delete']);

// Favorites
Route::post('/favorites/register', [UserController::class, 'register_favorite']);
Route::post('/favorites/delete', [UserController::class, 'delete_favorite']);
Route::post('/favorites/find-favorite', [UserController::class, 'find_favorite']);
Route::get('/favorites/user-favorites/{id}', [UserController::class, 'user_favorites']);

// Comments
Route::get('/comments/by-video-id/{id}', [CommentsController::class, 'fetch_comments_by_video_id']);
Route::post('/comments/register', [CommentsController::class, 'store']);

// Crew
Route::get('/crew/fetch-crew-from-serimovie/{id}', [CrewMembersController::class, 'fetch_crew_from_serimovie']);
Route::get('/crew/by-all/{crew}', [CrewMembersController::class, 'get_by_all']);
Route::post('/crew/delete/', [CrewMembersController::class, 'delete']);

// Users
Route::get('/users/findUserByEmail', [UserController::class, 'indexWithEmail']);
Route::post('/users/register', [UserController::class, 'store']);
Route::post('/users/update', [UserController::class, 'update']);
Route::post('/users/login', [UserController::class, 'login']);
Route::post('/users/delete', [UserController::class, 'delete']);
Route::post('/users/get-users', [UserController::class, 'get_users']);