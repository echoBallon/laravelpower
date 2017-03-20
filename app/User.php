<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','confirm_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 拿到帖子
     */
    public function discussions(){
        return $this->hasMany(Discussion::class);
    }
 public  function comments(){
     return $this->hasMany(Comment::class);
 }
    /**
     * @param $password
     *
     */
//    public function setPasswordAttribute($password){
//        $this->attributes['password']=Hash::make($password);
//    }

//    public function getAuthPassword()
//    {
//        return $this->user_password;
//    }
}
