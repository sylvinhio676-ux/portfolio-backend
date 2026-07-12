<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CertificationImage extends Model
{
    protected $fillable = [
        'certification_id',
        'url',
        'public_id',
        'alt',
        'sort_order',
    ];

    public function certification(): BelongsTo
    {
        return $this->belongsTo(Certification::class);
    }
}
