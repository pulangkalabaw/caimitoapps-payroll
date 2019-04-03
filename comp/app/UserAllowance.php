<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAllowance extends Model
{
    protected $table = 'user_allowance';
    protected $guarded = [];
    use SoftDeletes;
}
