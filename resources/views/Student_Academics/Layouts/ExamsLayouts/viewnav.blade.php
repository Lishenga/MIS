<div class="nav tabs-vertical">    <div>        <h4>Exams</h4>    </div>    @forelse($exam as $exams)        @foreach($academic as $academics)            @if($academics->id == $exams->Academic_year)                @if($exams->batch_id == $student->batch_id)                    {{$academics->Name}}                    <form role="form"   method="POST" action="{{ url('studentacademics/examined/check') }}" enctype="multipart/form-data">                        {{ csrf_field() }}                        <input type="hidden" name="student" value="{{$student->id}}">                        <input type="hidden" name="id" value="{{ $exams->id}}">                        <button type="submit" class="btn btn-info">{{$exams->Name}}</button>                    </form>                @endif            @endif        @endforeach        @empty            <p>No Data Found</p>        @endforelse    <div style="margin-top: 20px">        <form role="form"   method="POST" action="{{ url('studentacademics/examined/tally') }}" enctype="multipart/form-data">            {{ csrf_field() }}            @foreach($exam as $exams)                @foreach($academic as $academics)                    @if($academics->id == $exams->Academic_year)                        @if($exams->batch_id == $student->batch_id)                            <input type="hidden" name="student" value="{{$student->id}}">                            <input type="hidden" name="id" value="{{ $exams->id}}">                            <input type="hidden" name="Academic_year" value="{{ $academics->Name}}">                        @endif                    @endif                @endforeach            @endforeach            <button type="submit" class="btn btn-info">Process Final Tally</button>        </form>    </div></div>