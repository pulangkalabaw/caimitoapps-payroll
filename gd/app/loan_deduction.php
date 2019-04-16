<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loan_deduction extends Model
{
    protected $fillable = ['id','loan_name', 'amount', 'interest_rate', 'loan_term', 'monthly_amortization'];
}
