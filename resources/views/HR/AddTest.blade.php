@extends('Layouts.App')
@section('content')
    <center class="text">
        <h4>Hospital Test Brach</h4>
    </center>

    <div class="row">
        <div class="col-sm-2">
            <!-- Empty Div -->
        </div> 
        <div class="col-sm-8">
            <div class="container bg card">
                <center>
                    <!-- Show Add Test Successful Message -->
                    @if(session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif

                    <!-- Show Error Message__if any -->
                    @if($errors->any())
                        <div class="alert alert-warning">
                            <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </center>

                <form method="post">
                    {{csrf_field()}}
                    <table width="100%">
                        <br>

                        <tr>
                            <td>Test Name</td>
                            <td>
                                <input type="text"  name="testName" class="form-control" value="{{old('testName')}}">
                            </td>
                        </tr>

                        <tr>
                            <td>TestShortName</td>
                            <td>
                                <input type="text"  name="testShortName" class="form-control" value="{{old('testShortName')}}">
                            </td>
                        </tr>

                        <tr>
                            <td>Cost</td>
                            <td>
                                <input type="text"  name="testCost" class="form-control" value="{{old('testCost')}}">
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <center>
                                    <a href="#">
                                        <input type="submit" class="btn btn-success" width="100%" value="Save">
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="col-sm-2">
            <!-- Empty Div -->
        </div>
    </div>
@endsection