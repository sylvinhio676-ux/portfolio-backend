<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $table = 'seo_settings';

    protected $fillable = [
        'page',
        'title',
        'description',
        'og_image',
        'keywords',
        'og_title',
        'og_description',
        'robots',
    ];
}
