@extends('Layouts.App')
@section('content')
    <center>
        <h4>Edit Hospital Test Information</h4>
    </center>

    <div class="row">
        <div class="col-sm-1"></div>

        <div class="col-sm-10">
            <div class="container bg card">
                <form method="POST">
                    {{ csrf_field() }}
                    <table width="100%">
                        <tr>
                            <td>Test ID</td>
                            <td>
                                <input type="text" name="Id" readonly class="form-control" value="{{ $id }}">
                            </td>
                        </tr>

                        <tr>
                            <td>Test Adding Date</td>
                            <td>
                                <input type="text" readonly name="addingDate" class="form-control" value="{{ $addingDate }}">
                            </td>
                        </tr>

                        <tr>
                            <td>Test Name</td>
                            <td>
                                <input type="text" name="testName" class="form-control" value="{{ $testName }}">
                            </td>
                        </tr>

                        <tr>
                            <td>TestShortName</td>
                            <td>
                                <input type="text" name="testShortName" class="form-control" value="{{ $testShortName }}">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Test Cost</td>
                            <td>
                                <input type="number" name="testCost" class="form-control" value="{{ $testCost }}">
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <a href="{{route('HR.updateTest', $id )}}">
                                    <input type="submit" class="btn btn-primary" value="UpdateTestData">
                                </a>
                            </td>
                        </tr>
                    </table>
                </form>
                <br>
            </div>
        </div>

        <div class="col-sm-1"></div>
    </div>
@endsection