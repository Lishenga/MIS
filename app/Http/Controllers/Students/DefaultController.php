<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Students;
use App\Courses;
use App\Applications;
use App\Batch;
use Illuminate\Support\Facades\Input;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;
use App\Primary;
use App\HighSchool;
use App\Tertiary;
use App\Documents;
use App\User;
use PDF;

class DefaultController extends Controller
{
    public function students()
    {
        # code...
        $students = Students::get();
        $course = Courses::get();
        $batch = Batch::get();
        return view('Students.students')->with([
            'student'=> $students,
            'course'=> $course,
            'batch'=> $batch,
        ]);
    }

    public function applications()
    {
        # code...
        $course = Courses::get();
        $batch = Batch::get();
        return view('Students.Settings.applications')->with([
            'course'=> $course,
            'batch'=> $batch,
        ]);
    }

    public function apply(Request $request)
    {
        switch ($q = $request->Input('q')){
            case 0:
                $year = new Applications;
                foreach ($request->all() as $key => $value) {
                    //creating objects excluding the _token
                    if ( $key=='q' || $key=='_token')continue;
                    $year->$key = $value;
                }

                if ($year->save()){
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Application successful",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
                    return redirect('students/applications');
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Application not successful",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                }

            break;

            case 1:
                $data=[];
                $year = Applications::where('id',$request->id);
                foreach ($request->all() as $key => $value) {
                    //creating array excluding the _token the array will be used for update
                    if ($key=='id'or $key=='q' or $key=='_token')continue;
                    $data[$key]=$value;
                }

                if ($year->update($data)){
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Details saved",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Details not saved",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                }

            break;

            case 2:
                $data=[];
                $year = Applications::where('id',$request->id);
                foreach ($request->all() as $key => $value) {
                    //creating array excluding the _token the array will be used for update
                    if ($key=='id'or $key=='q' or $key=='_token')continue;
                    $data[$key]=$value;
                }

                if ($year->update($data)){
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Details saved",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Details not saved",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                }

                break;

            case 3:
                $app = Applications::where('id', $request->input('Application_id'))->first();
                $name = $app->middle_names;
                $id = $app->id;
                $files=$request->Documents;
                $destinationPath = public_path().'/Applications/Primary/';
                foreach ($files as $file) {

                    //creating objects excluding the _token
                    $filename = $name.''.date('YmdHis').''.rand(5, 15).''.''.$file->getClientOriginalExtension();
                    $file->move($destinationPath, $filename);
                    $year = new Documents;
                    $year->Documents= $filename;
                    $year->Application_id=$id;
                    $year->Category='APPLICANT';
                    $year->Type='PRIMARY';

                    $year->save();
                }

                $primary = new Primary;
                foreach ($request->all() as $key1 => $value1) {
                    //creating objects excluding the _token
                    if ( $key1=='q' or $key1=='Documents' or $key1=='_token')continue;
                    $primary->$key1 = $value1;
                }

                if ( $primary->save()){
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Details Saved",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Details not saved",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                }
                break;

            case 4:
                $app = Applications::where('id', $request->input('Application_id'))->first();
                $name = $app->middle_names;
                $id = $app->id;
                $files=$request->Documents;
                $destinationPath = public_path().'/Applications/HighSchool/';
                foreach ($files as $file) {

                    //creating objects excluding the _token
                    $filename = $name.''.date('YmdHis').''.rand(5, 15).''.''.$file->getClientOriginalExtension();
                    $file->move($destinationPath, $filename);
                    $year = new Documents;
                    $year->Documents= $filename;
                    $year->Application_id=$id;
                    $year->Category='APPLICANT';
                    $year->Type='HIGHSCHOOL';

                    $year->save();
                }

                $high = new HighSchool;
                foreach ($request->all() as $key1 => $value1) {
                    //creating objects excluding the _token
                    if ( $key1=='q' or $key1=='Documents' or $key1=='_token')continue;
                    $high->$key1 = $value1;
                }

                if ( $high->save()){
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Details Saved",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Details not saved",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                }

                break;

            case 5:
                $app = Applications::where('id', $request->input('Application_id'))->first();
                $name = $app->middle_names;
                $id = $app->id;
                $files=$request->Documents;
                $destinationPath = public_path().'/Applications/Tertiary/';
                foreach ($files as $file) {

                    //creating objects excluding the _token
                    $filename = $name.''.date('YmdHis').''.rand(5, 15).''.''.$file->getClientOriginalExtension();
                    $file->move($destinationPath, $filename);
                    $year = new Documents;
                    $year->Documents= $filename;
                    $year->Application_id=$id;
                    $year->Category='APPLICANT';
                    $year->Type='TERTIARY';

                    $year->save();
                }

                $Tertiary = new Tertiary;
                foreach ($request->all() as $key1 => $value1) {
                    //creating objects excluding the _token
                    if ( $key1=='q' or $key1=='Documents' or $key1=='_token')continue;
                    $Tertiary->$key1 = $value1;
                }

                if ( $Tertiary->save()){
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Details Saved",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Details not saved",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                }

                break;
            case 6:
                $data=[];
                $year = Applications::where('id',$request->id);
                foreach ($request->all() as $key => $value) {
                    //creating array excluding the _token the array will be used for update
                    if ($key=='id'or $key=='q' or $key=='_token')continue;
                    $data[$key]=$value;
                }

                if ($year->update($data)){
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Details saved",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Details not saved",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                }

                break;

            case 7:
                $data=[];
                $year = Applications::where('id',$request->id);
                foreach ($request->all() as $key => $value) {
                    //creating array excluding the _token the array will be used for update
                    if ($key=='id'or $key=='q' or $key=='_token')continue;
                    $data[$key]=$value;
                }

                if ($year->update($data)){
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Details saved",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Details not saved",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                }

                break;

            case 8:
                $data=[];
                $year = Applications::where('id',$request->id)->first();
                foreach ($request->all() as $key => $value) {
                    //creating array excluding the _token the array will be used for update
                    if ($key=='id'or $key=='q' or $key=='_token')continue;
                    $data[$key]=$value;
                }

                if ($year->update($data)){
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Details saved",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Details not saved",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                }

                break;

            case 9:
                $app = Applications::where('id',$request->Application_id)->get();
                $id = $request->input('Application_id');
                $admin = $request->input('admission_number');

                $year = new Students;
                foreach ($app as $key){
                    $year->Application_id = $id;
                    $year->admission_number = $admin;
                    $year->first_name =$key->first_name;
                    $year->middle_names = $key->middle_names;
                    $year->Gender = $key->Gender;
                    $year->dob = $key->dob;
                    $year->Marital_Status = $key->Marital_Status;
                    $year->nationality = $key->nationality;
                    $year->National_id = $key->National_id;
                    $year->postal_address = $key->postal_address;
                    $year->telephone_number = $key->telephone_number;
                    $year->mobile_number = $key->mobile_number;
                    $year->Accommodation = $key->Accommodation;
                    $year->email_address = $key->email_address;
                    $year->Parent_names = $key->Parent_names;
                    $year->Relationship = $key->Relationship;
                    $year->reporting_date = date('YmdHis');
                    $year->Address = $key->Address;
                    $year->Phone_number = $key->Phone_number;
                    $year->Physical = $key->Physical;
                    $year->Description = $key->Description;
                    $year->Finances = $key->Finances;
                    $year->FinancesDescription = $key->FinancesDescription;
                    $year->course_id = $key->course_id;
                    $year->batch_id = $key->batch_id;
                    $year->image = $key->image;

                    $user=new User();
                    $user->name=$key->first_name;
                    $user->username=$year->admission_number;
                    $user->email=$key->email_address;
                    $user->password=bcrypt($admin);
                    $user->role='STUDENT';
                    $user->save();
                }

                if ($year->save()){
                        $status = Input::get('status');

                        $user = Applications::where('id', '=', $id);
                        $default = Applications::where('id', '=', $id)->first();

                        if ($status == '') {
                            $user->update(array(
                                'status' => $default->status,
                            ));
                        } else if ($status != '') {
                            $user->update(array(
                                'status' => $status,
                            ));
                        }

                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Successful',
                        'text' => "Student Registered Successfully",
                        'timer' => 3000,
                        'type' => 'success',
                        'showConfirmButton' =>false
                    ]);
                    $students = Students::get();
                    $course = Courses::get();
                    $batch = Batch::get();
                    return redirect('students/')->with([
                        'student'=> $students,
                        'course'=> $course,
                        'batch'=> $batch,
                    ]);
                } else {
                    # code...
                    LaravelSweetAlert::setMessage([
                        'title' => 'Unsuccessful',
                        'text' => "Student Not Registered",
                        'timer' => 4000,
                        'type' => 'error',
                        'showConfirmButton' =>false
                    ]);
                    return redirect()->back();
                }

                break;

                case 10:
                    $app = Applications::where('id', $request->input('Application_id'))->first();
                    $name = $app->middle_names;
                    $id = $app->id;
                    $files=$request->image;
                    $destinationPath = public_path().'/image/student/';
                    $filename = $name.''.date('YmdHis').''.rand(5, 15).''.''.$files->getClientOriginalExtension();
                    $files->move($destinationPath, $filename);

                    if ( $app != ''){
                        # code...
                        $app->update(array(
                            'image' => $filename,
                        ));

                        LaravelSweetAlert::setMessage([
                            'title' => 'Successful',
                            'text' => "Image Saved",
                            'timer' => 3000,
                            'type' => 'success',
                            'showConfirmButton' =>false
                        ]);
                        return redirect()->back();
                    } else {
                        # code...
                        LaravelSweetAlert::setMessage([
                            'title' => 'Unsuccessful',
                            'text' => "Image not saved",
                            'timer' => 4000,
                            'type' => 'error',
                            'showConfirmButton' =>false
                        ]);
                        return redirect()->back();
                    }

                break;

        }


    }

    public function printing(Request $request){
        $student = Students::where('id',$request->id)->first();
        $course = Courses::where('id',$student->course_id)->first();
        $image = public_path().'/image/student/'.$student->image;

        $pdf = PDF::loadView('Students.PDF.schoolid', [
            'student'=>$student,
            'course'=>$course,
            'image'=>$image,
            ]);
        return $pdf->download($student->admission_number.'.pdf');
    }


}
