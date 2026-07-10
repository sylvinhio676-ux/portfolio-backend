<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = [
        'platform',
        'url',
        'icon',
        'label',
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
