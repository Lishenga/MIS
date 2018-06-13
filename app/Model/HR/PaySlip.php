<?php

namespace App\Model\HR;

use Illuminate\Database\Eloquent\Model;

class PaySlip extends Model
{
    //
    protected $table="pay_slips";

    public function  employee(){

         return $this->belongsTo('\App\Model\HR\Employee','employee_id');
         
    }
}
