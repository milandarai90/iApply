<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function country_to_consultancy(){
        return $this->belongsTo(consultancy_info::class ,'consultancY_id');
    }

    public function country_to_guidelines()
    {
        return $this->hasMany(country_guidelines::class, 'country_id');
    }
}
