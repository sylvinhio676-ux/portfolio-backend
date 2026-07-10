<?php

namespace App\Http\Requests\Social;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'platform'   => ['sometimes', 'required', 'string', 'max:100'],
            'url'        => ['sometimes', 'required', 'string', 'url', 'max:500'],
            'icon'       => ['nullable', 'string', 'max:100'],
            'label'      => ['nullable', 'string', 'max:100'],
            'is_visible' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}