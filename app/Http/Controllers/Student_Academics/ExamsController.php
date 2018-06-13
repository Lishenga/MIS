<?php

namespace App\Http\Controllers\Student_Academics;

use App\Exam_Marks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Students;
use App\Courses;
use App\Exams;
use App\Units;
use App\Academic_years;
use App\Batch;
use App\Marks;
use App\Exam_category;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;
use App\Grading;


class ExamsController extends Controller
{

    public function exams(){
        $category = Exam_category::get();
        $batch = Batch::get();
        $academic = Academic_years::get();
        $unit = Units::get();
        $exam = Exams::get();
        $grading = Grading::get();

        return view('Student_Academics.Exams')->with([
            'academic'=> $academic,
            'category'=> $category,
            'batch' => $batch,
            'unit' => $unit,
            'exam' => $exam,
            'grading'=>$grading,
        ]);

    }


    public function creation(Request $request){
        switch ($q = $request->Input('q')) {
            case 0:

                $units= $request->Units;
                $year = new Exams;
                $year->Units = json_encode($units);

                foreach ($request->all() as $key => $value) {
                    //creating objects excluding the _token
                    if ($key == 'q' || $key == '_token' || $key == 'Units') continue;
                    $year->$key = $value;
                }

                if ($year->save()) {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Exam Created Successfully",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' => false
                    ]);
                    return redirect()->back();
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Exam Unsuccessfully Created",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' => false
                    ]);
                    return redirect()->back();
                }

                break;

            case 2:
                $data=[];
                $year = Exams::where('id',$request->id)->first();
                $units= $request->Units;
                if ($units != '') {
                    $year->update(array(
                        'Units' => json_encode($units),
                    ));
                }

                foreach ($request->all() as $key => $value) {
                    //creating array excluding the _token the array will be used for update
                    if ($key=='_token'||$key=='id'||$key=='q'||$key== 'Units')continue;
                    $data[$key]=$value;
                }

                if ($year->update($data)){

                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Exam Updated",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' => false
                    ]);
                    return redirect('studentacademics/exams');
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Exam Unsuccessfully Updated",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' => false
                    ]);
                    return redirect()->back();
                }

                break;

            case 3:
                $examiner = Exams::where('id',$request->id)->first();
                $students = Students::where('id','=',$request->student)->first();
                $studentcourse = Courses::where('id','=',$students->course_id)->first();
                $batch = Batch::where('id', '=', $students->batch_id)->first();
                $academician = Academic_years::where('id',$examiner->Academic_year)->first();
                $academic = Academic_years::get();
                $exam = Exams::get();

                $unit = Units::get();

                return view('Student_Academics.Layouts.ViewExam')->with([
                    'unitdepart'=> $unit,
                    'student'=> $students,
                    'studentcourse'=> $studentcourse,
                    'batch'=> $batch,
                    'exam'=> $exam,
                    'examiner'=> $examiner,
                    'academic'=> $academic,
                    'academician'=> $academician,
                ]);

                break;

            case 4:
                $year = new Marks;
                $data = [];
                $build = [];
                foreach ($request->all() as $key => $value) {
                    //creating objects excluding the _token
                    if ($key == 'q' || $key == '_token' || $key == 'Student_id' || $key == 'Semester' || $key == 'Academic_year' || $key == 'Exam_id') continue;
                    $data[$key]=$value;
                }
                $exam = Exams::where('id',$request->Exam_id)->first();

                foreach ($data as $key=> $value){
                    $build[$key]=($value/$exam->out_of)*100;
                }

                $year->Results =json_encode($build);
                $year->Student_id=$request->Student_id;
                $year->Academic_year=$request->Academic_year;
                $year->Semester=$request->Semester;
                $year->Exam_id=$request->Exam_id;

                if ($year->save()) {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Marks Recorced Successfully",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' => false
                    ]);
                    return redirect('studentacademics/students/view/'.$request->Student_id);
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

                break;
        }
    }

    public function finaltally(Request $request){
        $markss = Marks::where('Student_id',$request->student)->where('Academic_year',$request->Academic_year)->get();
        if( $markss = null){
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "No Marks Available for Final Tally to be Calculated",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }elseif($mark = Marks::where('Student_id',$request->student)->where('Academic_year',$request->Academic_year)->get() != null){

            $category = Exam_category::where('academic_year',$request->Academic_year)->get();

            $mark = Marks::where('Student_id',$request->student)->where('Academic_year',$request->Academic_year)->get();

            $data =[];

            /**
             **build array for student marks for each exam category
             **{CAT:{'marks':{1:20,2:30}},}

             **/
            foreach ($category as $categories){
                foreach ($mark as $marks){

                    $exam_cat_id=Exams::where('id',$marks->Exam_id)->first();


                    if($exam_cat_id->Category != $categories->id)continue;
                    $data[$categories->Name] = [
                        'marks'=>json_decode($marks->Results),
                        'percentage'=>$categories->Percentage
                    ];

                }
            }

            /*
                loop through the values to calculate the
                totals as a value of the set percentage
            */
            $sub_totals=[];
            foreach ($data as $key1 => $value1) {
                # code...
                foreach ($value1['marks'] as $key2 => $value2) {
                    # code...
                    $sub_totals[$key2][]=$value2*0.01*$value1['percentage'];

                }
            }



            $total=[];
            foreach ($sub_totals as $key => $value) {
                # code...
                $total[$key]=array_sum($value);

            }

            $exam_grading =Exams::where('id',$marks->Exam_id)->first();

            $exam_mark = new Exam_Marks();
            $exam_mark->Student_id = $request->student;
            $exam_mark->academic_year = $request->Academic_year;
            $exam_mark->Marks = json_encode($total);
            $exam_mark->grading = $exam_grading->grading;

            if ($exam_mark->save()) {
                # code...

                $student = Students::where('id',$request->student)->first();
                $status = 1;
                if ($status != '') {
                    $student->update(array(
                        'Exam_Status' => $status,
                    ));
                }
                LaravelSweetAlert::setMessage([
                    'title' => 'Successful',
                    'text' => "Marks Recorced Successfully",
                    'timer' => 3000,
                    'type' => 'success',
                    'showConfirmButton' => false
                ]);
                return redirect('studentacademics/');
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
    }

    public function delete($id){

        $exam = Exams::where('id',$id)->first();
        if ( $exam){
            # code...
            $exam->delete();
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Exam Deleted",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Exam Not Deleted",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function update($id){
        $category = Exam_category::get();
        $batch = Batch::get();
        $academic = Academic_years::get();
        $unit = Units::get();
        $exam = Exams::where('id',$id)->first();
        $grading = Grading::get();

        return view('Student_Academics.Layouts.ExamsLayouts.updateexam')->with([
            'academic'=> $academic,
            'category'=> $category,
            'batch' => $batch,
            'unit' => $unit,
            'exams' => $exam,
            'grading'=>$grading,
        ]);
    }
}
