<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'hero_image' => $this->hero_image,
            'area' => $this->area,
            'implementation_time' => $this->implementation_time,
            'design_time' => $this->design_time,
            'style' => $this->style,
            'location' => $this->location,
            'gallery' => ProjectGalleryItemResource::collection($this->galleryItems)
        ];
    }
}
