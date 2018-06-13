<!-- Add User Modal -->

<div class="modal fade" id="myClassStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Create Class Status</h4>

            </div>

            <form role="form"   method="POST" action="{{ url('academics/ClassStatus/create') }}" enctype="multipart/form-data">

                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">

                        <label  for="form-username">Class Status<span class="text-danger">*</span></label>

                        <input type="text" name="Name" placeholder="Class Status..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <input type="hidden" name="status" value="1">

                </div>

                <div class="modal-footer form-group">

                    <button type="submit" class="btn btn-info">Create</button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- End Add User Modal -->



<div class="row" align="left">

    <button class="btn btn-custom" data-toggle="modal" data-target="#myClassStatus" style="margin-left: 25px; margin-bottom: 30px">Create Class Status</button>

    <br>

</div>





<div class="row">

    <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-primary">

        <thead>



        <tr>

            <th>Name</th>

            <th>Status</th>

            <th>Created at</th>

            <th>Updated at</th>

            <th>Disable or Enable</th>

            <th>Edit</th>

        </tr>



        </thead>





        <tbody>

        @forelse($class as $classes )

            <tr>

                <td>{{ $classes->Name }}</td>

                @if($classes->status == 1)

                    <td>Active</td>
                @else

                    <td>Inactive</td>

                @endif

                <td>{{ $classes->created_at }}</td>

                <td>{{ $classes->updated_at }}</td>


                <td>

                    @if ($classes->status == 1)

                        <a href="{{url('academics/classStatus/enabling')}}?id={{$classes->id}}&status=0" class="btn btn-danger" onclick="return confirm('Do you want to disable {{$classes->Name}}')"><i class="fa fa-fw fa-trash"></i></a>

                    @elseif($classes->status == 0)

                        <a href="{{url('academics/classStatus/enabling')}}?id={{$classes->id}}&status=1" class="btn btn-custom" onclick="return confirm('Do you want to enable {{$classes->Name}}')"><i class="fa fa-fw fa-trash"></i></a>

                    @endif
                </td>
                <td>

                    <a data-toggle="modal" data-target="#myClassUpdate{{$classes->id}}" class="btn btn-primary"><i class=" fa fa-fw fa-pencil "></i></a>

                </td>

            </tr>





            <!-- Add User Modal -->

            <div class="modal fade" id="myClassUpdate{{$classes->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="myModalLabel">Update Class Status Details</h4>

                        </div>

                        <div class="modal-body">

                            <form role="form"   method="POST" action="{{ url('academics/classStatus/update') }}">

                                <div class="modal-body">

                                        {{ csrf_field() }}

                                        <div class="form-group">

                                            <label  for="form-username">Class Status<span class="text-danger">*</span></label>

                                            <input type="text" name="Name" placeholder="Class Status..." class="form-username form-control"  required parsley-type="text">

                                        </div>

                                    <input type="hidden" name="id" value="{{$classes->id}}">

                                </div>

                                <div class="modal-footer form-group">

                                    <button type="submit" class="btn btn-info">Update Class Status</button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            <!-- End Add User Modal -->









        @empty

            <p>No Data Found</p>

        @endforelse

        </tbody>

    </table>

</div>

