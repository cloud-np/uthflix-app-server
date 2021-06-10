<?php

namespace App\Http\Controllers;

use App\Models\Episodes;
use App\Models\Videos;
use Exception;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public static function store_episode($season_id, $serimovies_id, $video_id, $episode_name) {
        $episode = new Episodes();
        $episode->name = $episode_name;
        $episode->serimovies_id = $serimovies_id;
        $episode->season_id = $season_id;
        $episode->video_id = $video_id;
        $episode->save();
    }

    public function delete(Request $req){
        try{
            Episodes::destroy($req->input("episode_id"));
            Videos::destroy($req->input("video_id"));
            return "OK";
        }catch(Exception $e){
            return $e;
        }
    }

    public function show($id){
        return Episodes::where("video_id", $id)->get()[0];
    }
}
