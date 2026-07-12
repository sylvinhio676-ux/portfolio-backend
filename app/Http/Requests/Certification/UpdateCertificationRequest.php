<?php

namespace App\Http\Requests\Certification;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'            => ['sometimes', 'required', 'string', 'max:255'],
            'provider'         => ['sometimes', 'required', 'string', 'max:255'],
            'provider_logo'    => ['nullable', 'string', 'max:500'],
            'category'         => ['nullable', 'string', 'max:255'],
            'credential_id'    => ['nullable', 'string', 'max:255'],
            'issue_date'       => ['sometimes', 'required', 'date'],
            'expiration_date'  => ['nullable', 'date', 'after_or_equal:issue_date'],
            'never_expire'     => ['boolean'],
            'verification_url' => ['nullable', 'string', 'url', 'max:500'],
            'certificate_url'  => ['nullable', 'string', 'url', 'max:500'],
            'badge'            => ['nullable', 'string', 'max:500'],
            'description'      => ['nullable', 'string'],
            'duration_hours'   => ['nullable', 'integer', 'min:0'],
            'score'            => ['nullable', 'string', 'max:255'],
            'language'         => ['nullable', 'string', 'max:255'],
            'level'            => ['nullable', 'string', 'max:255'],
            'featured'         => ['boolean'],
            'is_visible'       => ['boolean'],
            'sort_order'       => ['nullable', 'integer', 'min:0'],
            // Compétences liées (Many-To-Many)
            'skills'           => ['nullable', 'array'],
            'skills.*'         => ['integer', 'exists:skills,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'expiration_date.after_or_equal' => 'La date d\'expiration doit être postérieure ou égale à la date d\'obtention.',
            'skills.*.exists' => 'Une des compétences sélectionnées n\'existe pas.',
        ];
    }
}
