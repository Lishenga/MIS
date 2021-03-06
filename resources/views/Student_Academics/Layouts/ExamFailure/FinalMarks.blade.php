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

                <h4 class="header-title m-t-0 m-b-30 text-warning">Student's Exam Details</h4>

                <div class="">

                    <div class="row">

                        <div class="col-md-3">

                            <h5> {{$student->first_name}} {{$student->middle_names}}</h5>

                        </div>

                        <div class="col-md-3">

                            {{$course->course_name}}

                        </div>

                        <div class="col-md-3">

                            <h5>{{ $student->admission_number }}</h5>

                        </div>

                        <div class="col-md-3">

                            <form role="form"   method="POST" action="{{ url('studentacademics/examfailure/transcript') }}" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                @foreach($exam as $exams)

                                    @foreach($academic as $academics)

                                        @if($academics->id == $examfailure->academic_year)

                                            <input type="hidden" name="student" value="{{$student->id}}">


                                            <input type="hidden" name="academic_year" value="{{ $academics->Name}}">
                                        @endif

                                    @endforeach

                                @endforeach

                                <button type="submit" class="btn btn-info">Print Final Transcript</button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="card-box" >

                    <h3 class="center" >Student's Results</h3>

                    <div class="center">

                        <div class="modal-body">

                            <div class="row">

                                <div class="form-group  col-md-12">

                                    <label for="sell">
                                        Supplementary Exam Marks for {{$marks}} Academic Year
                                        <span class="text-danger">*</span>
                                    </label>

                                    @forelse($course->units as $unit_data=> $value)

                                        @foreach($grading as $gradings)

                                            <div class="row">

                                                <div class="col-md-4">

                                                    {{$unit_data}}

                                                </div>

                                                <div class="col-md-4">

                                                    <input type="text" class="form-username form-control"  required parsley-type="text" value="{{$value}}" disabled>

                                                </div>

                                                <div class="col-md-4">

                                                    @if($gradings->id == $course->grades)

                                                        {{$gradings->name}} Grading

                                                        @if($value <= $gradings->amax and $value >= $gradings->amin)
                                                            Grade:  A
                                                        @elseif($value <= $gradings->bmax and $value >= $gradings->bmin)
                                                            Grade:  B
                                                        @elseif($value <= $gradings->cmax and $value >= $gradings->cmin)
                                                            Grade:  C
                                                        @elseif($value <= $gradings->dmax and $value >= $gradings->dmin)
                                                            Grade:  D
                                                        @elseif($value <= $gradings->emax and $value >= $gradings->emin)
                                                            Grade:  E
                                                        @endif

                                                    @endif

                                                </div>

                                            </div>

                                        @endforeach

                                    @empty

                                        no units

                                    @endforelse

                                </div>

                            </div>

                            <div class="modal-footer form-group">

                                <div class="row">
                                    <div class="col-md-6">

                                        <a href="{{url('studentacademics/examfailure/failure')}}?academic_year={{ $examfailure->academic_year}}&student_id={{ $examfailure->student_id}}&exam_id={{ $examfailure->exam_id}}" class="btn btn-custom">Fail</a>

                                    </div>

                                    <div class="col-md-6">

                                        <form role="form"   method="POST" action="{{ url('studentacademics/examfailure/proceed') }}" enctype="multipart/form-data">

                                            <div class="modal-body">

                                                {{ csrf_field() }}

                                                <input type="hidden" name="student_id" value="{{$student->id}}">

                                                <input type="hidden" name="academic_year" value="{{$examfailure->academic_year}}">

                                                <input type="hidden" name="exam_id" value="{{$failure->examtodo}}">

                                                <input type="hidden" name="reporting_date" value="{{date('YmdHis')}}">

                                            </div>

                                                <button type="submit" class="btn btn-info">Proceed</button>
                                        </form>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>



        </div>

    </div>







@stop