<?php

namespace App\Http\Controllers\HRmanagement;

use App\Model\HR\JobGrade;
use App\Model\HR\SalaryItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;


class JobGradeController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        return view('Employees.jobgrade.jobgrades',[
            'grades'=>JobGrade::get(),
        ]);
    }



    public function createjobgrade(Request $request){

        return view('Employees.jobgrade.createjobgrade',[
            'items'=>SalaryItems::get(),
        ]);

    }


    public function updatejobgrade(Request $request){
          
        return view('Employees.jobgrade.updatejobgrade',[
            'grade'=>JobGrade::where('id',$request->id)->first(),
        ]);


    }


    public function docreatejobgrade(Request $request){

        $data=[];
        $totals=[];
        $grade = new JobGrade; 
        foreach ($request->all() as $key=>$value) {
            if ($key=='_token'|| $key=='Name')continue;
            $data[$key]=$value;
            $type=SalaryItems::where('name',$key)->first()->type;

            if ($type=='DEDUCTION') {
                # code...
                $totals[]=-(int)$value;
                continue;
            }
            $totals[]=(int)$value;
        }

        $grade->Name=$request->name;
        $grade->salary_items=json_encode($data);
        $grade->salary=array_sum($totals);

        if ($grade->save()){
            # code...
            LaravelSweetAlert::setMessage([
                        'title' => 'Success',
                        'text' => "Created!",
                        'timer' => 2000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
            return redirect('HR/jobgrades');
           
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                        'title' => 'Error',
                        'text' => "Could not create!",
                        'timer' => 2000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
            return redirect()->back();    
        }

    }


    public function doupdatejobgrade(Request $request){
        $data=[];
        $totals=[];
        $grade=JobGrade::where('id',$request->id);
        foreach ($request->all() as $key=>$value) {
            if ($key=='_token'|| $key=='Name' || $key=='id')continue;
            $data[$key]=$value;
            $type = SalaryItems::where('name',$key)->first()->type;

            if ($type=='DEDUCTION') {
                # code...
                $totals[]= -(int)$value;
                continue;
            }
            $totals[]=(int)$value;
        }

        $out =  [
                'Name'=>$request->Name,
                'salary_items'=>json_encode($data),
                'salary'=>array_sum($totals)
            ];

        if ($grade->update($out)){
            # code...
            LaravelSweetAlert::setMessage([
                        'title' => 'Success',
                        'text' => "Updated!",
                        'timer' => 2000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
            return redirect('HR/jobgrades');
           
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                        'title' => 'Error',
                        'text' => "not Updated!",
                        'timer' => 2000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
            return redirect()->back();    
        }


    }


    public function deletejobgrade(Request $request){

        $grade = JobGrade::where('id',$request->id);
        if ($grade->delete()){
            # code...
            LaravelSweetAlert::setMessage([
                        'title' => 'Success',
                        'text' => "deleted!",
                        'timer' => 2000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
            return redirect()->back();
           
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                        'title' => 'Error',
                        'text' => "Could not delete !",
                        'timer' => 2000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
            return redirect()->back();
            
        }  

    }


}
