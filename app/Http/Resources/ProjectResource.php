<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'slug'         => $this->slug,
            'title'        => $this->title,
            'tagline'      => $this->tagline,
            'result'       => $this->result,
            'cover_image'  => $this->cover_image,
            'category'     => $this->category,
            'is_featured'  => $this->is_featured,
            'status'       => $this->status,
            'sort_order'   => $this->sort_order,
            'technologies' => ProjectTechnologyResource::collection(
                $this->whenLoaded('technologies')
            ),
            'created_at'   => $this->created_at?->toISOString(),
        ];
    }
}