<?php

namespace App\Http\Requests\Testimonial;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['sometimes', 'required', 'string', 'max:255'],
            'role'       => ['nullable', 'string', 'max:255'],
            'content'    => ['sometimes', 'required', 'string'],
            'avatar_url' => ['nullable', 'string', 'max:500'],
            'rating'     => ['nullable', 'integer', 'min:1', 'max:5'],
            'is_visible' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}