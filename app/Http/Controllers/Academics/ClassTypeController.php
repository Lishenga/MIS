<?php

namespace App\Http\Controllers\Academics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;
use App\ClassType;

class ClassTypeController extends Controller
{

    public function view(){
        $class = ClassType::get();

        return view('Academics2.ClassType')->with([
            'class'=> $class,
        ]);
    }

    public function create(Request $request){
        $year = new ClassType();
        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ($key=='_token')continue;
            $year->$key = $value;
        }

        if ($year->save()){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "ClassType Created Successfully",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "ClassType Unsuccessfully Created",
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

        If(ClassType::where('id',$id)){
            $default = ClassType::where('id', '=', $id)->first();

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
        $year = ClassType::where('id',$request->id);
        foreach ($request->all() as $key => $value) {
            //creating array excluding the _token the array will be used for update
            if ($key=='_token'||$key=='id')continue;
            $data[$key]=$value;
        }

        if ($year->update($data)){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Class Type Details Updated",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Class Type Details Not Updated",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }
}
