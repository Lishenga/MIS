<?php

namespace App\Model\HR;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table="employees";

    public function jobGrade(){

         return $this->belongsTo('\App\Model\HR\JobGrade','job_grade');
         
    }

    
}
