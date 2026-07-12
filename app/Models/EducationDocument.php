<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationDocument extends Model
{
    protected $fillable = [
        'education_id',
        'type',
        'url',
        'public_id',
        'name',
        'sort_order',
    ];

    public function education(): BelongsTo
    {
        return $this->belongsTo(Education::class);
    }
}
