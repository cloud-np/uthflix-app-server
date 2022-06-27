<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use App\Models\SeriMovies;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


// Better Methods to keep in mind later on.
// $model = App\Flight::findOrFail(1);
// $model = App\Flight::where('legs', '>', 100)->firstOrFail();

class UserController extends Controller
{
    public function get_users(Request $req) {
        $user = User::find($req->input('user_id'));
        if ($user == NULL)
            return json_encode('User not found');

        if ($user['is_admin'])
            return User::all(); 
        else
            return json_encode(false);
    }

    // Check if the same fav exists.
    public function register_favorite(Request $req){
        try{
            $fav = new Favorites();
            $fav->user_id = $req->input("user_id");
            $fav->serimovies_id = $req->input("serimovies_id");
            $fav->save();
            return "OK";
        }catch(Exception $e){
            return $e;
        }
    }

    public function delete_favorite(Request $req){
        try{
            DB::delete('delete from favorites where user_id = ? AND serimovies_id = ?',[$req->input("user_id"), $req->input("serimovies_id")]);
            return "deleteeed";
        }catch(Exception $e){
            return $e;
        }
    }

    public function find_favorite(Request $req) {
        try{
            $fav = Favorites::where("user_id", $req->input("user_id"))
                        ->where("serimovies_id", $req->input("serimovies_id"))
                        ->get();
            return $fav;
        }catch(Exception $e){
            return $e;
        }
    }

    public function user_favorites($user_id) {
        try{
            $favorites = Favorites::where("user_id", $user_id)->get();
            $serimovies = [];
            foreach($favorites as $fav){
                array_push($serimovies, SeriMovies::find($fav->serimovies_id));
            }
            return $serimovies;
        }catch(Exception $e){
            return $e;
        }
    }

    // DELETE FROM users WHERE id = ? ;
    public function delete(Request $req){
        try{
            User::destroy($req->input("user_id"));
            return "OK";
        }catch(Exception $e){
            return $e;
        }
    }

    // The raw SQL statement could be something like that:
    // SELECT * FROM users WHERE email = ? AND password = ? ; 
    public function login(Request $req){
        $user = User::where('email', $req->input('email'))
                    ->where('password', $req->input('password'))->get();
        return $user[0];
    }

    // The raw SQL statement could be something like that:
    // UPDATE users SET put_here_values WHERE id = ? ;
    public function update(Request $req){
        $user = User::find($req->input('id'));
        $valid_keys = ['email', 'password', 'username', 'isAdmin', 'isProducer'];
        if ($user != NULL){
            foreach($req->all() as $key => $value){
                if(!in_array($key, $valid_keys))
                    continue;
                else
                    $user->update([$key => $value]);
            }
            $user->update(['updated_at' => now()]);
            return "OK";
        } else return "FAILED";
    }

    // The raw SQL statement could be something like that:
    // INSERT INTO users (id, username, is_admin .... ) VALUES (1, Cloud, 0 .... ) ;
    // NOTE: Later on we should hash this password in a real world scenario.
    public function store(Request $req) {
        $user = new User();
         
        $user->username = $req->input('username');
        $user->password = $req->input('password');
        $user->email = $req->input('email');
        $user->is_admin = $req->input('isAdmin');
        $user->is_producer = $req->input('isProducer');

        $user->save();
        return ;
    }

    // Here I just used raw sql just to test it out.
    public function indexWithEmail(Request $req) {
        $email = $req->input('email');
        $user = DB::select('select * from users where email = ?', [$email]);
        return $user;
    }

    public function show($id) {
        $users = DB::select('select * from users where id = ?', [$id]);

        return $users;
    }
}