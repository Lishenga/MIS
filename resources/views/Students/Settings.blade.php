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

    @include('Students.Layouts.nav')

    <div class="panel panel-default">

        <div class="panel-body">

            <div class="col-md-3 card-box" style="margin: 20px">

                <div class="row" align="left">

                    <form role="form"   method="POST" action="{{ url('students/settings/roll') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group" style="margin: 20px">

                            <label  for="form-username">Next Semester/Term Start Date<span class="text-danger">*</span></label>

                            <input type="date" name="Start_date" placeholder="Next Semester/Term Start Date..." class="form-username form-control"  required parsley-type="text">

                        </div>

                        @foreach($batch as $batches)

                            @if($batches->Batch_category == 'ONGOING' or $batches->Batch_category == 'INITIAL')

                                <input type="hidden" name="academic_year" value="{{$batches->academicyear}}">
                                
                                <input type="hidden" name="academic_semester" value="{{$batches->academicsemester}}">

                            @endif
                            
                        @endforeach


                        <div class="form-group col-md-6" style="margin: 20px">

                            <label  for="form-username">Classes To Roll<span class="text-danger">*</span></label>

                            <select class="selectpicker" multiple data-max-options="10" name="Batches[]" data-live-search="true">

                                @foreach($batch as $batches)
                                    @if($batches->Batch_category == 'ONGOING' or $batches->Batch_category == 'INITIAL')

                                    <option value="{{$batches->id}}">{{$batches->Batch_code}}</option>

                                    @endif
                                @endforeach

                            </select>


                            <button type="submit" class="btn btn-info" style="margin-top: 20px">Class Roll</button>
                        </div>



                    </form>

                    <br>

                </div>

            </div>

            <div class="col-md-3 card-box" style="margin: 20px">
                <form role="form"   method="POST" action="{{ url('students/settings/rollall') }}" enctype="multipart/form-data">
                    <div class="form-group" style="margin: 20px">

                        <label  for="form-username">Next Semester/Term Start Date<span class="text-danger">*</span></label>

                        <input type="date" name="Start_date" placeholder="Next Semester/Term Start Date..." class="form-username form-control"  required parsley-type="text">

                    </div>
                    <button class="btn btn-info" style="margin-top: 20px">Roll all Classes at Once</button>
                </form>
            </div>


            <div class="col-md-3 card-box" style="margin: 20px">
                
                <div class="row" align="left">

                    <form role="form"   method="POST" action="{{ url('students/settings/nextsem') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group" style="margin: 20px">

                            <label  for="form-username">Class to assign units<span class="text-danger">*</span></label>
                            
                            <select class="selectpicker" data-max-options="10" name="batch_id" data-live-search="true">

                                @foreach($batch as $batches)

                                    @if($batches->Batch_category == 'ONGOING' or $batches->Batch_category == 'INITIAL')

                                    <option value="{{$batches->id}}">{{$batches->Batch_code}}</option>

                                    @endif

                                @endforeach

                            </select>

                        </div>
                        

                        <div class="form-group" style="margin: 20px">
                            
                            <label  for="form-username">Academic Year<span class="text-danger">*</span></label>
                            
                            <select class="selectpicker" data-max-options="10" name="academic_year" data-live-search="true">

                                @foreach($batch as $batches)

                                    @if($batches->Batch_category == 'ONGOING' or $batches->Batch_category == 'INITIAL')

                                    <option value="{{$batches->academicyear}}">{{$batches->academicyear}}</option>

                                    @endif

                                @endforeach

                            </select>

                        </div>

                        <div class="form-group" style="margin: 20px">
                            
                            <label  for="form-username">Academic Semester<span class="text-danger">*</span></label>
                            
                            <select class="selectpicker" data-max-options="10" name="academic_semester" data-live-search="true">

                                @foreach($batch as $batches)

                                    @if($batches->Batch_category == 'ONGOING' or $batches->Batch_category == 'INITIAL')

                                    <option value="{{$batches->academicsemester}}">{{$batches->academicsemester}}</option>

                                    @endif

                                @endforeach

                            </select>

                        </div>


                        <div class="form-group col-md-6"  style="margin: 20px">

                            <label  for="form-username">Units<span class="text-danger">*</span></label>

                            <select class="selectpicker" multiple data-max-options="10" name="units[]" data-live-search="true">

                                @foreach($unit as $units)

                                    <option value="{{$units->unit_code}} {{$units->unit_name}}">{{$units->unit_code}}  {{$units->unit_name}}</option>
                                    
                                @endforeach

                            </select>


                            <button type="submit" class="btn btn-info" style="margin-top: 20px">Assign</button>
                        </div>



                    </form>

                    <br>

                </div>

            </div>

        </div>



    </div>





@stop