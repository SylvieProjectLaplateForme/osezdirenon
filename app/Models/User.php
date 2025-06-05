<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Publicite; 

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // ✅ clé étrangère vers roles
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ✅ Relation avec les articles créés par l'utilisateur
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // ✅ Relation avec le rôle de l'utilisateur
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // ✅ Vérification du rôle de l'utilisateur
    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }

    // ✅ Relation avec les publicités créées par l'utilisateur
    public function publicites()
    {
        return $this->hasMany(Publicite::class);
    }
}
