@extends('layouts.master')



@section('breadcrumb')

    <ol class="breadcrumb hide-phone p-0 m-0">

        <li class="active">

            <a href="{{ url('/dashboard') }}"> Dashboard</a>/

            <a href="{{ url('/finance') }}"> Finance</a>

        </li>

    </ol>

@stop

@section('page_title') Finance @stop

@section('content')





    <div class="col-md-2">



        @include('Student_Academics.Layouts.ExamsLayouts.examfailurenav')

    </div>

    <div class="col-md-10">

        <div class="card-box row">

            <div class="col-md-12">

                &nbsp;

                <h4 class="header-title m-t-0 m-b-30 text-warning">Input Student's Marks for Units Failed</h4>

                <div class="">

                    <div class="row">

                        <div class="col-md-4">

                            <h5> {{$student->first_name}} {{$student->middle_names}}</h5>

                        </div>

                        <div class="col-md-4">

                            {{$course->course_name}}

                        </div>

                        <div class="col-md-4">

                            <h5>{{ $student->admission_number }}</h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="card-box" >

                    <h3 class="center" >Student's Results for Attempt {{$examfailure->attempt}}</h3>

                    <div class="center">

                        <div class="modal-body">

                            <div class="row">

                                <div class="form-group  col-md-9">

                                    <label for="sell">
                                        @foreach($exam as $exams)

                                            @foreach($category as $categories)

                                                @if($examfailure->examtodo == $exams->id)

                                                    @if($exams->Category == $categories->id)

                                                        {{$categories->Name}} out of {{$exams->out_of}}

                                                    @endif

                                                @endif

                                            @endforeach

                                        @endforeach
                                        <span class="text-danger">*</span>
                                    </label>

                                    <form role="form"   method="POST" action="{{ url('/studentacademics/examfailure/input') }}" enctype="multipart/form-data">

                                        <div class="modal-body">

                                            {{ csrf_field() }}



                                            <div class="row">

                                                <div class="form-group  col-md-12">

                                                    @foreach($course->units as $unit_data)

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                {{$unit_data}}

                                                            </div>

                                                            <div class="col-md-6">

                                                                <input type="number" name="{{$unit_data}}" placeholder="Marks..." class="form-username form-control"  required parsley-type="text"><br>

                                                            </div>

                                                        </div>

                                                    @endforeach

                                                </div>

                                                <div class="form-group  col-md-3">

                                                </div>

                                            </div>

                                            <input type="hidden" name="Student_id" value="{{$student->id}}">

                                            <input type="hidden" name="Academic_year" value="{{$examfailure->academic_year}}">

                                            <input type="hidden" name="Exam_id" value="{{$examfailure->examtodo}}">

                                        </div>

                                        <div class="modal-footer form-group">

                                            <button type="submit" class="btn btn-info">Submit</button>

                                        </div>

                                    </form>

                                </div>

                                <div class="form-group  col-md-3">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



        </div>

    </div>







@stop