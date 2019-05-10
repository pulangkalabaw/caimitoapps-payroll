<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveCreditAudit extends Model
{
    //
    protected $table = 'leave_credit_audit';
    protected $guarded = [];

    public function Leave(){
        return $this->belongsTo('App\LibLeave', 'leave_id', 'leave_id');
    }
}
