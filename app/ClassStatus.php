<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassStatus extends Model
{
    protected $table = 'classstatus';

    protected $fillable = ['Name', 'status',  'created_at', 'updated_at'];
}
