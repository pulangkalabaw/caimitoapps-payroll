<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table = 'departments';
    protected $guarded = [];

    public function DepartmentHead(){
        return $this->belongsTo('App\User' ,'department_head', 'user_id');
    }
}
