<?php

namespace App\Http\Requests\Certification;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificationDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type'     => ['required', 'string', 'in:certificate,qr,autre'],
            'document' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,svg,pdf', 'max:10240'],
            'name'     => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required'     => 'Le type de document est obligatoire.',
            'type.in'           => 'Type de document invalide (certificate, qr ou autre).',
            'document.required' => 'Le fichier du document est obligatoire.',
            'document.mimes'    => 'Formats acceptés : jpg, jpeg, png, webp, svg, pdf.',
            'document.max'      => 'Le document ne doit pas dépasser 10 Mo.',
        ];
    }
}
