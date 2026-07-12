<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationImage extends Model
{
    protected $fillable = [
        'education_id',
        'url',
        'public_id',
        'alt',
        'sort_order',
    ];

    public function education(): BelongsTo
    {
        return $this->belongsTo(Education::class);
    }
}
