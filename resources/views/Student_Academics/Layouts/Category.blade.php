<!-- Add User Modal -->

<div class="modal fade" id="myCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">New Exam Category</h4>

            </div>

            <form role="form"   method="POST" action="{{ url('studentacademics/category/create') }}" enctype="multipart/form-data">

                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">

                        <label  for="form-username">Exam Category<span class="text-danger">*</span></label>

                        <input type="text" name="Name" placeholder="Exam Category..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">Percentage<span class="text-danger">*</span></label>

                        <input type="text" name="Percentage" placeholder="Percentage..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">Academic Year<span class="text-danger">*</span></label>

                        <select class="form-control selectpicker" id="sell" name="Academic_year" data-live-search="true">

                            @foreach($academic as $academics)

                                <option value="{{$academics->Name}}">{{$academics->Name}}</option>

                            @endforeach

                        </select>

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

    <button class="btn btn-custom" data-toggle="modal" data-target="#myCategory"><i class="fa fa-fw fa-plus"></i>New Exam Category</button>

    <br>

</div>





<div class="row card-box">

    <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-primary">

        <thead>



        <tr>

            <th>Exam Category</th>

            <th>Academic Year</th>

            <th>Percentage</th>

            <th>Action</th>

        </tr>



        </thead>





        <tbody>

        @forelse($category as $categories)

            <tr>

                <td>{{ $categories->Name }}</td>

                <td>{{ $categories->academic_year }}</td>

                <td>{{ $categories->Percentage }}</td>


                <td>

                    <a href="{{url('studentacademics/category/delete')}}/{{$categories->id}}" class="btn btn-danger" onclick="return confirm('Do you want to delete {{$categories->Name}}')"><i class="fa fa-fw fa-trash"></i></a>

                    <a data-toggle="modal" data-target="#myCategoryUpdate{{$categories->id}}" class="btn btn-primary"><i class=" fa fa-fw fa-pencil "></i></a>

                </td>

            </tr>





            <!-- Add User Modal -->

            <div class="modal fade" id="myCategoryUpdate{{$categories->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="myModalLabel">Update Exam Category Details</h4>

                        </div>

                        <div class="modal-body">

                            <form role="form"   method="POST" action="{{ url('studentacademics/category/update') }}" enctype="multipart/form-data">

                                <div class="modal-body">

                                    {{ csrf_field() }}

                                    <div class="form-group">

                                        <label  for="form-username">Exam Category Name<span class="text-danger">*</span></label>

                                        <input type="text" name="Name" placeholder="Exam Category Name..." class="form-username form-control"  required parsley-type="text">

                                    </div>

                                    <div class="form-group">

                                        <label  for="form-username">Percentage<span class="text-danger">*</span></label>

                                        <input type="date" name="Percentage" placeholder="Percentage..." class="form-username form-control"  required parsley-type="text">

                                    </div>



                                    <div class="form-group">

                                        <label  for="form-username">Academic Year<span class="text-danger">*</span></label>

                                        <select class="form-control selectpicker" id="sell" name="Academic_year" data-live-search="true">

                                            @foreach($academic as $academics)

                                                <option value="{{$academics->Name}}">{{$academics->Name}}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                    <input type="hidden" name="id" value="{{$categories->id}}">

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

