<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationDetailResource extends JsonResource
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
            'description'    => $this->description,
            'location'       => $this->location,
            'website'        => $this->website,
            'start_date'     => $this->start_date?->toDateString(),
            'end_date'       => $this->end_date?->toDateString(),
            'is_current'     => $this->is_current,
            'grade'          => $this->grade,
            'mention'        => $this->mention,
            'achievements'   => $this->achievements,
            'images'         => EducationImageResource::collection(
                $this->whenLoaded('images')
            ),
            'documents'      => EducationDocumentResource::collection(
                $this->whenLoaded('documents')
            ),
            'skills'         => SkillResource::collection(
                $this->whenLoaded('skills')
            ),
            'is_visible'     => $this->is_visible,
            'featured'       => $this->featured,
            'sort_order'     => $this->sort_order,
            'created_at'     => $this->created_at?->toISOString(),
            'updated_at'     => $this->updated_at?->toISOString(),
        ];
    }
}
