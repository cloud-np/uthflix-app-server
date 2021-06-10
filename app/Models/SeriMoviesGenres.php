<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriMoviesGenres extends Model
{
    protected $table = 'serimovies_genres';
    public $timestamps = false;

    protected $fillable = [
        'serimovies_id',
        'genre_id'
    ];

    use HasFactory;
}
