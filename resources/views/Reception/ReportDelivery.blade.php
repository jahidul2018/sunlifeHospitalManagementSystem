@extends('Layouts.ReceptionApp')
@section('content')
    <style>
        /* Delivery Button Style */
        #btnDelivery{
            width: 100%;
            height: 45px;
            border-radius: 5px;
            border:none;
            padding: 0;
            background-color: rgb(24, 150, 110);
            font-family: 'Lucida Bright';
            font-size: large;
            color: white;
        }
        #btnDelivery:hover{
            background-color: rgb(18, 99, 73);
            border-radius: 7px;
            color: white;
            font-size: larger;
        }

        /* Refresh Button */
        #refresh{
            width: 100%;
            height: 35px;
            border-radius: 5px;
            border:none;
            padding: 0;
            background-color: rgb(6,104,143);
            font-family: 'Lucida Bright';
            font-size: large;
            color: white;
        }
        #refresh:hover{
            background-color: rgb(5,79,109);
            border-radius: 7px;
            color: white;
            font-size: larger;
        }

        .delivery{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color:blue;
            font-size: larger;
            font-style: bold;
        }
    </style>

    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            Report Delivery Section
        </center>
    </div>


    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-sm-7 ">
                    <center>
                        <div id="deliveryDate"></div>
                    </center>
                    <table border="0">
                        <tr>
                            <td>InvoiceNo </td>
                            <td>
                                <input type="text" class="form-control" name="invoiceNo" id="invoiceNo" placeholder="Enter Last 5 Digits">
                            </td>
                            <td>
                                Invoice Status
                            </td>
                            <td>
                                <h5><span id='status'>  </span></h5>
                            </td>
                        </tr>
                        <tr>
                            <td>Patient Name </td>
                            <td>
                                <input type="text" readonly class="form-control" name="patientName" id="patientName">
                            </td>
                            <td>
                                Delivery Status:
                            </td>
                            <td>
                                <h5><span id='reportDelivery'> </span></h5>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>Patient Phone </td>
                            <td>
                                <input type="text" readonly class="form-control" name="patientPhone" id="patientPhone">
                            </td>
                            
                            <!-- Page Refresh Button -->
                            <td colspan="2">
                                <input type="button"  value="Refresh" id="refresh">
                            </td>
                        </tr>
                    </table>

                    <div>
                        <br>
                        <!-- Test List Records  -->
                        <table width="100%" class="table">
                            <thead>
                                <th>TestCode</th>
                                <th>TestName</th>
                                <th>TestCost</th>
                            </thead>

                            <tbody id="testRecords">

                            </tbody>
                        </table>
                    </div>
                    
                </div>

                <!-- Billing Information -->
                <div class="col-sm-5">
                    <table>
                        <tr>
                            <td>InvoiceNo </td>
                            <td>
                                <input type="text" readonly class="form-control" name="invoiceNo" id="invoiceNo2">
                            </td>
                        </tr>

                        <tr>
                            <td>Invoice Date </td>
                            <td>
                                <input type="text" readonly class="form-control" name="invoiceNo" id="invoiceDate">
                            </td>
                        </tr>


                        <tr>
                            <td>Total Cost</td>
                            <td>
                                <input type="text" readonly class="form-control" name="totalCost" id="totalCost">
                            </td>
                        </tr>


                        <tr>
                            <td>Discount(TK)</td>
                            <td>
                                <input type="text" readonly class="form-control" name="discount" id="discount">
                            </td>
                        </tr>

                        <tr>
                            <td>NetAmount</td>
                            <td>
                                <input type="text" readonly class="form-control" name="netAmount" id="netAmount">
                            </td>
                        </tr>

                        <tr>
                            <td>Paid Amount</td>
                            <td>
                                <input type="text" readonly class="form-control" name="paidAmount" id="paidAmount">
                            </td>
                        </tr>

                        <tr>
                            <td>New Amount</td>
                            <td>
                                <input type="number"  class="form-control" name="newAmount" id="newAmount">
                            </td>
                        </tr>

                        <tr>
                            <td>Given Amount</td>
                            <td>
                                <input type="number"  class="form-control" name="givenAmount" id="givenAmount">
                            </td>
                        </tr>

                        <tr>
                            <td>Return Amount</td>
                            <td>
                                <input type="number" readonly class="form-control" name="returnAmount" id="returnAmount">
                            </td>
                        </tr>

                        <tr>
                            <td>Due Amount</td>
                            <td>
                                <input type="text" readonly class="form-control" name="dueAmount" id="dueAmount">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="button"  id="btnDelivery" value="Report Delivery">
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- JavaScript Code Here -->

    <script>
        $(document).ready(function(){
            var noData = '';
            var deliveryDate = '';
            var td = '';
            
            // OnChange Event Fire on Invoice feild
            $(document).on('change', '#invoiceNo', function(){
                var invoiceNo = $(this).val();
                if(invoiceNo == null){
                    alert('Please Enter a Valid InvoiceNo');
                }
                else{
                    $.ajax({
                        url: "{{ route('Reception.reportDeliveryInfo') }}",
                        method: 'GET',
                        data:{data:noData,invoiceNo},
                        success:function(data){

                            var invoiceInfo = data['invoiceInfo'];
                            var invoiceDetail = data['invoiceDetail'];
                            console.log(invoiceInfo);
                            console.log(invoiceDetail);
                            td = '';
                            for(var i=0; i<invoiceDetail.length; i++){
                                td += '<tr>'
                                td += '<td>'+invoiceDetail[i].testCode+'</td>'
                                td += '<td>'+invoiceDetail[i].testName+'</td>'
                                td += '<td>'+invoiceDetail[i].testCost+'</td>'
                                td += '</tr>'
                            }

                            for(var i=0; i<invoiceInfo.length; i++){
                                var invoiceNo = invoiceInfo[i].invoiceNo;

                                if(invoiceInfo[i].invoiceNo == undefined){
                                    alert('No Record Found');
                                    break;
                                }
                                else{
                                    var invoiceNo2 = invoiceInfo[i].invoiceNo;
                                    var patientName = invoiceInfo[i].patientName; 
                                    var patientPhone = invoiceInfo[i].patientPhone;
                                    var invoiceDate = invoiceInfo[i].invoiceDate;
                                    var totalCost = invoiceInfo[i].totalCost;
                                    var discount = invoiceInfo[i].discount;
                                    var netAmount = invoiceInfo[i].netAmount;
                                    var paidAmount = invoiceInfo[i].paidAmount;
                                    var dueAmount = invoiceInfo[i].dueAmount;
                                    var status = invoiceInfo[i].status;
                                    var reportDelivery = invoiceInfo[i].reportDelivery;
                                        deliveryDate = invoiceInfo[i].deliveryDate;

                                    if(invoiceInfo[i].status == 'Clear'){
                                        status = '<text class="badge badge-success">'+invoiceInfo[i].status+'</text>'
                                    }
                                    else{
                                        status = '<text class="badge badge-danger">'+invoiceInfo[i].status+'</text>'
                                    }

                                    if(invoiceInfo[i].reportDelivery == 'Not Delivered'){
                                        reportDelivery = '<text class="badge badge-warning">'+invoiceInfo[i].reportDelivery+'</text>'

                                    }
                                    else{
                                        reportDelivery = '<text class="badge badge-success">'+invoiceInfo[i].reportDelivery+'</text>'
                                    }

                                    if(invoiceInfo[i].deliveryDate != 'No Date'){
                                        deliveryDate = '<text class="delivery">This Report is Delivered at - '+invoiceInfo[i].deliveryDate+'</text>'

                                    }
                                    else{
                                        deliveryDate = '';
                                    }
                                }
                            }

                            $('#patientName').val(patientName);
                            $('#patientPhone').val(patientPhone);
                            $('#invoiceDate').val(invoiceDate);
                            $('#invoiceNo2').val(invoiceNo2);
                            $('#totalCost').val(totalCost);
                            $('#discount').val(discount);
                            $('#netAmount').val(netAmount);
                            $('#paidAmount').val(paidAmount);
                            $('#dueAmount').val(dueAmount);
                            $('#status').html(status);
                            $('#reportDelivery').html(reportDelivery);
                            $('#deliveryDate').html(deliveryDate);
                            //Test List 
                            $('#testRecords').html(td);
                        }
                    });
                }

            });

            //New Amount Field
            $(document).on('keyup', '#newAmount', function(){
                var newAmount = $(this).val();
                var netAmount = $('#netAmount').val();
                var paidAmount = $('#paidAmount').val();
                var dueAmount = parseInt(netAmount) - (parseInt(paidAmount) + parseInt(newAmount));
                $('#dueAmount').val(dueAmount);

                //Given Amount
                var givenAmount = $('#newAmount').val();
                $('#givenAmount').val(givenAmount);
                var returnAmount = parseInt(givenAmount) - parseInt(newAmount);
                $('#returnAmount').val(returnAmount);
            });

            //Given Amount Field
            $(document).on('keyup', '#givenAmount', function(){
                var givenAmount = $(this).val();
                var newAmount = $('#newAmount').val();
                var returnAmount = parseInt(givenAmount) - parseInt(newAmount);
                $('#returnAmount').val(returnAmount);
            });

            //Clear All Data Function
            function ClearAllData(){
                $('#patientName').val('');
                $('#patientPhone').val('');
                $('#invoiceNo').val('');
                $('#invoiceNo2').val('');
                $('#totalCost').val('');
                $('#discount').val('');
                $('#netAmount').val('');
                $('#paidAmount').val('');
                $('#dueAmount').val('');
                $('#newAmount').val('');
                $('#givenAmount').val('');
                $('#returnAmount').val('');
                $('#invoiceDate').val('');
                $('#status').html('');
                $('#reportDelivery').html('');
                $('#deliveryDate').html('');
                $('#testRecords').html('');
            }

            //Refresh Button Click
            $(document).on('click', '#refresh', function(){
                ClearAllData();
            });

            //Click Delivery Button 
            $(document).on('click', '#btnDelivery', function(){
                var invoiceNo = $('#invoiceNo2').val();
                var dueAmount = $('#dueAmount').val();

                if(invoiceNo == ''){
                    alert('Please Enter a Valid Invoice No');
                }

                else if(deliveryDate != ''){
                    alert('This Report is Already Delivered');
                }

                else if(dueAmount != 0){
                    alert('Please Clear This Invoice DUE_AMOUNT First');
                }

                else{
                    var paidAmount = $('#netAmount').val();
                    var dueAmount = $('#dueAmount').val();

                    $.ajax({
                        url: "{{ route('Reception.updateInvoice') }}",
                        method: 'GET',
                        data:{data:noData, paidAmount,dueAmount,invoiceNo},
                        success:function(data){
                            console.log(data);
                            alert('Delivery Successfully Done!');
                            ClearAllData(); //Call CearAllData function to ReFresh this Page;
                        }
                    });
                }
            });
        });
    </script>

@endsection