@extends('Layouts.App')
@section('content')
    <center>
        <h3>Hospital Test List</h3>
        
        <hr>

        @if(session('msg'))
            <div class="alert alert-success">
                {{session('msg')}}
            </div>
        @endif

        <div class="row">
            <div class="col-sm-1">
                <!-- Empty DIV -->
            </div>

            <div class="col-sm-10">
                <div class="container">
                <center>
                    <input type="text" class="form-control" placeholder="Search Here..."  name="search" id="search">
                </center>
                </div>

                <br><br>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Adding Date</th>
                            <th>TestName</th>
                            <th>TestShortName</th>
                            <th>Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>

            <div class="col-sm-1">
                <!-- Empty Row -->
            </div>
        </div>
        

        <script>
            $(document).ready(function(){
                fetch_customer_data();

                function fetch_customer_data(query = ''){
                    $.ajax({
                        url: "{{ route('HR.searchTest') }}",
                        method: 'GET',
                        data : {query : query},
                        dataType: 'json',
                        success: function(data){
                            $('tbody').html(data.table_data);

                        }
                    })
                }

                $(document).on('keyup', '#search', function(){
                    var query = $(this).val();
                    console.log(query);
                    fetch_customer_data(query);
                });

            });
        </script>
        
@endsection