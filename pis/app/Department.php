<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table = 'departments';
    protected $guarded = [];

    public function department_head_info(){
        return $this->hasOne('App\User' ,'user_id', 'department_head');
    }
}
