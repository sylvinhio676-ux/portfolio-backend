<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        // Général
        'site_name',
        'logo_url',
        'favicon_url',
        'contact_email',
        'contact_phone',
        'contact_location',
        'is_available',
        'availability_message',
        'maintenance_mode',
        // Apparence
        'theme_default',
        'primary_color',
        'font_heading',
        'font_body',
        'border_radius',
        // SEO / Analytics
        'analytics_id',
        'search_console_verification',
        'default_og_image',
        'default_robots',
        'sitemap_enabled',
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
            'maintenance_mode' => 'boolean',
            'sitemap_enabled' => 'boolean',
        ];
    }
}
