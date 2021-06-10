<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seasons extends Model
{
    protected $table = 'seasons';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'release_date',
        'serimovies_id'
    ];
    use HasFactory;
}
