<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = ['title', 'slug', 'image', 'body', 'meta_title', 'meta_description'];

    public static function booted()
    {
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);

            // SEO generation
            $post->meta_title = Str::limit($post->title, 60);
            $post->meta_description = Str::limit(strip_tags($post->body), 160);
        });
    }
}
