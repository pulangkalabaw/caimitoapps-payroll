<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    //
    protected $table = "user_details";
    protected $guarded = [];

    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function Department(){
        return $this->belongsTo('App\Department', 'department_id', 'department_id');
    }

}
