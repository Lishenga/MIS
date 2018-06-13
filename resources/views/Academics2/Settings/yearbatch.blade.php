<!-- Add User Modal -->

<div class="modal fade" id="myBatch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">New Batch</h4>

            </div>

            <form role="form"   method="POST" action="{{ url('academics/create/batch') }}">

                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">

                        <label  for="form-username">Class Name<span class="text-danger">*</span></label>

                        <input type="text" name="Batch_name" placeholder="Class Name..." class="form-username form-control"  required parsley-type="text">

                    </div>



                    <div class="form-group">

                        <label  for="form-username">Class Code<span class="text-danger">*</span></label>

                        <input type="text" name="Batch_code" placeholder="Class Code..." class="form-username form-control"  required parsley-type="text">

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

                        <label  for="form-username">Class Year<span class="text-danger">*</span></label>

                        <input type="text" name="Batch_year" placeholder="Class Year..." class="form-username form-control"  required parsley-type="text">

                    </div>



                    <div class="form-group">

                        <label for="sell">Class Type<span class="text-danger"></span></label>

                        <select class="form-control selectpicker" id="sell" name="ClassType" data-live-search="true">

                            @foreach($classtype as $classtypes)

                                <option value="{{$classtypes->id}}">{{$classtypes->Name}}</option>

                            @endforeach

                        </select>

                    </div>



                    <div class="form-group">

                        <label for="sell">Class Status<span class="text-danger"></span></label>

                        <select class="form-control selectpicker" id="sell" name="ClassStatus" data-live-search="true">

                            @foreach($classStatus as $classStatues)

                                <option value="{{$classStatues->id}}">{{$classStatues->Name}}</option>

                            @endforeach

                        </select>

                    </div>



                    <div class="form-group">

                        <label for="sell">Course Found In<span class="text-danger"></span></label>

                        <select class="form-control selectpicker" id="sell" name="course_id" data-live-search="true">

                            @foreach($course as $courses)

                                <option value="{{$courses->id}}">{{$courses->course_name}}</option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="modal-footer form-group">

                    <button type="submit" class="btn btn-info">Create Class</button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- End Add User Modal -->



<div class="row" align="left">

    <button class="btn btn-custom" data-toggle="modal" data-target="#myBatch"><i class="fa fa-fw fa-plus"></i>New Class</button>

    <br>

</div>





