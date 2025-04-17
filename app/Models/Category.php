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
    return match ($this->name) {
        'Travail' => 'bg-yellow-500 text-white',
        'École' => 'bg-blue-500 text-white',
        'Famille' => 'bg-pink-500 text-white',
        'Couple' => 'bg-red-500 text-white',
        'Société' => 'bg-green-500 text-white',
        'Développement Personnel' => 'bg-purple-600 text-white',
        default => 'bg-gray-400 text-white',
    };
}

    }

