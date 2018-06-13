<!-- Add User Modal -->

<div class="modal fade" id="myYear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">New Academic Year</h4>

            </div>

            <form role="form"   method="POST" action="{{ url('studentacademics/year/create') }}" enctype="multipart/form-data">

                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">

                        <label  for="form-username">Academic Year<span class="text-danger">*</span></label>

                        <input type="text" name="Name" placeholder="Academic Year..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">Start Date<span class="text-danger">*</span></label>

                        <input type="date" name="Start_date" placeholder="Start Date..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">End Date<span class="text-danger">*</span></label>

                        <input type="date" name="End_date" placeholder="End Date..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">Academic Year Status<span class="text-danger">*</span></label>

                        <input type="text" name="Status" placeholder="Academic Year Status..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="modal-footer form-group">

                        <button type="submit" class="btn btn-info">Create</button>

                    </div>

                </div>



            </form>

        </div>


    </div>

</div>

<!-- End Add User Modal -->



<div class="row" align="left" STYLE="margin-top: 20px">

    <button class="btn btn-custom" data-toggle="modal" data-target="#myYear"><i class="fa fa-fw fa-plus"></i>New Academic Year</button>

    <br>

</div>





<div class="row card-box">

    <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-primary">

        <thead>



        <tr>

            <th>Academic Year</th>

            <th>Start Date</th>

            <th>End Date</th>

            <th> Status</th>

            <th>Action</th>

        </tr>



        </thead>





        <tbody>

        @forelse($academic as $academics)

            <tr>

                <td>{{ $academics->Name }}</td>

                <td>{{ $academics->Start_date }}</td>

                <td>{{ $academics->End_date }}</td>

                <td>{{ $academics->Status }}</td>




                <td>

                    <a href="{{url('studentacademics/year/delete')}}/{{$academics->id}}" class="btn btn-danger" onclick="return confirm('Do you want to delete {{$academics->Name}}')"><i class="fa fa-fw fa-trash"></i></a>

                    <a data-toggle="modal" data-target="#myYearUpdate{{$academics->id}}" class="btn btn-primary"><i class=" fa fa-fw fa-pencil "></i></a>

                </td>

            </tr>





            <!-- Add User Modal -->

            <div class="modal fade" id="myYearUpdate{{$academics->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="myModalLabel">Update Academic Year Details</h4>

                        </div>

                        <div class="modal-body">

                            <form role="form"   method="POST" action="{{ url('studentacademics/year/update') }}" enctype="multipart/form-data">

                                <div class="modal-body">

                                    {{ csrf_field() }}

                                    <div class="form-group">

                                        <label  for="form-username">Academic Year<span class="text-danger">*</span></label>

                                        <input type="text" name="Name" placeholder="Academic Year..." class="form-username form-control"  required parsley-type="text">

                                    </div>

                                    <div class="form-group">

                                        <label  for="form-username">Start Date<span class="text-danger">*</span></label>

                                        <input type="date" name="Start_date" placeholder="Start Date..." class="form-username form-control"  required parsley-type="text">

                                    </div>

                                    <div class="form-group">

                                        <label  for="form-username">End Date<span class="text-danger">*</span></label>

                                        <input type="date" name="End_date" placeholder="End Date..." class="form-username form-control"  required parsley-type="text">

                                    </div>

                                    <div class="form-group">

                                        <label  for="form-username">Academic Year Status<span class="text-danger">*</span></label>

                                        <input type="text" name="Status" placeholder="Academic Year Status..." class="form-username form-control"  required parsley-type="text">

                                    </div>

                                    <input type="hidden" name="id" value="{{$academics->id}}">

                                    <div class="modal-footer form-group">

                                        <button type="submit" class="btn btn-info">Update</button>

                                    </div>

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

