<?php

namespace App\Http\Controllers\HRmanagement;

use App\Model\HR\SalaryItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;


class SalaryController extends Controller
{
    //
    public function index(Request $request){

        return view('Employees.salaryitem.salaryitems',[
            'items'=>SalaryItems::get(),
        ]);
        
    }
    public function deletesalaryitem(Request $request){

        $salary = SalaryItems::where('id',$request->id);
        if ($salary->delete()){
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

    public function createsalaryitem(Request $request){
        $salary = new SalaryItems;
        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ($key=='_token')continue;
            $salary->$key = $value;
        }
    
        if ($salary->save()){
            # code...
            LaravelSweetAlert::setMessage([
                        'title' => 'Success',
                        'text' => "Created!",
                        'timer' => 2000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                        'title' => 'Error',
                        'text' => "Could not create Item!",
                        'timer' => 2000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
            return redirect()->back();
        } 

    }


    public function updatesalaryitem(Request $request){
         # code...
        $data=[];
        $salary = SalaryItems::where('id',$request->id);
        foreach ($request->all() as $key => $value) {
            //creating array excluding the _token the array will be used for update
            if ($key=='_token'||$key=='id')continue;
            $data[$key]=$value;     
        }

        //return $data;

        if ($salary->update($data)){
            # code...
            LaravelSweetAlert::setMessage([
                        'title' => 'Success',
                        'text' => "Updated!",
                        'timer' => 2000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
            return redirect()->back();
            
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                        'title' => 'Error',
                        'text' => "Could not update Item!",
                        'timer' => 2000,
                        'type' => 'error',
                        'showConfirmButton' =>true
                    ]);
            return redirect()->back();
        }
    }
}
