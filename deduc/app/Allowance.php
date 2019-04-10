<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deductions extends Model
{
    protected $table = 'deductions';
    protected $guarded = [];
    use SoftDeletes;
}
