@extends('Layouts.App')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            Update Hospital Departments :- <u>[{{$deptName}}]</u>
        </center>
    </div>


    <div class="card-body">
        <div class="">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <!-- Error Message -->
                    @if($errors->any())
                        <div class="alert alert-warning">
                            <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post">
                        {{csrf_field()}}
                    <table  width="100%">
                        <tr>
                            <td>Department ID </td>
                            <td>
                                <input type="text" readonly class="form-control" value="{{$id}}">
                            </td>
                        </tr>

                        <tr>
                            <td>Adding Date </td>
                            <td>
                                <input type="text" readonly class="form-control" value="{{$deptAddingDate}}">
                            </td>
                        </tr>

                        <tr>
                            <td>Department Code </td>
                            <td>
                                <input type="text" class="form-control" value="{{$deptCode}}" name="deptCode">
                            </td>
                        </tr>

                        <tr>
                            <td>Department Name </td>
                            <td>
                                <input type="text" class="form-control" value="{{$deptName}}" name="deptName">
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <a href="{{ route('HR.updateDepartment',$id )}}">
                                    <input type="submit" class="btn btn-primary" value="Update Department">
                                </a>
                                <!-- <a href="{{ route('HR.updateDepartment',$id )}}">
                                    <input type="submit" class="btn btn-danger" value="Deactivate ">
                                </a> -->
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
@endsection()