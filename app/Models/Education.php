<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Education extends Model
{
    // Table au singulier (Laravel pluraliserait sinon en "educations")
    protected $table = 'education';

    protected $fillable = [
        'school_name',
        'school_logo',
        'diploma',
        'field_of_study',
        'academic_level',
        'description',
        'location',
        'website',
        'start_date',
        'end_date',
        'is_current',
        'grade',
        'mention',
        'achievements',
        'is_visible',
        'featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_current' => 'boolean',
            'is_visible' => 'boolean',
            'featured'   => 'boolean',
            'start_date' => 'date',
            'end_date'   => 'date',
        ];
    }

    /**
     * Galerie d'images de la formation.
     */
    public function images(): HasMany
    {
        return $this->hasMany(EducationImage::class);
    }

    /**
     * Documents rattachés (mémoire, rapport, diplôme…).
     */
    public function documents(): HasMany
    {
        return $this->hasMany(EducationDocument::class);
    }

    /**
     * Compétences acquises durant la formation (Many-To-Many).
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'education_skill');
    }
}
