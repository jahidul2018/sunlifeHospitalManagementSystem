<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Employee;
use App\AppointmentTime;
use App\AppointmentTimeMaster;
use App\HospitalTest;
use App\HospitalDepartment;
use App\InvoiceMaster;
use App\Login;
use App\Notice;
use App\Notification;
use Carbon\Carbon;
use DB;
use PhpParser\Comment\Doc;
use SebastianBergmann\Environment\Console;

class HRController extends Controller
{
    public function index(){
        return view('HR.index');
    }

    public function chart(){
        return view('HR.charts');
    }

    //********************************************************* */
    //********************Reporting Module******************* */
    //********************************************************* */

    public function reporting(){
        return view('HR.Reporting');
    }

    public function incomeReport(){
        $incomeReports = InvoiceMaster::all();

        return view('HR.Reporting',compact('report'));
    }


    //********************************************************* */
    //********************End Reporting Module******************* */
    //********************************************************* */


    //********************************************************* */
    //********************Start Doctor Module******************* */
    //********************************************************* */


    public function addDoctor(){
        $empId = Doctor::max('empId'); //EmpId is For Matching This Doctor Data into Logins Table Data
        $nextId;
        if($empId == null){
            $nextId = 30001;
        }
        else{
            $nextId = $empId+1;
        }
        return view('HR.AddDoctor',['empId'=>$nextId]);
    }

   
    //Insert New Doctor
    public function insertDoctor(Request $req){
        $this->validate($req,[
            'name'       => 'required',
            'dob'        => 'required',
            'gender'     => 'required',
            'phone'      => 'required|max:12|min:11|unique:doctors|unique:logins',
            'email'      => 'required|email|unique:doctors|unique:logins',
            'department' => 'required',
            'specialist' => 'required',
            'visitingFee'=> 'required',
            'department' => 'required',
            'comission'  => 'required',
            'closingDay' => 'required',
        ]);
        $name = $req->name;
        $phone = $req->phone;
        $email  = $req->email;

        // dd($name);
        //Insert Data into Doctors DB Table
        $doctor = new Doctor;
        $doctor->empId      =$req->empId;
        $doctor->Name       = $name;
        $doctor->DOB        = $req->dob;
        $doctor->Gender     = $req->gender;
        $doctor->Phone      = $phone;
        $doctor->Emergency  = $req->emergency;
        $doctor->Email      = $email;
        $doctor->Address    = $req->address;
        $doctor->Department = $req->department;
        $doctor->Specialist = $req->specialist; 
        $doctor->VisitingFee = $req->visitingFee;
        $doctor->Commission  = $req->comission;
        $doctor->ClosingDay  = $req->closingDay;

        // Insert Profile Picture
        if($req->hasFile('profile')){
			$file = $req->file('profile');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            
            $file->move('uploads/',$filename);
            $doctor->ProfilePicture = $filename;

		}else{
            $doctor->ProfilePicture = null;
        }
        
        //Insert Doctor Login Information in LoginInfo Table;

        //Genarate Auto Password from Current Time;
        $time = new Carbon();
        $time->timezone('Asia/Dhaka');
        $second = $time->second;//get second;
        $millisecond = $time->millisecond;//get Millisecond
        $password = $name.'-'.$second.$millisecond;

        $login = new Login();

        $login->empId = $req->empId;
        $login->email = $email;
        $login->phone = $phone;
        $login->username = $phone;
        $login->password = $password;
        $login->passwordtype = 'Temporary';
        $login->type = 'Doctor';
        $login->status = 'Active';

        $login->save(); //Save Data into Logins Table
        $doctor->save(); //Save Data into Doctors Table

        //get login data to show one time username & password;
        $temporaryUsernamepassword = Login::where('phone', '=', $phone)
                                        ->orWhere('email', '=', $email)
                                        ->select('username','password')
                                        ->get();
        // error_log($temporaryUsernamepassword);
        return redirect()->route('HR.addDoctor')
                        ->with('msg',$temporaryUsernamepassword);
    }


