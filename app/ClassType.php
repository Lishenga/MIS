<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassType extends Model
{
    protected $table = 'classtype';

    protected $fillable = ['Name', 'status',  'created_at', 'updated_at'];
}
