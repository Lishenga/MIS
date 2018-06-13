<?php

namespace App\Http\Controllers\Academics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\School;
use App\College;
use App\Campus;
use App\Departments;
use App\Courses;
use App\Batch;
use App\Units;
use App\Employees;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;


class DepartmentsController extends Controller
{
    public function department()
    {
        # code...
        $school = School::get();
        $college = College::get();
        $campus = Campus:: get();
        $depart = Departments:: get();
        $employee = Employees::get();

        return view('Academics2.depart')->with([
            'school'=> $school,
            'college' => $college,
            'campus' => $campus,
            'depart' => $depart,
            'employee'=>$employee
        ]);

    }

    public function create(Request $request)
    {
        $year = new Departments;
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
                'text' => "Department Created",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Department Unsuccessfully Created",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        # code...
        if ($depart = Departments::where('id',$id)->first()){

            $depart->delete();

           if($course = Courses::where('department_id',$depart->id)->first()){

               $course->delete();

               if($units = Units:: where('department_id',$depart->id)){

                   $units->delete();

                   if($batch = Batch::where('course_id',$course->id)){

                       $batch->delete();

                   }
               }
           }


            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Department Deleted",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();


        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Department Unsuccessfully Deleted",
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
        $year = Departments::where('id',$request->id);
        foreach ($request->all() as $key => $value) {
            //creating array excluding the _token the array will be used for update
            if ($key=='_token'||$key=='id')continue;
            $data[$key]=$value;
        }

        if ($year->update($data)){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                    'text' => "Department Updated",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Department Unsuccessfully Updated",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }
}