    //View All Doctor List from Doctors Table
    public function doctorList(){
        $doctorList = Doctor::paginate(10);
        // $doctorList = Doctor::select('DoctorId','Name','Phone','Department','Specialist')->get();
        return view('HR.DoctorList',['doctors' => $doctorList]);
    }

    //View Doctor Profile
    public function doctorProfile($DoctorId){
        $doctor = Doctor::find($DoctorId);
        return view('HR.DoctorProfile',$doctor);
    }

    //Edt Doctor Profile
    public function editDoctor($DoctorId){
        $doctor = Doctor::find($DoctorId);
        return view('HR.EditDoctor',$doctor);
    }

    //Update Doctor
    public function updateDoctor($DoctorId, Request $req){
        $doctor = Doctor::find($DoctorId);

        $this->validate($req,[
            'name'       => 'required',
            'dob'        => 'required',
            'gender'     => 'required',
            'phone'      => 'required|max:12|min:11',
            'email'      => 'required|email',
            'department' => 'required',
            'specialist' => 'required',
            'visitingFee'=> 'required',
            'department' => 'required',
            'comission'  => 'required',
            'closingDay' => 'required',
        ]);

        $doctor->Name       = $req->name;
        $doctor->DOB        = $req->dob;
        $doctor->Gender     = $req->gender;
        $doctor->Phone      = $req->phone;
        $doctor->Emergency  = $req->emergency;
        $doctor->Email      = $req->email;
        $doctor->Address    = $req->address;
        $doctor->Department = $req->department;
        $doctor->Specialist = $req->specialist; 
        $doctor->VisitingFee = $req->visitingFee;
        $doctor->Commission  = $req->comission;
        $doctor->ClosingDay  = $req->closingDay;

        $doctor->save();

        return redirect()->route('HR.editDoctor',$DoctorId)
                        ->with('msg','Doctor Successfully Updated');
    }



    //Doctor Appointment Timing Scedule Function
    public function schedule($DoctorId, Request $req){
        
        $DoctorId  = $req->dId; //Get Doctor Id
        $Name = $req->name; //Get Doctor Name
        $shift = $req->shift; //Get Shift
        $Day = $req->selectDay; //get Day
        $startingTime = $req->startingTime;
        $duration = $req->duration;
        $endTime = $req->endTime;
        $presetTime = $req->presetTime;

        $NOP = $duration / $presetTime; //Get Total Number of Patient

        $starts = $startingTime;
        $startingHour = str_split($starts,2);
        $startingMin = str_split($starts,3);
        
        $ends = $endTime;

        $endingHour = str_split($ends,2);
        $endingMin = str_split($ends,3);
        
        $st = $startingHour[0];
        $et = $endingHour[0];

        $sm = $startingMin[1];
        $em = $endingMin[1];

        $finishHour; //Extra Variable Taken for Hour Counting
        $finishMin;  //Extra Variable taken for Minute Counting
        $amPm;  //Extra Variable Taken for Set AM or PM 
        $Timing; //Final Timing
        if($shift == "Evening"){
            $amPm = "PM";
        }
        else{
            $amPm = "AM";
        }

        //Get Total Time Duration
        if($st > 12){
            $st = $st-12;
            $totalDuration = $st.":".$sm." ".$amPm." - ".$et.":".$em." ".$amPm;

        }
        else{
            $totalDuration = $st.":".$sm." ".$amPm." - ".$et.":".$em." ".$amPm;
        }

        //Data Insert into AppointmentTimeMaster Table
        $AppTimeMaster = new AppointmentTimeMaster;

        $AppTimeMaster->DrId = $DoctorId;
        $AppTimeMaster->DrName = $Name;
        $AppTimeMaster->Shift = $shift;
        $AppTimeMaster->TimeDuration = $totalDuration;
        $AppTimeMaster->DayName = $Day;
        $AppTimeMaster->save();


        for($i = 0; $i< $NOP ; $i++){
            
            $finishHour = $st;
            $finishMin = $sm + $presetTime;

            if($finishHour > 12){
                $finishHour = $finishHour - 12;
            }
            
            //Check AM or PM on Globally;
            if($finishHour > 11){
                $amPm = "PM";
            }
            // if($finishMin == 60){
            if($finishMin >= 60){
            

                $finishHour = $st+1;
                $finishMin = 0;
                $Timing = $st.":".$sm." ".$amPm." - ".$finishHour.":".$finishMin."0"." ".$amPm;
                

                $AppTime = new AppointmentTime;

                $AppTime->DrId = $DoctorId;
                $AppTime->DrName = $Name;
                $AppTime->DayName = $Day;
                $AppTime->TimeSchedule = $Timing;
                $AppTime->Shift = $shift;
                $AppTime->TotalDuration = $totalDuration;
                $AppTime->save(); 
                echo "<br>";
            }
            else{
                
                $Timing = $finishHour.":".$sm." ".$amPm." - ".$finishHour.":".$finishMin." ".$amPm;
                
                $AppTime = new AppointmentTime;

                $AppTime->DrId = $DoctorId;
                $AppTime->DrName = $Name;
                $AppTime->DayName = $Day;
                $AppTime->TimeSchedule = $Timing;
                $AppTime->Shift = $shift;
                $AppTime->TotalDuration = $totalDuration;
                $AppTime->save();
                echo "<br>";
            }
                
            $st = $finishHour;
            $sm = $finishMin;
        }

        $AppTime->save();
        return redirect()->route('HR.search',$DoctorId);
        
    }


