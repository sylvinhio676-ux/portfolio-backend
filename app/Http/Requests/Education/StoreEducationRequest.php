<?php

namespace App\Http\Requests\Education;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'school_name'     => ['required', 'string', 'max:255'],
            'school_logo'     => ['nullable', 'string', 'max:500'],
            'diploma'         => ['required', 'string', 'max:255'],
            'field_of_study'  => ['required', 'string', 'max:255'],
            'academic_level'  => ['required', 'string', 'max:255'],
            'description'     => ['nullable', 'string'],
            'location'        => ['nullable', 'string', 'max:255'],
            'website'         => ['nullable', 'string', 'url', 'max:500'],
            'start_date'      => ['required', 'date'],
            'end_date'        => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_current'      => ['boolean'],
            'grade'           => ['nullable', 'string', 'max:255'],
            'mention'         => ['nullable', 'string', 'max:255'],
            'achievements'    => ['nullable', 'string'],
            'is_visible'      => ['boolean'],
            'featured'        => ['boolean'],
            'sort_order'      => ['nullable', 'integer', 'min:0'],
            // Compétences liées (ids)
            'skills'          => ['nullable', 'array'],
            'skills.*'        => ['integer', 'exists:skills,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'end_date.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'skills.*.exists'         => 'Une des compétences sélectionnées est introuvable.',
        ];
    }
}
