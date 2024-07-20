<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];



    protected $table = 'users'; // Ensure no space here

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function allUsers()
    {
        return $this->belongsTo(roles::class, 'role');
    }

    public function consultancy()
    {
        return $this->belongsTo(consultancy_info::class, 'consultancy_id');
    }

    public function userBranch()
    {
        return $this->belongsTo(consultancy_branch::class, 'branch_id');
    }

    public function student()
    {
        return $this->hasOne(studentsInfo::class, 'user_id');
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

    public function personalAccessTokens(): HasMany
    {
        return $this->hasMany(PersonalAccessToken::class, 'tokenable_id');
    }
    public function userToProfileImage(){
        return $this->hasOne(ProfileImage::class,'user_id');
    }
}