    //Doctor Appointment Timing

    public function timing(){
        return view('HR.DoctorTiming');
    }

    public function search($DoctorId){
        $doctor = Doctor::find($DoctorId);

        //getTime List
        $timeList = AppointmentTime::where('DrId', $DoctorId)->paginate(6);
        $timeDuration = AppointmentTimeMaster::where('DrId',$DoctorId)->paginate(8);
        
        return view('HR.DoctorTiming',['doctor'=> $doctor, 'timeList'=> $timeList, 'timeDuration'=>$timeDuration]);
    }

    //Search Docotr
    public function searchDoctor(Request $req){
        if($req->ajax()){
            $query = $req->get('query');
            error_log('Name : '.$query);
            error_log('Function Called');
            $doctorData;
            $doctorInfo = Doctor::where('Name','like','%'.$query.'%')
                                ->orWhere('Phone', 'like', '%'.$query.'%')
                                ->orWhere('Department','like','%'.$query.'%')
                                ->get();
            $total_row = $doctorInfo->count();
            if($total_row > 0){
                $doctorData = $doctorInfo;
            }
            else{
                $doctorData = 'No Record Found';
            }

            return response()->json($doctorData);
        }
    }



    ####################################################################
    /* **********************End Doctor Module ************************/
    ####################################################################



    ####################################################################
    /* **********************Start Employee Module ********************/
    ####################################################################

    
    // View Add Employee Page
    public function addEmployee(){
        $empId;
        $id = Employee::max('id');
        $empId = $id+1;
        error_log($empId);
        return view('HR.AddEmployee',['empId' => $empId]);
    }

