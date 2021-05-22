@extends('Layouts.ReceptionApp')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            Patient All Appointment List
        </center>
    </div>


    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <input type="text" class="form-control" placeholder="Search by Patient Name or Contact or ID..." id="search" name="search">
                    <hr>
                    <table width="100%" border="0" class="table-hover">
                        <thead>
                            <th>P.ID</th>
                            <th>BokkingDate</th>
                            <th>PName</th>
                            <th>PContact</th>
                            <th>AppointmentDate</th>
                            <th>VisitingTime</th>
                            <th>DoctorName</th>
                            <th>Action</th>
                        </thead>

                        <tbody id="pData">
                            @foreach($patientAppointment as $p)
                                <tr>
                                    <td>{{ $p['patientId'] }}</td>
                                    <td>{{ $p['bookingDate'] }}</td>
                                    <td>{{ $p['patientName'] }}</td>
                                    <td>{{ $p['pContact'] }}</td>
                                    <td>{{ $p['appointmentDate'] }}</td>
                                    <td>{{ $p['appointmentTime'] }}</td>
                                    <td>{{ $p['drName'] }}</td>
                                    <td>
                                        <a href="{{ route('Reception.emptyPrecription',$p['patientId']) }}">
                                            <input type="submit" class="btn btn-info" value="Print">
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$patientAppointment->links()}}
                </div>
            </div>
        </div>
    </div>


    <!-- Ajax Searching Code -->

    <script>
        $(document).ready(function(){
            $(document).on('keyup','#search',function(){
                var src = $(this).val();
                var td = '';
                var msg = 'No Data Found';

                $.ajax({
                    url: "{{ route('Reception.searchAppointment') }}",
                    method: 'GET',
                    data: {query:src},
                    success:function(data){
                        td='';
                        for(var i=0; i<data.length;i++){

                            if(data[i].patientId == undefined){
                                td += '<tr>'
                                td += '<td></td>'
                                td += '<td></td>'
                                td += '<td></td>'
                                td += '<td></td>'
                                td += '<td>'+msg+'</td>'
                                td += '</tr>'
                                break;
                            }
                            else{
                                td += '<tr>'
                                td += '<td>'+data[i].patientId+'</td>'
                                td += '<td>'+data[i].bookingDate+'</td>'
                                td += '<td>'+data[i].patientName+'</td>'
                                td += '<td>'+data[i].pContact+'</td>'
                                td += '<td>'+data[i].appointmentDate+'</td>'
                                td += '<td>'+data[i].appointmentTime+'</td>'
                                td += '<td>'+data[i].drName+'</td>'
                                td += '<td> <a href="/EmptyPrecription/'+data[i].patientId+'"> <text class="btn btn-info"> Print </text> </a> </td>'
                                td += '</tr>'
                            }
                            
                        }

                        $('#pData').html(td);
                    }
                })
            });


        });
    </script>
@endsection