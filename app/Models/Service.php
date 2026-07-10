<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'is_visible',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
        ];
    }
}
