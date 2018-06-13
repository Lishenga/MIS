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
            @include('Employees.portal.sidenav')
        </div>
        <div class="col-md-10">
            <div class="card-box">
        <div class="row" align="left">
            <a href="{{ url('HR/createjobgrade') }}" class="btn btn-custom"><i class="fa fa-fw fa-plus"></i>New JobGrade</a>
            <br>
        </div>
           
        </div>
        </div>
    </div>

@stop