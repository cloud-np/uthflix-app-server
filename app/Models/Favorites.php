<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    protected $table = 'favorites';
    public $timestamps = false;

    protected $fillable = [
        "user_id",
        "serimovies_id"
    ];
    use HasFactory;
}
