<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'title'           => $this->title,
            'location'        => $this->location,
            'email'           => $this->email,
            'availability'    => $this->availability,
            'tagline'         => $this->tagline,
            'bio'             => $this->bio,
            'philosophy'      => $this->philosophy,
            'photo_url'       => $this->photo_url,
            'cv_url'          => $this->cv_url,
            'stat_projects'   => $this->stat_projects,
            'stat_years'      => $this->stat_years,
            'stat_techs'      => $this->stat_techs,
            'stat_clients'    => $this->stat_clients,
            'hero_cta1_label' => $this->hero_cta1_label,
            'hero_cta1_url'   => $this->hero_cta1_url,
            'hero_cta2_label' => $this->hero_cta2_label,
            'hero_cta2_url'   => $this->hero_cta2_url,
            'updated_at'      => $this->updated_at?->toISOString(),
        ];
    }
}