@extends('Layouts.App')
@section('content') 

    <center>
        <h3 class="m-0 font-weight-bold text-primary">HR Employee List</h3> 
    </center>


    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">Doctor List</!-->  

    <!-- Print Success Message -->
    @if(session('msg'))
        <div class="alert alert-success">
          {{ session('msg') }}
        </div>
      @endif

    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-2 large" placeholder="HR Name or ID" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
        </form>
  </div>


  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
          </tr>
        </thead>
        
        <tbody>
          @foreach($hr as $hr)
            <tr>
              <td>{{ $hr['id'] }}</td>
              <td>
                {{ $hr['name'] }} 
                <p class="badge badge-primary">{{ $hr['status'] }}</p>
              </td>
              <td>{{ $hr['email'] }}</td>
              <td>{{ $hr['phone'] }}</td>
              <td>
                <!-- View Profile -->
                <a href=" {{ route('HR.HRProfile',$hr['id']) }} ">
                  <i class="fas fa-user btn btn-success"></i>
                </a> | 
                <!-- Active/Inactive Profile -->
                <a href="{{ route('HR.HRProfile',$hr['id']) }}">
                  <i class="far fa-trash-alt btn btn-primary"></i>
                </a> 
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection