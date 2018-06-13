<?php

namespace App\Http\Controllers\Student_Academics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Grading;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;

class GradingController extends Controller
{
    public function view(){
        $grading = Grading::get();

        return view('Student_Academics.grading')->with([
           'grading'=>$grading,
        ]);
    }

    public function create(Request $request){
        $year = new Grading();
        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ( $key == '_token') continue;
            $year->$key = $value;
        }

        if ($year->save()) {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Grading System Created Successfully",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Grading System Unsuccessfully Created",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function update (Request $request){
        $data=[];
        $year = Grading::where('id',$request->id);
        foreach ($request->all() as $key => $value) {
            //creating array excluding the _token the array will be used for update
            if ($key=='_token'||$key=='id')continue;
            $data[$key]=$value;
        }
        if($year->update($data)){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Grading System Updated",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Grading System Not Updated",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function delete($id){

        if ($timetable = Grading::where('id',$id)->first()){

            $timetable->delete();

            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Grading System Successfully Deleted",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Grading System Unsuccessfully Deleted",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }
}
