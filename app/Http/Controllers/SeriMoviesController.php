<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriMoviesController extends Controller
{
    //
    public function index(){
        return "index";
    }

    public function show($id){
        return "show id: "; 
    }
}
