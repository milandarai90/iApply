<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    use HasFactory;
    public function students()
    {
        return $this->hasMany(studentsInfo::class, 'classroom_id');
    }
    public function classBranch()
    {
        return $this->belongsTo(consultancy_branch::class, 'branchclass_id');
    }
}
