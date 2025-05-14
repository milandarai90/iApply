<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileImage extends Model
{

    use HasFactory;
    protected $fillable = ['user_id', 'image_path'];

    protected $hidden = ['created_at', 'updated_at'];

    public function profileImageToUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
