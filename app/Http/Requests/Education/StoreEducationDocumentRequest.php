<?php

namespace App\Http\Requests\Education;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'documents'     => ['required', 'array', 'min:1', 'max:10'],
            'documents.*'   => ['required', 'file', 'mimes:pdf', 'max:10240'],
            'types'         => ['nullable', 'array'],
            'types.*'       => ['nullable', 'string', 'in:memoire,rapport,diplome,autre'],
            'names'         => ['nullable', 'array'],
            'names.*'       => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'documents.required' => 'Au moins un document est obligatoire.',
            'documents.max'      => 'Maximum 10 documents par formation.',
            'documents.*.mimes'  => 'Chaque document doit être un fichier PDF.',
            'documents.*.max'    => 'Chaque document ne doit pas dépasser 10 Mo.',
            'types.*.in'         => 'Type de document invalide (memoire, rapport, diplome, autre).',
        ];
    }
}
