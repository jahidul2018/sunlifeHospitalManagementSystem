@extends('Layouts.App')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            All Notice List
        </center>
    </div>

    <div class="card-body">
    <a href="{{ route('HR.index') }}">Home</a>/<a href="{{ route('HR.notice') }}">Notice Post</a>/<a href="#">All Notices</a>
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="container bg card">
                        <table width="100%" border="0" class="table table-hover">
                            <thead>
                                <th><center>ID</center></th>
                                <th><center>Post Date</center></th>
                                <th><center>Title</center></th>
                                <th><center>Tag Peoples</center></th>
                                <th><center>Files</center></th>
                                <th><center>Action</center></th>
                            </thead>

                            <tbody>
                                @foreach($notices as $notice)
                                    <tr>
                                        <td><center>{{ $notice['id'] }}</center></td>
                                        <td><center>{{ $notice['date'] }}</center></td>
                                        <td><center>{{ $notice['title'] }}</center></td>
                                        <td><center>{{ $notice['tagPeople'] }}</center></td>
                                        <td><center>{{ $notice['addtionalFile'] }}</center></td>
                                        <td><center>
                                            <a href="{{ route('HR.editNotice',$notice['id']) }}">
                                                <input type="submit" class="btn btn-info" value="Edit">
                                            </a>
                                            <a href="#">
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection