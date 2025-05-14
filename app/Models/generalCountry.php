<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\generalCountryGuidelines;


class generalCountry extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    public function generalCountry_to_generalCountryGuidelines(){
        return $this->hasMany(generalCountryGuidelines::class,'generalCountry_id');
    }

}
