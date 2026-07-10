<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'company'     => $this->company,
            'role'        => $this->position,
            'description' => $this->description,
            'start_date'  => $this->start_date?->format('Y-m-d'),
            'end_date'    => $this->end_date?->format('Y-m-d'),
            'is_current'  => $this->is_current,
            'type'        => $this->type,
            'sort_order'  => $this->sort_order,
            // Champ calculé utile pour le frontend (affichage timeline)
            'period'      => $this->formatPeriod(),
        ];
    }

    private function formatPeriod(): string
    {
        $start = $this->start_date?->translatedFormat('M Y') ?? '';
        $end   = $this->is_current
            ? 'Aujourd\'hui'
            : ($this->end_date?->translatedFormat('M Y') ?? '');

        return "{$start} — {$end}";
    }
}