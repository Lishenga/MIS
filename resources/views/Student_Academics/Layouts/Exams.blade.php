<!-- Add User Modal -->

<div class="modal fade" id="myExam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">New Exam</h4>

            </div>

            <form role="form"   method="POST" action="{{ url('studentacademics/students/creation') }}" enctype="multipart/form-data">

                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="row">

                        <div class="form-group center col-md-4">

                            <label  for="form-username">Name<span class="text-danger">*</span></label>

                            <input type="text" name="Name" placeholder="Name..." class="form-username form-control"  required parsley-type="text">

                        </div>

                        <div class="form-group  col-md-4">

                            <label  for="form-username">Semester<span class="text-danger">*</span></label>

                            <select class="form-control selectpicker" id="sell" name="Semester" data-live-search="true">

                                <option value="1">Sem 1</option>

                                <option value="2">Sem 2</option>

                                <option value="3">Sem 3</option>

                                <option value="4">Sem 4</option>

                                <option value="5">Sem 5</option>

                                <option value="6">Sem 6</option>

                            </select>

                        </div>

                        <div class="form-group center col-md-4">

                            <label  for="form-username">Exam Status<span class="text-danger">*</span></label>

                            <input type="text" name="Status" placeholder="Exam Status..." class="form-username form-control"  required parsley-type="text">

                        </div>

                    </div>



                    <div class="row">

                        <div class="form-group  col-md-4">

                            <label for="sell">Class <span class="text-danger">*</span></label>

                            <select class="form-control selectpicker" id="sell" name="batch_id" data-live-search="true">

                                @foreach($batch as $batches)

                                    <option value="{{$batches->id}}">{{$batches->Batch_code}}</option>

                                @endforeach

                            </select>

                        </div>



                        <div class="form-group  col-md-4">

                            <label  for="form-username">Academic Year<span class="text-danger">*</span></label>

                            <select class="form-control selectpicker" id="sell" name="Academic_year" data-live-search="true">

                                @foreach($academic as $academics)

                                    <option value="{{$academics->id}}">{{$academics->Name}}</option>

                                @endforeach

                            </select>

                        </div>



                        <div class="form-group  col-md-4">

                            <label for="sell">Exam Category<span class="text-danger">*</span></label>

                            <select class="form-control selectpicker" id="sell" name="Category" data-live-search="true">

                                @foreach($category as $categories)

                                    <option value="{{$categories->id}}">{{$categories->Name}}</option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-4">

                            <label for="sell">Units<span class="text-danger">*</span></label>

                            <select class="selectpicker" multiple data-max-options="10" name="Units[]" data-live-search="true">

                                @foreach($unit as $units)

                                    <option value="{{$units->unit_code}} {{$units->unit_name}}">{{$units->unit_code}} {{$units->unit_name}}</option>

                                @endforeach

                            </select>

                        </div>

                        <div class="form-group center col-md-4">

                            <label  for="form-username">Supplementary Exam Pass Mark<span class="text-danger">*</span></label>

                            <input type="text" name="supplementarypassmark" placeholder="Supplementary Exam Pass Mark..." class="form-username form-control">

                        </div>

                        <div class="form-group center col-md-4">

                            <label  for="form-username">Supplementary Exam Maximum Number of Attempts<span class="text-danger">*</span></label>

                            <input type="text" name="supmaxattempts" placeholder="Supplementary Exam Maximum Number of Attempts..." class="form-username form-control">

                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group center col-md-6">

                            <label  for="form-username">Out of<span class="text-danger">*</span></label>

                            <input type="text" name="out_of" placeholder="Exam will be out of..." class="form-username form-control"  required parsley-type="text">

                        </div>

                        <div class="form-group  col-md-6">

                            <label for="sell">Grading System<span class="text-danger">*</span></label>

                            <select class="form-control selectpicker" id="sell" name="grading" data-live-search="true">

                                @foreach($grading as $gradings)

                                    <option value="{{$gradings->id}}">{{$gradings->name}}</option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <input type="hidden" name="q" value="0">

                </div>

                <div class="modal-footer form-group">

                    <button type="submit" class="btn btn-info">Create</button>

                </div>

            </form>

        </div>


    </div>

</div>

<!-- End Add User Modal -->



<div class="row" align="left" STYLE="margin-top: 20px">

    <button class="btn btn-custom" data-toggle="modal" data-target="#myExam"><i class="fa fa-fw fa-plus"></i>New Exam</button>

    <br>

</div>





<div class="row card-box">

    <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-primary">

        <thead>



        <tr>

            <th>Exam Name</th>

            <th>Class</th>

            <th>Academic Year</th>

            <th>Exam Category</th>

            <th>Supplementary Exam Pass Mark</th>

            <th>Supplementary Exam Maximum Number of Attempts</th>

            <th>Grading System</th>

            <th> Units</th>

            <th>Exam Status</th>

            <th>Out of</th>

            <th>Action</th>

        </tr>



        </thead>





        <tbody>

        @forelse($exam as $exams)

            <tr>

                <td>{{ $exams->Name }}</td>

                @foreach($batch as $batches)
                    @if($batches->id == $exams->batch_id)

                    <td>{{ $batches->Batch_code }}</td>

                    @endif
                @endforeach

                @foreach($academic as $academics)
                    @if($academics->id == $exams->Academic_year)

                        <td>{{ $academics->Name }}</td>

                    @endif
                @endforeach

                @foreach($category as $categories)
                    @if($exams->Category == $categories->id)
                        <td>{{ $categories->Name }}</td>
                    @endif
                @endforeach

                @if($exams->supplementarypassmark == '')
                    <td>Not Applicable</td>
                @elseif($exams->supplementarypassmark != '')
                    <td>{{$exams->supplementarypassmark}}</td>
                @endif

                @if($exams->supmaxattempts == '')
                    <td>Not Applicable</td>
                @elseif($exams->supmaxattempts != '')
                    <td>{{$exams->supmaxattempts}}</td>
                @endif

                @foreach($grading as $gradings)
                    @if($exams->grading == $gradings->id)
                        <td>{{ $gradings->name }}</td>
                    @endif
                @endforeach

                <td>
                    @forelse(json_decode($exams->Units) as $unit_data)
                        <div class="alert alert-success"  style="padding:3px; border-radius:5%;">
                            {{$unit_data}}
                        </div>
                    @empty
                        no units
                    @endforelse
                </td>

                <td>{{ $exams->Status }}</td>

                <td>{{ $exams->out_of }}</td>

                <td>

                    <a href="{{url('studentacademics/exam/delete')}}/{{$exams->id}}" class="btn btn-danger" onclick="return confirm('Do you want to delete {{$exams->Name}}')"><i class="fa fa-fw fa-trash"></i></a>

                    <a href="{{url('studentacademics/exams/update')}}/{{$exams->id}}" class="btn btn-primary"><i class=" fa fa-fw fa-pencil "></i></a>

                </td>

            </tr>





            <!-- Add User Modal -->



            <!-- End Add User Modal -->


        @empty

            <p>No Data Found</p>

        @endforelse

        </tbody>

    </table>

</div>

