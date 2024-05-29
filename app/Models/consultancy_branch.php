<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultancy_branch extends Model
{
    use HasFactory;
    public function branch()
    {
        return $this->belongsTo(consultancy_info::class, 'consultancy_id');
    }
    public function setbranchNameAttribute($value)
    {
        $this->attributes['branchName'] = ucwords($value);
    }
    public function setemailAttribute($value)
    {
        $this->attributes['email'] = ucwords($value);
    }
    public function setbranchDistrictAttribute($value)
    {
        $this->attributes['branchDistrict'] = ucwords($value);
    }
    public function setbranchMunicipalityAttribute($value)
    {
        $this->attributes['branchMunicipality'] = ucwords($value);
    }
    public function setbranchManagerAttribute($value)
    {
        $this->attributes['branchManager'] = ucwords($value);
    }
}
