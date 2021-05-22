@extends('Layouts.App')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            REPORTING SECTION
        </center>
    </div>

    <div class="card-body">
        <div class="table">
            <div class="row">
            <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#incomeReport">Income Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#accounts">Expence Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#activity">Doctor Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#activity">Patient Report</a>
                </li>
            </ul>
        <!--Tab Panes-->
        <div class="tab-content">
            <!-- My Profile -->
            <div id="incomeReport" class="container tab-pane active"><br>
                <div class="row">
                    <div class="col-sm-12">
                        @include('HR.IncomeReport')
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
@endsection