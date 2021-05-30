<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gerne;

class GerneController extends Controller
{
    //
    public function index() {
        $gernes = Gernes::all();
        
        return $gernes;
    }

    public function show($id){
        $gerne = Gernes::find($id);
        // $gerne = Gernes::where('id', $id)->get();

        return $gerne;
    }
}
