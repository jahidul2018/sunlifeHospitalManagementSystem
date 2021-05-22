<?php
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/Home','HomeController@index')->name('Home.index');
Route::get('/Department','HomeController@department')->name('Home.department');

//Login Page Route
Route::get('/Login','LoginController@index')->name('Login.index');
Route::post('/Login','LoginController@verifyUser')->name('Login.verifyUser');
//Logout Route
Route::get('/Logout','LogoutController@index')->name('Logout.index');


//Admin Page Route
Route::get('/admin','AdminController@index')->name('Admin.index');


// Route::group(['middleware'=>['sass']], function(){
    //HR Page Route
    Route::get('/HR', 'HRController@index')->name('HR.index'); //Dashbord
    Route::get('/HR/Reporting', 'HRController@reporting')->name('HR.reporting'); //Reporting
    Route::get('/HR/Chart', 'HRController@chart')->name('HR.chart');

    //View HR Profile
    Route::get('/HR/HRProfile/{id}', 'HRController@viewHRProfile')->name('HR.HRProfile');
    //View Receptionist Profile
    Route::get('/HR/ReceptionProfile/{id}', 'HRController@viewReceptionProfile')->name('HR.ReceptionProfile');
    Route::get('/HR/EditReception/{id}', 'HRController@editReception')->name('HR.editReception');
    Route::post('/HR/EditReception/{id}', 'HRController@updateReception')->name('HR.updateReception');


    //Insert Doctor
    Route::get('/HR/AddDoctor', 'HRController@addDoctor')->name('HR.addDoctor');
    Route::post('/HR/AddDoctor', 'HRController@insertDoctor')->name('HR.insertDoctor');

    //Insert Employees
    Route::get('/HR/AddEmployee', 'HRController@addEmployee')->name('HR.addEmployee');
    Route::post('/HR/AddEmployee', 'HRController@insertEmployee')->name('HR.insertEmployee');

    //Notice Section
    Route::get('/HR/Notice', 'HRController@notice')->name('HR.notice');
    Route::post('/HR/Notice', 'HRController@postNotice')->name('HR.notice');
    Route::get('/HR/AllNotices', 'HRController@allNotices')->name('HR.allNotices');
    //Edit Notice
    Route::get('/HR/EditNotice/{id}', 'HRController@editNotice')->name('HR.editNotice');
    Route::post('/HR/EditNotice/{id}', 'HRController@updateNotice')->name('HR.updateNotice');



    Route::get('/HR/DoctorList', 'HRController@doctorList')->name('HR.doctorList');
    Route::get('/HR/HRList', 'HRController@hrList')->name('HR.hrList');
    Route::get('/HR/ManagerList', 'HRController@managerList')->name('HR.managerList');
    Route::get('/HR/ReceiptionistList', 'HRController@receiptionistList')->name('HR.receiptionistList');

    Route::get('/HR/DoctorProfile/{DoctorId}', 'HRController@doctorProfile')->name('HR.doctorProfile');
    Route::get('/HR/EditDoctor/{DoctorId}', 'HRController@editDoctor')->name('HR.editDoctor');
    Route::post('/HR/EditDoctor/{DoctorId}', 'HRController@updateDoctor')->name('HR.updateDoctor');

    //Upload Doctor Profile Picture
    Route::post('/HR/ProfilePicture', 'HRController@profilePicture')->name('HR.profilePicture');
    //Search Doctor
    Route::get('/HR/SearchDoctor', 'HRController@searchDoctor')->name('HR.searchDoctor');

    Route::get('/HR/Timing', 'HRController@timing')->name('HR.timing');

    //New Hospital Test Add
    Route::get('/HR/NewTest', 'HRController@newTest')->name('HR.newTest');
    Route::post('/HR/NewTest', 'HRController@insertTest')->name('HR.insertTest');

    //View Test List 
    Route::get('/HR/TestList', 'HRController@testList')->name('HR.testList');
    //Search Test List on HR Department
    Route::get('/HR/action', 'HRController@action')->name('HR.searchTest');

    //Edit Hospital Test
    Route::get('/HR/EditTest/{id}', 'HRController@editTest')->name('HR.editTest');
    Route::post('/HR/EditTest/{id}', 'HRController@updateTest')->name('HR.updateTest');

    //Delete Test
    Route::get('/HR/DeleteTest/{id}', 'HRController@deleteTest')->name('HR.deleteTest');
    Route::get('/HR/RemoveTest/{id}', 'HRController@removeTest')->name('HR.removeTest');

    //Hospital Department
    Route::get('/HR/AddDepartment', 'HRController@addDepartment')->name('HR.addDepartment');
    Route::post('/HR/AddDepartment', 'HRController@insertDept')->name('HR.insertDept');
    //Update Departments updateDepartment
    Route::get('/HR/UpdateDepartments/{id}', 'HRController@updateDepartment')->name('HR.updateDepartment');
    Route::post('/HR/UpdateDepartments/{id}', 'HRController@updateDepartmentInfo')->name('HR.updateDepartment');

    //Temp Authentication List
    Route::get('/HR/TempAuthVerification', 'HRController@tempAuthVerification')->name('HR.tempAuthVerification');
    Route::post('/HR/TempAuthVerification', 'HRController@userAuthVerify')->name('HR.userAuthVerify');
    
    Route::get('/HR/TempAuth', 'HRController@tempAuth')->name('HR.tempAuth');

    Route::get('/HR/SetTime/{DoctorId}', 'HRController@search')->name('HR.search');
    Route::post('/HR/SetTime/{DoctorId}', 'HRController@schedule')->name('HR.schedule');

    //Income Report
    Route::get('/HR/IncomeReport', 'HRController@incomeReport')->name('HR.incomeReport');

