<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\generalCountryGuidelines;


class generalCountry extends Model
{
    use HasFactory;
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    public function generalCountry_to_generalCountryGuidelines(){
        return $this->hasMany(generalCountryGuidelines::class,'generalCountry_id');
    }
    
}
