<?php

namespace App\Http\Controllers\Academics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Courses;
use App\School;
use App\ClassType;
use App\ClassStatus;
use App\College;
use App\Campus;
use App\Departments;
use App\Units;
use App\Batch;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;

class BatchController extends Controller
{
    public function view (){

        return view ('Academics2.View');
    }

    public function batch()
    {
        # code...
        $course = Courses::get();
        $school = School::get();
        $college = College::get();
        $campus = Campus:: get();
        $depart = Departments:: get();
        $units = Units:: get();
        $batch = Batch:: get();
        $classtype = ClassType::get();
        $classStatus = ClassStatus::get();

        

        return view('Academics2.Batch')->with([
            'batch'=> $batch,
            'unit'=> $units,
            'course'=> $course,
            'depart'=> $depart,
            'school'=> $school,
            'college' => $college,
            'campus' => $campus,
            'classtype' => $classtype,
            'classStatus' => $classStatus,
        ]);

    }

    public function create(Request $request)
    {
        $year = new Batch;
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
                'text' => "Class Created Successfully",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Class Unsuccessfully Created",
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
        $year = Batch::where('id',$id);
        if ($year->delete()){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Class Deleted",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Class Unsuccessfully Deleted",
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
        $year = Batch::where('id',$request->id);
        foreach ($request->all() as $key => $value) {
            //creating array excluding the _token the array will be used for update
            if ($key=='_token'||$key=='id')continue;
            $data[$key]=$value;
        }

        if ($year->update($data)){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Class Updated",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Class Unsuccessfully Updated",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }
}