<div class="row">

    <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-primary">

        <thead>



        <tr>

            <th>Class Name</th>

            <th>Class Code</th>

            <th>Class Year</th>

            <th>Class Type</th>

            <th>Class Status</th>

            <th>Course Found In</th>

            <th>Department Found In</th>

            <th>School Found In</th>

            <th>College Found In</th>

            <th>Campus Situated At</th>

            <th>Action</th>

        </tr>



        </thead>





        <tbody>

        @forelse($batch as $batches)

            <tr>

                <td>{{ $batches->Batch_name }}</td>

                <td>{{ $batches->Batch_code }}</td>

                <td>{{ $batches->Batch_year }}</td>



                @foreach($classtype as $classtypes)

                    @if($classtypes->id == $batches->ClassType)

                        <td>{{$classtypes->Name }}</td>

                    @endif

                @endforeach



                @foreach($classStatus as $classStatuses)

                    @if($classStatuses->id == $batches->ClassStatus)

                        <td>{{$classStatuses->Name }}</td>

                    @else
                        <td>{{$batches->ClassStatus }}</td>

                    @endif

                @endforeach



                @foreach($course as $courses)

                    @if($courses->id == $batches->course_id)

                        <td>{{$courses->course_name }}</td>

                    @endif

                @endforeach



                @foreach($depart as $departs)

                    @foreach($course as $courses)

                        @if($departs->id == $courses->department_id)

                            @if($courses->id == $batches->course_id)

                                <td>{{$departs->department_name }}</td>

                            @endif

                        @endif

                    @endforeach

                @endforeach



                @foreach($school as $schools)

                    @foreach($depart as $departs)

                        @foreach($course as $courses)

                            @if($schools->id == $departs->school_id)

                                @if($departs->id == $courses->department_id)

                                    @if($courses->id == $batches->course_id)

                                        <td>{{$schools->school_name }}</td>

                                    @endif

                                @endif

                            @endif

                        @endforeach

                    @endforeach

                @endforeach



                @foreach($college as $colleges)

                    @foreach($school as $schools)

                        @foreach($depart as $departs)

                            @foreach($course as $courses)

                                @if($colleges->id == $schools->college_id)

                                    @if($schools->id == $departs->school_id)

                                        @if($departs->id == $courses->department_id)

                                            @if($courses->id == $batches->course_id)

                                                <td>{{$colleges->name }}</td>

                                            @endif

                                        @endif

                                    @endif

                                @endif

                            @endforeach

                        @endforeach

                    @endforeach

                @endforeach



                @foreach($campus as $campuses)

                    @foreach($college as $colleges)

                        @foreach($school as $schools)

                            @foreach($depart as $departs)

                                @foreach($course as $courses)

                                    @if($campuses->id == $colleges->campus_id)

                                        @if($colleges->id == $schools->college_id)

                                            @if($schools->id == $departs->school_id)

                                                @if($departs->id == $courses->department_id)

                                                    @if($courses->id == $batches->course_id)

                                                        <td>{{$campuses->name }}</td>

                                                    @endif

                                                @endif

                                            @endif

                                        @endif

                                    @endif

                                @endforeach

                            @endforeach

                        @endforeach

                    @endforeach

                @endforeach

                <td>

                    <a href="{{url('academics/delete/batch')}}/{{$batches->id}}" class="btn btn-danger" onclick="return confirm('Do you want to delete {{$batches->Batch_name}}')"><i class="fa fa-fw fa-trash"></i></a>

                    <a data-toggle="modal" data-target="#myBatchUpdate{{$batches->id}}" class="btn btn-primary"><i class=" fa fa-fw fa-pencil "></i></a>

                </td>

            </tr>





            <!-- Add User Modal -->

            <div class="modal fade" id="myBatchUpdate{{$batches->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="myModalLabel">Update Class Details</h4>

                        </div>

                        <div class="modal-body">

                            <form role="form"   method="POST" action="{{ url('academics/update/batch') }}">

                                <div class="modal-body">

                                    <div class="form-group">

                                        <label  for="form-username">Class Name<span class="text-danger">*</span></label>

                                        <input type="text" name="Batch_name" placeholder="Class Name..." class="form-username form-control"  required parsley-type="text">

                                    </div>



                                    <div class="form-group">

                                        <label  for="form-username">Class Code<span class="text-danger">*</span></label>

                                        <input type="text" name="Batch_code" placeholder="Class Code..." class="form-username form-control"  required parsley-type="text">

                                    </div>



                                    <div class="form-group">

                                        <label  for="form-username">Class Year<span class="text-danger">*</span></label>

                                        <input type="text" name="Batch_year" placeholder="Year..." class="form-username form-control"  required parsley-type="text">

                                    </div>



                                    <div class="form-group">

                                        <label  for="form-username">Start Date<span class="text-danger">*</span></label>

                                        <input type="date" name="Start_date" placeholder="Start Date..." class="form-username form-control"  required parsley-type="text">

                                    </div>



                                    <div class="form-group">

                                        <label  for="form-username">End Date<span class="text-danger">*</span></label>

                                        <input type="date" name="End_date" placeholder="End Date..." class="form-username form-control"  required parsley-type="text">

                                    </div>



                                    <input type="hidden" name="id" value="{{$batches->id}}">



                                    <div class="form-group">

                                        <label for="sell">Class Type<span class="text-danger"></span></label>

                                        <select class="form-control selectpicker" id="sell" name="ClassType" data-live-search="true">

                                            @foreach($classtype as $classtypes)

                                                <option value="{{$classtypes->id}}">{{$classtypes->Name}}</option>

                                            @endforeach

                                        </select>

                                    </div>



                                    <div class="form-group">

                                        <label for="sell">Class Status<span class="text-danger"></span></label>

                                        <select class="form-control selectpicker" id="sell" name="ClassStatus" data-live-search="true">

                                            @foreach($classStatus as $classStatues)

                                                <option value="{{$classStatues->id}}">{{$classStatues->Name}}</option>

                                            @endforeach

                                        </select>

                                    </div>



                                        <div class="form-group">

                                            <label for="sell">Course Found In<span class="text-danger"></span></label>

                                            <select class="form-control selectpicker" id="sell" name="course_id" data-live-search="true">

                                                @foreach($course as $courses)

                                                    <option value="{{$courses->id}}">{{$courses->course_name}}</option>

                                                @endforeach

                                            </select>

                                        </div>

                                </div>

                                <div class="modal-footer form-group">

                                    <button type="submit" class="btn btn-info">Update Batch</button>

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

