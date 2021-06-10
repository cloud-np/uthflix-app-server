<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use App\Models\SeriMovies;
use App\Models\SeriMoviesGenres;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenresController extends Controller
{
    public function get_genres() {
        return Genres::all(); 
    }

    public function register(Request $req) {
        try {
            GenresController::store_serimovies_genres($req, $req->input('serimovies_id'));
            return "OK";
        }catch(Exception $e){
            return $e;
        }
    }

    public static function store_serimovies_genres($req, $serimovies_id){
        if($req->has("genres") && count($req->input("genres")) > 0){
            foreach($req->input("genres") as $genre){
                $serimovies_genres = new SeriMoviesGenres();
                $genres_found = DB::select('select * from genres where name = ?', [$genre["name"]]);
                $serimovies_genres->serimovies_id = $serimovies_id;
                $serimovies_genres->genre_id = $genres_found[0]->id;
                $serimovies_genres->save();
            }
        }
    }



    public function delete(Request $req) {
        try {
            SeriMoviesGenres::where('serimovies_id', $req->input('serimovies_id'))
            ->where('genre_id', $req->input('genre_id'))->delete();
            return "OK";
        }catch(Exception $e){
            return $e;
        }
    }

    public function get_serimovies_genres(Request $req) {
        if ($req->has("serimovies_id")){
            try {
                $serimovies = SeriMoviesGenres::where("serimovies_id", $req->input("serimovies_id"))
                              ->join("genres", "genres.id", "=", "serimovies_genres.genre_id")
                              ->get();
            }catch(Exception $e){
                return $e;
            }
            return $serimovies;
        } else {
            return "No serimovie_id provided.";
        }
    }

    public function genres_by_names(Request $req) {
        if ($req->has("genres")){
            try {
                $serimovies = [];
                foreach($req->input("genres") as $given_genre){
                    $genre = Genres::where("name", strtolower($given_genre["name"]))->get();

                    if (count($genre) === 0)
                        return "CANT FIND GENRE NAME: " . $genre;

                    $tmp = DB::table("serimovies_genres")
                                  ->where("genre_id", $genre[0]["id"])
                                  ->join("serimovies", "serimovies.id", "=", "serimovies_genres.serimovies_id")
                                  ->get();
                    array_push($serimovies, $tmp);
                }
            }catch(Exception $e){
                return $e;
            }
            return $serimovies;
        }
        return "NO GENRES PROVIDED";
    }

    public function genres_by_name(Request $req) {
        if ($req->has("genre")){
            try {
                $genre = Genres::where("name", strtolower($req->input("genre")))->get();
                if (count($genre) === 0)
                    return "NOT FOUND Genre";
                $serimovies = DB::table("serimovies_genres")
                              ->where("genre_id", $genre[0]["id"])
                              ->join("serimovies", "serimovies.id", "=", "serimovies_genres.serimovies_id")
                              ->get();
            }catch(Exception $e){
                return $e;
            }
            return $serimovies;
        }
        return "NO Genre NAME PROVIDED";
    }
}
