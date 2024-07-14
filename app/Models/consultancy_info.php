<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultancy_info extends Model
{
    use HasFactory;
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = ucwords($value);
    }
    public function setDistrictAttribute($value)
    {
        $this->attributes['u_district'] = ucwords($value);
    }
    public function setMunicipalityAttribute($value)
    {
        $this->attributes['u_municipality'] = ucwords($value);
    }
    public function setHeadpersonnameAttribute($value)
    {
        $this->attributes['u_ward'] = ucwords($value);
    }

    public function consultancyDetails()
    {
        return $this->hasOne(User::class, 'consultancy_id');
    }
    public function branch()
    {
        return $this->hasMany(consultancy_branch::class, 'consultancy_id');
    }

    public function consultancy_to_country(){
        return $this->hasMany(country::class,'consultancy_id');
    }
}
