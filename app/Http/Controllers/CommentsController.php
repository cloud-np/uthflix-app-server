<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class CommentsController extends Controller
{
    public function fetch_comments_by_video_id($video_id){
        try{
            $comments = Comments::where("video_id", $video_id)->get();
            foreach($comments as $c){
                if(isset($c["user_id"])){
                    $user_name = User::find($c["user_id"])["username"];
                    $c["username"] = $user_name;
                }else $c["username"] = null;
            }
            return $comments;
        }catch(Exception $e){
            return $e;
        }
    }

    public function store(Request $req){
        $comment = new Comments();
        $comment->content = $req->input("content");
        $comment->video_id = $req->input("video_id");
        $comment->user_id = $req->input("user_id");
        $comment->review = $req->input("review");
        $comment->created_at = new Carbon();
        $comment->save();
        return "OK";
    }
}
