<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // 🔧 Laravel attend "roles" → on force le nom réel ici :
    protected $table = 'roles';

    protected $fillable = ['name'];
}

