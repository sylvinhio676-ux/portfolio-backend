<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'tagline',
        'description',
        'problem',
        'solution',
        'challenge',
        'result',
        'architecture',
        'github_url',
        'demo_url',
        'video_url',
        'cover_image',
        'category',
        'is_featured',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function technologies(): HasMany
    {
        return $this->hasMany(ProjectTechnology::class);
    }
}
