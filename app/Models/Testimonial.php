<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'role',
        'content',
        'avatar_url',
        'rating',
        'is_visible',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_visible' => 'boolean',
        ];
    }
}
