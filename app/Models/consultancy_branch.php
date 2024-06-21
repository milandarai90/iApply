<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class consultancy_branch extends Model
{
    use HasFactory;
    public function branch()
    {
        return $this->belongsTo(consultancy_info::class, 'consultancy_id');
    }
    public function userBranch()
    {
        return $this->hasOne(User::class, 'branch_id');
    }
    public function setbranchManagerAttribute($value)
    {
        $this->attributes['branchManager'] = ucwords($value);
    }
    public function classBranch()
    {
        return $this->hasMany(classroom::class, 'branch_id');
    }

    public function branchCourse()
    {
        return $this->hasMany(course::class, 'branch_id');
    }
}
