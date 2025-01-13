<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'image',
        'content',
        'publicationDate'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'publicationDate'
    ];
}
