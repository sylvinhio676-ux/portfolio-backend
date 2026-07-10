<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'logo_url',
        'level',
        'color',
        'is_visible',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'level' => 'integer',
            'is_visible' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class, 'category_id');
    }
}
