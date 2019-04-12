<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];
    protected $hidden = ['password'];

    // Relationship to user_details
    public function UserDetails()
    {
        return $this->hasOne('App\UserDetails', 'user_id', 'user_id');
    }

	// Get all Allowances
	public function UserCompensation()
    {
        return $this->hasMany('App\UserCompensation', 'user_id', 'user_id');
    }

	// Get all Deductions
	public function UserDeduction()
    {
        return $this->hasMany('App\UserDeduction', 'user_id', 'user_id');
    }

	// Payroll Details
    public function UserPayrollDetails(){
        return $this->hasOne('App\UserPayrollDetails', 'user_id', 'user_id');
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = zencrypt($value);
    }

    public function getEmailAttribute($value)
    {
        return zdecrypt($value);
    }
}
