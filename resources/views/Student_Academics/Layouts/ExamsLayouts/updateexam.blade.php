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



@section('styles')

    <style>

        .multiselect {

            width: 200px;

        }



        .selectBox {

            position: relative;

        }



        .selectBox select {

            width: 100%;

            font-weight: bold;

        }



        .overSelect {

            position: absolute;

            left: 0;

            right: 0;

            top: 0;

            bottom: 0;

        }



        #checkboxes {

            display: none;

            border: 1px #dadada solid;

        }



        #checkboxes label {

            display: block;

        }



        #checkboxes label:hover {

            background-color: #1e90ff;

        }

    </style>



@endsection
@section('content')



<div class="row">

    <div class="col-md-2">



        @include('Student_Academics.Layouts.ExamsLayouts.Sidebarnav')

    </div>
    <div class="col-md-10" >

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="myModalLabel">Update Exam Details</h4>

                </div>

                <div class="modal-body">

                    <form role="form"   method="POST" action="{{ url('/studentacademics/students/creation') }}" enctype="multipart/form-data">

                        <div class="modal-body">

                            {{ csrf_field() }}

                            <div class="row">

                                <div class="form-group center col-md-4">

                                    <label  for="form-username">Name<span class="text-danger">*</span></label>

                                    <input type="text" name="Name" placeholder="Name..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group  col-md-4">

                                    <label  for="form-username">Semester<span class="text-danger">*</span></label>

                                    <select class="form-control selectpicker" id="sell" name="Semester" data-live-search="true">

                                        <option value="1">Sem 1</option>

                                        <option value="2">Sem 2</option>

                                        <option value="3">Sem 3</option>

                                        <option value="4">Sem 4</option>

                                        <option value="5">Sem 5</option>

                                        <option value="6">Sem 6</option>

                                    </select>

                                </div>

                                <div class="form-group center col-md-4">

                                    <label  for="form-username">Exam Status<span class="text-danger">*</span></label>

                                    <input type="text" name="Status" placeholder="Exam Status..." class="form-username form-control"  required parsley-type="text">

                                </div>

                            </div>



                            <div class="row">

                                <div class="form-group  col-md-4">

                                    <label for="sell">Class <span class="text-danger">*</span></label>

                                    <select class="form-control selectpicker" id="sell" name="batch_id" data-live-search="true">

                                        @foreach($batch as $batches)

                                            <option value="{{$batches->id}}">{{$batches->Batch_code}}</option>

                                        @endforeach

                                    </select>

                                </div>



                                <div class="form-group  col-md-4">

                                    <label  for="form-username">Academic Year<span class="text-danger">*</span></label>

                                    <select class="form-control selectpicker" id="sell" name="Academic_year" data-live-search="true">

                                        @foreach($academic as $academics)

                                            <option value="{{$academics->id}}">{{$academics->Name}}</option>

                                        @endforeach

                                    </select>

                                </div>



                                <div class="form-group  col-md-4">

                                    <label for="sell">Exam Category<span class="text-danger">*</span></label>

                                    <select class="form-control selectpicker" id="sell" name="Category" data-live-search="true">

                                        @foreach($category as $categories)

                                            <option value="{{$categories->id}}">{{$categories->Name}}</option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-md-4">

                                    <label for="sell">Units<span class="text-danger">*</span></label>

                                    <select class="selectpicker" multiple data-max-options="10" name="Units[]" data-live-search="true">

                                        @foreach($unit as $units)

                                            <option value="{{$units->unit_code}} {{$units->unit_name}}">{{$units->unit_code}} {{$units->unit_name}}</option>

                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group center col-md-4">

                                    <label  for="form-username">Supplementary Exam Pass Mark<span class="text-danger">*</span></label>

                                    <input type="text" name="supplementarypassmark" placeholder="Supplementary Exam Pass Mark..." class="form-username form-control">

                                </div>

                                <div class="form-group center col-md-4">

                                    <label  for="form-username">Supplementary Exam Maximum Number of Attempts<span class="text-danger">*</span></label>

                                    <input type="text" name="supmaxattempts" placeholder="Supplementary Exam Maximum Number of Attempts..." class="form-username form-control">

                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group center col-md-6">

                                    <label  for="form-username">Out of<span class="text-danger">*</span></label>

                                    <input type="text" name="out_of" placeholder="Exam will be out of..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group  col-md-6">

                                    <label for="sell">Grading System<span class="text-danger">*</span></label>

                                    <select class="form-control selectpicker" id="sell" name="grading" data-live-search="true">

                                        @foreach($grading as $gradings)

                                            <option value="{{$gradings->id}}">{{$gradings->name}}</option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                            <input type="hidden" name="q" value="2">

                            <input type="hidden" name="id" value="{{$exams->id}}">

                        </div>

                        <div class="modal-footer form-group">

                            <button type="submit" class="btn btn-info">Update</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>



@stop



@section('scripts')

    <script>

        var expanded = false;



        function showCheckboxes() {

            var checkboxes = document.getElementById("checkboxes");

            if (!expanded) {

                checkboxes.style.display = "block";

                expanded = true;

            } else {

                checkboxes.style.display = "none";

                expanded = false;

            }

        }

    </script>

@stop