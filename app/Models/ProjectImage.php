<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    protected $fillable = [
        'project_id',
        'url',
        'public_id',
        'alt',
        'sort_order',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