// });

//Receptionist Route
Route::group(['middleware'=>['sass']], function(){
    Route::get('/ReceptionIndex', 'ReceptionController@index')->name('Reception.index');


    Route::get('/Appointment', 'ReceptionController@appointment')->name('Reception.appointment');
    Route::get('/action', 'ReceptionController@action')->name('Reception.action');
    Route::get('/doctorDate', 'ReceptionController@doctorDate')->name('Reception.doctorDate');

    //set Patient Appointment
    Route::get('/setAppointment', 'ReceptionController@setAppointment')->name('Reception.setAppointment');


    //Patient Registration
    Route::get('/Registration', 'ReceptionController@registration')->name('Reception.registration');
    //Insert New Patient
    Route::post('/Registration', 'ReceptionController@insertPatient')->name('Reception.insertPatient');

    //Patient AppointmentList
    Route::get('/AppointmentList', 'ReceptionController@appointmentList')->name('Reception.appointmentList');

    Route::get('/searchAppointment', 'ReceptionController@searchAppointment')->name('Reception.searchAppointment');

    //See Doctors Schedule
    Route::get('/DoctorSchedule', 'ReceptionController@doctorSchedule')->name('Reception.doctorSchedule');
    Route::get('/DoctorScheduleDetails/{DrId}', 'ReceptionController@doctorScheduleDetails')->name('Reception.doctorScheduleDetails');
    Route::get('/SearchDoctorTime', 'ReceptionController@searchDoctorTime')->name('Reception.searchDoctorTime');

    //get Patient Data from PID
    Route::get('/PatientInfo', 'ReceptionController@patientInfo')->name('Reception.patientInfo');


    //Print Appointment Page as Blank Prescription
    Route::get('/EmptyPrecription/{patientId}', 'ReceptionController@emptyPrecription')->name('Reception.emptyPrecription');

    //Get Registered PatientInfo from Patient ID
    Route::get('/PatientData', 'ReceptionController@patientData')->name('Reception.patientData');

    //Get TestInfo from TestCode
    Route::get('/TestInfo', 'ReceptionController@testInfo')->name('Reception.testInfo');

    //Remove Test
    Route::get('/removeTest', 'ReceptionController@removeTest')->name('Reception.removeTest');
    Route::get('/TempTest', 'ReceptionController@tempTestList')->name('Reception.tempTestList');

    //Delete All Data from TempTest List
    Route::get('/DeleteTempTest', 'ReceptionController@deleteTempData')->name('Reception.deleteTempData');

    //Patient Invoice Section
    Route::get('/CreateInvoice', 'ReceptionController@createInvoice')->name('Reception.createInvoice');
    Route::get('/InvoiceDetails', 'ReceptionController@invoiceDetails')->name('Reception.invoiceDetails');
    //Print Invoice 
    Route::get('/PrintInvoice/{invoiceNo}', 'ReceptionController@printInvoice')->name('Reception.printInvoice');


    //Report Delivery
    Route::get('/ReportDelivey', 'ReceptionController@reportDelivery')->name('Reception.reportDelivery');


    //Report Delivery Section
    Route::get('/ReportDeliveyInfo', 'ReceptionController@reportDeliveryInfo')->name('Reception.reportDeliveryInfo');

    //Report Delivery And Update Invoice_Masters Table
    Route::get('/UpdateInvoice', 'ReceptionController@updateInvoice')->name('Reception.updateInvoice');

    //View Full Notice
    Route::get('/Notice/{id}', 'ReceptionController@viewNotice')->name('Reception.viewNotice');

    //All Notification
    Route::get('/AllNotification', 'ReceptionController@allNotification')->name('Reception.allNotification');

    //Receptionist Profile
    Route::get('/MyProfile', 'ReceptionController@myProfile')->name('Reception.myProfile');
    //Edit MyProfile
    Route::get('/EditProfile/{id}', 'ReceptionController@editProfile')->name('Reception.editProfile');
    Route::post('/EditProfile/{id}', 'ReceptionController@editInformations')->name('Reception.update');

    //Settings
    Route::get('/Settings', 'ReceptionController@settings')->name('Reception.settings');
    //Check Current Password
    Route::get('/CheckCurrentPassword', 'ReceptionController@checkCurrentPassword')->name('Reception.checkCurrentPassword');
    //Update Password
    Route::get('/ChangePassword', 'ReceptionController@changePassword')->name('Reception.changePassword');

});


