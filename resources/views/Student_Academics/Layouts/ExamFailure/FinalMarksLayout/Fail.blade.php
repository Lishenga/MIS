<div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel" align="center">Exam Failure</h4>

            </div>

            <form role="form"   method="POST" action="{{ url('studentacademics/examfailure/fail2') }}" enctype="multipart/form-data">

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

                    <input type="hidden" name="academic_year" value="{{ $examfailure->academic_year}}">

                    <input type="hidden" name="student_id" value="{{$examfailure->student_id}}">

                    <input type="hidden" name="exam_id" value="{{$examfailure->examtodo}}">

                    <div class="form-group">

                        <label for="sell" align="center">Units Failed<span class="text-danger">*</span></label>

                        <select class="selectpicker" multiple data-max-options="20" name="unitsfailed[]" data-live-search="true">

                            @foreach($course->units as $unit_data)

                                <option value="{{$unit_data}}">{{$unit_data}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="sell" align="center">Units Passed<span class="text-danger">*</span></label>

                        <select class="selectpicker" multiple data-max-options="20" name="unitspassed[]" data-live-search="true">

                            @foreach($course->units as $unit_data)

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

<!-- End Add User Modal -->