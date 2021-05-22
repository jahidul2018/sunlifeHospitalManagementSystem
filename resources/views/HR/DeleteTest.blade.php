@extends('Layouts.App')
@section('content')
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="container bg card">
                <center>
                    <h4>Confirmation Message</h4>
                </center>
                    <table width="100%" class="table table-hover">
                        <tr>
                            <td>Test ID : </td>
                            <td>{{ $id }}</td>
                        </tr>

                        <tr>
                            <td>Test Name : </td>
                            <td>{{ $testName }}</td>
                        </tr>

                        <tr>
                            <td>TestShort Name : </td>
                            <td>{{ $testShortName }}</td>
                        </tr>

                        <tr>
                            <td>Test Cost : </td>
                            <td>{{ $testCost }}</td>
                        </tr>
                    </table>
                    <text>Are You Sure to Delete This Test?
                        <a href="{{route('HR.removeTest',$id)}}">
                        <input type="submit" class="btn btn-danger" value="Yes">
                        </a> &nbsp;&nbsp;&nbsp;
                        <a href="{{route('HR.testList')}}">
                        <input type="submit" class="btn btn-primary" value="No">
                        </a>
                    </text>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection