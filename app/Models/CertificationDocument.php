<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CertificationDocument extends Model
{
    protected $fillable = [
        'certification_id',
        'type',
        'url',
        'public_id',
        'name',
        'sort_order',
    ];

    public function certification(): BelongsTo
    {
        return $this->belongsTo(Certification::class);
    }
}
