<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compensation extends Model
{
    protected $table = 'compensation';
    protected $guarded = [];
    use SoftDeletes;
}
