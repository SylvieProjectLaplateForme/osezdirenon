<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'publicite_id',
        'amount',
        'payment_method',
        'payment_last4',
        'stripe_payment_id',
        'paid_at',
    ];

    /**
     * Les dates  instances Carbon (
     *
     * @var array
     */
    protected $dates = [
        'paid_at',
    ];

    /**
     * Relation avec la publicité.
     *
     * Un paiement appartient à une publicité.
     */
    public function publicite()
    {
        return $this->belongsTo(Publicite::class);
    }

    /**
     * Relation avec l'utilisateur (facultatif mais conseillé).
     *
     * Un paiement appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
