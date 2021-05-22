@extends('Layouts.ReceptionApp')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            Patient Registration
        </center>
    </div>

    <!-- Print Error message -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
        </div>
    @endif

    <!-- Registration Message -->

    @if(session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif


    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-sm-7 bg card">
                    <div id="msg"></div>
                    <form method="POST">
                        <table width="100%">
                            {{ csrf_field() }}
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Patient ID</td>
                            <td>
                                <input type="text" name="pId" id="pId" class="form-control" value="{{old('pId')}}">
                            </td>
                        </tr>

                        <tr>
                            <td>Patient Type</td>
                            <td>
                                <select class="form-control" name="type" value="{{old('type')}}">
                                    <option selected disabled>Select Patient Type</option>
                                    <option>Outdoor</option>
                                    <option>Indoor</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Patient Name</td>
                            <td>
                                <input type="text" name="pName" id="pName" class="form-control" value="{{old('pName')}}">
                            </td>
                        </tr>
                        <tr>
                            <td>Patient Contact</td>
                            <td>
                                <input type="text" name="pContact" id="pContact" class="form-control" value="{{old('pContact')}}">
                            </td>
                        </tr>
                        <tr>
                            <td>Patient Gender</td>
                            <td>
                                <select class="form-control" name="pGender" value="{{old('pGender')}}">
                                    <option selected disabled>Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Patient Age</td>
                            <td>
                                <input type="number" name="pAge" class="form-control" value="{{old('pAge')}}">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <center>
                                <a href="{{ route('Reception.insertPatient') }}">
                                    <button class="btn btn-success">Registered</button>
                                </a>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        </table>
                    </form>
                </div>

                <!-- Related Doctor Information -->
                <div class="col-sm-5 bg card">
                    <table width="100%" class="table">
                        
                        <tr>
                            <td>Doctor Name</td>
                            <td>
                                <text id="dname"></text>
                            </td>
                        </tr>

                        <tr>
                            <td>Visited Date</td>
                            <td>
                                <text id="visitingDate"></text>
                            </td>
                        </tr>
                        <tr>
                            <td>Time</td>
                            <td>
                                <text id="visitingTime"></text>
                            </td>
                        </tr>

                        <tr>
                            <td>Booking Date</td>
                            <td>
                                <text id="bookingDate"></text>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- AJAX CODE -->

    <script>
        $(document).ready(function(){
            
            $(document).on('change', '#pId', function(){
                var patientId = $(this).val();
                console.log(patientId);
                var noData          = '';
                var patientName     = '';
                var patientContact  = '';
                var doctorName      = '';
                var visitingDate    = '';
                var vistingTime     = '';
                var bookingDate     = '';
                var emptyData       = '';
                var msg = 'Maybe New Patient.Click Here To Appointment';


                $.ajax({
                    url: "{{ route('Reception.patientInfo') }}",
                    method: 'GET',
                    data:{data:noData,patientId},
                    success:function(data){
                        console.log(data);
                        patientName     = '';
                        patientContact  = '';
                        doctorInfo      = '';

                        for(var i=0; i<data.length; i++){
                            if(data[i].patientName == undefined ){
                                patientName     += emptyData;
                                patientContact  += emptyData;
                                noData          += '<div> <a href="/Appointment"> <strong> '+msg+' </strong> </a> </div>'
                                alert('No Record Found!!');
                                break;
                            }
                            else{
                                patientName += data[i].patientName;
                                patientContact += data[i].pContact;
                                // Get Doctor Data
                                doctorName    += '<text>'+data[i].drName+'</text>'
                                visitingDate  += '<text>'+data[i].appointmentDate+'</text>'
                                vistingTime   += '<text>'+data[i].appointmentTime+'</text>'
                                bookingDate   += '<text>'+data[i].bookingDate+'</text>'
                            }
                        } 
                        $('#msg').html(noData);
                        $('#pName').val(patientName);
                        $('#pContact').val(patientContact);
                        $('#dname').html(doctorName);
                        $('#visitingDate').html(visitingDate);
                        $('#visitingTime').html(vistingTime);
                        $('#bookingDate').html(bookingDate);
                    }
                });
            });

            $('#pId').keyup(function(){
                $(this).next('#pAge').focus();
            });
            
        });
    </script>
@endsection