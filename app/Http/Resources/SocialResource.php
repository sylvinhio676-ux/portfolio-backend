<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'platform'   => $this->platform,
            'url'        => $this->url,
            'icon'       => $this->icon,
            'label'      => $this->label,
            'is_visible' => $this->is_visible,
            'sort_order' => $this->sort_order,
        ];
    }
}