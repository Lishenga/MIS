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
            @include('Employees.Layouts.sidenav')
        </div>
    <div class="col-md-10">
    <div class="card-box">
        <div class="row" align="left">
            <a href="{{ url('HR/payslip/generate') }}" class="btn btn-custom"><i class="fa fa-fw fa-plus"></i>Generate Payslips</a>
            <br>
        </div>
        <div class="table-responsive">
            <h3 class="center">PaySlips</h3>
            <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-custom">
                <thead>

                <tr>
                    <th>Employee</th>
                    <th>Items</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th>Action</th>
                   
                </tr>

                </thead>


                <tbody>
                @forelse($payslips as $payslip)
                    <tr>
                        <td>{{$payslip->employee->First_name}} {{$payslip->employee->Middle_name}} {{$payslip->employee->Last_name}}</td>
                        <td>
                            @foreach(json_decode($payslip->salary_items) as $key => $value)
                                <div class="alert alert-success col-sm-3" style="padding:2px; margin:2px;">
                                 {{ $key }} - {{ $value }} 
                                </div> 
                            @endforeach
                           
                        </td>
                        <td>{{$payslip->salary}}</td>
                        <td>{{$payslip->status}}</td>
                        <td>
                            <!-- <a href="{{url('HR/payslip/download')}}?id={{$payslip->id}}" class="btn btn-danger" ><i class="fa fa-fw fa-trash"></i></a>-->
                            <a href="{{url('HR/payslip/download')}}?id={{$payslip->id}}" class="btn btn-custom"><i class=" fa fa-fw fa-download "></i></a>
                        </td>
                    </tr>
                @empty
                    <p>No Data Found</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>   

@stop