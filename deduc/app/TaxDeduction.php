<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxDeduction extends Model
{
     protected $fillable = ['id','wage_type','compensation_range_from','compensation_range_to','prescribed_withholding_tax'];
}
