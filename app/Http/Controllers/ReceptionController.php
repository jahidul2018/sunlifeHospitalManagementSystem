<?php

namespace App\Http\Controllers;

use Carbon\Carbon; 
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use DB;
use App\Doctor;
use App\HospitalDepartment;
use App\AppointmentTime;
use App\AppointmentTimeMaster;
use App\Employee;
use App\HospitalTest;
use App\PatientAppointment;
use App\PatientlistMaster;
use App\TempTestlist;
use App\InvoiceMaster;
use App\InvoiceDetail;
use App\Login;
use App\Notice;

use DateTime;
use Illuminate\Contracts\Session\Session;
use SebastianBergmann\Environment\Console;

class ReceptionController extends Controller
{
    //Genarate Invoice
    public function invoice(){
        $dt = new Carbon();
        $dt->timezone('Asia/Dhaka');
        $year =  $dt->year;
        $month = $dt->month;
        $day = $dt->day;
        if($month < 10){
            $month = '0'.$month;
        }
        if($day < 10){
            $day = '0'.$day;
        }
        $invoice = $year.$month.$day;
        return $invoice;
    }

    public function index(){
        $testList = HospitalTest::all();
            $dt = new Carbon();
            $dt->timezone('Asia/Dhaka');
            $year =  $dt->year;
            $month = $dt->month;
            $day = $dt->day;
            $seconds = $dt->second;
            $milisec = $dt->millisecond;
            $incrementDigits = '0000';
            $lastDayofCurrentMonth = $dt->daysInMonth;
            $lastDay = $lastDayofCurrentMonth;
            if($month < 10){
                $month = '0'.$month;
            }
            if($day < 10){
                $day = '0'.$day;
            }
            if($lastDay > $lastDayofCurrentMonth+1){
                $incrementDigits = '0000';
            }
            $invoice = $year.$month.$day.$seconds.$milisec;
            $nextInvoiceNo = $invoice;

        // }
        // else{
            // $invoice = $year.$month.$day.$seconds;
            // $nextInvoiceNo = $getInvoice+1;
        // }
        return view('Reception.index',['testList' => $testList, 'invoiceNo' => $nextInvoiceNo]);
    }

    ####################################################################
    /* **********************Doctors Appointment Set ********************/
    ####################################################################

    //Appointment Function
    public function appointment(){
        $dept = HospitalDepartment::all();
        $pId = PatientAppointment::max('patientId');

        if($pId == null){
            $nextId = 1001;
        }
        else{
            $nextId = $pId+1;
        }   
        
        return view('Reception.Appointment',['dept' => $dept,'nextId'=>$nextId]);
    }

    //Ajax Request to Load Doctor Name With Selected Department
    function action(Request $req){
        if($req->ajax()){
            $query = $req->get('query');

            if($query != ''){
                $doctorName = Doctor::where('Department', $query)->get(['DoctorId','Name']);
                return response()->json($doctorName);
            }
            
        }
    }

    //Ajax Request to Show Selected Doctor Time Slots for Appointment Booking;
    public function doctorDate(Request $req){
        if($req->ajax()){
            $date = $req->get('date');
            $name = $req->get('name');
            $dept = $req->get('dept');

            error_log('Date   : '.$date);
            error_log('DrName : '.$name);
            error_log('Dept   : '.$dept);
            //Get Day
            $d = new DateTime($date);
            $day = ($d->format('l'));
            error_log($day);

            // $apntTime = AppointmentTime::where([
            //                             ['DrName', '=', $name],
            //                             ['DayName', '=', $day]
            // ])->get(['Id', 'Shift','TimeSchedule']);

            //Raw SQL Query for Getting Doctor Available Time Slots Joining appointment_times and patient_appointments Table;
            $apntTime = DB::select('SELECT  Shift,TimeSchedule FROM appointment_times
            WHERE  DayName=? AND DrName = ? AND TimeSchedule NOT IN(SELECT appointmentTime FROM patient_appointments WHERE appointmentDate = ? AND drName = ? and appointmentDay = ?)',[$day,$name,$date,$name,$day]);
            error_log('Before $apntTime');
            return $apntTime;

            //This Part would not work Because we return the DB Value;
            // error_log('After $apntTime');

            
            // $total_row = $apntTime->count();
            // error_log('Total Row :'.$total_row);
            // if($total_row > 0){
            //     $AppointmentTimes = $apntTime;
            // }
            // else{
            //     $AppointmentTimes = 'Dr.'.$name.' is not Available on that Day';
            // }

            // return response()->json($AppointmentTimes);
        }
    }



    /*******************Set Patient Appointment Booking ***************************** */

    public function setAppointment(Request $req){
        if($req->ajax()){
            $patientName = $req->get('patientName');
            $patientId = $req->get('patientId');
            $patientContact = $req->get('patientContact');
            $DrName = $req->get('DrName');
            $appointmentDate = $req->get('appointmentDate');
            $bookingTime = $req->get('bookingTime');

            //get Appointment Day from appointmentDate
            $d = new DateTime($appointmentDate);
            $appointmentDay = ($d->format('l'));

            $bookingDate = new Carbon();
            $bookingDate -> timezone('Asia/Dhaka');

            // Now Insert Data into Patient_Appointments Table
            $appointment = new PatientAppointment();

            $appointment->appointmentDate = $appointmentDate;
            $appointment->bookingDate = $bookingDate;
            $appointment->appointmentDay = $appointmentDay;
            $appointment->appointmentTime = $bookingTime;
            $appointment->drName = $DrName;
            $appointment->patientName = $patientName;
            $appointment->patientId = $patientId;
            $appointment->pContact = $patientContact;

            $appointment->save();
            

        }
    }


    /**********************Patient All Appointment List**************** */

    public function appointmentList(){
        $patientAppointment = PatientAppointment::orderBy('id','desc')->paginate(10);
        return view('Reception.AppointmentList',['patientAppointment' => $patientAppointment]);
    }

    /**********************Search Appointment Patient List *************************/
    public function searchAppointment(Request $req){
        if($req->ajax()){
            $query = $req->get('query');
            $patientAppnt = '';
            $result = '';
            if($query != ''){
                $patientAppnt = PatientAppointment::where('patientId', 'like', '%'. $query .'%')
                                            ->orWhere('patientName', 'like', '%'. $query .'%')
                                            ->orWhere('pContact', 'like', '%'. $query .'%')
                                            ->get();
            }
            else{
                $patientAppnt = PatientAppointment::orderBy('id','desc')->get();
            }

            $row_data = $patientAppnt->count(); //Check Total Data Row.

            if($row_data > 0){
                $result = $patientAppnt;
            }
            else{
                $result = "No Data Found";
            }

            return response()->json($result);
            
            
        }
    }

    ####################################################################
    /* **********************End Doctors Appointment********************/
    ####################################################################


    /*******************View Doctor Time Schedule******************* */
    public function doctorSchedule(){

        $doctorTimes = DB::table('appointment_time_masters')
                        ->join('doctors','doctors.DoctorId', '=', 'appointment_time_masters.DrId')
                        ->select('appointment_time_masters.DrId','appointment_time_masters.DrName','doctors.Department')
                        // ->groupBy('doctors.DoctorId')
                        ->paginate(10);
                        
        return view('Reception.DoctorSchedule',['doctorTimes' => $doctorTimes]);
    }

    /*******************View Doctor Time Schedule Details******************* */

    public function doctorScheduleDetails($DrId){
        $DrDetails = AppointmentTimeMaster::where('DrId', '=', $DrId)
                                            ->get();
        $getDrName = DB::table('doctors')
                        ->where('DoctorId', '=', $DrId)
                        ->select('Name')
                        ->get();
        return view('Reception.ViewDoctorTimeDetails',['DrDetails' => $DrDetails,'DrName' => $getDrName]);
    }

    //Search Doctor Time Schedule

    public function searchDoctorTime(Request $req){
        if($req->ajax()){
            $query = $req->get('search');
            $doctorTimes;
            if($query!=''){
                $doctorTimes = DB::table('appointment_time_masters')
                        ->join('doctors','doctors.DoctorId', '=', 'appointment_time_masters.DrId')
                        ->where('appointment_time_masters.DrName','like','%'.$query. '%')
                        ->orWhere('doctors.Department','like','%'.$query. '%')
                        // ->groupBy('appointment_time_masters.DrName')
                        ->select('appointment_time_masters.DrId','appointment_time_masters.DrName','doctors.Department')
                        ->get();

               
            }

            return response()->json($doctorTimes);
        }
    }


    ####################################################################
    /* **********************Patient Registration**********************/
    ####################################################################

    public function registration(){
        return view('Reception.PatientRegistration');
    }

    //Get Patient Data From AJAX REQUEST
    public function patientInfo(Request $req){
        if($req->ajax()){
            $pId = $req->get('patientId');
            $patientInfo;
            $doctorInfo;
            // $pInfo = PatientlistMaster::where('patientId', '=', $pId)->get();
            // $dInfo = DB::table('patient_appointments')
            //         ->where('patientId', '=', $pId)
            //         ->get();
            
            $pInfo = PatientAppointment::where('patientId', '=', $pId)->get();


            $data_row = $pInfo->count();
            if($data_row > 0){
                $patientInfo = $pInfo;
                // $doctorInfo  = $dInfo; 
            }
            else{
                $patientInfo = 'No Record Found';
            }
        }

        return response()->json($patientInfo);
    }

    public function insertPatient(Request $req){
        $this->validate($req,[
            'pName' => 'required',
            'type' => 'required',
            'pContact' => 'required',
            'pGender' => 'required',
            'pAge' => 'required'
        ]);

        //Create Registered Date
        $registerDate = new Carbon();
        $registerDate -> timezone('Asia/Dhaka');
        
        $newPatient = new PatientlistMaster();
        
        $newPatient->patientId = $req->pId;
        $newPatient->name = $req->pName;
        $newPatient->contact = $req->pContact;
        $newPatient->gender = $req->pGender;
        $newPatient->age = $req->pAge;
        $newPatient->type = $req->type;
        $newPatient->registerDate = $registerDate;
        

        $newPatient->save();

        return redirect()->route('Reception.registration')
                         ->with('msg', 'Patient Registration Successfully Done!!');
    }


    ####################################################################
    /* **********************End Patient Registration********************/
    ####################################################################


    ####################################################################
    /* **********************Print Empty Prescription********************/
    ####################################################################

    public function emptyPrecription($patientId){
        $information = PatientAppointment::where('patientId', '=', $patientId)->get();
        error_log($information);
        return view('Reception.EmptyPrecription',['information' => $information]);
    }

    ####################################################################
    /* *****************End Print Empty Prescription********************/
    ####################################################################

    ####################################################################
    /* *****************Patient Invoice Module Page********************/
    ####################################################################

    public function patientData(Request $req){
        if($req->ajax()){
            $patientId = $req->get('pId');
            $patientData;
            $pInfo = PatientlistMaster::where('patientId', '=', $patientId)->get();
            
            $total_row = $pInfo->count();
            if($total_row > 0){
                $patientData = $pInfo;
            }
            else{
                $patientData = 'No Record Found!';
            }

            return response()->json($patientData);
        }
    }

    public function testInfo(Request $req){
        if($req->ajax()){
            $testInfo;
            $testCode = $req->get('testCode');
            
            if($testCode != ''){
                $tInfo = HospitalTest::where('testShortName', '=', $testCode)->get();
            }
            else{
                $tInfo = HospitalTest::all();
            }
            
            $total_row = $tInfo->count();

            if($total_row > 0){
                $testCode = $tInfo;
            }
            else{
                $testCode = 'Test Code dosent Matched';
            }

            return response()->json($testCode);
        }
    }

    public function tempTestList(Request $req){
        if($req->ajax()){
            $invoiceNo = $req->get('invoiceNo');
            $testCode = $req->get('testCode');
            $testName = $req->get('testName');
            $testCost = $req->get('testCost');

            $testList = new TempTestlist();

            $testList->invoiceNo= $invoiceNo;
            $testList->testCode = $testCode;
            $testList->testName = $testName;
            $testList->testCost = $testCost;

            $testList->save();

            //Get All TestList after Saving into TempTest Table;
            // $testRecord = TempTestlist::all();
            $testRecord = TempTestlist::where('invoiceNo', '=', $invoiceNo)->get();

            return response()->json($testRecord);
        }
    }

    public function deleteTempData(Request $req){
        if($req->ajax()){
            $deleteTest = DB::table('temp_testlists')->delete();

            //Get All TestList after Saving into TempTest Table;
            $testRecord = TempTestlist::all();

            return response()->json($testRecord);     
        }
    }

    public function removeTest(Request $req){
        if($req->ajax()){

            $id = $req->get('tid');
            $invoiceNo = $req->get('invoiceNo');
            $getTestPrice = DB::table('temp_testlists')
                            ->where('id', '=', $id)
                            ->select('testCost')
                            ->get();
                            
            error_log('Delete Test Price is :::: --- '.$getTestPrice);
            $removeTest = DB::table('temp_testlists')
                    ->where('id', '=', $id)
                    ->delete();
            
            // $testRecord = TempTestlist::all();
            $testRecord = TempTestlist::where('invoiceNo', '=', $invoiceNo)->get();

            // error_log($testRecord);
            return response()->json(array('testRecord'=>$testRecord, 'price'=>$getTestPrice));
        }
        
    }

    //Invoice Details
    public function invoiceDetails(Request $req){
        if($req->ajax()){
            $invoiceDate = new Carbon();
            $invoiceDate -> timezone('Asia/Dhaka');

            $invoiceDetail = new InvoiceDetail();

            $invoiceDetail->invoiceNo = $req->get('invoiceNo');
            $invoiceDetail->invoiceDate = $invoiceDate;
            $invoiceDetail->patientId = $req->get('patientId');
            $invoiceDetail->testCode = $req->get('testCode');
            $invoiceDetail->testName = $req->get('testName');
            $invoiceDetail->testCost = $req->get('testCost');

            $invoiceDetail->save();
        }
    }

    //Invoice Masters
    public function createInvoice(Request $req){
        if($req->ajax()){
            $invoiceNo = $req->get('invoiceNo');
            $status = 'Not Clear';

            $invoiceDate = new Carbon();
            $invoiceDate -> timezone('Asia/Dhaka');

            $dueAmount = $req->get('dueAmount');
            if($dueAmount == 0){
                $status = 'Clear';
            }

            // Insert Data into InvoiceMasters Table
            $data = array();
            $data['invoiceNo']      = $invoiceNo;
            $data['invoiceDate']    = $invoiceDate;
            $data['patientId']      = $req->get('patientId');
            $data['patientName']    = $req->get('patientName');
            $data['patientPhone']   = $req->get('patientPhone');
            $data['totalCost']      = $req->get('totalCost');
            $data['discount']       = $req->get('discount');
            $data['netAmount']      = $req->get('netAmount');
            $data['paidAmount']     = $req->get('paidAmount');
            $data['dueAmount']      = $dueAmount;
            $data['givenAmount']    = $req->get('givenAmount');
            $data['returnAmount']   = $req->get('returnAmount');
            $data['paymentType']    = $req->get('paymentType');
            $data['status']         = $status;
            $data['reportDelivery'] = 'Not Delivered';
            $data['deliveryDate']   = 'No Date';

            error_log($data['totalCost']);
            
            $invoiceMaster = DB::table('invoice_masters')->insert($data);
            
            //Delete Test from TempTestList for This InvoiceNo;
            $deleteTest = DB::table('temp_testlists')
                            ->where('invoiceNo', '=', $invoiceNo)
                            ->delete();
        }
        
    }

    //Print Invoice Report

    public function printInvoice($invoiceNo){
        $getInvoiceMasterData = InvoiceMaster::where('invoiceNo', '=', $invoiceNo)->get();
        $getInvoiceDetailData = InvoiceDetail::where('invoiceNo', '=', $invoiceNo)->get();
        
        return view('Reception.PrintInvoice', ['invoiceMaster'=> $getInvoiceMasterData, 'invoiceDetail'=>$getInvoiceDetailData]);
    }

    // public function getInvoiceData(Request $req){
    //     $invoiceNo = $req->invoiceNo;
    //     error_log('Invoice No :- '.$invoiceNo);
    //     // $invoiceMasters = InvoiceMaster::where('invoiceNo', '=', '2020051021715')->get();

    // }

    /*****************REPORT DELIVERY SECTION ******************** */
    public function reportDelivery(){
        return view('Reception.ReportDelivery');
    }

    public function reportDeliveryInfo(Request $req){
        if($req->ajax()){
            $invoiceInfo;
            $invoiceDetail;
            $invoiceNo = $req->get('invoiceNo');
            error_log($invoiceNo);
            if($invoiceNo != ''){
                $getInvoiceData = InvoiceMaster::where('invoiceNo','like','%'. $invoiceNo .'%')->get();
                $getInvoiceDetails = InvoiceDetail::where('invoiceNo', 'like', '%'.$invoiceNo. '%')->get();
                
                $total_row = $getInvoiceData->count();
                if($total_row > 0){
                    $invoiceInfo    = $getInvoiceData;
                    $invoiceDetail  = $getInvoiceDetails;
                }
                else{
                    $invoiceInfo = 'No Record Found';
                }

                // return response()->json($invoiceInfo);
                return response()->json(array('invoiceInfo' => $invoiceInfo, 'invoiceDetail' => $invoiceDetail));

            }

            else{
                $getInvoiceData = '';
            }
        }
    }

    //Update Invoice after Report Delivered
    public function updateInvoice(Request $req){
        if($req->ajax()){
            $invoiceNo = $req->get('invoiceNo');
            
            $deliveryDate = new Carbon();
            $deliveryDate->timezone('Asia/Dhaka'); 

            $updateDetails = [
                'paidAmount' => $req->get('paidAmount'),
                'dueAmount'  => $req->get('dueAmount'),
                'status'     => 'Clear',
                'reportDelivery' => 'Delivered',
                'deliveryDate' => $deliveryDate
            ];

            //Update Table Information
            DB::table('invoice_masters')
                ->where('invoiceNo' ,'=', $invoiceNo)
                ->update($updateDetails);
            

            //Select Updated Informations
            $invoiceInfo;
            $getInvoiceData = InvoiceMaster::where('invoiceNo','like','%'. $invoiceNo .'%')->get();

            $total_row = $getInvoiceData->count();
                if($total_row > 0){
                    $invoiceInfo = $getInvoiceData;
                }
                else{
                    $invoiceInfo = 'No Record Found';
                }

                return response()->json($invoiceInfo);
            // $updateInvoice = DB::table('invoice_masters')
            //                     ->where('invoiceNo', '=', $invoiceNo)
            //                     ->update(['paidAmount' => $paidAmount , 'dueAmount' => $dueAmount]);
            
            
            // $updateInvoice = DB::update('UPDATE invoice_masters SET paidAmount=?, dueAmount=?, status=?, reportDelivery=?, deliveryDate=? WHERE invoiceNo=?)',[$paidAmount, $dueAmount, $status, $reportDelivery, $deliveryDate, $invoiceNo]);
            
            // return $updateInvoice;
            return response()->json($invoiceInfo);
        }
    }
    

    ####################################################################
    /* *****************EndPatient Invoice Module Page********************/
    ####################################################################

    ####################################################################
    /* *****************View All Notices ********************/
    ####################################################################
    public function viewNotice($id){
        $notice = Notice::find($id);
        return view('Reception.ViewNotice',$notice);
    }

    public function allNotification(){
        $allNotice = Notice::where('tagPeople', '=', 'All')
                            ->orWhere('tagPeople', '=', 'Reciptionists')
                            ->orderBy('id', 'desc')
                            ->paginate(20);
        return view('Reception.AllNotification',['allNotice' => $allNotice]);
    }

    ####################################################################
    /* *****************End View All Notices ********************/
    ####################################################################


    //My Profile

    public function myProfile(){
        $username = session('username');
        $password = session('password');
        $userInformation = DB::table('logins')
                        ->join('employees', 'employees.email', '=', 'logins.email')
                        ->where('logins.username', '=', $username)
                        ->where('logins.password', '=', $password)
                        ->get();
        return view('Reception.MyProfile',['userInformation' => $userInformation]);
    }

    //Edit Profile

    public function editProfile($id){
        $editUser = Employee::find($id);
        return view('Reception.EditProfile',$editUser);
    }

    public function editInformations($id, Request $req){
        $this->validate($req,[
            'name' => 'required',
            // 'email' => 'required|unique:employees|unique:logins',
            // 'phone' => 'required|unique:employees|unique:logins',
            'email' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'address' => 'required'
        ]);

        $email = $req->email;
        $phone = $req->phone;
        $name = $req->name;

        $update = Employee::find($id);
        $update->name = $name;
        $update->email = $email;
        $update->phone = $phone;
        $update->dob = $req->dob;
        $update->address = $req->address;

        //Update Profile Picture
        if($req->hasFile('profilePicture')){
			$file = $req->file('profilePicture');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            
            $file->move('uploads/',$filename);
            $update->ProfilePicture = $filename;

		}else{
            $update->ProfilePicture = $req->defaultPicture;
        }
        $update->save();

        //Update Login Table
        $updateLogin = [
            'email' => $email,
            'phone' => $phone
        ];
        DB::table('logins')
            ->where('empId', '=', $id)
            ->update($updateLogin);

        return redirect()->route('Reception.editProfile',$id)->with('msg', 'Successfully Updated');
    }

    //Settings
    public function settings(){
        $username = session('username');
        $password = session('password');
        $userInformation = DB::table('logins')
                        ->join('employees', 'employees.email', '=', 'logins.email')
                        ->where('logins.username', '=', $username)
                        ->where('logins.password', '=', $password)
                        ->get();

        return view('Reception.Settings',['userInformation' => $userInformation]);
    }

    //Check Current Password
    public function checkCurrentPassword(Request $req){
        if($req->ajax()){
            $message;
            $currentPassword = Login::where('email', '=', $req->get('email'))
                                    ->where('password', '=', $req->get('currentPassword'))
                                    ->get();
            $total_row = $currentPassword->count();
            if($total_row > 0){
                $message = 'OK';
            }
            else{
                $message = 'No Match';
            }

            return response()->json($message);
        }
    }

    //Change Password
    public function changePassword(Request $req){
        if($req->ajax()){
            $updateUsernamePassword = [
                'username' => $req->get('username'),
                'password' => $req->get('newPassword'),
                'passwordType' => 'Permanent'
            ];

            DB::table('logins')
                ->where('email' ,'=', $req->get('email'))
                ->update($updateUsernamePassword);
            return redirect()->route('Login.index');
        }
    }
}
