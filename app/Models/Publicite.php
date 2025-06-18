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
        'is_approved', 
        'paid',        
        'user_id',     
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
public function paiement()
{
    return $this->hasOne(\App\Models\Paiement::class);
}

}
