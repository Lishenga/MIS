
    <div class="col-md-12">

        <div class="card-box row">

            <div class="col-md-12">

                &nbsp;

                <h4 class="header-title m-t-0 m-b-30 text-warning">Student's Exam Details</h4>

                <div class="">

                    <div class="row">

                        <div class="col-md-3 img-responsive">

                             {{asset(public_path().'/image/student/'.$student->image)}}

                        </div>

                        <div class="col-md-3">

                            <h5> {{$student->first_name}} {{$student->middle_names}}</h5>

                        </div>

                        <div class="col-md-3">

                            {{$course->course_name}}

                        </div>

                        <div class="col-md-3">

                            <h5>{{ $student->admission_number }}</h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>