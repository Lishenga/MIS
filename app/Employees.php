<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = ['FinancialBank', 'FinancialAccount',  'created_at', 'updated_at'];
}
