<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll_Process extends Model
{
    protected $table = "payroll_master";
    
    protected $guarded = [];


    // Auto encode and decode compensation_data
    public function setCompensationDataAttribute($value)
    {
        $this->attributes['compensation_data'] = json_encode($value);
    }

    public function getCompensationDataAttribute($value)
    {
        return json_decode($value);
    }

    // Auto encode and decode deduction_data
    public function setDeductionDataAttribute($value)
    {
        $this->attributes['deduction_data'] = json_encode($value);
    }

    public function getDeductionDataAttribute($value)
    {
        return json_decode($value);
    }

    // Auto encode and decode overtime_data
    public function setOvertimeDataAttribute($value)
    {
        $this->attributes['overtime_data'] = json_encode($value);
    }

    public function getOvertimeDataAttribute($value)
    {
        return json_decode($value);
    }

    // Auto encode and decode leaves
    public function setLeavesAttribute($value)
    {
        $this->attributes['leaves'] = json_encode($value);
    }

    public function getLeavesAttribute($value)
    {
        return json_decode($value);
    }

    // Auto encode and decode payroll_details
    public function setPayrollDetailsAttribute($value)
    {
        $this->attributes['payroll_details'] = json_encode($value);
    }

    public function getPayrollDetailsAttribute($value)
    {
        return json_decode($value);
    }

    // Auto encode and decode other_info
    public function setOtherInfoAttribute($value)
    {
        $this->attributes['other_info'] = json_encode($value);
    }

    public function getOtherInfoAttribute($value)
    {
        return json_decode($value);
    }



    // public function manufacturer()
    // {
    //     return $this->hasOne('App\Manufacturer', 'id', 'manufacturer_id');
    // }
}
