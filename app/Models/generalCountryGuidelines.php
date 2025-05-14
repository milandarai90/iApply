<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\generalCountry;

class generalCountryGuidelines extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];
    public function generalCountryGuidelines_to_generalCountry(){
        return $this->belongsTo(generalCountry::class,'generalCountry_id');
    }
    public function setGuidelinesAttribute($value)
    {
        $this->attributes['guidelines'] = ucwords($value);
    }
}
