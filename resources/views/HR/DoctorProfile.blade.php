@extends('Layouts.App')
@section('content')

    

    <div class="row">
        <div class="col-sm-8">
            <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Dr.{{$Name}}'s, Profile Information</h6>
            </div>
            <div class="card-body">
            <table width="80%" class="table table-hover">
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
                    {{$DoctorId}}  
                  </td>
                </tr>

                <tr>
                  <td>Full Name</td>
                  <td>
                    {{$Name}}
                  </td>
                </tr>

                <tr>
                  <td>DOB</td>
                  <td>
                    {{$DOB}}
                  </td>
                </tr>

                <tr>
                  <td>Gender</td>
                  <td>
                    {{$Gender}}
                  </td>
                </tr>

                <tr>
                  <td>Phone</td>
                  <td>
                    {{$Phone}}
                  </td>
                </tr>

                <tr>
                  <td>Emergency</td>
                  <td>
                    {{$Emergency}}
                  </td>
                </tr>

                <tr>
                  <td>Email</td>
                  <td>
                    {{$Email}}
                  </td>
                </tr>

                <tr>
                  <td>Address</td>
                  <td>
                    {{$Address}}
                  </td>
                </tr>
                <tr class="thead-dark">
                  <td colspan="2">
                    <center>
                      Institutional Information
                    </center>
                  </td>
                </tr>
                <tr>
                  <td>Department</td>
                  <td>
                    {{$Department}}
                  </td>
                </tr>


                <tr>
                  <td>Specialist</td>
                  <td> {{$Specialist}} </td>
                </tr>

                <tr>
                  <td>Visiting Fee</td>
                  <td>
                    {{$VisitingFee}}
                  </td>
                </tr>

                <tr>
                  <td>Comission (%)</td>
                  <td>
                    {{$Commission}}
                  </td>
                </tr>

                <tr>
                  <td>Closing Day</td>
                  <td> {{$ClosingDay}} </td>
                </tr>

                <tr>
                    <td>InTotal Comission</td>
                    <td><text>250000</text></td>
                </tr>

                <tr>
                    <td>Total Patient Checked</td>
                    <td><text>2500</text></td>
                </tr>
                <!-- <tr>
                  <td colspan="2">
                    <center>
                      <input type="submit" class="btn btn-warning" value="Edit Profile">
                    </center>
                  </td>
                </tr> -->

              </table>

              <div class="container bg card">
                  <center>
                      Monthly Information
                  </center>
                  <table width="100%" class="table table-hover">
                      <tr>
                          <td>Select Month</td>
                          <td>
                              <input type="date" class="form-control" name="date">
                          </td>
                          <td>
                          <input type="submit" class="btn btn-info" value="Go">
                          </td>
                      </tr>

                      <tr>
                          <td>Patient Checked</td>
                          <td>
                              <text name="monthPathientChecked">25</text>
                          </td>
                      </tr>

                      <tr>
                          <td>Tests Referred</td>
                          <td>
                              <text name="monthPathientChecked">93</text>
                          </td>
                      </tr>

                      <tr>
                          <td>Comissions</td>
                          <td>
                              <text name="monthPathientChecked">25365</text>
                          </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                            <center>
                            <a href="{{route('HR.editDoctor', $DoctorId)}}">
                              <input type="submit" class="btn btn-warning" value="Edit Profile">

                            </a>
                            </center>
                        </td>
                        </tr>

                  </table>
              </div>
            </div>
            </div>
        </div>
        

        <div class="col-sm-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Picture</h6>
                </div>
                <div class="card-body">
                  <center>
                    <img class="rounded-circle z-depth-2" height="200px" width="200px" src="/uploads/{{$ProfilePicture}}">
                  </center>
                </div>
        </div>
    </div>
@endsection