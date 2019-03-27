<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    // Relationship to user_details
    public function UserDetails()
    {
        return $this->hasOne('App\UserDetails', 'user_id', 'user_id');
    }

    public function UserPayrollDetails(){
        return $this->hasOne('App\UserPayrollDetails', 'user_id', 'user_id');
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = zencrypt($value);
    }

    public function getEmailAttribute($value)
    {
        return zdecrypt($value);
    }
}
