<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LeaveCredits extends Model
{
    //
    protected $table = 'leave_credits';
    protected $guarded = [];
    use SoftDeletes;
}
