<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriMovies extends Model
{
    protected $table = 'serimovies';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'release_date',
        'overview',
        'is_movie',
        'user_id',
        'img_url'
    ];
    use HasFactory;
}
