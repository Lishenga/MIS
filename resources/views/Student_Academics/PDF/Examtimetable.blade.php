

<body style="background-color: rgb(66, 197, 244)">

<div class="card-box">

    <div class="table-responsive">

        <h3 style="margin-left: 300px">Exam Timetable</h3>

        <table id="datatable" class="table table-striped table-condensed table-bordered table-colored table-custom" style="margin-left: 40px">

            <thead>



            <tr style="background-color: rgb(65, 244, 122)">

                <th>Exam Name</th>

                <th>Class</th>

                <th>Unit</th>

                <th>Venue</th>

                <th>Day</th>

                <th>Time</th>

            </tr>



            </thead>





            <tbody style="background-color: rgb(88, 104, 93); color: white">

            @forelse($timetable as $timetables)

                <tr>

                    @foreach($category as $categories)

                        @if($categories->id == $timetables->category_id)

                            <td>{{ $categories->Name }}</td>

                        @endif

                    @endforeach

                    @foreach($batch as $batches)

                        @if($batches->id == $timetables->batch_id)

                            <td>{{ $batches->Batch_code }}</td>

                        @endif

                    @endforeach

                    <td>{{ $timetables->unitname }}</td>

                    <td>{{ $timetables->venue }}</td>

                    <td>{{ $timetables->day	 }}</td>

                    <td>{{ $timetables->time }}</td>

                </tr>

            @empty

                <p>No Data Found</p>

            @endforelse

            </tbody>

        </table>

    </div>

</div>



</body>