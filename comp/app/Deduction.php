<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deduction extends Model
{
    protected $table = 'deduction';
    protected $guarded = [];
    use SoftDeletes;
}
