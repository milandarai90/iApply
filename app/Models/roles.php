<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];
    public function allUsers()
    {
        return $this->hasMany(User::class, 'role');
    }
}

