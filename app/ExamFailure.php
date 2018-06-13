<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamFailure extends Model
{
    protected $table = 'examfailure';

    protected $fillable=['attempt', 'reason','units','examtodo'];
}
