<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];
    public function students()
    {
        return $this->hasMany(studentsInfo::class, 'classroom_id');
    }
    public function classBranch()
    {
        return $this->belongsTo(consultancy_branch::class, 'branch_id');
    }
    public function course()
    {
        return $this->belongsTo(course::class, 'course_id');
    }
    public function classroom_to_bookingRequest()
    {
        return $this->hasMany(BookingRequest::class, 'classroom_id');
    }
}
