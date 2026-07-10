<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SkillResource;

class SkillCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'slug'       => $this->slug,
            'description'=> $this->description,
            'icon'       => $this->icon,
            'sort_order' => $this->sort_order,
            'skills'     => SkillResource::collection(
                $this->whenLoaded('skills')
            ),
        ];
    }
}