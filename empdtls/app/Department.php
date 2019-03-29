<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table = 'departments';
    protected $guarded = [];

    public function User(){
        return $this->hasMany('App\User' ,'user_id', 'user_id');
    }
}
