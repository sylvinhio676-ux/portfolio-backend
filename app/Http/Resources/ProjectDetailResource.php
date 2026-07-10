<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'slug'         => $this->slug,
            'title'        => $this->title,
            'tagline'      => $this->tagline,
            'description'  => $this->description,
            'problem'      => $this->problem,
            'solution'     => $this->solution,
            'challenge'    => $this->challenge,
            'result'       => $this->result,
            'architecture' => $this->architecture,
            'links'        => [
                'github' => $this->github_url,
                'demo'   => $this->demo_url,
                'video'  => $this->video_url,
            ],
            'cover_image'  => $this->cover_image,
            'images'       => ProjectImageResource::collection(
                $this->whenLoaded('images')
            ),
            'technologies' => ProjectTechnologyResource::collection(
                $this->whenLoaded('technologies')
            ),
            'is_featured'  => $this->is_featured,
            'status'       => $this->status,
            'sort_order'   => $this->sort_order,
            'created_at'   => $this->created_at?->toISOString(),
            'updated_at'   => $this->updated_at?->toISOString(),
        ];
    }
}