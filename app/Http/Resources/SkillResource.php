<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'category_id' => $this->category_id,
            'name'        => $this->name,
            'logo_url'    => $this->logo_url,
            'level'       => $this->level,
            'color'       => $this->color,
            'is_visible'  => $this->is_visible,
            'sort_order'  => $this->sort_order,
        ];
    }
}