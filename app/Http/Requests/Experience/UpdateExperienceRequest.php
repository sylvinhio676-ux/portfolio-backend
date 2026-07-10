<?php

namespace App\Http\Requests\Experience;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company'     => ['sometimes', 'required', 'string', 'max:255'],
            'role'        => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date'  => ['sometimes', 'required', 'date'],
            'end_date'    => ['nullable', 'date', 'after:start_date'],
            'is_current'  => ['boolean'],
            'type'        => ['sometimes', 'required', 'in:job,freelance,personal,academic'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ];
    }
}