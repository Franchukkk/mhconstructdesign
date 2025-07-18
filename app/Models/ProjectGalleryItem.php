<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGalleryItem extends Model
{
    protected $fillable = [
        'project_id', 'design_image', 'real_image', 'description'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
