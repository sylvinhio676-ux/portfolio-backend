<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';

    protected $fillable = [
        'name',
        'title',
        'location',
        'email',
        'availability',
        'tagline',
        'bio',
        'philosophy',
        'photo_url',
        'cv_url',
        'stat_projects',
        'stat_years',
        'stat_techs',
        'stat_clients',
        'hero_cta1_label',
        'hero_cta1_url',
        'hero_cta2_label',
        'hero_cta2_url',
    ];

    protected function casts(): array
    {
        return [
            'stat_projects' => 'integer',
            'stat_years' => 'integer',
            'stat_techs' => 'integer',
            'stat_clients' => 'integer',
        ];
    }
}
