<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];


    public function getColorClassAttribute()
    {
        return match (strtolower($this->name)) {
            'santé' => 'text-green-600',
            'international' => 'text-blue-600',
            'lifestyle' => 'text-pink-500',
            'technologie' => 'text-red-500',
            'actualité' => 'text-purple-500',
            default => 'text-black-600', // fallback
        };
    }
}
