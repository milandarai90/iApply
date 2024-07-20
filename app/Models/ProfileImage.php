<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileImage extends Model
{

    use HasFactory;
    public function profileImageToUser(){
        return $this->belongsTo(User::class,'user_id');
    }
}
