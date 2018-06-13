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
   <div class="row container-fluid">
         <div class="col-md-2">
        @include('Employees.Layouts.AppNav')
    </div>

    <div class="col-md-10">
        <div class="card-box" >
            <h3 class="center" >Employee's Physical Disabilities</h3>
            <div class="center">
                <form role="form"   method="POST" action="{{ url('HR/employee/create') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="sell">Physical challenge <span class="text-danger">*</span></label>
                            <select class="form-control selectpicker" id="sel1" name="Physical" data-live-search="true">
                                <option value="YES">Yes</option>
                                <option value="NO">No</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label  for="form-username">Description<span class="text-danger">*</span></label>
                            <textarea rows="4" cols="50" name="PhysicalDescription" class="form-username form-control"  required parsley-type="text">
                        </textarea>
                        </div>
                        <input type="hidden" name="q" value="7">
                        <input type="hidden" name="id" value="{{$employee->id}}">
                    </div>
                    <div class="modal-footer form-group">
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   </div>

@stop