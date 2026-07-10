<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug'         => ['required', 'string', 'max:255', 'unique:projects,slug', 'regex:/^[a-z0-9-]+$/'],
            'title'        => ['required', 'string', 'max:255'],
            'tagline'      => ['nullable', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'problem'      => ['nullable', 'string'],
            'solution'     => ['nullable', 'string'],
            'challenge'    => ['nullable', 'string'],
            'result'       => ['nullable', 'string'],
            'architecture' => ['nullable', 'string'],
            'github_url'   => ['nullable', 'string', 'url', 'max:500'],
            'demo_url'     => ['nullable', 'string', 'url', 'max:500'],
            'video_url'    => ['nullable', 'string', 'url', 'max:500'],
            'cover_image'  => ['nullable', 'string', 'max:500'],
            'is_featured'  => ['boolean'],
            'status'       => ['nullable', 'in:draft,published,archived'],
            'sort_order'   => ['nullable', 'integer', 'min:0'],
            // Technologies imbriquees
            'technologies'         => ['nullable', 'array'],
            'technologies.*.name'  => ['required_with:technologies', 'string', 'max:100'],
            'technologies.*.color' => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.unique'  => 'Ce slug est déjà utilisé par un autre projet.',
            'slug.regex'   => 'Le slug ne peut contenir que des lettres minuscules, des chiffres et des tirets.',
            'technologies.*.name.required_with' => 'Le nom de chaque technologie est obligatoire.',
        ];
    }
}