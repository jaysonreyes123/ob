<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE = array('ob' => 4,'collection' => 5);
    const ACCESS_TOKEN = "qFPzGzglv4bna49xSkMQ3kyeHnbEdtV8uXdktNdn1DvYcZpK8k1OohTMNEiOILLWoWNF9uqJIxk5KoxcswvUGmybfEaT3DfFAVcBjcdkmjXpoPkGpKCeAMIWIRRQt8au";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transaction_(){
        return $this->hasMany(Transaction::class,'user_id','id');
    }

    public function success_(){
        return $this->hasMany(Transaction::class,'user_id');
    }
    public function failed_(){
       return $this->hasMany(Transaction::class,'user_id'); 
    }

    public function user_privileges_(){
        return $this->hasOne(UserPrivileges::class,'id','role');
    }

}
