<?php

namespace App\Http\Controllers\Student_Academics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exam_category;
use App\Academic_years;
use Riazxrazor\LaravelSweetAlert\LaravelSweetAlert;

class Exam_CategoryController extends Controller
{
    public function category(){

        $category = Exam_category::get();
        $year = Academic_years::get();

        return view('Student_Academics.Category')->with([
            'category'=>$category,
            'academic'=> $year,
        ]);
    }

    public function create(Request $request){

        $year = new Exam_category();
        foreach ($request->all() as $key => $value) {
            //creating objects excluding the _token
            if ($key == 'q' || $key == '_token') continue;
            $year->$key = $value;
        }

        if ($year->save()) {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Exam Category created successfully",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Exam Category Unsuccessfully Created",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function update(Request $request){
        $data=[];
        $year = Exam_category::where('id',$request->id);
        foreach ($request->all() as $key => $value) {
            //creating array excluding the _token the array will be used for update
            if ($key=='_token'||$key=='id')continue;
            $data[$key]=$value;
        }

        if ($year->update($data)){
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Exam Category Updated",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Exam Category Unsuccessfully Updated",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }

    public function delete($id){
        $year = Exam_category::where('id','=',$id)->first();

        if ($year){
            # code...
            $year->delete();
            LaravelSweetAlert::setMessage([
                'title' => 'Successful',
                'text' => "Exam Category Deleted",
                'timer' => 3000,
                'type' => 'success',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        } else {
            # code...
            LaravelSweetAlert::setMessage([
                'title' => 'Unsuccessful',
                'text' => "Exam Category Not Deleted",
                'timer' => 4000,
                'type' => 'error',
                'showConfirmButton' => false
            ]);
            return redirect()->back();
        }
    }
}
