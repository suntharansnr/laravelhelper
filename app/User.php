<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'First_Name','Last_Name','email', 'password','role_id','status','message','gender','mobile','phone','country','address','website','User_Org_Image','User_Thumb_Image','provider','provider_id','user_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function role(){
        return $this->belongsTo('App\Role');
    }

    public function isAdmin()
{
    foreach ($this->role()->get() as $role)
    {
        if ($role->id == '1')
        {
            return true;
        }
    }
}

public function properties()
{
  return $this->hasMany('App\Property');
}

}
