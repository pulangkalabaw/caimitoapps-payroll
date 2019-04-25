<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompensationHistory extends Model
{
    protected $table = 'user_compensation_history';
    protected $guarded = [];
    use SoftDeletes;
}
