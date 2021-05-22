<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrintInvoice</title>

    <style>
        body{
            padding: 0px;
            margin: 0px;
        }
        main{
            display: grid;
            height: 100vh;
            row-gap: 1px;
            column-gap: 1px;
            grid-template-columns: 1fr 1fr 1fr;
        }
        .item{
            background-color: #bbb;
        }
        .item2{
            background-color: white;
        }
        .s2{
            grid-row-start: 1;
            grid-row-end: 3
        }

        .patientInfo{
            margin-left: 15%;
            font-family: 'Segoe UI';
            font-size: medium;
            color:black;
        }

        .testList{
            margin-left: 5px;
            margin-right: 5px;
        }
        .billingInfo{
            margin-left: 60%;
            margin-right: 2px;
            padding: 2px;
        }
    </style>
</head>
<body>
    <main>
        <section class="s2 item2"></section>
        <section class="s2 item">
            <center>
                <img src="/css/homeDesign/img/logo.png" alt="logo"> <br>
                <b>Location:</b><i>Unit 1-</i>A.R.F Plaza, Joydebpur Station Road,Gazipur. Phone: 01777127618
            </center>
            <hr>
            <center>
                @foreach($invoiceMaster as $inv)
                <h4>INVOICE NO : {{ $inv['invoiceNo'] }}</h4>
                @endforeach
            </center>

            <!-- TABLE PRINT DATE&TIME AND USERNAME -->
            <div class="container">
                <table width="100%" border="1">
                @foreach($invoiceMaster as $inv)
                    <tr>
                        <td>Invoice Date & Time   </td>
                        <td> {{ $inv['invoiceDate'] }} </td>

                        <td>User  </td>
                        <td> <strong> &nbsp;&nbsp; Shohel</strong></td>
                    </tr>
                @endforeach
                </table>

                
                <!-- TABLE PATIENT ID AND NAME -->
                <table width="100%" class="patientInfo"">
                    @foreach($invoiceMaster as $inv)
                    <tr>
                        <td>Patient ID </td>
                        <td> {{ $inv['patientId'] }} </td>
                    </tr>
                    <tr>
                        <td>Patient Name </td>
                        <td> {{ $inv['patientName'] }} </td>
                    </tr>
                    @endforeach
                </table>
                <hr>

                <center>
                    TEST LISTS
                </center>

                <!-- TABLE ALL TEST LIST AND PRICE -->
                <table width="100%" class="testList" border="0">
                    <thead>
                        <th>TestCode</th>
                        <th>TestName</th>
                        <th>TestCost</th>
                    </thead>

                    <tbody>
                        @foreach($invoiceDetail as $test)
                        <tr>
                            <td><center> {{ $test['testCode'] }} </center></td>
                            <td><center>{{ $test['testName'] }} </center></td>
                            <td><center> {{ $test['testCost'] }} </center></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>

                <div class="billingInfo">
                <table border="0">
                    @foreach($invoiceMaster as $inv)
                    <tr>
                        <td>Total Cost</td>
                        <td> : </td>
                        <td> {{ $inv['totalCost'] }} </td>
                    </tr>
                    
                    <tr>
                        <td>Discount(TK)</td>
                        <td> : </td>
                        <td> {{ $inv['discount'] }} </td>
                    </tr>
                    <tr>
                        <td>NetAmount</td>
                        <td> : </td>
                        <td> {{ $inv['netAmount'] }} </td>
                    </tr>
                    <tr>
                        <td>PaidAmount</td>
                        <td> : </td>
                        <td> {{ $inv['paidAmount'] }} </td>
                    </tr>
                    <tr>
                        <td>GivenAmount</td>
                        <td> : </td>
                        <td> {{ $inv['givenAmount'] }} </td>
                    </tr>
                    <tr>
                        <td>ReturnAmount</td>
                        <td> : </td>
                        <td> {{ $inv['returnAmount'] }} </td>
                    </tr>
                    <tr>
                        <td>DueAmount</td>
                        <td> : </td>
                        <td> {{ $inv['dueAmount'] }} </td>
                    </tr>
                    <tr>
                        <td>PaymentType</td>
                        <td> : </td>
                        <td> Cash </td>
                    </tr>
                    @endforeach
                    </table>
                </div>
                <center>
                    <a href="{{ route('Reception.index') }}">
                        <input type="submit" class="btn btn-primary" value="Back to Home">
                    </a>
                </center>
            </div>
        </section>
        <section class="s2 item2"></section>
        

    </main>
</body>
</html>