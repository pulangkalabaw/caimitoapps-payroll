<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allowance extends Model
{
    protected $table = 'allowance';
    protected $guarded = [];
    use SoftDeletes;
}
