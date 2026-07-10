<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'images'           => ['required', 'array', 'min:1', 'max:10'],
            'images.*'         => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'alts'             => ['nullable', 'array'],
            'alts.*'           => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.required'  => 'Au moins une image est obligatoire.',
            'images.max'       => 'Maximum 10 images par projet.',
            'images.*.image'   => 'Chaque fichier doit être une image.',
            'images.*.mimes'   => 'Formats acceptés : jpg, jpeg, png, webp.',
            'images.*.max'     => 'Chaque image ne doit pas dépasser 5 Mo.',
        ];
    }
}