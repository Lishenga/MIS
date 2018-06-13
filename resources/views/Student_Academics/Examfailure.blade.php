@extends('layouts.master')



@section('breadcrumb')

    <ol class="breadcrumb hide-phone p-0 m-0">

        <li class="active">

            <a href="{{ url('/dashboard') }}"> Dashboard</a>/

            <a href="{{ url('/pos') }}"> Point Of Sale</a>/

            <a href="{{ url('/pos/suppliers') }}">Supplier</a>

        </li>

    </ol>

@stop

@section('page_title') POS @stop

@section('content')

    <div class="panel panel-default">

        <div class="panel-body">

            <div class="col-md-2">



                @include('Student_Academics.Layouts.ExamsLayouts.Sidebarnav')

            </div>

            <div class="col-md-10">

                <div class="card-box row">

                    <div class="col-md-12">

                        &nbsp;

                        <h4 class="header-title m-t-0 m-b-30 text-warning">Students Who Failed Exams</h4>

                        <div class="">

                            <div class="row">

                                <div class="table-responsive">

                                    <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-custom">

                                        <thead>



                                        <tr>

                                            <th>Admission Number</th>

                                            <th>Course</th>

                                            <th>First Name</th>

                                            <th>Middle Names</th>

                                            <th>Reason</th>

                                            <th>Academic Year</th>

                                            <th>Units Failed</th>

                                            <th>Carry Forward</th>

                                            <th>Action</th>

                                        </tr>



                                        </thead>





                                        <tbody>

                                        @forelse($failure as $failures)

                                            @foreach($student as $students)

                                                @if($students->id == $failures->student_id)

                                                    @if($students->Exam_Status == 1 or $failures->reason == 'CARRYFORWARD')

                                                            <tr>

                                                                <td>{{ $students->admission_number }}</td>

                                                                @foreach($course as $courses)

                                                                    @if($courses->id == $students->course_id)

                                                                            <td>{{ $courses->course_name }}</td>

                                                                    @endif

                                                                @endforeach

                                                                <td>{{ $students->first_name }}</td>

                                                                <td>{{ $students->middle_names }}</td>

                                                                <td>{{ $failures->reason }}</td>

                                                                <td>{{ $failures->academic_year}}</td>

                                                                <td>

                                                                @foreach(json_decode( $failures->units) as $units)

                                                                    <div class="alert alert-success"  style="padding:3px; border-radius:5%;">

                                                                    {{ $units}}

                                                                    </div>

                                                                @endforeach

                                                                </td>

                                                                    @if($failures->reason == 'FAIL')

                                                                        <td>

                                                                            <form role="form"   method="POST" action="{{ url('studentacademics/examfailure/forward') }}" enctype="multipart/form-data">

                                                                                <div class="modal-body">

                                                                                    {{ csrf_field() }}

                                                                                    <input type="hidden" name="student_id" value="{{$students->id}}">

                                                                                    <input type="hidden" name="academic_year" value="{{$failures->academic_year}}">

                                                                                    <input type="hidden" name="exam_id" value="{{$failures->examtodo}}">

                                                                                    <input type="hidden" name="academic_Status" value="PROCEED">

                                                                                    <input type="hidden" name="reason" value="CARRYFORWARD">

                                                                                    <input type="hidden" name="reporting_date" value="{{date('YmdHis')}}">

                                                                                </div>

                                                                                    <button type="submit" class="btn btn-info">Proceed</button>
                                                                            </form>

                                                                        </td>
                                                                    @else

                                                                    <td>

                                                                        Not Applicable

                                                                    </td>

                                                                    @endif

                                                                <td>

                                                                    <a href="{{url('studentacademics/examfailure/particular')}}/{{$students->id}}" class="btn btn-custom"><i class=" fa fa-fw fa-pencil "></i></a>

                                                                </td>

                                                            </tr>

                                                        @endif

                                                    @endif

                                            @endforeach

                                        @empty

                                            <p>No Data Found</p>

                                        @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



@stop











