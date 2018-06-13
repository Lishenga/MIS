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
            <form method="POST" action="{{ url('HR/createjobgrade')}}">

                {{ csrf_field() }}

                <h3>Create Job Grade</h3>
                <div class="form-group col-md-12">
                    <label  for="form-username">Name<span class="text-danger">*</span></label>
                    <input type="text" name="Name" class="form-username form-control"  required parsley-type="text">
                </div>
                <legend></legend>

                <h3>Items</h3>
                <div class="alert alert-success">
                    <p> Fill the Items Below with the required amount for each value </p>
                </div>

                <legend></legend>
                
                @forelse($items as $item)
                    <div class="form-group col-md-6">
                        <label  for="form-username">{{$item->name}}<span class="text-danger">*</span></label>
                        <input type="number" name="{{$item->name}}" class="form-username form-control"  required parsley-type="text">
                    </div>
                @empty
                     <p> no salary items present </p>
                @endforelse


                <div class="row" align="left">
                    <button type="submit" class="btn btn-custom"><i class="fa fa-fw fa-plus"></i>Create</a>
                    <br>
                </div>
            </form>
           
        </div>
        </div>
    </div>

@stop