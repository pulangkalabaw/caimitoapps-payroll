<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class LibLeave extends Model
{
    //
    protected $table = 'lib_leave';
    protected $guarded = [];
    use SoftDeletes;
}
