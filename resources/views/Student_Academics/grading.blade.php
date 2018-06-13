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



    <div class="row">

        <div class="col-md-2">



            @include('Student_Academics.Layouts.ExamsLayouts.Sidebarnav')

        </div>

        <div class="col-md-10">

            @include('Student_Academics.Layouts.grading')

        </div>



    </div>





@stop


