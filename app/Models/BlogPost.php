<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'preview_text',
        'body',
        'meta_title',
        'meta_description',
        'published_at',
    ];

    protected $dates = ['published_at'];
}
