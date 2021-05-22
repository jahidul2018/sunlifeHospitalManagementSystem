@extends('Layouts.ReceptionApp')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
           <strong>All Notifications</strong>
        </center>
    </div>

    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-hover" width="100%">
                        <thead>
                                <th><center>Post Date</center></th>
                                <th><center>Title</center></th>
                                <th><center>Action</center></th>
                            </thead>

                            <tbody>
                                @foreach($allNotice as $notice)
                                    <tr>
                                        <td><center>{{ $notice['date'] }}</center></td>
                                        <td><center>{{ $notice['title'] }}</center></td>
                                        <td><center>
                                            <a href="/Notice/{{ $notice['id'] }}">
                                                <input type="submit" class="btn btn-info" value="Read Notice">
                                            </a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                    {{$allNotice->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection