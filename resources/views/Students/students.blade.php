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

    <div class="card-box">

        @include('Students.Layouts.nav')

        <div class="row" align="left">

            <a href="{{ url('students/apply/register') }}" class="btn btn-custom"><i class="fa fa-fw fa-plus"></i>New Student</a>

            <br>

        </div>

        <div class="table-responsive">

            <h3 class="center">Students</h3>

            <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-custom">

                <thead>



                <tr>

                    <th>Admission Number</th>

                    <th>Course</th>

                    <th>First Name</th>

                    <th>Middle Names</th>

                    <th>Date of Birth</th>

                    <th>Nationality</th>

                    <th>Mobile Number</th>

                    <th>Email Address</th>

                    <th>Print School Identity Card</th>

                </tr>



                </thead>





                <tbody>

                @forelse($student as $students)

                    <tr>

                        @foreach($batch as $batches)

                            @if($batches->id == $students->batch_id)

                                <td>{{ $students->admission_number }}</td>

                            @endif

                        @endforeach



                            @foreach($course as $courses)

                                @if($courses->id == $students->course_id)

                                    <td>{{ $courses->course_name }}</td>

                                @endif

                            @endforeach



                        <td>{{ $students->first_name }}</td>

                        <td>{{ $students->middle_names }}</td>

                        <td>{{ $students->dob }}</td>

                        <td>{{ $students->nationality	 }}</td>

                        <td>{{ $students->mobile_number }}</td>

                        <td>{{ $students->email_address }}</td>

                        <td>
                            <form role="form"   method="POST" action="{{ url('students/print') }}" enctype="multipart/form-data">

                                <div class="modal-body">

                                    {{ csrf_field() }}

                                    <input type="hidden" name="id" value="{{$students->id}}">

                                </div>

                                    <button type="submit" class="btn btn-info">Print</button>

                            </form>
                        </td>

                    </tr>

                @empty

                    <p>No Data Found</p>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>



@stop