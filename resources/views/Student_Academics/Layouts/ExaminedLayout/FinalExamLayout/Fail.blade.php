<div class="modal fade" id="myFail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel" align="center">Exam Failure</h4>

            </div>

            <form role="form"   method="POST" action="{{ url('studentacademics/examfailure/fail') }}" enctype="multipart/form-data">

                <div class="modal-body">

                    {{ csrf_field() }}

                        <div class="form-group">

                            <label for="sell" align="center">Reason<span class="text-danger">*</span></label>

                            <select class="form-control selectpicker" id="sel1" name="reason" data-live-search="true">

                                <option value="ACADEMICLEAVE">ACADEMIC LEAVE</option>

                                <option value="DISCONTINUATION">DISCONTINUATION</option>

                                <option value="FAIL">FAIL</option>



                            </select>

                        </div>
                        
                        <div class="form-group">

                            <label for="sell" align="center">Number of Attempt<span class="text-danger">*</span></label>

                            <input type="number" name="attempt" placeholder="Number of Attempt..." class="form-username form-control"  required parsley-type="text"><br>

                        </div>

                    @foreach($exam as $exams)

                        @foreach($academic as $academics)

                            @if($academics->id == $exams->Academic_year)

                                <input type="hidden" name="academic_year" value="{{ $academics->Name}}">

                            @endif

                        @endforeach

                    @endforeach

                        <input type="hidden" name="student_id" value="{{$student->id}}">

                        <div class="form-group">

                            <label for="sell" align="center">Units<span class="text-danger">*</span></label>

                            <select class="selectpicker" multiple data-max-options="20" name="units[]" data-live-search="true">

                                @foreach($course->units as $unit_data=> $value)

                                    <option value="{{$unit_data}}">{{$unit_data}}</option>

                                @endforeach

                            </select>

                        </div>

                    <div class="form-group">

                        <label for="sell">Exam to Do <span class="text-danger">*</span></label>

                        <select class="form-control selectpicker" id="sell" name="examtodo" data-live-search="true">

                            @foreach($exam as $exams)

                                <option value="{{$exams->id}}">{{$exams->Name}}</option>

                            @endforeach

                        </select>

                    </div>

                <div class="modal-footer form-group">

                    <button type="submit" class="btn btn-info">Submit</button>

                </div>
            </div>

            </form>

        </div>


    </div>

</div>

<!-- End Add User Modal -->



<div class="row" align="right" STYLE="margin-top: 20px">

    <button class="btn btn-custom" data-toggle="modal" data-target="#myFail"><i class="fa fa-fw fa-plus"></i>Fail</button>

    <br>

</div>