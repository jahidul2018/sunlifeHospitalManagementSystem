@extends('Layouts.DoctorApp')
@section('content')
    <center>
        Cancel My Appointment
    </center>
    <div class="row">
        <div class="col-sm-5">
            <label>Enter Date</label>
            <input type="date" class="form-control" name="date" id="date">
            <input type="submit" class="btn btn-info"  value= "Search"id="submit">

        </div>
    </div>

    <center>
        <h4>Appointment List</h4>
        <hr>
    </center>

    @if(session('msg'))
        <div class="alert alert-danger">
            {{session('msg')}}
        </div>
    @endif

    <table class="table table-hover">
        <thead>
            <th>Date</th>
            <th>Patient ID</th>
            <th>Name</th>
            <th>Visiting Time</th>
            <th>Action</th>
        </thead>

        <tbody id="list">

        </tbody>
    </table>

    <script>
        $(document).on('click', '#submit', function(){
            var noData = '';
            var td = '';
            var date = $('#date').val();
            console.log(date);
            $.ajax({
                url: "{{route('Doctor.getCancel')}}",
                method: 'GET',
                data: {data:noData,date},
                success:function(data){
                    td = '';
                    for(var i=0; i<data.length; i++){
                        td += '<tr>'
                        td += '<td>'+data[i].appointmentDate+'</td>'
                        td += '<td>'+data[i].patientId+'</td>'
                        td += '<td>'+data[i].patientName+'</td>'
                        td += '<td>'+data[i].appointmentTime+'</td>'
                        td += '<td><a href="/Cancel/Appointment/'+data[i].patientId+'"><text class="btn btn-danger">Cancel</text></a></td>'
                        td += '</tr>'
                    }
                    $('#list').html(td);
                }
                
            });
        });
    </script>
@endsection