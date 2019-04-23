<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sss_table extends Model
{
    protected $fillable = ['id', 'from', 'to', 'monthly_salary_credit', 'social_security_er', 'social_security_ee','social_security_total', 'ec_er', 'total_contribution_er', 'total_contribution_ee', 'total_contribution_total'];
}
