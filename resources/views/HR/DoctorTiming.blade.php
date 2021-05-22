@extends('Layouts.App')
@section('content') 

    <div class="row">
    
        <div class="col-sm-6">
            <div class="container bg card">
                <br>
                <h3>Set Doctor Appointment Timing</h3>
                <hr>
                <form method="POST">
                    <!-- CSRF Token Value -->
                    {{csrf_field()}}
                    <table width="100%">
                        <tr>
                            <td>Doctor ID</td>
                            <td>
                                <input type="text" name="dId"class="form-control" readonly value="{{$doctor['DoctorId']}}">
                            </td>
                        </tr>

                        <tr>
                            <td>Doctor Name</td>
                            <td>
                                <input type="text" name="name" class="form-control" value="{{$doctor['Name']}}" readonly>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Select Day
                            </td>
                            <td>
                                <select class="form-control" name="selectDay">
                                    <option>Saturday</option>
                                    <option>Sunday</option>
                                    <option>Monday</option>
                                    <option>Tuesday</option>
                                    <option>Wednesday</option>
                                    <option>Thursday</option>
                                    <option>Friday</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Shift
                            </td>
                            <td>
                                <select class="form-control" name="shift">
                                    <option>Morning</option>
                                    <option>Evening</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>starting Time</td>
                            <td>
                                <input type="time" name="startingTime" class="form-control" id="startingTime">
                            </td>
                        </tr>

                        <tr>
                            <td>Total Duration</td>
                            <td>
                                <input type="number" name="duration" class="form-control" id="duration">
                            </td>
                        </tr>

                        <tr>
                            <td>Ending Time</td>
                            <td>
                                <input type="text" readonly value="" class="form-control" id="endTime" name="endTime">
                            </td>
                        </tr>

                        <tr>
                            <td>Preset Time</td>
                            <td>
                                <input type="number" class="form-control" name="presetTime" id="presetTime">
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <a href="{{route('HR.schedule',$doctor['DoctorId'])}}">
                                <input type="submit" class="btn btn-success" value="Genarate Schedule">
                                </a>
                            </td>
                        </tr>
                    </table>
                </form>
                <br>
            </div>
        </div>

        <!-- Doctor Appointment Time Show Div -->

        <div class="col-sm-6">
            <div class="container bg card">
                <br>
                <center>
                    <h6>{{$doctor['Name']}}'s Time Slots</h6>
                </center>

                <table class="table table-hover">
                    <tr>
                        <th>Day Name</th>
                        <th>Time Slots</th>
                        <th>Shift</th>
                    </tr>
                    
                    <!-- @foreach($timeList as $time)
                    <tr>
                        <td>{{$time['DayName']}}</td>
                        <td>{{$time['TotalDuration']}}</td>
                        <td>{{$time['Shift']}}</td>
                        <td>
                            <a href="#data" data-toggle="collapse">Details</a>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                        <div id="data" class="collapse">
                            <table>
                                @foreach($timeList as $time)
                                    <tr>
                                        <td>
                                            {{$time['TimeSchedule']}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {{$time['TimeSchedule']}}
                        </div>
                        </td>
                    </tr>
                    @endforeach -->

                    @foreach($timeList as $time)
                        <tr>
                            <td>{{$time['DayName']}}</td>
                            <td>{{$time['TimeSchedule']}}</td>
                            <td>{{$time['Shift']}}</td>
                        </tr>
                    @endforeach
                </table>
                {{$timeList->links()}}
            </div>
        </div>
    </div>
    

    <!-- Jquery Code Here -->
    <script>
        $("#duration").keypress(function(){
            var startingTime = document.getElementById('startingTime').value;
            var duration     = document.getElementById('duration').value+0;
            var x            = 60;
            var getHour      = duration/x;
            var endHour      = parseInt(startingTime) + parseInt(getHour);
            
            //get Hour and Minute by using split function
            var getMin = startingTime.split(":");
            // alert(getMin[1]);
            if(endHour > 12){
                var newHour = endHour - 12;
                var amPm    = "PM";
            }
            else{
                var newHour = endHour;
                var amPm    = "AM";
            }
            
            if(newHour<10){
                newHour = '0'+newHour;
                console.log(newHour);
            }
            var time = newHour+":"+getMin[1]+" "+amPm;
            // console.log(time);
            $('#endTime').val(time);
            
        });
    </script>

@endsection