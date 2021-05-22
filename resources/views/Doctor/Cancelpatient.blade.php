@extends('Layouts.DoctorApp')
@section('content')
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <center>
                <h4>Confirmation</h4>
            </center>
            <table width="100%" class="table">
                @foreach($patient as $p)
                
                <tr>
                    <td>Patient ID : </td>
                    <td>{{ $p['patientId'] }}</td>
                </tr>
                <tr>
                    <td>Patient Name : </td>
                    <td>{{ $p['patientName'] }}</td>
                </tr>
                <tr>
                    <td>Visiting Date : </td>
                    <td>{{ $p['appointmentDate'] }}</td>
                </tr>
                <tr>
                    <td>Visiting Time : </td>
                    <td>{{ $p['appointmentTime'] }}</td>
                </tr>
                @endforeach
            </table>
            <text><strong>You Sure to Delete This Appointment?</strong>
                        <a href="{{ route('Doctor.removeAppnt', $p['patientId']) }}">
                        <input type="submit" class="btn btn-danger" value="Yes">
                        </a> &nbsp;&nbsp;&nbsp;
                        <a href="{{route('Doctor.cancelAppointment')}}">
                        <input type="submit" class="btn btn-primary" value="No">
                        </a>
                    </text>
        </div>
        <div class="col-sm-3"></div>

    </div>

@endsection