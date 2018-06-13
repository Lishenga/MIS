<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Batch;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;
use App\Courses;
use App\Units;
use App\Units_for_next_sem;

class SettingsController extends Controller
{

    public function settings (){
        $batch = Batch::get();
        $unit = Units::get();

        return view('Students.Settings')->with([
            'batch'=> $batch,
            'unit' => $unit,
        ]);
    }

    public function classroll(Request $request){
        if($batches = $request->Batches) {
            foreach ($batches as $batch){
                $batchsp = Batch::where('id',$batch)->first();
                $course = Courses::where('id',$batchsp->course_id)->first();
                $duration = $course->duration;
                $semeters = $course->semesters;
                $year = $batchsp->academicyear;
                $sem = $batchsp->academicsemester;
                if($year < $duration){
                    if($sem < $semeters){
                        $batchsp->update(array(
                            'academicsemester' => $batchsp->academicsemester+1,
                        ));

                        $batchsp->update(array(
                            'Batch_category' => 'ONGOING',
                        ));

                        $batchsp->update(array(
                            'Start_date' => $request->input('Start_date'),
                        ));

                    }elseif ($sem = $semeters){
                        $batchsp->update(array(
                            'academicyear' => $batchsp->academicyear+1,
                        ));
                        $batchsp->update(array(
                            'academicsemester' => '1',
                        ));

                        $batchsp->update(array(
                            'Batch_category' => 'ONGOING',
                        ));

                        $batchsp->update(array(
                            'Start_date' => $request->input('Start_date'),
                        ));
                    }
                }elseif ($year = $duration) {
                    if($sem < $semeters){
                        $batchsp->update(array(
                            'academicsemester' => $batchsp->academicsemester+1,
                        ));

                        $batchsp->update(array(
                            'Batch_category' => 'ONGOING',
                        ));

                        $batchsp->update(array(
                            'Start_date' => $request->input('Start_date'),
                        ));

                    }elseif ($sem = $semeters){
                        $batchsp->update(array(
                            'academicyear' => $batchsp->academicyear,
                        ));
                        $batchsp->update(array(
                            'academicsemester' => $batchsp->academicsemester,
                        ));

                        $batchsp->update(array(
                            'ClassStatus' => 'COMPLETED COURSE',
                        ));
                        $batchsp->update(array(
                            'Batch_category' => 'FINISHED',
                        ));

                    }
                }

            }
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Class Roll Successful",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();

        }  else{
            LaravelSweetAlert::setMessage([
                'title' => 'Class Roll Unsuccessful',
                'text' => "Details not saved",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function rollall(Request $request){

        $batches = Batch::get();
            foreach ($batches as $batch){
                $course = Courses::where('id',$batch->course_id)->first();
                $duration = $course->duration;
                $semeters = $course->semesters;
                $year = $batch->academicyear;
                $sem = $batch->academicsemester;
                if($year < $duration){
                    if($sem < $semeters){
                        $batch->update(array(
                            'academicsemester' => $batch->academicsemester+1,
                        ));

                        $batch->update(array(
                            'Batch_category' => 'ONGOING',
                        ));

                        $batch->update(array(
                            'Start_date' => $request->input('Start_date'),
                        ));

                    }elseif ($sem = $semeters){
                        $batch->update(array(
                            'academicyear' => $batch->academicyear+1,
                        ));
                        $batch->update(array(
                            'academicsemester' => '1',
                        ));

                        $batch->update(array(
                            'Batch_category' => 'ONGOING',
                        ));

                        $batch->update(array(
                            'Start_date' => $request->input('Start_date'),
                        ));
                    }
                }elseif ($year = $duration) {
                    if($sem < $semeters){
                        $batch->update(array(
                            'academicsemester' => $batch->academicsemester+1,
                        ));

                        $batch->update(array(
                            'Batch_category' => 'ONGOING',
                        ));

                        $batch->update(array(
                            'Start_date' => $request->input('Start_date'),
                        ));

                    }elseif ($sem = $semeters){
                        $batch->update(array(
                            'academicyear' => $batch->academicyear,
                        ));
                        $batch->update(array(
                            'academicsemester' => $batch->academicsemester,
                        ));

                        $batch->update(array(
                            'ClassStatus' => 'COMPLETED COURSE',
                        ));
                        $batch->update(array(
                            'Batch_category' => 'FINISHED',
                        ));

                    }
                }

            }
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "All Classes Rolled Successfully",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
    }

    public function nextsem(Request $request){

        $unit = json_encode($request->units);
        $year = new Units_for_next_sem;
        $year->units = $unit;
        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ($key=='_token' || $key=='units')continue;
            $year->$key = $value;
        }

        if ($year->save()){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Units Recorded Successfully",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Units Unsuccessfully Recorded",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }

    }
}
