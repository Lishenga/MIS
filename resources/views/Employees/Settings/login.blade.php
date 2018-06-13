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
            <h3 class="center" >Employee's Login Status</h3>
            <div class="center">
                @if($employee->login==false)
                    <div class="alert alert-warning">
                        <p>The Employee Cannot Log In to the system</p>
                    </div>
                    <br>
                    <a href="{{ url('HR/employee/allow/login') }}?id={{$employee->id}}" class="btn btn-success btn-block">Allow Login</a>
                @else
                    <div class="alert alert-success">
                        <p>The button below will reset the password to the default</p>
                    </div>
                    <br>
                    <a href="{{ url('HR/employee/reset/password') }}" class="btn btn-success btn-block">Reset Password</a>
                @endif
            </div>
        </div>
    </div>
   </div>

@stop