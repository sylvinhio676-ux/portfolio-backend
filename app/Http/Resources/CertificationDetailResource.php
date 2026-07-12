<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificationDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'provider'        => $this->provider,
            'provider_logo'   => $this->provider_logo,
            'category'        => $this->category,
            'credential_id'   => $this->credential_id,
            'issue_date'      => $this->issue_date?->toDateString(),
            'expiration_date' => $this->expiration_date?->toDateString(),
            'never_expire'    => $this->never_expire,
            'links'           => [
                'verification' => $this->verification_url,
                'certificate'  => $this->certificate_url,
            ],
            'badge'           => $this->badge,
            'description'     => $this->description,
            'duration_hours'  => $this->duration_hours,
            'score'           => $this->score,
            'language'        => $this->language,
            'level'           => $this->level,
            'images'          => CertificationImageResource::collection(
                $this->whenLoaded('images')
            ),
            'documents'       => CertificationDocumentResource::collection(
                $this->whenLoaded('documents')
            ),
            'skills'          => SkillResource::collection(
                $this->whenLoaded('skills')
            ),
            'featured'        => $this->featured,
            'is_visible'      => $this->is_visible,
            'sort_order'      => $this->sort_order,
            'created_at'      => $this->created_at?->toISOString(),
            'updated_at'      => $this->updated_at?->toISOString(),
        ];
    }
}
