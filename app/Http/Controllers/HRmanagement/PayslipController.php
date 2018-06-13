<?php

namespace App\Http\Controllers\HRmanagement;

use App\Model\HR\Payslip;
use App\Model\HR\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayslipController extends Controller
{
    //
    public function index(){
        return view('Employees.payroll.index',[
            'payslips'=>Payslip::get(),
        ]);
    }

    public function generateSlips(Request $request)
    {
        # code...
        $employees=Employee::get();
        foreach ($employees as $employee) {
            # code...
            if( PaySlip::where('status','PENDING')
                        ->where('employee_id',$employee->id)
                        ->first() != []
                            ||
                PaySlip::where('status','PENDING')
                        ->where('employee_id',$employee->id)
                        ->first()!=null
                        )continue;
            
            if($employee->salary==''){
                $slip=new PaySlip;
                $slip->employee_id=$employee->id;
                $slip->salary_items=$employee->jobGrade->salary_items;
                $slip->salary=$employee->jobGrade->salary;
                $slip->status='PENDING';
                $slip->save(); 
                continue;
            }

            $slip=new PaySlip;
            $slip->employee_id=$employee->id;
            $slip->salary_items=$employee->salary_items;
            $slip->salary=$employee->salary;
            $slip->status='PENDING';
            $slip->save();

        }
        return redirect()->back();
    }

    public function downloadSlip(Request $request)
    {
        # code...
        $slip = PaySlip::where('id',$request->id)
                         ->first();

        $pdf = \PDF::loadView('Employees.payroll.slipreport',[
            'payslip'=>$slip,
        ]);
        return $pdf->stream('slip.pdf');                

    }
}


