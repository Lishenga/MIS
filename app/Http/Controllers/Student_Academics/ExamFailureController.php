<?php

namespace App\Http\Controllers\Student_Academics;

use App\Batch;
use App\Courses;
use App\Exam_Marks;
use App\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ExamFailure;
use App\Exams;
use App\Academic_years;
use App\Exam_category;
use App\ExamFailureMarks;
use App\Grading;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;

class ExamFailureController extends Controller
{
    public function create(Request $request){

        $units= $request->units;
        $year = new ExamFailure();
        $year->units = json_encode($units);

        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ( $key == '_token' || $key == 'units') continue;
            $year->$key = $value;
        }

        if ($year->save()) {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Units Recorded",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Units not Recorded",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function view (Request $request){
        $student = Students::get();
        $failure = ExamFailure::get();
        $course = Courses::get();
        $batch = Batch::get();

        return view('Student_Academics.Examfailure')->with([
            'failure'=>$failure,
            'student'=>$student,
            'course'=>$course,
            'batch'=>$batch,
        ]);

    }

    public function particular ($id){
        # code...
        $students = Students::where('id','=',$id)->first();
        $course = Courses::where('id','=',$students->course_id)->first();
        $batch = Batch::where('id',$students->batch_id)->first();
        $exam = Exams::where('batch_id',$batch->id)->first();
        $examfailure = ExamFailure::where('Student_id',$students->id)->first();
        $data = [];
        $exams = Exams::get();
        $academic = Academic_years::get();
        $category = Exam_category::get();

        foreach ($academic as $academics){
            if($academics->Name == $examfailure->academic_year){
                $data=[
                    'course_name'=>$course->course_name,
                    'units'=>json_decode($examfailure->units),
                ];
            }
        }

        return view('Student_Academics.Layouts.ExamFailure.ExamFailure')->with([
            'course'=> json_decode(json_encode($data)),
            'student'=> $students,
            'exam'=> $exams,
            'academic'=> $academic,
            'category'=> $category,
            'exams'=> $exam,
            'examfailure'=> $examfailure,
        ]);
    }

    public function input(Request $request){
        $year = new ExamFailureMarks;
        $data = [];
        $build = [];
        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ( $key == '_token' || $key == 'Student_id' || $key == 'Academic_year' || $key == 'Exam_id') continue;
            $data[$key]=$value;
        }
        $exam = Exams::where('id',$request->Exam_id)->first();

        foreach ($data as $key=> $value){
            $build[$key]=($value/$exam->out_of)*100;
        }

        $year->results =json_encode($build);
        $year->student_id=$request->Student_id;
        $year->academic_year=$request->Academic_year;
        $year->exam_id=$request->Exam_id;

        if ($year->save()) {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Marks Recorced Successfully",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Marks Not Recorced Successfully",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function tally(Request $request){
        $examfailure = ExamFailureMarks::where('Student_id',$request->student)->where('academic_year',$request->Academic_year)->where('exam_id',$request->exam_id)->first();
        $failure = ExamFailure::where('student_id',$request->student)->where('academic_year',$request->Academic_year)->where('examtodo',$request->exam_id)->first();
        $students = Students::where('id','=',$request->student)->first();
        $course = Courses::where('id','=',$students->course_id)->first();
        $exam = Exams::where('id',$request->exam_id)->first();
        $data=[];
        $exams = Exams::get();
        $academic = Academic_years::get();
        $category = Exam_category::get();
        $grading = Grading::get();

        foreach ($academic as $academics){
            if($academics->Name == $examfailure->academic_year){
                $data=[
                    'course_name'=>$course->course_name,
                    'units'=>json_decode($examfailure->results),
                    'grades'=>$exam->grading,
                ];
            }
        }

        return view('Student_Academics.Layouts.ExamFailure.FinalMarks')->with([
            'course'=> json_decode(json_encode($data)),
            'student'=> $students,
            'exam'=> $exams,
            'exams'=> $exam,
            'courses'=> $course,
            'academic'=> $academic,
            'category'=> $category,
            'marks'=> $request->Academic_year,
            'examfailure'=> $examfailure,
            'grading'=>$grading,
            'failure'=>$failure,
        ]);
    }

    public function failure(Request $request){
        $examfailure = ExamFailure::where('Student_id',$request->student_id)->where('academic_year',$request->academic_year)->where('examtodo',$request->exam_id)->first();
        $students = Students::where('id','=',$request->student_id)->first();
        $course = Courses::where('id','=',$students->course_id)->first();
        $exam = Exams::where('id',$request->exam_id)->first();
        $data=[];
        $exams = Exams::get();
        $academic = Academic_years::get();
        $category = Exam_category::get();

        foreach ($academic as $academics){
            if($academics->Name == $examfailure->academic_year){
                $data=[
                    'course_name'=>$course->course_name,
                    'units'=>json_decode($examfailure->units),
                ];
            }
        }

        return view('Student_Academics.Layouts.ExamFailure.Fail')->with([
            'course'=> json_decode(json_encode($data)),
            'student'=> $students,
            'exam'=> $exams,
            'exams'=> $exam,
            'courses'=> $course,
            'academic'=> $academic,
            'category'=> $category,
            'marks'=> $request->Academic_year,
            'examfailure'=> $examfailure,
        ]);
    }

    public function fail (Request $request){
        $exam_marks = Exam_Marks::where('Student_id',$request->student_id)->where('academic_year',$request->academic_year)->first();
        $examfailure = ExamFailure::where('student_id',$request->student_id)->where('academic_year',$request->academic_year)->where('examtodo',$request->exam_id)->first();
        $problem = ExamFailureMarks::where('Student_id',$request->student_id)->where('academic_year',$request->academic_year)->where('exam_id',$request->exam_id)->first();
        $exam = Exams::where('id',$request->exam_id)->first();
        $failure = json_decode($examfailure->units);
        $mark = json_decode($exam_marks->Marks,true);
        $data = [];
        $unit_data = [];

        foreach ($request->unitspassed as $units){
            foreach ($failure as $failures){
                if($units != $failures)continue;
                foreach ($mark as $marks => $value){
                    if($marks != $failures) continue;
                    $data[$units] = $exam->supplementarypassmark;

                }

            }
        }


        foreach ($mark as $marks => $value){
            foreach ($data as $datas => $value1){
                if($marks == $datas) continue;
                $unit_data[$marks]= $value;

            }
        }
        foreach ($data as $datas =>$value){
            $unit_data[$datas]= $value;
        }

        if($request->attempt < $exam->supmaxattempts){

            if ($unit_data != '' and $request->unitsfailed != '') {
                $exam_marks->update(array(
                    'Marks' => json_encode($unit_data),
                ));

                $examfailure->update(array(
                    'units' => json_encode($request->unitsfailed),
                ));

                $examfailure->update(array(
                    'reason' => $request->reason,
                ));

                $examfailure->update(array(
                    'examtodo' => $request->examtodo,
                ));

                $examfailure->update(array(
                    'attempt' => $request->attempt,
                ));

                $problem->delete();

                LaravelSweetAlert::setMessage([
                    'title' => 'Successful',
                    'text' => "Action Successfull",
                    'timer' => 4000,
                    'type' => 'success',
                    'showConfirmButton' => false
                ]);
                return redirect()->back();
            }elseif($request->unitsfailed == ''and $unit_data != ''){
                $examfailure->delete();
        
                $exam_marks->update(array(
                    'Marks' => json_encode($unit_data),
                ));

                $problem->delete();

                LaravelSweetAlert::setMessage([
                    'title' => 'Successful',
                    'text' => "Action Successfull",
                    'timer' => 4000,
                    'type' => 'success',
                    'showConfirmButton' => false
                ]);
                return redirect()->back();
            }
            elseif($unit_data == '' and $request->unitsfailed != ''){
                $exam_marks->update(array(
                    'Marks' => $exam_marks->Marks,
                ));

                $examfailure->update(array(
                    'units' => json_encode($request->unitsfailed),
                ));

                $examfailure->update(array(
                    'reason' => $request->reason,
                ));

                $examfailure->update(array(
                    'examtodo' => $request->examtodo,
                ));

                $examfailure->update(array(
                    'attempt' => $request->attempt,
                ));

                $problem->delete();

                LaravelSweetAlert::setMessage([
                    'title' => 'Successful',
                    'text' => "Action Successfull",
                    'timer' => 4000,
                    'type' => 'success',
                    'showConfirmButton' => false
                ]);
                return redirect()->back();
            }
            elseif ($request->unitsfailed == '' and $unit_data == '') {
                LaravelSweetAlert::setMessage([
                    'title' => 'Unsuccessful',
                    'text' => "Please Specify the Student's Failed Exam Credentials",
                    'timer' => 4000,
                    'type' => 'error',
                    'showConfirmButton' => false
                ]);
                return redirect()->back();
            }
        }elseif($request->attempt == $exam->supmaxattempts){

            if ($unit_data != '' and $request->unitsfailed != '') {
                $exam_marks->update(array(
                    'Marks' => json_encode($unit_data),
                ));

                $examfailure->update(array(
                    'units' => json_encode($request->unitsfailed),
                ));

                $examfailure->update(array(
                    'reason' => $request->reason,
                ));

                $examfailure->update(array(
                    'attempt' => $request->attempt,
                ));

                $problem->delete();

                LaravelSweetAlert::setMessage([
                    'title' => 'Successful',
                    'text' => "Action Successfull",
                    'timer' => 4000,
                    'type' => 'success',
                    'showConfirmButton' => false
                ]);
                return redirect()->back();
            }elseif($request->unitsfailed == ''and $unit_data != ''){
                $examfailure->delete();

                $exam_marks->update(array(
                    'Marks' => json_encode($unit_data),
                ));

                $problem->delete();

                LaravelSweetAlert::setMessage([
                    'title' => 'Successful',
                    'text' => "Action Successfull",
                    'timer' => 4000,
                    'type' => 'success',
                    'showConfirmButton' => false
                ]);
                return redirect()->back();
            }
            elseif($unit_data == '' and $request->unitsfailed != ''){
                $exam_marks->update(array(
                    'Marks' => $exam_marks->Marks,
                ));

                $examfailure->update(array(
                    'units' => json_encode($request->unitsfailed),
                ));

                $examfailure->update(array(
                    'reason' => $request->reason,
                ));

                $examfailure->update(array(
                    'attempt' => $request->attempt,
                ));

                $problem->delete();

                LaravelSweetAlert::setMessage([
                    'title' => 'Successful',
                    'text' => "Action Successfull",
                    'timer' => 4000,
                    'type' => 'success',
                    'showConfirmButton' => false
                ]);
                return redirect()->back();
            }
            elseif ($request->unitsfailed == '' and $unit_data == '') {
                LaravelSweetAlert::setMessage([
                    'title' => 'Unsuccessful',
                    'text' => "Please Specify the Student's Exam Credentials",
                    'timer' => 4000,
                    'type' => 'error',
                    'showConfirmButton' => false
                ]);
                return redirect()->back();
            }
        }
    }

    public function proceed(Request $request){
        if (Students::where('id',$request->Student_id)) {

            $exam_marks = Exam_Marks::where('Student_id',$request->student_id)->where('academic_year',$request->academic_year)->first();
            $examfailure = ExamFailure::where('student_id',$request->student_id)->where('academic_year',$request->academic_year)->where('examtodo',$request->exam_id)->first();
            $problem = ExamFailureMarks::where('Student_id',$request->student_id)->where('academic_year',$request->academic_year)->where('exam_id',$request->exam_id)->first();
            $exam = Exams::where('id',$request->exam_id)->first();
            $failure = json_decode($examfailure->units);
            $mark = json_decode($exam_marks->Marks,true);
            $datas = [];
            $unit_data = [];

            foreach ($failure as $failures){
                $datas[$failures] = $exam->supplementarypassmark;
            }
    
            foreach ($mark as $marks => $value){
                foreach ($datas as $datass => $value1){
                    if($marks == $datass) continue;
                    $unit_data[$marks]= $value;
    
                }
            }
            foreach ($datas as $datass =>$value){
                $unit_data[$datass]= $value;
            }

            if ($unit_data != '') {
                $exam_marks->update(array(
                    'Marks' => json_encode($unit_data),
                ));

                $problem->delete();
                
            }elseif($unit_data == ''){
                $exam_marks->update(array(
                    'Marks' => $exam_marks->Marks,
                ));
            }

            $data = [];
            $year = Students::where('id', $request->student_id);
            foreach ($request->all() as $key => $value) {
                //creating array excluding the _token the array will be used for update
                if ($key == 'student_id' or $key == '_token' or $key == 'academic_year' or $key == 'exam_id') continue;
                $data[$key] = $value;
            }

            if ($year->update($data)) {
                # code...
                LaravelSweetAlert::setMessage([
                    'title' => 'Successful',
                    'text' => "Action Successful",
                    'timer' => 3000,
                    'type' => 'success',
                    'showConfirmButton' => false
                ]);
                $student = Students::get();
                $failure = ExamFailure::get();
                $course = Courses::get();
                $batch = Batch::get();
                return redirect('studentacademics/examfaliure/view')->with([
                    'failure'=>$failure,
                    'student'=>$student,
                    'course'=>$course,
                    'batch'=>$batch,
                ]);
            } else {
                # code...
                LaravelSweetAlert::setMessage([
                    'title' => 'Action Not Unsuccessful',
                    'text' => "Details not saved",
                    'timer' => 4000,
                    'type' => 'error',
                    'showConfirmButton' => false
                ]);
                return redirect()->back();
            }
        }
    }

    public function forward(Request $request){
        $examfailure = ExamFailure::where('student_id',$request->student_id)->where('academic_year',$request->academic_year)->where('examtodo',$request->exam_id)->first();

        if($examfailure != ''){
            $examfailure->update(array(
                'reason' => $request->reason,
            ));
            $data = [];
            $year = Students::where('id', $request->student_id);
            foreach ($request->all() as $key => $value) {
                //creating array excluding the _token the array will be used for update
                if ($key == 'student_id' or $key == '_token' or $key == 'academic_year' or $key == 'exam_id' or $key == 'reason') continue;
                $data[$key] = $value;
            }

            if ($year->update($data)) {
                # code...
                LaravelSweetAlert::setMessage([
                    'title' => 'Successful',
                    'text' => "Action Successful",
                    'timer' => 3000,
                    'type' => 'success',
                    'showConfirmButton' => false
                ]);
                return redirect()->back();
            } else {
                # code...
                LaravelSweetAlert::setMessage([
                    'title' => 'Action Not Unsuccessful',
                    'text' => "Details not saved",
                    'timer' => 4000,
                    'type' => 'error',
                    'showConfirmButton' => false
                ]);
                return redirect()->back();
            }
        }else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Action Not Unsuccessful',
                'text' => "Details not saved",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }
}

