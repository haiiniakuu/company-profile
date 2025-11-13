<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'major',
        'sosmed',
        'sosmed_urls',
    ];

    protected $casts = [
        'sosmed' => 'array',
        'sosmed_urls' => 'array',
    ];
}
