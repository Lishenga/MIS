<?php

namespace App\Http\Controllers\Student_Academics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Students;
use App\Courses;
use App\Exams;
use App\Academic_years;
use App\Batch;

class DefaultController extends Controller
{
    public function view()
    {
        # code...
        $students = Students::get();
        $course = Courses::get();
        $batch = Batch::get();
        return view('Student_Academics.Students')->with([
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
        $batch = Batch::where('id', '=', $students->batch_id)->first();
        $academic = Academic_years::get();
        $exam = Exams::get();
        return view('Student_Academics.Layouts.ParticularStudent')->with([
            'student'=> $students,
            'course'=> $course,
            'batch'=> $batch,
            'exam'=> $exam,
            'academic'=> $academic,
        ]);
    }
}
