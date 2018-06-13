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

        <!-- Add User Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">New Item</h4>
            </div>
            <div class="modal-body">
            <form role="form"   method="POST" action="{{ url('HR/createsalaryitem') }}">
                {{ csrf_field() }}
            <div class="form-group">
                <label  for="form-username">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" placeholder="" class="form-username form-control"  required parsley-type="text">
            </div>

            <div class="form-group">
                <label for="sel1">Type<span class="text-danger">*</span></label>
                <select class="form-control selectpicker" id="sel1" name="type" data-live-search="true">
                    <option>BENEFIT</option>
                    <option>DEDUCTION</option>        
                </select>
            </div>
            
            <div class="form-group">
            <button type="submit" class="btn btn-info">Create</button>
        </div>
        </form>
            </div>
        
            </div>
        </div>
        </div>
    <!-- End Add User Modal --> 



    <div class="row container-fluid">
        <div class="col-md-2">
            @include('Employees.Layouts.sidenav')
        </div>
        <div class="col-md-10">
            <div class="card-box">
        <div class="row" align="left">
            <a data-toggle="modal" data-target="#myModal" class="btn btn-custom"><i class="fa fa-fw fa-plus"></i>New Salary Item</a>
            <br>
        </div>
            <div class="table-responsive">
                <h3 class="center">Salary Items</h3>
                <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-custom">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>type</th>
                            <th>Date Created</th>
                            <th>Action</th>   
                        </tr> 

                    </thead>


                    <tbody>
                    @forelse($items as $item)
                      <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->type}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a href="{{url('HR/deletesalaryitem')}}?id={{$item->id}}" class="btn btn-danger" ><i class="fa fa-fw fa-trash"></i></a>
                            <a data-toggle="modal" data-target="#edit{{$item->id}}" class="btn btn-custom"><i class=" fa fa-fw fa-pencil "></i></a>
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


    @forelse($items as $item)
        <!-- Add User Modal -->
        <div class="modal fade" id="edit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">
            <form role="form"   method="POST" action="{{ url('HR/updatesalaryitem') }}">
                {{ csrf_field() }}
            <div class="form-group">
                <label  for="form-username">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" placeholder="" class="form-username form-control" value="{{$item->name}}" required parsley-type="text">
            </div>
            <input type="hidden" value="{{$item->id}}" name="id">
            <div class="form-group">
                <label for="sel1">Type<span class="text-danger">*</span></label>
                <select class="form-control selectpicker" id="sel1" name="type" data-live-search="true">
                       
                    <option>{{ $item->type }}</option>   
                    <option>BENEFIT</option>
                    <option>DEDUCTION</option>        
                </select>
            </div>
            
            <div class="form-group">
            <button type="submit" class="btn btn-info">Save</button>
        </div>
        </form>
            </div>
        
            </div>
        </div>
        </div>
    @empty

    @endforelse    
    <!-- End Add User Modal --> 

@stop