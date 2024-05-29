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
    public function userBranch()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function setbranchManagerAttribute($value)
    {
        $this->attributes['branchManager'] = ucwords($value);
    }
}
