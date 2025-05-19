<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    /**
     * Attributs assignables en masse
     */
    protected $fillable = [
        'user_id',
        'publicite_id',
        'amount',
        'payment_method',
        'payment_last4',
        'stripe_payment_id',
        'paid_at',
        'status',
    ];

    /**
     * Cast des champs en objets Carbon pour les dates
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'paid_at'    => 'datetime',
    ];

    /**
     * Relation : un paiement appartient à une publicité
     */
    public function publicite()
    {
        return $this->belongsTo(Publicite::class);
    }
    public function paiement()
{
    return $this->hasOne(\App\Models\Paiement::class);
}

    /**
     * Relation : un paiement appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
