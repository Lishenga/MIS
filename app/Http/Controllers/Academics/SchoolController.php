<?php

namespace App\Http\Controllers\Academics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\School;
use App\College;
use App\Campus;
use App\Employees;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;

class SchoolController extends Controller
{
    public function school()
    {
        # code...
        $school = School::get();
        $college = College::get();
        $campus = Campus:: get();
        $employee = Employees::get();

        return view('Academics2.school')->with([
            'school'=> $school,
            'college' => $college,
            'campus' => $campus,
            'employee'=>$employee,
        ]);

    }

    public function create(Request $request)
    {
        $year = new School;
        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ($key=='_token')continue;
            $year->$key = $value;
        }
        $year->status = 1;

        if ($year->save()){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "School Created",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "School Unsuccessfully Created",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function enabling(Request $request)
    {
        # code...

        $id = $request->input('id');
        $status = $request->input('status');

        if(School::where('id',$id)){
            $default = School::where('id', '=', $id)->first();

            if ($status != '') {
                $default->update(array(
                    'status' => $status,
                ));
            }
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Action Successful",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {

            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Action Unsuccessful",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        # code...
        $data=[];
        $year = School::where('id',$request->id);
        foreach ($request->all() as $key => $value) {
            //creating array excluding the _token the array will be used for update
            if ($key=='_token'||$key=='id')continue;
            $data[$key]=$value;
        }

        if ($year->update($data)){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "School Updated",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "School Not Updated",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }
}
