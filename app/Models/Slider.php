<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'button_text',
        'button_url',
        'image',
        'height',
        'overlay_opacity',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'height' => 'integer',
        'overlay_opacity' => 'integer',
    ];
}
