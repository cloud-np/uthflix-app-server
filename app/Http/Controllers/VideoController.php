<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    //
    public function show($id) {
        $videos = DB::select('select * from videos where id = ?', [$id]);

        return $videos;
    }
}
