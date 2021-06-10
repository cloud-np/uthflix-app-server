<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    public $timestamps = false;

    protected $fillable = [
        'content',
        'user_id',
        'video_id',
        'review',
        'created_at',
    ];

    use HasFactory;
}
