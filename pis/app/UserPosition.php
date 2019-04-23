<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPosition extends Model
{
    protected $table = 'user_position';
    protected $guarded = [];
    use SoftDeletes;

    public function getSupervisor() {
        return $this->hasOne('App\User','user_id','supervisor_id');
    }

    public function getDepartment() {
        return $this->hasOne('App\Department','department_id','department_id');
    }

    public function getUser() {
        return $this->hasOne('App\User','user_id','user_id');
    }
}
