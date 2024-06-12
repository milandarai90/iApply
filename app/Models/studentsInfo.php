<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class studentsInfo extends Model
{
    use HasFactory;


    public function student()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function classes()
    {
        return $this->belongsTo(classroom::class, 'classroom_id');
    }
}