    //Insert New Employee
    public function insertEmployee(Request $req){
        //Form Validation
        $this->validate($req, [
            'name'        => 'required',
            'dob'         => 'required',
            'gender'      => 'required',
            'phone'       => 'required|max:11|min:11|unique:employees',
            'email'       => 'required|email|unique:employees',
            'designation' => 'required',
            'monthlyfee'  => 'required|max:10',
            'address'     => 'required',
        ]);

        //Insert Data in Employees Table
        $emp = new Employee();
        $emp->name        = $req->name;
        $emp->dob         = $req->dob;
        $emp->gender      = $req->gender;
        $emp->phone       = $req->phone;
        $emp->email       = $req->email;
        $emp->designation = $req->designation;
        $emp->monthlyfee  = $req->monthlyfee;
        $emp->address     = $req->address;
        $emp->status = 'Active';
        $emp->profilePicture = 'demoImg.png';

        $login = new Login();
        //Genarate Temp Password;
        $time = new Carbon();
        $time->timezone('Asia/Dhaka');
        $second = $time->second;
        $millisecond = $time->millisecond;
        $name = $req->name;
        $password = $name.'-'.$second.$millisecond;

        $login->empId = $req->empId;
        $login->email = $req->email;
        $login->phone = $req->phone;
        $login->username = $req->name;
        $login->password = $password;
        $login->type = $req->designation;
        $login->passwordType = 'Temporary';
        $login->status = 'Active';

        $login->save();
        $emp->save();
        
        $designation = $req->designation;
        if($designation == "HR"){
            return redirect()->route('HR.hrList')
                        ->with('msg', 'Employee Successfully Added');
        }

        if ($designation == "Manager") {
            
        }

        if ($designation == "Receiptionist") {
            return redirect()->route('HR.receiptionistList')
                        ->with('msg', 'Receiptionist ['.$req->name.'] Successfully Added');
        }

    }

    
    /****************************HR Dept Employee Module ******************************************/

    //Get All HR Employee Lists
    public function hrList(){
        $hr = Employee::where('designation', 'HR')->paginate(10);
        return view('HR.HRList',['hr' => $hr]);
    }

    //View HR Employee Profile
    public function viewHRProfile($id){
        $hrProfile = Employee::find($id);
        return view('HR.HRProfile',['hrProfile' => $hrProfile]);
    }


    /*******************************End HR Dept Employee Module ***********************************/
    

    /******************************Receptionist Employee Module *********************************/
    
    //View Receptionist List Page
    public function receiptionistList(){
        $reception = Employee::where('designation' , 'Receiptionist')->paginate(10);
        return view('HR.ReceiptionistList',['reception' => $reception]);
    }

    //View Receptionist Employee Profile
    public function viewReceptionProfile($id){
        $receptionProfile = Employee::find($id);
        return view('HR.ReceptionProfile',['receptionProfile' => $receptionProfile]);
    }

    public function editReception($id){
        $receptionProfile = Employee::find($id);
        return view('HR.EditReception', ['receptionProfile' => $receptionProfile]);
    }

    //Update Reception Data
    public function updateReception($id, Request $req){
        $reception = Employee::find($id);

        $reception->name        = $req->name;
        $reception->dob         = $req->dob;
        $reception->gender      = $req->gender;
        $reception->phone       = $req->phone;
        $reception->email       = $req->email;
        $reception->designation = $req->designation;
        $reception->monthlyfee  = $req->monthlyfee;
        $reception->address     = $req->address;
        $reception->status      = $req->status;
        
        $reception->save();
        return redirect()->route('HR.ReceptionProfile',$id);
    }

    
    /********************End Receptionist Employee Module *******************/
    

    ####################################################################
    /* **********************End Employee Module **********************/
    ####################################################################



    ####################################################################
    /* **********************Hospital Test Module **********************/
    ####################################################################


    //View New Hospital Test
    public function newTest(){
        return view('HR.AddTest');
    }

    //Insert New Test
    public function insertTest(Request $req){
        $this->validate($req, [
            'testName'      => 'required|unique:hospital_tests',
            'testShortName' => 'required|unique:hospital_tests',
            'testCost'      => 'required'
        ]);

        $test = new HospitalTest();
        
        $addingDate = new Carbon();
        $addingDate -> timezone('Asia/Dhaka');

        $test->addingDate = $addingDate;
        $test->testName = $req->testName;
        $test->testShortName = $req->testShortName;
        $test->testCost = $req->testCost;

        $test->save();
        return redirect()->route('HR.testList')->with('msg','Test Added Successfully Done !');
    }

