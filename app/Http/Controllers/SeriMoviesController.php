<?php

namespace App\Http\Controllers;

use App\Models\Episodes;
use App\Models\Seasons;
use App\Models\SeriMovies;
use Exception;
use Illuminate\Http\Request;


function store_seasons($req, $serimovies_id){
    // Seasons
    foreach($req->input("seasons") as $given_season){
        // Season
        $season = new Seasons();
        $season->release_date = isset($given_season["release_date"]) ? $given_season["release_date"] : null;
        $season->serimovies_id = $serimovies_id;
        $season->save();
        $season_id = $season->id;
        foreach($given_season["episodes"] as $episode){
            // Video
            $video_id = VideosController::store_video($req, $episode);
            // Episode
            EpisodesController::store_episode($season_id, $serimovies_id, $video_id, isset($episode["name"]) ? $episode['name'] : null);
        }
    }
}

function store_serimovie($req){
    $serimovie = new SeriMovies();
    $serimovie->name = $req->input("name");
    $serimovie->release_date = $req->input("release_date");
    $serimovie->overview = $req->input("overview");
    $serimovie->is_movie = $req->input("isMovie");
    $serimovie->user_id = (int) $req->input("user_id");
    $serimovie->img_url = $req->input("img_url");
    $serimovie->save();
    return $serimovie->id;
}

class SeriMoviesController extends Controller
{
    // The raw SQL statement could be something like that:
    // INSERT INTO SeriMovies (id, username, is_admin .... ) VALUES (1, Cloud, 0 .... ) ;
    // NOTE: Later on we should hash this password in a real world scenario.
    public function store(Request $req) {
        try{
            if($req->input("isMovie") === 1){
                // Video 
                $video_id = VideosController::store_video($req);

                // SeriMovie
                $serimovie_id = store_serimovie($req);

                // Season
                $season = new Seasons();
                $season->release_date = null;
                $season->serimovies_id = $serimovie_id;
                $season->save();
                $season_id = $season->id;

                // Episode
                EpisodesController::store_episode($season_id, $serimovie_id, $video_id, $req->input("episode")['name']);
                
            }else if($req->input("isMovie") === 0){
                // SeriMovie
                $serimovie_id = store_serimovie($req);
                store_seasons($req, $serimovie_id);
            }
            // Crew
            CrewMembersController::store_crew($req, $serimovie_id);
            // Serimovies Genres
            GenresController::store_serimovies_genres($req, $serimovie_id);
        }catch(exception $e){
            return $e;
        }
        return 'OK';
    }

    public function get_reviews($id){
        try{
            // SeriMovies::destroy($req->input("serimovies_id"));
            $serimovies = Episodes::where("serimovies_id", $id)
                          ->join("videos", "videos.id", "=", "episodes.video_id")
                          ->join("comments", "comments.video_id", "=", "videos.id")
                          ->get();
            $review_sum = 0;
            foreach($serimovies as $serimovie){
                $review_sum += $serimovie["review"];
            }

            return ["review_sum" => $review_sum, "n_comments" => count($serimovies), "review" => $review_sum / count($serimovies)];
        }catch(Exception $e){
            return $e;
        }
    }

    public function delete(Request $req){
        try{
            SeriMovies::destroy($req->input("serimovies_id"));
            return "OK";
        }catch(Exception $e){
            return $e;
        }
    }
    
    public function serimovies_by_name($name){
        try{
            return SeriMovies::where("name", $name)->get();
        }catch(Exception $e){
            return $e;
        }
    }

    public function get_by_dates(Request $req){
        try{
            $serimovies = SeriMovies::whereBetween('release_date', [$req->input("startDate"), $req->input("endDate")])->get();
            return $serimovies;
        }catch(Exception $e){
            return $e;
        }
    }

    public function delete_season(Request $req){
        try{
            Seasons::destroy($req->input("season_id"));
            return "OK";
        }catch(Exception $e){
            return $e;
        }
    }

    public function register_season(Request $req){
        try{
            store_seasons($req, $req->input("serimovies_id"));
            return "OK";
        }catch(Exception $e){
            return $e;
        }
    }

    public function update(Request $req){
        try{
            $serimovie = SeriMovies::find($req->input('id'));
            $valid_keys = ['img_url', 'name', 'overview', 'release_date'];
            if ($serimovie != NULL){
                foreach($req->all() as $key => $value){
                    if(!in_array($key, $valid_keys))
                        continue;
                    else
                        $serimovie->update([$key => $value]);
                }
                $serimovie->update(['updated_at' => now()]);
            }
        }catch(Exception $e){
            return $e;
        }
    }

    public function get_series(){
        return SeriMovies::where("is_movie", 0)->get();
    }

    public function get_movies(){
        return SeriMovies::where("is_movie", 1)->get();
    }
}
