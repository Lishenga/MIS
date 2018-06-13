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

                        <h4 class="header-title m-t-0 m-b-30 text-warning">Exam Timetable</h4>

                        <div class="">

                            <div class="row">
                                <div align="left" style="margin-top: 20px">

                                    <a href="{{ url('studentacademics/timetable/make') }}" class="btn btn-custom"><i class="fa fa-fw fa-plus"></i>Create Exam Timetable </a>

                                    <br>

                                </div>

                                <div align="right" style="margin-top: -25px">

                                    <a href="{{ url('studentacademics/timetable/pdf') }}" class="btn btn-custom"><i class="fa fa-fw fa-plus"></i>Download Exam Timetable </a>

                                    <br>

                                </div>

                                <div class="table-responsive">

                                    <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-custom">

                                        <thead>



                                        <tr>

                                            <th>Exam Name</th>

                                            <th>Class</th>

                                            <th>Unit</th>

                                            <th>Venue</th>

                                            <th>Day</th>

                                            <th>Time</th>

                                            <th>Action</th>

                                        </tr>



                                        </thead>





                                        <tbody>

                                        @forelse($timetable as $timetables)

                                            <tr>

                                                @foreach($category as $categories)

                                                    @if($categories->id == $timetables->category_id)

                                                        <td>{{ $categories->Name }}</td>

                                                    @endif

                                                @endforeach

                                                    @foreach($batch as $batches)

                                                        @if($batches->id == $timetables->batch_id)

                                                            <td>{{ $batches->Batch_code }}</td>

                                                        @endif

                                                    @endforeach

                                                <td>{{ $timetables->unitname }}</td>

                                                <td>{{ $timetables->venue }}</td>

                                                <td>{{ $timetables->day	 }}</td>

                                                <td>{{ $timetables->time }}</td>

                                                <td>

                                                    <a href="{{url('studentacademics/timetable/delete')}}/{{$timetables->id}}" class="btn btn-danger" onclick="return confirm('Do you want to delete {{$timetables->unitname}}')"><i class="fa fa-fw fa-trash"></i></a>

                                                    <a data-toggle="modal" data-target="#myTimetableUpdate{{$timetables->id}}" class="btn btn-primary"><i class=" fa fa-fw fa-pencil "></i></a>

                                                </td>

                                            </tr>





                                            <!-- Add User Modal -->

                                            <div class="modal fade" id="myTimetableUpdate{{$timetables->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">



                                                <div class="modal-dialog" role="document">

                                                    <div class="modal-content">

                                                        <div class="modal-header">

                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                            <h4 class="modal-title" id="myModalLabel">Update Exam Timetable Details</h4>

                                                        </div>

                                                        <div class="modal-body">

                                                            <form role="form"   method="POST" action="{{ url('/studentacademics/timetable/update') }}" enctype="multipart/form-data">

                                                                <div class="modal-body">

                                                                    {{ csrf_field() }}

                                                                    <div class="row">

                                                                        <div class="form-group  col-md-4">

                                                                            <label for="sell">Course <span class="text-danger">*</span></label>

                                                                            <select class="form-control selectpicker" id="sell" name="unitname" data-live-search="true">

                                                                                @foreach($exam as $exams)
                                                                                    @foreach(json_decode($exams->Units) as $unit)

                                                                                        <option value="{{$unit}}">{{$unit}}</option>

                                                                                    @endforeach
                                                                                @endforeach

                                                                            </select>

                                                                        </div>

                                                                        <div class="form-group center col-md-4">

                                                                            <label for="sell">Class <span class="text-danger">*</span></label>

                                                                            <select class="form-control selectpicker" id="sell" name="batch_id" data-live-search="true">

                                                                                @foreach($batch as $batches)

                                                                                    <option value="{{$batches->id}}">{{$batches->Batch_name}}</option>

                                                                                @endforeach

                                                                            </select>

                                                                        </div>

                                                                        <div class="form-group center col-md-4">

                                                                            <label  for="form-username">Venue<span class="text-danger">*</span></label>

                                                                            <input type="text" name="venue" placeholder="Venue..." class="form-username form-control"  required parsley-type="text">

                                                                        </div>



                                                                    </div>



                                                                    <div class="row">


                                                                        <div class="form-group  col-md-4">

                                                                            <label  for="form-username">Exam Category<span class="text-danger">*</span></label>

                                                                            <select class="form-control selectpicker" id="sell" name="category_id" data-live-search="true">

                                                                                @foreach($category as $categories)

                                                                                    <option value="{{$categories->id}}">{{$categories->Name}}</option>

                                                                                @endforeach

                                                                            </select>

                                                                        </div>



                                                                        <div class="form-group center col-md-4">

                                                                            <label  for="form-username">Day<span class="text-danger">*</span></label>

                                                                            <input type="date" name="day" class="form-username form-control"  required parsley-type="text">

                                                                        </div>

                                                                        <div class="form-group center col-md-4">

                                                                            <label  for="form-username">Time<span class="text-danger">*</span></label>

                                                                            <input type="text" name="time" placeholder="Time..." class="form-username form-control"  required parsley-type="text">

                                                                        </div>

                                                                        <input type="hidden" name="id" value="{{$timetables->id}}">

                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer form-group">

                                                                    <button type="submit" class="btn btn-info">Update</button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>

                                                </div>



                                            </div>

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











