<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'page'        => $this->page,
            'title'       => $this->title,
            'description' => $this->description,
            'og_image'    => $this->og_image,
            'keywords'    => $this->keywords,
            'og_title'    => $this->og_title,
            'og_description' => $this->og_description,
            'robots'      => $this->robots,
            'updated_at'  => $this->updated_at?->toISOString(),
        ];
    }
}