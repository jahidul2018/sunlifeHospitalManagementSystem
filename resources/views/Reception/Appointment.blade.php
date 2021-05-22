@extends('Layouts.ReceptionApp')
@section('content') 

    <center>
        <h2>Doctors Appointment </h2>
    </center>

    @if(session('msg'))
        <div class="alert alert-info">
            {{ session('msg') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-6">
            <div class="container bg card">
                <table width="100%">
                    <tr>
                        <td>Department</td>
                        <td>
                            <select class="form-control" name="department" id="dept">
                                <option disabled selected>Select Department</option>
                                @foreach($dept as $dept)
                                <option>
                                    {{ $dept['deptName'] }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Doctors</td>
                        <td>
                            <select class="form-control" name="doctorName" id="dname">
                                <option>
                                    <option disabled selected>Select Doctor</option>
                                </option>
                            </select>
                        </td>
                    </tr>

                    <!-- <tr>
                        <td>Doctor ID</td>
                        <td>
                            <input type="text" id="DrId" name="DrId">
                        </td>
                    </tr> -->


                    <tr>
                        <td>Date</td>
                        <td>
                            <input type="date" class="form-control" name="date" id="date">
                        </td>
                    </tr>

                    
                    <tr>
                        <td><u><b>Patient Information</b></u></td>
                    </tr>

                    <tr>
                        <td>Patient ID</td>
                        <td>
                            <input type="text" name="pId" id="pId" class="form-control" value="{{$nextId}}" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td>Patient Name</td>
                        <td>
                            <input type="text" name="pName" id="pName"  class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Patient Contact</td>
                        <td>
                            <input type="text" name="pContact" id="pContact" class="form-control">
                        </td>
                    </tr>
                    
                </table>
            </div>
        </div>

        <!-- Doctors Available Time Slot Shown Here -->
        <div class="col-sm-6">
            <div class="container bg card">
                <center>
                    <text >Time Slots</text>
                </center>
                <hr>

                <table width="100%" border="0">
                    <thead>
                        <tr>
                            <th width="40%"><center>Shift</center></th>
                            <th width="60%"><center>Time Slots</center></th>
                        </tr>
                    </thead>

                    <tbody id="times">
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- AJAX code for Department wise Doctor List -->
    <script>
            $(document).ready(function(){


                //Some Global Variable
                var DrId='';
                var patientInfo = '';
                var op='';
                $(document).on('change','#dept',function(){
                    var query = $(this).val();
                    console.log(query);
                    fetch_doctor_data(query);
                });
                
                var div = $(this).parent();
                function fetch_doctor_data(query = ''){
                    $.ajax({
                        url: "{{ route('Reception.action') }}",
                        method: 'GET',
                        data : {query : query},
                        success:function(data){
                            console.log(data);
                            op = '';
                            console.log(op);
                            for(var i=0;i<data.length;i++){
                                DrId += data[i].DoctorId;
                                op += data[i].DoctorId;
                                op += '<option>'+data[i].Name+'</option>'
                            }

                            console.log(op);
                            $('#dname').html(op);
                            $('#DrId').val(op);
                        }
                        
                    })
                }

                //Get Doctor Appointment Time Based on Date

                var name=""; //Global Name Variable;
                $(document).on('change', '#date', function(){
                    var date = $('#date').val();
                    var name = $('#dname').val();
                    var dept = $('#dept').val();

                    // console.log('Doctor ID :'+DrId);
                    console.log('Doctor Name :'+name);
                    console.log('Date '+date);
                    console.log('Department'+dept);

                    //Condition Checking

                    if(dept == null){
                        alert('Select Department Name First');
                    }

                    if(dept != null && name!= null){
                        fetch_doctor_time(name,date,dept);
                    }
                });

                var time = " ";
                // var shift = " ";
                var msg = 'Doctor is Not Available on This Date';
                
                function fetch_doctor_time(name, date, dept){
                    $.ajax({
                        url: "{{ route('Reception.doctorDate') }}",
                        method: 'GET',
                        data : {date : date, name, dept },
                        success:function(data){
                            time ='';
                            
                            for(var i=0;i<data.length;i++){

                                if(data[0].Shift == ''){
                                    time+='<tr>'
                                    time+='<td colspan="2">'+msg+'</td>'
                                    time+='</tr>'
                                    break;
                                }
                                else{
                                    var shift = data[i].Shift;
                                    if(shift == "Morning"){
                                        time+='<tr>';
                                        time+='<td> <center>'+data[i].Shift+'</center> </td>'

                                        time+='<td> <center> <input type="submit" class="btn btn-info" value="'+data[i].TimeSchedule+'" id="booking"> </center> </td>'
                                        time+='</tr>';
                                    }
                                    else{
                                        time+='<tr>';
                                        time+='<td> <center> '+data[i].Shift+' </center> </td>'
                                        time+='<td> <center>  <input type="submit" class="btn btn-success" value="'+data[i].TimeSchedule+'" id="booking"> </center> </td>'
                                        time+='</tr>';
                                    }
                                    
                                }
                                
                            }
                            $('#times').html(time);
                            console.log(data);
                        }
                        
                    });
                }


                //Set Patient Appointment Booking

                $(document).on('click', '#booking', function(){
                    //fetch All Information
                    var patientId = $('#pId').val();
                    var patientName = $('#pName').val();
                    var patientContact = $('#pContact').val();
                    var DrName = $('#dname').val();
                    var appointmentDate = $('#date').val();
                    var nn = '';

                    if(patientId == '' || patientName == '' || patientContact == ''){
                        alert('Please Fillup Patient Basic Information');
                    }else{

                        var bookingTime = $(this).val();
                        console.log(patientId+' '+patientName+' '+patientContact+' --> '+DrName+' '+appointmentDate+' bTime : '+bookingTime);

                        // console.log(bookingTime);
                        alert('You Booked at '+bookingTime);
                        $.ajax({
                            url: "{{ route('Reception.setAppointment') }}",
                            method: 'GET',
                            data:{info: nn, patientName, patientId, patientContact, DrName, appointmentDate, bookingTime,},
                            success:function(data){
                                alert('Booking Successfully Completed');
                                window.location.replace("{{route('Reception.appointment')}}");
                            }
                        });
                    }
                });

            });
    </script>


@endsection