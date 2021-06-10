<?php

namespace App\Http\Controllers;

use App\Models\CrewMembers;
use App\Models\SeriMovies;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;

class CrewMembersController extends Controller
{

    public static function store_crew($req, $serimovie_id){
        if($req->has("crew") && count($req->input("crew")) > 0){ 
            foreach($req->input("crew") as $member){
                $crew_mem = new CrewMembers();
                $crew_mem->fname = $member["fname"];
                $crew_mem->lname = $member["lname"];
                $crew_mem->job = $member["job"];
                $crew_mem->serimovies_id = $serimovie_id;
                $crew_mem->save();
            }
        }
    }

    public function get_by_all($crew) {
        try {
            $members = CrewMembers::where("fname", $crew)->orWhere("lname", $crew)->orWhere("job", $crew)->get();
            $serimovies = [];
            foreach($members as $m)
                array_push($serimovies, SeriMovies::find($m->serimovies_id));
            return ["serimovies" => $serimovies, "members" => $members];
        }catch(Exception $e){
            return $e;
        }
    }

    public function delete(Request $req){
        try {
            CrewMembers::destroy($req->input("crew_id"));
        }catch(Expectation $e){
            return $e;
        }
    }

    public function fetch_crew_from_serimovie($serimovie_id){
        try {
            return CrewMembers::where("serimovies_id", $serimovie_id)->get();
        }catch(Expectation $e){
            return $e;
        }
    }
}
