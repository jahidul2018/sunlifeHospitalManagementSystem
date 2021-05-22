
@extends('Layouts.App')
@section('content') 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 ">Add New Doctor</h1>
          </div>

          <!-- @if(session('msg'))
            <div class="alert alert-success">
              {{session('msg')}}
            </div>
          @endif -->
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

      @if(session('msg'))
        <div class="alert alert-primary">
          Temp Username and Password<br>
          --------------------------<br>
            <li>{{session('msg')}}</li>
        </div>
      @endif
      <!--Body Main Part-->
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
                  <td>Emp ID</td>
                  <td>
                    <input type="text" readonly class="form-control" value="{{ $empId }}" name="empId">
                  </td>
                </>

                <tr>
                  <td>Full Name</td>
                  <td>
                    <input type="text" class="form-control" value="{{old('name')}}" name="name">
                  </td>
                </tr>

                <tr>
                  <td>DOB</td>
                  <td>
                    <input type="date" class="form-control" value="{{old('dob')}}" name="dob">
                  </td>
                </tr>

                <tr>
                  <td>Gender</td>
                  <td>
                    <select class="form-control" name="gender" value="{{old('gender')}}">
                      <option selected disabled>{{old('gender')}}</option>
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Phone</td>
                  <td>
                    <input type="number" class="form-control" value="{{old('phone')}}" name="phone">
                  </td>
                </tr>

                <tr>
                  <td>Emergency</td>
                  <td>
                    <input type="number" class="form-control" value="{{old('emergency')}}" name="emergency">
                  </td>
                </tr>

                <tr>
                  <td>Email</td>
                  <td>
                    <input type="email" class="form-control" value="{{old('email')}}" name="email">
                  </td>
                </tr>

                <tr>
                  <td>Address</td>
                  <td>
                    <input type="text" class="form-control" value="{{old('address')}}" name="address">
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
                    <select class="form-control" name="department" value="{{old('department')}}">
                      <option selected disabled>{{old('department')}}</option>
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
                    <select class="form-control" name="specialist" value="{{old('specialist')}}">
                      <option selected disabled>{{old('specialist')}}</option>
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
                    <input type="number" class="form-control" name="visitingFee" value="{{old('visitingFee')}}">
                  </td>
                </tr>

                <tr>
                  <td>Comission (%)</td>
                  <td>
                    <input type="number" class="form-control" name="comission" value="{{old('comission')}}">
                  </td>
                </tr>

                <tr>
                  <td>Closing Day</td>
                  <td>
                    <select class="form-control" name="closingDay" value="{{old('closingDay')}}">
                        <option selected disabled>{{old('closingDay')}}</option>
                        <option>None</option>
                        <option>Saturday</option>
                        <option>Sunday</option>
                        <option>Monday</option>
                        <option>Tuesday</option>
                        <option>Wednesday</option>
                        <option>Thursday</option>
                        <option>Friday</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td colspan="2">
                    <a href="{{route('HR.insertDoctor')}}">
                    <center>
                      <input type="submit" class="btn btn-success" value="Registered">
                    </center>
                    </a>
                  </td>
                </tr>
                <!-- </form> -->
              </table>
            
          </div>
        </div>
        <div class="col-sm-4">
          <div class="container bg card">
              Set a profile Picture
              <br>
              <img src="" height="150px" width="150px"> <br>
              <input type="file" class="btn btn-info" value="Select a Picture" name="profile"><br>
          </div>
        </div>
        </form>
      </div>

      <!--End Of Body Main Part-->
@endsection