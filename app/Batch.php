<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batch';
    protected $fillable=['academicsemester', 'academicyear','ClassStatus','Batch_category','Start_date'];
}
