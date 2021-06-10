<?php

namespace App\Http\Controllers;

use App\Models\Episodes;
use App\Models\Seasons;
use App\Models\Videos;
use Exception;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public static function store_video($req, $episode = null){
        try{
            if($episode === NULL)
                $given_episode = $req->input("episode");
            else
                $given_episode = $episode;

            $video_arr = ['release_date' => '', 'trailer_url' => '', 'img_url' => '', 'duration' => ''];

            foreach($video_arr as $key => $value){
                if($key === 'duration')
                    $video_arr[$key] = (int) $given_episode["duration"];
                else
                    $video_arr[$key] = isset($given_episode[$key])  ? $given_episode[$key] : null;
            }
            $video = Videos::create($video_arr);
            $video->save();
            return $video->id;
        }catch(Exception $e){
            return $e;
        }
    }

    public function fetch_videos_from_serimovie(Request $req){
        $all_seasons = Seasons::where("serimovies_id", $req->input("serimovies_id"))->get();
        $all_episodes = [];
        $all_videos = [];
        foreach($all_seasons as $s){
            $episodes = Episodes::where("season_id", $s->id)->get();
            $videos = [];
            foreach($episodes as $e){
                $video = Videos::find($e->video_id);
                array_push($videos, $video);
            }
            array_push($all_videos, $videos);
            array_push($all_episodes, $episodes);
        }
        return ["videos" => $all_videos, "episodes" => $all_episodes, "seasons" => $all_seasons];
    }

    public function show($id){
        try{
            return Videos::find($id);
        }catch(Exception $e){
            return $e;
        }
    }
}
