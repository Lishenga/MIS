<?php

namespace App\Http\Controllers\Academics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Courses;
use App\School;
use App\College;
use App\Campus;
use App\Departments;
use App\Units;
use App\Batch;
use App\Employees;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;

class CourseController extends Controller
{
    public function course()
    {
        # code...
        $course = Courses::get();
        $unit = Units::get();
        $school = School::get();
        $college = College::get();
        $campus = Campus:: get();
        $depart = Departments:: get();
        $data = [];
        $unit_data=[];
        $employee = Employees::get();

        foreach ($course as $courses){
            $merge = json_decode($courses->Units);
            if($merge==null){
                $merge=[];
            };
            foreach ($merge as $merger){
                foreach ($unit as $units){
                    if($units->id == $merger){
                        $unit_data=$unit;
                    }

                }
            }
            $data[]=[
                'course_name'=>$courses->course_name,
                'course_code'=>$courses->course_code,
                'department_id'=>$courses->department_id,
                'head'=>$courses->head,
                'duration'=>$courses->duration,
                'semesters'=>$courses->semesters,
                'id'=>$courses->id,
                'units'=>$unit_data,
            ];
        }

        return view('Academics2.course')->with([
            'course'=> json_decode(json_encode($data)),
            'depart'=> $depart,
            'school'=> $school,
            'college' => $college,
            'campus' => $campus,
            'employee'=>$employee,
        ]);

    }

    public function createcourse(){

        $unit = Units::get();
        $depart = Departments::get();
        $employee = Employees::get();

        return view ('Academics2.Settings.createcourse')->with([
            'unit'=> $unit,
            'depart'=> $depart,
            'employee'=>$employee,
        ]);
    }

    public function updatecourse($id){

        $unit = Units::get();
        $depart = Departments::get();
        $course = Courses::where('id',$id)->first();
        $employee = Employees::get();

        return view ('Academics2.Settings.updatecourse')->with([
            'unit'=> $unit,
            'depart'=> $depart,
            'course'=> $course,
            'employee'=>$employee
        ]);
    }

    public function create(Request $request)
    {
        $unit = json_encode($request->Units);
        $year = new Courses;
        $year->Units = $unit;
        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ($key=='_token' || $key=='Units')continue;
            $year->$key = $value;
        }
        $year->status = 1;

        if ($year->save()){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Course Created Successfully",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect('academics/course');
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Course Unsuccessfully Created",
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
        if ($course = courses::where('id',$id)->first()){

            $course->delete();

            if($batch = Batch::where('course_id',$course->id)){

                $batch->delete();
            }


            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Course Deleted",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Course Unsuccessfully Deleted",
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
        $year = Courses::where('id',$request->id);
        foreach ($request->all() as $key => $value) {
            //creating array excluding the _token the array will be used for update
            if ($key=='_token'||$key=='id'||$key=='Units')continue;
            $data[$key]=$value;
        }
        $unit = json_encode($request->Units);
        if($unit != ''){
            $year->update(array(
                'Units'=>$unit,
            ));

        $year->update($data);
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Course Details Updated",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect('academics/course');
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Course Unsuccessfully Updated",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }
}
