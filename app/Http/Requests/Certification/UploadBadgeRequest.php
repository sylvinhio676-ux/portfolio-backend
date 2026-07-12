<?php

namespace App\Http\Requests\Certification;

use Illuminate\Foundation\Http\FormRequest;

class UploadBadgeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'badge' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'badge.required' => 'Le fichier du badge est obligatoire.',
            'badge.image'    => 'Le badge doit être une image.',
            'badge.mimes'    => 'Formats acceptés : jpg, jpeg, png, webp, svg.',
            'badge.max'      => 'Le badge ne doit pas dépasser 5 Mo.',
        ];
    }
}
