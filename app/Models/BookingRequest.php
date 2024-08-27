<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    use HasFactory;
    public function bookingRequestToUser(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function bookingRequest_to_consultancy(){
        return $this->belongsTo(consultancy_info::class,'consultancy_id');
    }
    public function bookingRequest_to_branch()
    {
        return $this->belongsTo(consultancy_branch::class, 'branch_id');
    }
    public function bookingRequest_to_course()
    {
        return $this->belongsTo(course::class, 'course_id');
    }
    public function bookingRequest_to_classroom()
    {
        return $this->belongsTo(classroom::class, 'classroom_id');
    }
}
