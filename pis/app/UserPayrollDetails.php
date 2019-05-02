<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPayrollDetails extends Model
{
    //

    protected $table = "user_payroll_details";
    protected $guarded = [];

    public function setPayoutTypeAttribute($value) {
        $this->attributes['bank_details'] = json_encode($value);
    }

    public function getPayoutTypeAttribute($value) {
        return json_decode($value);
    }
}
