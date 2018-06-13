<!-- Add User Modal -->

<div class="modal fade" id="myGrading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">New Grading System</h4>

            </div>

            <div class="modal-body">

                <form role="form"   method="POST" action="{{ url('studentacademics/grading/create') }}">

                    {{ csrf_field() }}

                    <div class="form-group">

                        <label  for="form-username">Name<span class="text-danger">*</span></label>

                        <input type="text" name="name" placeholder="Name..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">A-Maximum<span class="text-danger">*</span></label>

                        <input type="text" name="amax" placeholder="A-Maximum..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">A-Minimum<span class="text-danger">*</span></label>

                        <input type="text" name="amin" placeholder="A-Minimum..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">B-Maximum<span class="text-danger">*</span></label>

                        <input type="text" name="bmax" placeholder="B-Maximum..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">B-Minimum<span class="text-danger">*</span></label>

                        <input type="text" name="bmin" placeholder="B-Minimum..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">C-Maximum<span class="text-danger">*</span></label>

                        <input type="text" name="cmax" placeholder="C-Maximum..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">C-Minimum<span class="text-danger">*</span></label>

                        <input type="text" name="cmin" placeholder="C-Minimum..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">D-Maximum<span class="text-danger">*</span></label>

                        <input type="text" name="dmax" placeholder="D-Maximum..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">D-Minimum<span class="text-danger">*</span></label>

                        <input type="text" name="dmin" placeholder="D-Minimum..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">E-Maximum<span class="text-danger">*</span></label>

                        <input type="text" name="emax" placeholder="E-Maximum..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="form-group">

                        <label  for="form-username">E-Minimum<span class="text-danger">*</span></label>

                        <input type="text" name="emin" placeholder="E-Minimum..." class="form-username form-control"  required parsley-type="text">

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-info">Create Grading System</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- End Add User Modal -->



<div class="row" align="left">

    <button class="btn btn-custom" data-toggle="modal" data-target="#myGrading"><i class="fa fa-fw fa-plus"></i>New Grading System</button>

    <br>

</div>





<div class="row">

    <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-primary">

        <thead>



        <tr>

            <th>Name</th>

            <th>A-Maximum</th>

            <th>A-Minimum</th>

            <th>B-Maximum</th>

            <th>B-Minimum</th>

            <th>C-Maximum</th>

            <th>C-Minimum</th>

            <th>D-Maximum</th>

            <th>D-Minimum</th>

            <th>E-Maximum</th>

            <th>E-Minimum</th>

            <th>Action</th>

        </tr>



        </thead>





        <tbody>

        @forelse($grading as $gradings)
            <tr>

                <td>{{ $gradings->name }}</td>

                <td>{{ $gradings->amax }}</td>

                <td>{{ $gradings->amin }}</td>

                <td>{{ $gradings->bmax }}</td>

                <td>{{ $gradings->bmin }}</td>

                <td>{{ $gradings->cmax }}</td>

                <td>{{ $gradings->cmin }}</td>

                <td>{{ $gradings->dmax }}</td>

                <td>{{ $gradings->dmin }}</td>

                <td>{{ $gradings->emax }}</td>

                <td>{{ $gradings->emin }}</td>

                <td>

                    <a href="{{url('studentacademics/grading/delete')}}/{{$gradings->id}}" class="btn btn-danger" onclick="return confirm('Do you want to delete {{$gradings->name}}')"><i class="fa fa-fw fa-trash"></i></a>

                    <a data-toggle="modal" data-target="#myGradingUpdate{{$gradings->id}}" class="btn btn-primary"><i class=" fa fa-fw fa-pencil "></i></a>

                </td>

            </tr>





            <!-- Add User Modal -->

            <div class="modal fade" id="myGradingUpdate{{$gradings->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="myModalLabel">Update Grading System</h4>

                        </div>

                        <div class="modal-body">

                            <form role="form"   method="POST" action="{{ url('studentacademics/grading/update') }}">

                                {{ csrf_field() }}

                                <div class="form-group">

                                    <label  for="form-username">Name<span class="text-danger">*</span></label>

                                    <input type="text" name="name" placeholder="Name..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group">

                                    <label  for="form-username">A-Maximum<span class="text-danger">*</span></label>

                                    <input type="text" name="amax" placeholder="A-Maximum..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group">

                                    <label  for="form-username">A-Minimum<span class="text-danger">*</span></label>

                                    <input type="text" name="amin" placeholder="A-Minimum..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group">

                                    <label  for="form-username">B-Maximum<span class="text-danger">*</span></label>

                                    <input type="text" name="bmax" placeholder="B-Maximum..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group">

                                    <label  for="form-username">B-Minimum<span class="text-danger">*</span></label>

                                    <input type="text" name="bmin" placeholder="B-Minimum..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group">

                                    <label  for="form-username">C-Maximum<span class="text-danger">*</span></label>

                                    <input type="text" name="cmax" placeholder="C-Maximum..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group">

                                    <label  for="form-username">C-Minimum<span class="text-danger">*</span></label>

                                    <input type="text" name="cmin" placeholder="C-Minimum..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group">

                                    <label  for="form-username">D-Maximum<span class="text-danger">*</span></label>

                                    <input type="text" name="dmax" placeholder="D-Maximum..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group">

                                    <label  for="form-username">D-Minimum<span class="text-danger">*</span></label>

                                    <input type="text" name="dmin" placeholder="D-Minimum..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group">

                                    <label  for="form-username">E-Maximum<span class="text-danger">*</span></label>

                                    <input type="text" name="emax" placeholder="E-Maximum..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <div class="form-group">

                                    <label  for="form-username">E-Minimum<span class="text-danger">*</span></label>

                                    <input type="text" name="emin" placeholder="E-Minimum..." class="form-username form-control"  required parsley-type="text">

                                </div>

                                <input type="hidden" name="id" value="{{$gradings->id}}">

                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-info">Update Grading System</button>

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

