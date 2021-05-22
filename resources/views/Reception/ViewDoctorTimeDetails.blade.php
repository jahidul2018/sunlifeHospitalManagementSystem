@extends('Layouts.ReceptionApp')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            @foreach($DrName as $name)
                Dr.{{ $name->Name }}'s Time Details
            @endforeach
        </center>
    </div>


    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-sm-12 bg card">
                    <table width="100%" class="table table-hover">
                        <thead>
                            <th><center>SHIFT</center></th>
                            <th><center>DAY NAME</center></th>
                            <th><center>TIME DURATION</center></th>
                        </thead>

                        <tbody>
                            @foreach($DrDetails as $details)
                            <tr>
                                <td><center>{{ $details['Shift'] }}</center></td>
                                <td><center>{{ $details['DayName'] }}</center></td>
                                <td><center>{{ $details['TimeDuration'] }}</center></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection