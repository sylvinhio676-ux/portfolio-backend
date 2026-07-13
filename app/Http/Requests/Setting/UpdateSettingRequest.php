<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Général
            'site_name'                   => ['nullable', 'string', 'max:255'],
            'logo_url'                    => ['nullable', 'string', 'max:500'],
            'favicon_url'                 => ['nullable', 'string', 'max:500'],
            'contact_email'               => ['nullable', 'email', 'max:255'],
            'contact_phone'               => ['nullable', 'string', 'max:255'],
            'contact_location'            => ['nullable', 'string', 'max:255'],
            'is_available'                => ['nullable', 'boolean'],
            'availability_message'        => ['nullable', 'string', 'max:255'],
            'maintenance_mode'            => ['nullable', 'boolean'],
            // Apparence
            'theme_default'               => ['nullable', 'string', 'in:dark,light,system'],
            'primary_color'               => ['nullable', 'string', 'max:50'],
            'font_heading'                => ['nullable', 'string', 'max:100'],
            'font_body'                   => ['nullable', 'string', 'max:100'],
            'border_radius'               => ['nullable', 'string', 'max:50'],
            // SEO / Analytics
            'analytics_id'                => ['nullable', 'string', 'max:255'],
            'search_console_verification' => ['nullable', 'string', 'max:255'],
            'default_og_image'            => ['nullable', 'string', 'max:500'],
            'default_robots'              => ['nullable', 'string', 'max:255'],
            'sitemap_enabled'             => ['nullable', 'boolean'],
        ];
    }
}
