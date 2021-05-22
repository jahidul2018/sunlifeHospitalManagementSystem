@extends('Layouts.App')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            Profile OF : {{ $receptionProfile['name'] }}
        </center>
    </div>


    <div class="card-body">
        <div class="table">
            <div class="row">
                <div class="col-sm-8 bg card">
                    <table width="100%" class="table">
                        <tr>
                            <td>Emp.ID</td>
                            <td>
                                {{ $receptionProfile['id'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>Full Name</td>
                            <td>
                                {{ $receptionProfile['name'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>DOB</td>
                            <td>
                                {{ $receptionProfile['dob'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>Gender</td>
                            <td>
                                {{ $receptionProfile['gender'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>PhoneNo</td>
                            <td>
                                {{ $receptionProfile['phone'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td>
                                {{ $receptionProfile['email'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>Designation</td>
                            <td>
                                {{ $receptionProfile['designation'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>Monthly Fee</td>
                            <td>
                                {{ $receptionProfile['monthlyfee'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>Address</td>
                            <td>
                                {{ $receptionProfile['address'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>
                                <p class="badge badge-primary">{{ $receptionProfile['status'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <a href="{{ route('HR.editReception', $receptionProfile['id']) }}">
                                    <input type="submit" class="btn btn-info" value="Update Info">
                                </a>                            
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Profile Picture Div -->
                <div class="col-sm-4">
                    <img src="/uploads/{{$receptionProfile['profilePicture']}}" height="200px" width="200px">
                </div>
            </div>
        </div>
    </div>

@endsection