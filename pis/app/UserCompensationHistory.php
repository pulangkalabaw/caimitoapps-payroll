<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCompensationHistory extends Model
{
    protected $table = 'user_compensation_history';
    protected $guarded = [];
    use SoftDeletes;


    public function getCompensation () {
        return $this->hasOne('App\Compensation','compensation_id','compensation_id');
    }
}
