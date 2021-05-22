<style>
    h5{
        color:blue;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: medium;
    }
</style>
@extends('Layouts.App')
@section('content')
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="container bg card">
                <center>
                    <h5>Verify Yourself to See the TempAuth. List</h5>
                </center>
                <!-- Error Message Print -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                 @endif

                 <!-- Message Print -->
                 @if(session('msg'))
                    <div class="alert alert-primary">
                        {{session('msg')}}
                    </div>
                 @endif
                <form method="POST">
                    {{csrf_field()}}
                    <table width=100%>
                        <tr>
                            <td>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="password" class="form-control" name="password" placeholder="Enter Password">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <center>
                                    <a href="{{route('HR.userAuthVerify')}}">
                                        <input type="submit" class="btn btn-danger" value="Verify">
                                    </a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection