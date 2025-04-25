<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicite extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'lien',
        'image',
        'date_debut',
        'date_fin',
        'is_approved', // ✅ à ajouter
        'paid',        // ✅ à ajouter
        'user_id',     // ✅ à ajouter
    ];
    

    protected $casts = [
        'is_active' => 'boolean',
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];
    //lien user
    public function user()
{
    return $this->belongsTo(User::class);
}

}
