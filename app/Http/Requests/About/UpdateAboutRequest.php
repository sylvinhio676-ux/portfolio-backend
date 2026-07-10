<?php

namespace App\Http\Requests\About;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:255'],
            'title'           => ['required', 'string', 'max:255'],
            'location'        => ['nullable', 'string', 'max:255'],
            'email'           => ['nullable', 'email', 'max:255'],
            'availability'    => ['nullable', 'string', 'max:255'],
            'tagline'         => ['nullable', 'string', 'max:500'],
            'bio'             => ['required', 'string'],
            'philosophy'      => ['nullable', 'string'],
            'photo_url'       => ['nullable', 'string', 'max:500'],
            'cv_url'          => ['nullable', 'string', 'max:500'],
            'stat_projects'   => ['nullable', 'integer', 'min:0'],
            'stat_years'      => ['nullable', 'integer', 'min:0'],
            'stat_techs'      => ['nullable', 'integer', 'min:0'],
            'stat_clients'    => ['nullable', 'integer', 'min:0'],
            'hero_cta1_label' => ['nullable', 'string', 'max:100'],
            'hero_cta1_url'   => ['nullable', 'string', 'max:500'],
            'hero_cta2_label' => ['nullable', 'string', 'max:100'],
            'hero_cta2_url'   => ['nullable', 'string', 'max:500'],
        ];
    }
}