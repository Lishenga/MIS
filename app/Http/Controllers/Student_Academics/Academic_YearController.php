<?php

namespace App\Http\Controllers\Student_Academics;

use App\Exams;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Academic_years;
use App\Students;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;

class Academic_YearController extends Controller
{
    public function academic(){
        $year = Academic_years::get();

        return view('Student_Academics.Academic')->with([
            'academic'=> $year,
        ]);
    }

    public function create(Request $request){

        $year = new Academic_years();
        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ($key == 'q' || $key == '_token') continue;
            $year->$key = $value;
        }

        if ($year->save()) {
            # code...
            $student = Students::where('Academic_Status','=', 'PROCEED');
            $student->update(array(
                'Exam_Status' => '0',
            ));
            $student->update(array(
                'Academic_Status' => 'SUSPENSE',
            ));
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Academic Year created successfully",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Academic Year Unsuccessfully Created",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function update(Request $request){
        $data=[];
        $year = Academic_years::where('id',$request->id);
        foreach ($request->all() as $key => $value) {
            //creating array excluding the _token the array will be used for update
            if ($key=='_token'||$key=='id')continue;
            $data[$key]=$value;
        }

        if ($year->update($data)){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Academic Year Updated",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Academic Year Unsuccessfully Updated",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function delete($id){
        $year = Academic_years::where('id','=',$id)->first();
        $exam = Exams::where('Academic_year','=',$id);

        if ($year && $exam){
            # code...
            $year->delete();
            $exam->delete();
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Academic Year Deleted",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Academic Year Not Deleted",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

}
