<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                if (is_string($value)) {
                    $model->setAttribute($key, strtoupper($value));
                }
            }
        });
    }
    public function branchCourse()
    {
        return $this->belongsTo(consultancy_branch::class, 'branch_id');
    }
    public function course()
    {
        return $this->hasMany(classroom::class, 'course_id');
    }
    public function course_to_bookingRequest()
    {
        return $this->hasMany(BookingRequest::class, 'course_id');
    }
}
