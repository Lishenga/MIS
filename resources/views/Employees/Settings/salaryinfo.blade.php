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
            <div class="card-box">
            <form method="POST" action="{{ url('HR/employee/updatesalary')}}">

                {{ csrf_field() }}

            
                <legend></legend>
                <input value="{{$employee->id}}" name="id" type="hidden">

                <h3>Items</h3>
                <div class="alert alert-success">
                    <p> Fill the Items Below with the required amount for each value </p>
                </div>

                <legend></legend>
                
                @if($employee->salary !=''||$employee->salary!=null)
                    @forelse(json_decode($employee->salary_items) as $key => $value)
                        <div class="form-group col-md-6">
                            <label  for="form-username">{{$key}}<span class="text-danger">*</span></label>
                            <input type="number" name="{{$key}}" class="form-username form-control"  value="{{$value}}" required parsley-type="text">
                        </div>
                    @empty
                        <p> no salary items present </p>
                    @endforelse
                @elseif($employee->job_grade ==''|| $employee->job_grade == null)
                    <div class="alert alert-warning">
                        <p> No Job Grade Set Please Set Job Grade First</p>
                    </div> 
                @else
                    @forelse(json_decode($employee->jobGrade->salary_items) as $key => $value)
                        <div class="form-group col-md-6">
                            <label  for="form-username">{{$key}}<span class="text-danger">*</span></label>
                            <input type="number" name="{{$key}}" class="form-username form-control"  value="{{$value}}" required parsley-type="text">
                        </div>
                    @empty
                        <p> no salary items present </p>
                    @endforelse
                   
                @endif


                <div class="row" align="left">
                    <button type="submit" class="btn btn-custom"><i class="fa fa-fw fa-plus"></i>Save</a>
                    <br>
                </div>
            </form>
           
        </div>
        </div>
    </div>

@stop