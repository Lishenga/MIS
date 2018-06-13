
    <div class="col-md-12">

        <div class="card-box row">

            <div class="col-md-12">

                &nbsp;

                <h4 class="header-title m-t-0 m-b-30 text-warning">Student's Exam Details</h4>

                <div class="">

                    <div class="row">

                        <div class="col-md-4">

                            <h5> {{$student->first_name}} {{$student->middle_names}}</h5>

                        </div>

                        <div class="col-md-4">

                            {{$course}}

                        </div>

                        <div class="col-md-4">

                            <h5>{{ $student->admission_number }}</h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="card-box" >

                    <h3 class="center" >Student's Results</h3>

                    <div class="center">

                        <div class="modal-body">

                            <div class="row">

                                <div class="form-group  col-md-9">

                                    <label for="sell">Results <span class="text-danger">*</span></label>

                                    @forelse(json_decode($marks->Marks) as $key => $value)

                                        <div class="row">

                                            <div class="col-md-6">

                                                {{$key}}

                                            </div>

                                            <div class="col-md-6">

                                                <input type="text" class="form-username form-control"  required parsley-type="text" value="{{$value}}" disabled>

                                            </div>

                                        </div>

                                    @empty

                                        no units

                                    @endforelse

                                </div>

                                <div class="form-group  col-md-3">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



        </div>

    </div>