<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCompensation extends Model
{
    protected $table = 'user_compensation';
    protected $guarded = [];
    use SoftDeletes;

    public function getCompensation () {
        return $this->hasOne('App\Compensation','compensation_id','compensation_id');
    }

    public function getUser () {
        return $this->hasOne('App\User','user_id','user_id');
    }

}
