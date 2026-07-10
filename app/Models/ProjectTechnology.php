<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectTechnology extends Model
{
    // La table project_technologies n'a pas de colonnes timestamps
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'name',
        'color',
        'icon',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
