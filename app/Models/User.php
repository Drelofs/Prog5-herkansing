<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'username',
        'password',
        'user_type',
        'status'
    ];

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
    * Always encrypt the password when it is updated.
    *
    * @param $value
    * @return string
    */
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function isAdmin() {
        return $this->is_admin === 1;
    }

    public function isAdminCheck() {
        if($this->is_admin === 1){
            return 1;
        }
    }
 
     public function isUser() {
        return $this->is_admin === 0;
     }

     public function cars()
    {
        return $this->hasmany(Car::class,'user_id','id');
    }

    public function login_count()
    {
        return $this->hasOne(LoginCount::class,'user_id','id');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
