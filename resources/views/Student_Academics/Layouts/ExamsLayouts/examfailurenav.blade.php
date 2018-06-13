



<div class="nav tabs-vertical">

    <div>

        <h4>Exams</h4>

    </div>

    <div style="margin-top: 20px">

        <form role="form"   method="POST" action="{{ url('studentacademics/examfailure/tally') }}" enctype="multipart/form-data">

            {{ csrf_field() }}

                @foreach($academic as $academics)

                    @if($academics->Name == $examfailure->academic_year)

                        @if($examfailure->student_id == $student->id)

                            <input type="hidden" name="student" value="{{$student->id}}">

                            <input type="hidden" name="Academic_year" value="{{ $academics->Name}}">

                            <input type="hidden" name="exam_id" value="{{ $examfailure->examtodo}}">

                            <button type="submit" class="btn btn-info">{{ $academics->Name}}</button>

                        @endif

                        @endif

                @endforeach

        </form>

    </div>

</div>



