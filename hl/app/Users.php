<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';
    protected $guarded = [];

    public function LeaveCredits(){
        return $this->hasMany('App\LeaveCredits', 'user_id', 'user_id');
    }

}