//Doctor Route;
Route::group(['middleware'=>['sass']], function(){
    Route::get('/DoctorIndex', 'DoctorController@index')->name('Doctor.index');
    //Setting
    Route::get('/DoctorSettings', 'DoctorController@settings')->name('Doctor.settings');
    //Profile
    Route::get('/DoctorProfile', 'DoctorController@myProfile')->name('Doctor.myProfile');
    //Edit
    Route::get('/EditDoctorProfile/{DoctorId}', 'DoctorController@editProfile')->name('Doctor.editProfile');
    Route::post('/EditDoctorProfile/{DoctorId}', 'DoctorController@editInformations')->name('Doctor.update');
    //Appointment List
    Route::get('/DoctorAppointmentList', 'DoctorController@appointmentList')->name('Doctor.appointmentList');
    Route::get('/searchMyAppointment', 'ReceptionController@searchAppointment')->name('Doctor.searchAppointment');

    //Check Current Password
    Route::get('/DoctorCheckCurrentPassword', 'DoctorController@checkCurrentPassword')->name('Doctor.checkCurrentPassword');
    //Update Password
    Route::get('/DoctorChangePassword', 'DoctorController@changePassword')->name('Doctor.changePassword');
    //Cancel My Appointment
    Route::get('/CancelAppointment', 'DoctorController@cancelAppointment')->name('Doctor.cancelAppointment');
    Route::get('/Cancel', 'DoctorController@cancel')->name('Doctor.getCancel');
    Route::get('/Cancel/Appointment/{patientId}', 'DoctorController@cancelpatient');
    Route::get('/RemoveAppointment/{patientId}', 'DoctorController@removeApnt')->name('Doctor.removeAppnt');
});


// Day Testing Routing
Route::get('/day', function(){
    // $date = '2020-04-19';
    // $d = new DateTime($date);
    // echo $d->format('l');

    $dt = new Carbon();
    $dt->timezone('Asia/Dhaka');
    // $dt->toDayDateTimeString();
    $dt->toFormattedDateString();
    echo $dt;
    // $year =  $dt->year;
    // $month = $dt->month;
    // $day = $dt->day;
    // $sec = $dt->second;
    // $milisec = $dt->millisecond;
    // if($month < 10){
    //     $month = '0'.$month;
    // }
    // if($day < 10){
    //     $day = '0'.$day;
    // }
    // echo $day;
    // echo '<br>';
    // echo $month;
    // echo '<br>';
    // echo $year;
    // echo '<br>';
    // echo $sec;
    // echo '<br>';
    // echo $milisec;
    // echo '<br>';
    // $invoice = $year.$month.$day;
    // echo $invoice;


    // for($i=0; $i<30;$i++){
    //     $invoice++;
    //     echo $invoice.'<br>';
    // }
});