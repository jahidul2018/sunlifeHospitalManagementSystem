
<style>
    .noticeBody{
        font-family: 'Lucida Sans Unicode';
        font-size: medium;
        color: black;
        margin-left: 5%;
        margin-right: 5%;

    }

    .noticeDate{
        height: 80px;
        width: 120px;
        background-color: black;
        color: white;
        font-size: large;
        font-family: 'Times New Roman', Times, serif;
        text-align: center;
        padding-top: 5px;
    }

    .frame{
        height: 100vh;
        width:100%;

    }
</style>

@extends('Layouts.ReceptionApp')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
           Notice for , <strong> {{ $title }} </strong>
        </center>
    </div>

    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="container">
                        <div class="noticeBody">
                            {{ $body }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 container">
                    <div class="noticeDate">
                        {{ $date }}
                    </div>
                </div>
            </div>

            <br>
            
            @if($additionalFile != null)
                <div class="col-sm-12">
                    <div class="container">
                        <div class="container bg card">
                            <center>
                                <h5>Additional File's</h5>
                            </center>
                            <iframe src="{{url('noticeFile/'.$additionalFile)}}" class="frame" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection