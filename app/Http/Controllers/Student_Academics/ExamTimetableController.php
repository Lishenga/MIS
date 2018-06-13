<?php

namespace App\Http\Controllers\Student_Academics;

use App\Batch;
use App\Exam_category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exams;
use App\ExamTimetable;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;
use PDF;

class ExamTimetableController extends Controller
{
    public function view(){
        $timetable = ExamTimetable::get();
        $category = Exam_category::get();
        $batch = Batch::get();
        $exam = Exams::get();

        return view('Student_Academics.ExamTimetable')->with([
            'timetable'=> $timetable,
            'category'=> $category,
            'batch'=>$batch,
            'exam'=>$exam,
        ]);
    }

    public function make (){
        $exam = Exams::get();
        $category = Exam_category::get();
        $batch = Batch::get();

        return view('Student_Academics.Layouts.ExamTimetable')->with([
            'exam'=> $exam,
            'category'=> $category,
            'batch'=>$batch,
        ]);
    }

    public function create (Request $request){

        $year = new ExamTimetable();
        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ( $key == '_token') continue;
            $year->$key = $value;
        }

        if ($year->save()) {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Exam Timetabling Successful",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Exam Timetabling Unsuccessful",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }
     public function update (Request $request){
         $data=[];
         $year = ExamTimetable::where('id',$request->id);
         foreach ($request->all() as $key => $value) {
             //creating array excluding the _token the array will be used for update
             if ($key=='_token'||$key=='id')continue;
             $data[$key]=$value;
         }
         if($year->update($data)){
             # code...
             LaravelSweetAlert::setMessage([
                 'title' => 'Successful',
                 'text' => "Exam Timetabling Updated",
                 'timer' => 3000,
                 'type' => 'success',
                 'showConfirmButton' => false
             ]);
             return redirect()->back();
         } else {
             # code...
             LaravelSweetAlert::setMessage([
                 'title' => 'Unsuccessful',
                 'text' => "Exam Timetabling Not Updated",
                 'timer' => 4000,
                 'type' => 'error',
                 'showConfirmButton' => false
             ]);
             return redirect()->back();
         }
     }

     public function delete($id){

         if ($timetable = ExamTimetable::where('id',$id)->first()){

             $timetable->delete();

             LaravelSweetAlert::setMessage([
                 'title' => 'Successful',
                 'text' => "Successfully Deleted",
                 'timer' => 3000,
                 'type' => 'success',
                 'showConfirmButton' => false
             ]);
             return redirect()->back();
         } else {
             # code...
             LaravelSweetAlert::setMessage([
                 'title' => 'Unsuccessful',
                 'text' => "Unsuccessfully Deleted",
                 'timer' => 4000,
                 'type' => 'error',
                 'showConfirmButton' => false
             ]);
             return redirect()->back();
         }
     }

     public function pdf (){
         if($timetable = ExamTimetable::get()){
             $category = Exam_category::get();
             $batch = Batch::get();

             $pdf = PDF::loadView('Student_Academics.PDF.Examtimetable', [
                 'timetable'=>$timetable,
                 'category'=>$category,
                 'batch'=>$batch,
             ]);
             return $pdf->download('ExamTimetable.pdf');
         }else{
             LaravelSweetAlert::setMessage([
                 'title' => 'Unsuccessful',
                 'text' => "Download Unsuccessful",
                 'timer' => 4000,
                 'type' => 'error',
                 'showConfirmButton' => false
             ]);
             return redirect()->back();
         }
     }
}
