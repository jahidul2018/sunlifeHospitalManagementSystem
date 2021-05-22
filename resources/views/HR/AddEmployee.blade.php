@extends('Layouts.App')
@section('content') 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
              <center>
                Add New Employee
              </center>  
            </h1>
           
          </div>

      <!--Body Main Part-->
      

      <!-- print Error Messages -->
      @if($errors->any())
        <div class="alert alert-warning">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
          <div class="container bg card">
              <form method="POST">
              {{ csrf_field() }}
              <table width="100%">
                <tr>
                  <td colspan="2">
                    <center>
                      Personal Information
                    </center>
                  </td>
                </tr>

                <tr>
                  <td>Employee ID</td>
                  <td>
                    <input type="text" readonly class="form-control" value="{{$empId}}" name="empId">
                  </td>
                </tr>

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
                    <select class="form-control" name="gender" value="{{ old('gender') }}">
                      <option selected disabled>{{ old('gender') }}</option>
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Phone</td>
                  <td>
                    <input type="number" class="form-control" value="{{ old('phone') }}" name="phone">
                  </td>
                </tr>

                <tr>
                  <td>Email</td>
                  <td>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email">
                  </td>
                </tr>

                <tr>
                  <td>Designation</td>
                  <td>
                    <select class="form-control" name="designation" value="{{ old('designation') }}">
                      <option selected disabled>{{ old('designation') }}</option>
                      <option>HR</option>
                      <option>Manager</option>
                      <option>Receiptionist</option>
                      <option>Nurse</option>
                      <option>Word Boy</option>
                      <option>Gatemen</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>Monthly Fee</td>
                  <td>
                    <input type="number" name="monthlyfee" class="form-control" value="{{ old('monthlyfee') }}">
                  </td>
                </tr>

                <tr>
                  <td>Address</td>
                  <td>
                    <textarea class="form-control" name="address" value="{{ old('address') }}">
                    {{ old('address') }}
                    </textarea>
                    <!-- <input type="text" class="form-control" value="" name="email"> -->
                  </td>
                </tr>

                <tr>
                  <td colspan="2">
                    <center>
                      <input type="submit" class="btn btn-success" value="Registered">
                    </center>
                  </td>
                </tr>
              </table>
              </form>
          </div>
        </div>
        <div class="col-sm-1"></div>
      </div>

      <!--End Of Body Main Part-->
@endsection