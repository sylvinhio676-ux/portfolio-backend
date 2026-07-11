<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $projectId = $this->route('id');

        return [
            'slug'         => ['sometimes', 'required', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', Rule::unique('projects', 'slug')->ignore($projectId)],
            'title'        => ['sometimes', 'required', 'string', 'max:255'],
            'tagline'      => ['nullable', 'string', 'max:255'],
            'description'  => ['sometimes', 'required', 'string'],
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
            'technologies'         => ['nullable', 'array'],
            'technologies.*.name'  => ['required_with:technologies', 'string', 'max:100'],
            'technologies.*.color' => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }
}