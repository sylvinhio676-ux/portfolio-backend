<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Ressource Admin : expose l'intégralité des paramètres.
 */
class SettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                          => $this->id,
            // Général
            'site_name'                   => $this->site_name,
            'logo_url'                    => $this->logo_url,
            'favicon_url'                 => $this->favicon_url,
            'contact_email'               => $this->contact_email,
            'contact_phone'               => $this->contact_phone,
            'contact_location'            => $this->contact_location,
            'is_available'                => $this->is_available,
            'availability_message'        => $this->availability_message,
            'maintenance_mode'            => $this->maintenance_mode,
            // Apparence
            'theme_default'               => $this->theme_default,
            'primary_color'               => $this->primary_color,
            'font_heading'                => $this->font_heading,
            'font_body'                   => $this->font_body,
            'border_radius'               => $this->border_radius,
            // SEO / Analytics
            'analytics_id'                => $this->analytics_id,
            'search_console_verification' => $this->search_console_verification,
            'default_og_image'            => $this->default_og_image,
            'default_robots'              => $this->default_robots,
            'sitemap_enabled'             => $this->sitemap_enabled,
            'updated_at'                  => $this->updated_at?->toISOString(),
        ];
    }
}
