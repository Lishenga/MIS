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

                        @include('Student_Academics.Layouts.ExamFailure.FinalMarksLayout.Fail')

                    </div>

                </div>

            </div>



        </div>

    </div>







@stop