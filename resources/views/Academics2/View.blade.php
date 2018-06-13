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

    <div class="col-md-2">

        @include('Academics2.Layouts.navacademics')

    </div>



    <div class="col-md-9" style="margin-top : 20px;">

            <div class=" row">

                <div class="col-md-4">

                    <div align="left">

                        <a href="{{url('academics/batch') }}" class="btn btn-custom"><i class="fa fa-fw fa-plus"></i>Classes</a>

                    </div>

                </div>

                <div class="col-md-4">

                    <a href="{{ url('academics/classStatus') }}" class="btn btn-custom"><i class="fa fa-fw fa-plus"></i>Class Status</a>

                </div>

                <div class="col-md-4">

                    <a href="{{ url('academics/classType') }}" class="btn btn-custom"><i class="fa fa-fw fa-plus"></i>Class Type</a>

                </div>

            </div>

    </div>





@stop