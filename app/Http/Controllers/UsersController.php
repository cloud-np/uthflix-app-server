<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index() {

        $users = Users::all();
        $users_arr = [];

        foreach($users as $user){
            array_push($users_arr, $user->toJson());
        }

        return $users_arr;
    }

    public function indexWithEmail(Request $req) {
        $email = $req->input('email');
        $user = DB::select('select * from users where email = ?', [$email]);
        // $users = DB::find($email);
        return $user;
        // return $users;
    }

    public function show($id) {
        $users = DB::select('select * from users where id = ?', [$id]);

        return $users;
    }
}
