<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'provider'        => $this->provider,
            'provider_logo'   => $this->provider_logo,
            'category'        => $this->category,
            'issue_date'      => $this->issue_date?->toDateString(),
            'expiration_date' => $this->expiration_date?->toDateString(),
            'never_expire'    => $this->never_expire,
            'badge'           => $this->badge,
            'level'           => $this->level,
            'featured'        => $this->featured,
            'is_visible'      => $this->is_visible,
            'sort_order'      => $this->sort_order,
            'skills'          => SkillResource::collection(
                $this->whenLoaded('skills')
            ),
            'created_at'      => $this->created_at?->toISOString(),
        ];
    }
}
