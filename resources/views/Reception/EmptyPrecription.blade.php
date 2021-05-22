<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precription</title>

    <!--BootStrap 4 CDN Likns-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- <link href="/css/app.css" rel="stylesheet"> -->
    

</head>
<body>
    <div class="container bg card">
        <div class="row">
            <div class="col-sm-12">
                <center>
                    <img src="/css/homeDesign/img/logo.png" alt="logo"> <br>
                    <b>Location:</b><i>Unit 1-</i>A.R.F Plaza, Joydebpur Station Road,Gazipur. Phone: 01777127618
                </center>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <table width="100%">
                    <tr><td></td></tr>
                    @foreach($information as $info)
                    <tr>
                        <td>Patient ID </td>
                        <td>
                            {{ $info['patientId'] }}
                        </td>
                    </tr>
                    @endforeach

                    @foreach($information as $info)
                    <tr>
                        <td>Patient Name </td>
                        <td>
                            {{ $info['patientName'] }}
                        </td>
                    </tr>
                    @endforeach

                    @foreach($information as $info)
                    <tr>
                        <td>Contact No </td>
                        <td>
                            {{ $info['pContact'] }}
                        </td>
                    </tr>
                    @endforeach

                    @foreach($information as $info)
                    <tr>
                        <td>Appointemnt </td>
                        <td>
                            {{ $info['appointmentDate'] }}, at {{ $info['appointmentTime'] }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div class="col-sm-6">
                Referd.By :- 
                @foreach($information as $info)
                    <strong>{{$info['drName']}} </strong>
                @endforeach
            </div>
        </div>
    </div>
    <hr>
</body>
</html>