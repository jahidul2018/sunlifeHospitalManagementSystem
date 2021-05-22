@extends('Layouts.App')
@section('content') 

    <center>
        <h3 class="m-0 font-weight-bold text-primary">Manager List</h3> 
    </center>


    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">Doctor List</!-->  

    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-2 large" placeholder="Manager Name or ID" aria-label="Search" aria-describedby="basic-addon2">
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
          <tr>
            <td>Emp-1001</td>
            <td>Nazib Mahfuz</td>
            <td>nazibmahfuz60@gmail.com</td>
            <td>01777127618</td>
            <td>
                <a href="{{route('HR.doctorProfile')}}">
                    <i class="fas fa-user btn btn-success"></i>
                </a>
                <a href="#">
                    <i class="far fa-trash-alt btn btn-danger"></i>
                </a>
            </td>
          </tr>
          <tr>
            <td>Emp-1001</td>
            <td>Nazib Mahfuz</td>
            <td>nazibmahfuz60@gmail.com</td>
            <td>01777127618</td>
            <td>
                <a href="#">
                    <i class="fas fa-user btn btn-success"></i>
                </a>
                <a href="#">
                    <i class="far fa-trash-alt btn btn-danger"></i>
                </a>
            </td>
          </tr>
          <tr>
            <td>Emp-1001</td>
            <td>Nazib Mahfuz</td>
            <td>nazibmahfuz60@gmail.com</td>
            <td>01777127618</td>
            <td>
                <a href="#">
                    <i class="fas fa-user btn btn-success"></i>
                </a>
                <a href="#">
                    <i class="far fa-trash-alt btn btn-danger"></i>
                </a>
            </td>
          </tr>
          <tr>
            <td>Emp-1001</td>
            <td>Nazib Mahfuz</td>
            <td>nazibmahfuz60@gmail.com</td>
            <td>01777127618</td>
            <td>
                <a href="#">
                    <i class="fas fa-user btn btn-success"></i>
                </a>
                <a href="#">
                    <i class="far fa-trash-alt btn btn-danger"></i>
                </a>
            </td>
          </tr>
          
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