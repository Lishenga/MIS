<?php

namespace App\Http\Controllers\Academics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;
use App\ClassStatus;

class ClassStatusController extends Controller
{

    public function view(){
        $class = ClassStatus::get();

        return view('Academics2.ClassStatus')->with([
            'class'=> $class,
        ]);
    }

    public function create(Request $request){
        $year = new ClassStatus();
        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ($key=='_token')continue;
            $year->$key = $value;
        }

        if ($year->save()){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "ClassStatus Created Successfully",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "ClassStatus Unsuccessfully Created",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function enabling(Request $request)
    {
        # code...

        $id = $request->input('id');
        $status = $request->input('status');

        If(ClassStatus::where('id',$id)){
            $default = ClassStatus::where('id', '=', $id)->first();

            if ($status != '') {
                $default->update(array(
                    'status' => $status,
                ));
            }
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Action Successful",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {

            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Action Unsuccessful",
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
        $year = ClassStatus::where('id',$request->id);
        foreach ($request->all() as $key => $value) {
            //creating array excluding the _token the array will be used for update
            if ($key=='_token'||$key=='id')continue;
            $data[$key]=$value;
        }

        if ($year->update($data)){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Class Status Details Updated",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Class Status Details Not Updated",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }
}