    //View Test List Page
    public function testList(){
        return view('HR.TestList');
    }

    //Search Test
    function action(request $request){
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');
            if($query != ''){
                $data = DB::table('hospital_tests')
                        -> where('testName','like','%'. $query .'%')
                        ->orWhere('testShortName','like','%'.$query.'%')
                        ->orWhere('Id','like','%'.$query.'%')
                        ->get();
            }
            else{
                $data = DB::table('hospital_tests')->get();
            }
            $total_row = $data->count();
            if($total_row > 0){
                foreach($data as $row){
                    $output .= '
                        <tr>
                            <td>'.$row->id.'</td>
                            <td>'.$row->addingDate.'</td>
                            <td>'.$row->testName.'</td>
                            <td>'.$row->testShortName.'</td>
                            <td>'.$row->testCost.'</td>
                            <td>
                                <a href="/HR/EditTest/'.$row->id.'">
                                    <input type="submit" class="btn btn-info" value="Edit">
                                </a>

                                <a href="/HR/DeleteTest/'.$row->id.'">
                                <input type="submit" class="btn btn-danger" value="Delete" data-toggle="model" data-target="#logoutModel">
                                </a>
                            </td>
                        </tr>
                    ';
                }
            }
            else{
                $output = '
                    <tr>
                        <td align="center" colspan="5"> No Data Found  </td>
                    </tr>
                ';
            }

            $data = array(
                'table_data'    => $output
            );

            echo json_encode($data);
        }
    }


    //Edit Test List
    public function editTest($id){
        $testInfo = HospitalTest::find($id);
        return view('HR.EditTest',$testInfo);
    }

    //Update test 
    public function updateTest($id, Request $req){
        $this->validate($req, [
            'addingDate'    => 'required',
            'testName'      => 'required',
            'testShortName' => 'required',
            'testCost'      => 'required'
        ]);
        
        $testinfo = HospitalTest::find($id);
        $testInfo->testName         =   $req->testName;
        $testInfo->testShortName    =   $req->testShortName;
        $testInfo->testCost         =   $req->testCost;

        $testInfo->save();

        return redirect()->route('HR.testList')->with('msg', 'Test Successfully Updated');
    }

    //Delete Confirmation Message
    public function deleteTest($id){
        $test = HospitalTest::find($id);
        return view('HR.DeleteTest',$test);
    }

    public function removeTest($id){
        $test = HospitalTest::find($id);
        $test->delete();
        return redirect()->route('HR.testList')->with('msg', 'Test Successfully Deleted');
    }


    #########################################################################
    /* **********************End Hospital Test Module **********************/
    #########################################################################


    #########################################################################
    /* ***************************Notice Module ****************************/
    #########################################################################
    public function notice(){
        $date = date('Y-m-d H:i:s');
        return view('HR.Notice');
    }

    public function postNotice(Request $req){
        //Genarate Today Date and Time;
        $date = new Carbon();
        $date->timezone('Asia/Dhaka');
        $date->toDateTimeString();

        $notice = new Notice();
        $notice->date = $date;
        $notice->title = $req->title;
        $notice->body = $req->body;
        $notice->tagPeople = $req->tagPeople;
        //Store Additional File 
        if($req->hasFile('addtionalFile')){
			$file = $req->file('addtionalFile');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            $file->move('noticeFile/',$filename);
            $notice->additionalFile  = $filename;
		}else{
            $notice->additionalFile =  null;
        }
        $notice->save();
        return redirect()->route('HR.notice')->with('msg', 'Notice Successfully Posting Done!');
    }

    public function allNotices(){
        $allNoticeList = Notice::orderBy('id', 'desc')->paginate(10);
        return view('HR.AllNotices',['notices' => $allNoticeList]);
    }


    //Edit Notice
    public function editNotice($id){
        $noticeInformation = Notice::find($id);
        return view('HR.EditNotice',$noticeInformation);
    }

    public function updateNotice($id, Request $req){
        $updateNotice = Notice::find($id);
        $updateNotice->title = $req->title;
        $updateNotice->body = $req->body;
        $updateNotice->tagPeople = $req->tagPeople;
        //Update Files
        if($req->hasFile('addtionalFile')){
			$file = $req->file('addtionalFile');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            $file->move('noticeFile/',$filename);
            $updateNotice->additionalFile  = $filename;
		}else{
            $updateNotice->additionalFile =  $req->currentAdditonalFile;
        }
        $updateNotice->save();
        return redirect()->route('HR.allNotices');

    }

    #########################################################################
    /* ************************End Notice Module ****************************/
    #########################################################################


    #########################################################################
    /* ***********************Hospital Dept. Module *************************/
    #########################################################################
    public function addDepartment(){
        $dept = HospitalDepartment::all();
        return view('HR.AddDepartment',['dept' => $dept]);
    }

    //Insert Department
    public function insertDept(Request $req){
        $this->validate($req,[
            'deptCode' => 'required|unique:hospital_departments',
            'deptName' => 'required|unique:hospital_departments',
            'deptAddingDate' => 'required'
        ]);
        $dept = new HospitalDepartment();
        $dept->deptCode = $req->deptCode;
        $dept->deptName = $req->deptName;
        $dept->deptAddingDate = $req->deptAddingDate;
        $dept->save();

        return redirect()->route('HR.addDepartment');
    }

    //Update Hospital Departments
    public function updateDepartment($id){
        $departmentInfo = HospitalDepartment::find($id);
        return view('HR.UpdateDepartment',$departmentInfo);
    }

    public function updateDepartmentInfo($id,Request $req){
        $this->validate($req,[
            'deptCode' => 'required|unique:hospital_departments',
            'deptName' => 'required|unique:hospital_departments'
        ]);

        $deptInfo = HospitalDepartment::find($id);
        $deptInfo->deptCode = $req->deptCode;
        $deptInfo->deptName = $req->deptName;
        $deptInfo->save();

        return redirect()->route('HR.addDepartment')->with('msg', 'Department Information Successfully Updated');
    }

    #########################################################################
    /* *********************End Hospital Dept. Module ***********************/
    #########################################################################
    
    //Manager List
    public function managerList(){
        return view('HR.ManagerList');
    }

     #########################################################################
    /* ***********************Dashbord Module****** *************************/
    #########################################################################

    public function getTotalDepartment(){
        $dept = HospitalDepartment::all();
        $totalDept = $dept->count();
        error_log('Total Dept : '.$totalDept);
        return view('HR.index',$totalDept);
    }

     #########################################################################
    /* ***********************End Dashbord  Module *************************/
    #########################################################################

    //Temporary Authentication 
    public function tempAuthVerification(){
        return view('HR.VerifyAuth');
    }

    public function userAuthVerify(Request $req){
        $this->validate($req,[
            'email' => 'required',
            'password' => 'required'
        ]);
        $email;
        $password;

        $username = session('username');
        $password = session('password');
        $userInformation = DB::table('logins')
                        ->join('employees', 'employees.email', '=', 'logins.email')
                        ->where('logins.username', '=', $username)
                        ->where('logins.password', '=', $password)
                        ->select('logins.email','logins.password')
                        ->get();
        foreach($userInformation as $user){
            $email = $user->email;
            $password = $user->password;
        }

        if($email == $req->email && $password == $req->password){
            return redirect()->route('HR.tempAuth');
        }
        else{
            return redirect()->route('HR.tempAuthVerification')->with('msg', 'Your are not Authorized!');
        }
    }
    public function tempAuth(){
        $tempAuthList = Login::where('passwordType', '=', 'Temporary')->get();
        return view('HR.TempAuthentication',['tempAuth' => $tempAuthList]);
    }
}