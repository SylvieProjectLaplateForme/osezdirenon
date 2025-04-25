<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // ✅ Remplacé 'role' par 'role_id'
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

    // ✅ Lien avec les articles
    public function articles()
    {
        return $this->hasMany(\App\Models\Article::class);
    }

    // ✅ Lien avec le rôle
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }
    public function hasRole($roleName)
{
    return $this->role && $this->role->name === $roleName;
}
//lien pub
public function publicites()
{
    return $this->hasMany(Publicite::class);
}


}
