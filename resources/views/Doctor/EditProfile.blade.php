@extends('Layouts.DoctorApp')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
           Edit Profile
        </center>
    </div>

    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-sm-8">
                    <form method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Basic Informations</h6>
                                <!-- error Message -->
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(session('msg'))
                                    <div class="alert alert-primary">
                                        {{session('msg')}}
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <table width="100%">
                                
                                <tr>
                                    <td>
                                        <input type="hidden" class="form-control" value="{{$empId}}" name="empId">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>
                                        <input type="text" class="form-control" value="{{$Name}}" name="name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>
                                        <input type="text" class="form-control" value="{{$Email}}" name="email">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>
                                        <input type="text" class="form-control" value="{{$Phone}}" name="phone">
                                    </td>
                                </tr>
                                <tr>
                                    <td>DOB</td>
                                    <td>
                                        <input type="date" class="form-control" value="{{$DOB}}" name="dob">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>
                                        <select class="form-control" name="gender">
                                            <option disabled selected>{{$Gender}}</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Visiting Fee</td>
                                    <td>
                                        <input type="number" class="form-control" value="{{ $VisitingFee }}" name="visitingFee">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Address</td>
                                    <td>
                                        <textarea class="form-control" name="address">
                                            {{$Address}}
                                        </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="{{route('Doctor.update',$DoctorId)}}">
                                            <input type="submit" class="btn btn-dark" value="Update Profile">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            </div>
                        </div>
                </div>

                    <div class="col-sm-4">
                        <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Profile Picture</h6>
                                </div>
                                <div class="card-body">
                                    <center>
                                        <img class="rounded-circle z-depth-2" height="200px" width="200px" src="/uploads/{{$ProfilePicture}}">
                                    </center>
                                </div>
                                <input type="hidden" class="btn btn-primary" name="defaultPicture" value="{{$ProfilePicture}}">
                                <input type="file" class="btn btn-primary" name="profilePicture">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection