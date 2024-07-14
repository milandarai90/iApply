<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function country_to_consultancy(){
        return $this->belongsTo(consultancy_info::class ,'consultancY_id');
    }
}
