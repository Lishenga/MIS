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

    @include('Students.Layouts.nav')

    <div class="col-md-2">

        @include('Students.Layouts.AppNav')

    </div>

    

    <div class="col-md-9">

    <!-- Add User Modal -->



            <form role="form"   method="POST" action="{{ url('/students/apply/students') }}" enctype="multipart/form-data">

                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">

                        <label  for="form-username">Image<span class="text-danger">*</span></label>

                        <input type="file" name="image" placeholder="Image..." class="form-username form-control"  required parsley-type="text">

                    </div>


                    <input type="hidden" name="q" value="10">

                    <input type="hidden" name="Application_id" value="{{$application->id}}">

                </div>

                <div class="modal-footer form-group">

                    <button type="submit" class="btn btn-info">Save</button>

                </div>

            </form>


    </div>



@stop




