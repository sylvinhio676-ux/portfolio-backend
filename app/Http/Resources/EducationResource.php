<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'school_name'    => $this->school_name,
            'school_logo'    => $this->school_logo,
            'diploma'        => $this->diploma,
            'field_of_study' => $this->field_of_study,
            'academic_level' => $this->academic_level,
            'location'       => $this->location,
            'start_date'     => $this->start_date?->toDateString(),
            'end_date'       => $this->end_date?->toDateString(),
            'is_current'     => $this->is_current,
            'grade'          => $this->grade,
            'mention'        => $this->mention,
            'is_visible'     => $this->is_visible,
            'featured'       => $this->featured,
            'sort_order'     => $this->sort_order,
            'skills'         => SkillResource::collection(
                $this->whenLoaded('skills')
            ),
            'created_at'     => $this->created_at?->toISOString(),
        ];
    }
}
