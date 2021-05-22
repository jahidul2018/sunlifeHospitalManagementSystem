<style>
    .btnEdit{
        height: 40px;
        width: 100%;
        background-color: rgb(7, 134, 134);
        border-radius: 5px;
        cursor: pointer;
        color: white;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: medium;
        transition-duration: 0.5s;
    }
    .btnEdit:hover{
        background-color: rgb(1, 54, 54);
        border-radius: 7px;
        font-size: large;
        transition-duration: 0.5s;
    }
</style>

@extends('Layouts.ReceptionApp')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            @foreach($userInformation as $user)
                MY PROFILE : {{$user->name}}
            @endforeach
        </center>
    </div>

    <div class="card-body">
        <div class="table">
            <div class="row">
            <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#myProfile">My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#accounts">Accounts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#activity">Activity</a>
                </li>
            </ul>
        <!--Tab Panes-->
        <div class="tab-content">
            <!-- My Profile -->
            <div id="myProfile" class="container tab-pane active"><br>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="container bg card">
                        @foreach($userInformation as $user)
                        <table width="100%" class="table table-hover">
                            <tr>
                                <td>Full Name</td>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td>Phone No</td>
                                <td>{{$user->phone}}</td>
                            </tr>
                            <tr>
                                <td>DOB</td>
                                <td>{{$user->dob}}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{$user->gender}}</td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td>{{$user->designation}}</td>
                            </tr>

                            <tr>
                                <td>Address</td>
                                <td>{{$user->address}}</td>
                            </tr>
                        </table>
                        @endforeach
                        </div>
                    </div>
                    <!-- //Profile Picture -->
                    <div class="col-sm-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Profile Picture</h6>
                            </div>
                            <div class="card-body">
                            @foreach($userInformation as $user)
                                <center>
                                    <img class="rounded-circle z-depth-2" height="200px" width="200px" src="/uploads/{{$user->profilePicture}}">
                                </center>
                            </div>
                        </div>
                        <div>
                            <a href="{{route('Reception.editProfile',$user->id)}}">
                                <input type="submit" value="Edit Profile" class="btnEdit">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- ACCOUNTS -->
            <div id="accounts" class="container tab-pane"><br>
                <center><h5>My Accounts</h5></center>
                
            </div>

            <!-- ACTIVITY -->
            <div id="activity" class="container tab-pane"><br>
                <center>
                    <h5>My Activity</h5>
                </center>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
@endsection