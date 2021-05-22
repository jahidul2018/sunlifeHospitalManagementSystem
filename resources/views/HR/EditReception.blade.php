@extends('Layouts.App')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            Edit {{ $receptionProfile['name'] }}'s Profile
        </center>
    </div>


    <div class="card-body">
        <div class="">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10 bg card">
                    <form method="POST">
                        {{ csrf_field() }}
                    <table width="100%" >
                        <tr>
                            <td>Emp.ID</td>
                            <td>
                                
                                {{ $receptionProfile['id'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>Full Name</td>
                            <td>
                                <input type="text" class="form-control" value="{{ $receptionProfile['name'] }}" name="name">
                            </td>
                        </tr>

                        <tr>
                            <td>DOB</td>
                            <td>
                                <input type="text" class="form-control" value="{{ $receptionProfile['dob'] }}" name="dob">
                                
                            </td>
                        </tr>

                        <tr>
                            <td>Gender</td>
                            <td>
                                <select class="form-control" name="gender">
                                    <option disabled>{{ $receptionProfile['gender'] }}</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>PhoneNo</td>
                            <td>
                                <input type="number" class="form-control" value="{{ $receptionProfile['phone'] }}" name="phone">
                                
                            </td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="email" class="form-control" value="{{ $receptionProfile['email'] }}" name="email">
                                
                            </td>
                        </tr>

                        <tr>
                            <td>Designation</td>
                            <td>
                                <select class="form-control" name="designation">
                                    <option>{{ $receptionProfile['designation'] }}</option>
                                    <option>HR</option>
                                    <option>Receptionist</option>
                                    <option>Nurse</option>
                                    <option>Wordboy</option>
                                    <option>Gatemen</option>
                                </select>
                                
                            </td>
                        </tr>

                        <tr>
                            <td>Monthly Fee</td>
                            <td>
                                <input type="number" class="form-control" value="{{ $receptionProfile['monthlyfee'] }}" name="monthlyfee">
                                
                            </td>
                        </tr>

                        <tr>
                            <td>Address</td>
                            <td>
                                <textarea class="form-control" name="address">
                                    {{ $receptionProfile['address'] }}
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>
                                <select name="status" class="form-control">
                                    <option>{{ $receptionProfile['status']}}</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <a href="{{ route('HR.updateReception', $receptionProfile['id']) }}">
                                    <input type="submit" class="btn btn-success" value="Save">
                                </a>                            
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>
@endsection