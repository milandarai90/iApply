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
}
