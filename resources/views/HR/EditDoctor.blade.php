@extends('Layouts.App')
@section('content') 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Doctor Profile</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

      <!--Body Main Part-->

      @if(session('msg'))
            <div class="alert alert-success">
              {{session('msg')}}
            </div>
      @endif

      <!--Error List Show-->
      @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif


      <div class="row">
        <div class="col-sm-8">
          <div class="container bg card">
            <form method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
              <table width="100%">
                <tr>
                  <td colspan="2">
                    <center>
                      Personal Information
                    </center>
                  </td>
                </tr>
                <tr>
                  <td>Doctor ID</td>
                  <td>
                    <input type="text"  readonly class="form-control" value="{{$DoctorId}}" name="DID">
                  </td>
                </tr>

                <tr>
                  <td>Full Name</td>
                  <td>
                    <input type="text" class="form-control" value="{{$Name}}" name="name">
                  </td>
                </tr>

                <tr>
                  <td>DOB</td>
                  <td>
                    <input type="date" class="form-control" value="{{$DOB}}" name="dob">
                  </td>
                </tr>

                <tr>
                  <td>Gender</td>
                  <td>
                    <select class="form-control" name="gender" value="{{$Gender}}">
                      <!-- <option></option> -->
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Phone</td>
                  <td>
                    <input type="number" class="form-control" value="{{$Phone}}" name="phone">
                  </td>
                </tr>

                <tr>
                  <td>Emergency</td>
                  <td>
                    <input type="number" class="form-control" value="{{$Emergency}}" name="emergency">
                  </td>
                </tr>

                <tr>
                  <td>Email</td>
                  <td>
                    <input type="email" class="form-control" value="{{$Email}}" name="email">
                  </td>
                </tr>

                <tr>
                  <td>Address</td>
                  <td>
                    <input type="text" class="form-control" value="{{$Address}}" name="address">
                  </td>
                </tr>

                <tr>
                  <td colspan="2"><hr></td>
                </tr>
                <tr>
                  <td colspan="2">
                    <center>
                      Institutional Information
                    </center>
                  </td>
                </tr>
                <tr>
                  <td>Department</td>
                  <td>
                    <select class="form-control" name="department" >
                      <option>{{$Department}}</option>
                      <option>Dental</option>
                      <option>Neourology</option>
                      <option>Heart</option>
                      <option>Cardiology</option>
                      <option>Ear,Nose & Tharot(ENT)</option>
                    </select>
                  </td>
                </tr>


                <tr>
                  <td>Specialist</td>
                  <td>
                    <select class="form-control" name="specialist" >
                      <option>{{$Specialist}}</option>
                      <option>Dentist</option>
                      <option>Neourologist</option>
                      <option>Cardiologiest</option>
                      <option>Cardiologiest</option>
                      <option>ENTeist</option>
                    </select>
                  </td>
                </tr>


                <tr>
                  <td>Visiting Fee</td>
                  <td>
                    <input type="number" class="form-control" name="visitingFee" value="{{$VisitingFee}}">
                  </td>
                </tr>

                <tr>
                  <td>Comission (%)</td>
                  <td>
                    <input type="number" class="form-control" name="comission" value="{{$Commission}}">
                  </td>
                </tr>

                <tr>
                  <td>Closing Day</td>
                  <td>
                  <select class="form-control" name="closingDay">
                      <option>{{$ClosingDay}}</option>
                      <option>None</option>
                      <option>Sat</option>
                      <option>Sun</option>
                      <option>Mon</option>
                      <option>Tue</option>
                      <option>Wed</option>
                      <option>Thus</option>
                      <option>Fri</option>
                
                    </select>
                  </td>
                </tr>

                <tr>
                  <td colspan="2">
                    <center>
                      <a href="{{route('HR.updateDoctor',$DoctorId)}}">
                        <input type="submit" class="btn btn-success" value="Update Profile">
                      </a>
                    </center>
                  </td>
                </tr>
                </form>

              </table>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="container bg card">
              Set a profile Picture
              <img class="rounded-circle z-depth-2" height="200px" width="200px" src="/uploads/{{$ProfilePicture}}">
              <br>  
              <!-- <input type="file" class="btn btn-info" value="{{$ProfilePicture}}" name="profile"> -->
            </div>
          </div>
          </div>
      <!-- </form> -->

      <!--End Of Body Main Part-->
@endsection