<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultancy_info extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];
     public function studentInfos(){
        return $this->hasMany(studentsInfo::class, 'consultancy_id');
    }
     public function studentStatus(){
        return $this->hasMany(studentsInfo::class, 'consultancy_id')->get(['user_id','status']);
    }
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
    public function consultancy_to_bookingRequest(){
        return $this->hasMany(BookingRequest::class,'consultancy_id');
    }
    // public function studentStatus(){
    //     return $this->hasOne(studentsInfo::class, 'consultancy_id')->select(['status', 'consultancy_id']);
    // }
}
