<?php

namespace App\Http\Requests\Experience;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company'     => ['required', 'string', 'max:255'],
            'role'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after:start_date'],
            'is_current'  => ['boolean'],
            'type'        => ['required', 'in:job,freelance,personal,academic'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ];
    }
}