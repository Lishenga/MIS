<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    protected $table = 'exams';

    protected $fillable = ['Units',  'created_at', 'updated_at'];
}
