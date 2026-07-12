<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Certification extends Model
{
    /** @use HasFactory<\Database\Factories\CertificationFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'provider',
        'provider_logo',
        'category',
        'credential_id',
        'issue_date',
        'expiration_date',
        'never_expire',
        'verification_url',
        'certificate_url',
        'badge',
        'description',
        'duration_hours',
        'score',
        'language',
        'level',
        'featured',
        'is_visible',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'issue_date'      => 'date',
            'expiration_date' => 'date',
            'never_expire'    => 'boolean',
            'duration_hours'  => 'integer',
            'featured'        => 'boolean',
            'is_visible'      => 'boolean',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(CertificationImage::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(CertificationDocument::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'certification_skill');
    }
}
