<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPosition extends Model
{
    protected $table = 'user_position';
    protected $guarded = [];
    use SoftDeletes;

    public function getUser() {
        return $this->hasOne('App\User','supervisor_id','user_id');
    }
}
