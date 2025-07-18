<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectGalleryItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'design_image' => $this->design_image,
            'real_image' => $this->real_image,
            'description' => $this->description,
        ];
    }
}
