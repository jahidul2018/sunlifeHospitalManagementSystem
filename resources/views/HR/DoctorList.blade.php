@extends('Layouts.App')
@section('content') 

    <center>
        <h3 class="m-0 font-weight-bold text-primary">Doctor List</h3> 
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
              <input type="text" class="form-control bg-light border-2 large" placeholder="Doctor Name or ID" aria-label="Search" aria-describedby="basic-addon2" id="doctorSearch">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="src">
                  <i class="fas fa-search fa-sm"></i>
                </button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="{{ route('HR.doctorList') }}">
                  <button class="btn btn-info">
                    Refresh
                  </button>
                </a>
              </div>
            </div>
          </form>
  </div>


  <!-- @if(session('msg'))
            <div class="alert alert-success">
              {{session('msg')}}
            </div>
      @endif -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Doctor ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Department</th>
            <th>Specialist</th>
            <th>Schedule</th>
            <th>Action</th>
          </tr>
        </thead>
        
          <tbody id="doctor">
          @foreach($doctors as $doctor)
            <tr>
              <td>{{$doctor['DoctorId']}}</td>
              <td>{{$doctor['Name']}}</td>
              <td>{{$doctor['Phone']}}</td>
              <td>{{$doctor['Department']}}</td>
              <td>{{$doctor['Specialist']}}</td>
              <td>
                <a href="{{route('HR.search',$doctor['DoctorId'])}}">
                  <input type="submit" name="schedule" value="Genarate Time" class="btn btn-info">
                </a>
              </td>
              <td>
                  <a href="{{route('HR.doctorProfile', $doctor['DoctorId'])}}">
                      <i class="fas fa-user btn btn-success"></i>
                  </a>
                  <a href="#">
                      <i class="far fa-trash-alt btn btn-danger"></i>
                  </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{$doctors->links()}}
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ee1bc5c5654b068"></script>

                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
            
</div>
<!-- End of Main Content -->

<!-- AJAX CODE -->
<script>
  $(document).ready(function(){
    $(document).on('click', '#src', function(){
      var noData = '';
      var td='';
      var msg = 'No Data Found';
      var query = $('#doctorSearch').val();
      
      $.ajax({
          url: "{{ route('HR.searchDoctor') }}",
          method: 'GET',
          data:{data:noData, query},
          success:function(data){
            console.log(data);
            td = '';
            for(var i=0 ;i<data.length; i++){
              if(data[i].DoctorId == undefined){
                td += '<tr>'
                td += '<td></td>'
                td += '<td></td>'
                td += '<td></td>'
                td += '<td>'+msg+'</td>'
                td += '<td></td>'
                td += '<td></td>'
                td += '<td></td>'
                td += '</tr>'
                break;
              }
              td += '<tr>'
              td += '<td>'+data[i].DoctorId+'</td>'
              td += '<td>'+data[i].Name+'</td>'
              td += '<td>'+data[i].Phone+'</td>'
              td += '<td>'+data[i].Department+'</td>'
              td += '<td>'+data[i].Specialist+'</td>'
              td += '<td> <a href="/HR/SetTime/'+data[i].DoctorId+'"> <text class="btn btn-info">Genarate Time</text></a> </td>'
              td += '<td> <a href="/HR/DoctorProfile/'+data[i].DoctorId+'"> <i class="fas fa-user btn btn-success"></i> </a> | <a href="#/'+data[i].DoctorId+'"> <i class="far fa-trash-alt btn btn-danger"></i> </a></td>'
              td += '</tr>'
            }

            $('#doctor').html(td);
            
          }
      });
    });
  });
</script>

@endsection