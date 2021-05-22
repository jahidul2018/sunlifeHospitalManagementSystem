@extends('Layouts.ReceptionApp')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            Doctors Time Schedule List
        </center>
    </div>


    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <input type="text" class="form-control" placeholder="Enter Dept or DrName..." id="search" name="search">
                    <hr>
                    
                    <table class="table-hover" width="100%">
                        <thead>
                            <th><center>DrID</center></th>
                            <th><center>DoctorName</center></th>
                            <th><center>Department</center></th>
                            <th><center>Action</center></th>
                        </thead>
                        
                        <tbody id="dData">
                            @foreach($doctorTimes as $time)
                                <tr>
                                    <td><center>{{ $time->DrId }}</center></td>
                                    <td><center>{{ $time->DrName }}</center></td>
                                    <td><center>{{ $time->Department }}</center></td>
                                    <td><center>
                                        <a href="{{ route('Reception.doctorScheduleDetails', $time->DrId) }}">
                                            <input type="submit" class="btn btn-info" value="View Details">
                                        </a>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$doctorTimes->links()}}
                </div>
            </div>
        </div>
    </div>


    <!-- Searching Code AJAX -->

    <script>
        $(document).ready(function(){
            var noData = '';
            var td = '';
            var msg = 'No Data Found';
            $(document).on('keyup','#search', function(){
                var search = $(this).val();
                console.log(search);
                td='';
                $.ajax({
                    url: "{{ route('Reception.searchDoctorTime') }}",
                    method: 'GET',
                    data:{data:noData, search},
                    success:function(data){
                        for(var i=0; i<data.length; i++){
                            if(data[i].DrName == undefined){
                                td += '<tr>'
                                td += '<td>'+msg+'</td>'
                                td += '</tr>'
                                break;
                            }
                            else{
                                td += '<tr>'
                                td += '<td>'+data[i].DrId+'</td>'
                                td += '<td>'+data[i].DrName+'</td>'
                                td += '<td>'+data[i].Department+'</td>'
                                td += '</tr>'

                            }
                        }
                        $('#dData').html(td);
                    }
                });
            });
        });
    </script>
@endsection