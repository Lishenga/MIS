<?php

namespace App\Http\Controllers\HRmanagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortalController extends Controller
{
    //
    public function index(){
        return view('Employees.portal.index');
    }
}
