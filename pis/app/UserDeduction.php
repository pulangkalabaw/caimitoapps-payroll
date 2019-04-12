<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDeduction extends Model
{
    protected $table = 'user_deduction';
    protected $guarded = [];
    use SoftDeletes;

    public function getDeduction () {
        return $this->hasOne('App\Deductions','deduction_id','deduction_id');
    }

    public function getUser () {
        return $this->hasOne('App\User','user_id','user_id');
    }
}
