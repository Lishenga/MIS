

<div class="modal-dialog" role="document">

    <div class="modal-content">

        <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <h4 class="modal-title" id="myModalLabel">Exam Timetable Details</h4>

        </div>

        <div class="modal-body">

            <form role="form"   method="POST" action="{{ url('/studentacademics/timetable/create') }}" enctype="multipart/form-data">

                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="row">

                        <div class="form-group  col-md-4">

                            <label for="sell">Course <span class="text-danger">*</span></label>

                            <select class="form-control selectpicker" id="sell" name="unitname" data-live-search="true">

                                @foreach($exam as $exams)
                                    @foreach(json_decode($exams->Units) as $unit)

                                        <option value="{{$unit}}">{{$unit}}</option>

                                    @endforeach
                                @endforeach

                            </select>

                        </div>

                        <div class="form-group center col-md-4">

                            <label for="sell">Class <span class="text-danger">*</span></label>

                            <select class="form-control selectpicker" id="sell" name="batch_id" data-live-search="true">

                                @foreach($batch as $batches)

                                    <option value="{{$batches->id}}">{{$batches->Batch_name}}</option>

                                @endforeach

                            </select>

                        </div>

                        <div class="form-group center col-md-4">

                            <label  for="form-username">Venue<span class="text-danger">*</span></label>

                            <input type="text" name="venue" placeholder="Venue..." class="form-username form-control"  required parsley-type="text">

                        </div>



                    </div>



                    <div class="row">


                        <div class="form-group  col-md-4">

                            <label  for="form-username">Exam Category<span class="text-danger">*</span></label>

                            <select class="form-control selectpicker" id="sell" name="category_id" data-live-search="true">

                                @foreach($category as $categories)

                                    <option value="{{$categories->id}}">{{$categories->Name}}</option>

                                @endforeach

                            </select>

                        </div>



                        <div class="form-group center col-md-4">

                            <label  for="form-username">Day<span class="text-danger">*</span></label>

                            <input type="date" name="day" class="form-username form-control"  required parsley-type="text">

                        </div>

                        <div class="form-group center col-md-4">

                            <label  for="form-username">Time<span class="text-danger">*</span></label>

                            <input type="text" name="time" placeholder="Time..." class="form-username form-control"  required parsley-type="text">

                        </div>

                    </div>

                </div>

                <div class="modal-footer form-group">

                    <button type="submit" class="btn btn-info">Create</button>

                </div>

            </form>

        </div>

    </div>

</div>

