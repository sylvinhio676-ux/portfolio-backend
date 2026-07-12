<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificationDocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'type'       => $this->type,
            'url'        => $this->url,
            'public_id'  => $this->public_id,
            'name'       => $this->name,
            'sort_order' => $this->sort_order,
        ];
    }
}
