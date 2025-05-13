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
        'Travail' => 'bg-yellow-200 text-yellow-800',
        'École' => 'bg-blue-200 text-blue-800',
        'Famille' => 'bg-pink-200 text-pink-800',
        'Couple' => 'bg-red-200 text-red-800',
        'Société' => 'bg-green-200 text-green-800',
        'Développement Personnel' => 'bg-purple-200 text-purple-800',
        default => 'bg-gray-200 text-gray-800',
    };
}
}



