<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'hero_image',
        'area', 'implementation_time', 'design_time', 'style', 'location',
        'meta_title', 'meta_description'
    ];

    public function galleryItems()
    {
        return $this->hasMany(ProjectGalleryItem::class);
    }

    protected static function booted()
    {
        static::creating(function ($project) {
            $project->slug = Str::slug($project->title);
        });
    }
}
