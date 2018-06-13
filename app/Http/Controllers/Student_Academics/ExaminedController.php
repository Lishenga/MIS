<?php

namespace App\Http\Controllers\Student_Academics;

use App\Exam_Marks;
use App\Grading;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Students;
use App\Courses;
use App\Exams;
use App\Academic_years;
use App\Batch;
use App\Marks;
use App\Exam_category;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;
use PDF;

class ExaminedController extends Controller
{
    public function view()
    {
        # code...
        $students = Students::get();
        $course = Courses::get();
        $batch = Batch::get();
        return view('Student_Academics.Examined')->with([
            'student'=> $students,
            'course'=> $course,
            'batch'=> $batch,
        ]);
    }

    public function particular($id)
    {
        # code...
        $students = Students::where('id','=',$id)->first();
        $course = Courses::where('id','=',$students->course_id)->first();
        $batch = Batch::where('id',$students->batch_id)->first();
        $exam = Exams::where('batch_id',$batch->id)->first();
        $mark = Marks::where('Student_id',$students->id)->first();
        $data = [];
        $exams = Exams::get();
        $academic = Academic_years::get();
        $category = Exam_category::get();

        foreach ($academic as $academics){
            if($academics->Name == $mark->Academic_year){
                $data=[
                    'course_name'=>$course->course_name,
                    'units'=>json_decode($mark->Results),
                ];
            }
        }

        return view('Student_Academics.Layouts.ExaminedLayout.Particular')->with([
            'course'=> json_decode(json_encode($data)),
            'student'=> $students,
            'exam'=> $exams,
            'academic'=> $academic,
            'category'=> $category,
            'exams'=> $exam,
        ]);
    }

    public function check(Request $request)
    {
        # code...
        $students = Students::where('id','=',$request->student)->first();
        $course = Courses::where('id','=',$students->course_id)->first();
        $batch = Batch::where('id', '=', $students->batch_id)->first();
        $exam = Exams::where('id',$request->id)->first();
        $mark = Marks::where('Student_id',$students->id)->where('Exam_id',$exam->id)->first();
        $data=[];
        $exams = Exams::get();
        $academic = Academic_years::get();
        $category = Exam_category::get();

        foreach ($academic as $academics){
            if($academics->Name == $mark->Academic_year){
                $data=[
                    'course_name'=>$course->course_name,
                    'units'=>json_decode($mark->Results),
                ];
            }
        }

        return view('Student_Academics.Layouts.ExaminedLayout.ParticularExam')->with([
            'course'=> json_decode(json_encode($data)),
            'student'=> $students,
            'batch'=> $batch,
            'exam'=> $exams,
            'exams'=> $exam,
            'courses'=> $course,
            'academic'=> $academic,
            'category'=> $category,
        ]);
    }

    public function transcript (Request $request){

        $exam_mark = Exam_Marks::where('Student_id',$request->student)->where('academic_year',$request->academic_year)->first();
        $student = Students::where('id',$request->student)->first();
        $course = Courses::where('id',$student->course_id)->first();


        $pdf = PDF::loadView('Student_Academics.PDF.transcript', [
            'student'=>$student,
            'course'=> $course->course_name,
            'marks'=>$exam_mark,
        ]);
        return $pdf->download($student->admission_number.'.pdf');
    }

    public function tally(Request $request){
        $mark = Exam_Marks::where('Student_id',$request->student)->where('academic_year',$request->Academic_year)->first();
        $students = Students::where('id','=',$request->student)->first();
        $course = Courses::where('id','=',$students->course_id)->first();
        $exam = Exams::where('id',$request->id)->first();
        $data=[];
        $exams = Exams::get();
        $academic = Academic_years::get();
        $category = Exam_category::get();
        $grading = Grading::get();

        foreach ($academic as $academics){
            if($academics->Name == $mark->academic_year){
                $data=[
                    'course_name'=>$course->course_name,
                    'units'=>json_decode($mark->Marks),
                    'grades'=>$mark->grading,
                ];
            }
        }

        return view('Student_Academics.Layouts.ExaminedLayout.FinalExam')->with([
            'course'=> json_decode(json_encode($data)),
            'student'=> $students,
            'exam'=> $exams,
            'exams'=> $exam,
            'courses'=> $course,
            'academic'=> $academic,
            'category'=> $category,
            'marks'=> $request->Academic_year,
            'grading'=>$grading,
        ]);
    }
}
