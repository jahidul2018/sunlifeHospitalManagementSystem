@extends('Layouts.DoctorApp')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            General Settings
        </center>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="container">
                    <center>Password Reset</center>
                    <!-- <form method="post"> -->
                        <table width="100%">
                            <!-- Hidden UserEmail -->
                            @foreach($userInformation as $user)
                                <input type="hidden" value="{{ $user->Email }}" name="email" id="email">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="username" value="{{ $user->username }}" id="username">
                                    </td>
                                </tr>
                            @endforeach
                            
                            <tr>
                                <td>
                                    <input type="password" class="form-control" name="currentPassword" placeholder="Enter Current Password.." id="currentPassword">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="password" class="form-control" name="newPassword" placeholder="Enter New Password.." id="newPassword">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="password" class="form-control" name="reTypePassword" placeholder="ReType New Password.." id="reTypePassword">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <center>
                                        <input type="submit" class="btn btn-primary" value="ReSet Password" id="btnResetPassword">
                                    </center>
                                </td>
                            </tr>
                        </table>
                    <!-- </form> -->
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>

    </div>

    <script>
    $(document).ready(function(){
            
        $(document).on('click', '#btnResetPassword', function(){
            var noData='';
            var email = $('#email').val();
            var username = $('#username').val();
            var currentPassword = $('#currentPassword').val();
            var newPassword = $('#newPassword').val();
            var reTypePassword = $('#reTypePassword').val();
            var valid = 'Yes';
            console.log(currentPassword+ ' '+newPassword+ ' '+reTypePassword);
            //Check Current Password Validity
            $.ajax({
                url: "{{ route('Doctor.checkCurrentPassword') }}",
                method: 'GET',
                data:{data:noData,email,currentPassword},
                success:function(data){
                    console.log(data);
                    if(data != 'OK'){
                        alert('Incorrect Current Password');
                        valid = 'No';
                    }
                }
            });

            //Matching New Passwords Field
            if(newPassword != reTypePassword){
                alert('Password Dont Matched');
                valid = 'No';
            }
            if(valid != 'No'){
                updatePassword();
            }
        });

        function updatePassword(){
                var noData='';
                var email = $('#email').val();
                var username = $('#username').val();
                var currentPassword = $('#currentPassword').val();
                var newPassword = $('#newPassword').val();
                var reTypePassword = $('#reTypePassword').val();
                $.ajax({
                    url: "{{ route('Doctor.changePassword') }}",
                    method: 'GET',
                    data:{data:noData,email,username,newPassword},
                    success:function(data){
                        console.log(data);
                        alert('Password Successfully Updated');
                        window.location.replace("/Login"); //Redirect into Login URL

                    }
                });
            }

    });
</script>

@endsection

