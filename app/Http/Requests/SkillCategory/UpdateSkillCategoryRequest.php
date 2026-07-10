<?php

namespace App\Http\Requests\SkillCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkillCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['sometimes', 'required', 'string', 'max:100'],
            'slug'       => ['sometimes', 'required', 'string', 'max:100', 'unique:skill_categories,slug'],
            'description'=> ['sometimes', 'nullable', 'string'],
            'icon'       => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}