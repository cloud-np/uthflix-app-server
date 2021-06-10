<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'release_date',
        'review',
        'trailer_url',
        'img_url',
        'duration',
        'bg_img_url'
    ];
}
