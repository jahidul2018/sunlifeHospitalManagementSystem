@extends('Layouts.App')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            Temporary Authentication Lists
        </center>
    </div>

    <div class="card-body">
        <div class="table">
            <div class="row">
                <div class="col-sm-12">
                    <table width="100%">
                        <thead>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>UserType</th>
                            <th>Username</th>
                            <th>Password</th>
                        </thead>
                        <tbody>
                            @foreach($tempAuth as $temp)
                            <tr>
                                <td>{{$temp['email']}}</td>
                                <td>{{$temp['phone']}}</td>
                                <td>{{$temp['type']}}</td>
                                <td>{{$temp['username']}}</td>
                                <td>{{$temp['password']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection 