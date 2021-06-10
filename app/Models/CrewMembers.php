<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewMembers extends Model
{
    protected $table = 'crew_members';
    public $timestamps = false;

    protected $fillable = [
        'serimovies_id',
        'fname',
        'lname',
        'job',
    ];
    use HasFactory;
}
