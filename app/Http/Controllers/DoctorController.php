<?php
namespace App\Http\Controllers;
use App\Doctor;
use App\Login;
use App\PatientAppointment;
use App\PatientlistMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index(){
        $visitingFee;
        $totalPatient;
        $totalIncome;
        $drName;
        $username = session('username');
        $password = session('password');
        $userInformation = DB::table('logins')
                        ->join('doctors', 'doctors.email', '=', 'logins.email')
                        ->where('logins.username', '=', $username)
                        ->where('logins.password', '=', $password)
                        ->select('doctors.VisitingFee','doctors.Name')
                        ->get();
        foreach($userInformation as $user){
            $visitingFee = $user->VisitingFee;
            $drName = $user->Name;
        }

        $dt = new Carbon();
        $dt->timezone('Asia/Dhaka');
        $year =  $dt->year;
        $month = $dt->month;
        $day = $dt->day;
        if($day < 10){
            $day = '0'.$day;
        }
        if($month < 10){
            $month = '0'.$month;
        }
        $today = $year.'-'.$month.'-'.$day;
        
        $todaysTotalPatient = PatientAppointment::where('drName', '=', $drName)
                                                ->where('appointmentDate', '=', $today)
                                                ->get();
        
        return view('Doctor.Index');
    }

    //Profile 
    public function myProfile()
    {
        $username = session('username');
        $password = session('password');
        $userInformation = DB::table('logins')
                        ->join('doctors', 'doctors.email', '=', 'logins.email')
                        ->where('logins.username', '=', $username)
                        ->where('logins.password', '=', $password)
                        ->get();
        return view('Doctor.MyProfile',['userInformation' => $userInformation]);
    }

    public function editProfile($DoctorId){
        $editUser = Doctor::find($DoctorId);
        error_log($editUser);
        return view('Doctor.EditProfile',$editUser);
    }

    public function editInformations($DoctorId, Request $req){
        $this->validate($req,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'address' => 'required'
        ]);

        $email = $req->email;
        $phone = $req->phone;
        $name = $req->name;
        $empId = $req->empId;

        $update = Doctor::find($DoctorId);
        $update->Name = $name;
        $update->Email = $email;
        $update->Phone = $phone;
        $update->DOB = $req->dob;
        $update->VisitingFee = $req->visitingFee;
        $update->Address = $req->address;

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
            ->where('empId', '=', $empId)
            ->update($updateLogin);

        return redirect()->route('Doctor.editProfile',$DoctorId)->with('msg', 'Successfully Updated');
    }
    //Appointment List
    public function appointmentList(){
        $drName;
        $username = session('username');
        $password = session('password');
        $userInformation = DB::table('logins')
                        ->join('doctors', 'doctors.email', '=', 'logins.email')
                        ->where('logins.username', '=', $username)
                        ->where('logins.password', '=', $password)
                        ->select('doctors.Name', 'doctors.DoctorId')
                        ->get();
        foreach($userInformation as $user){
            $drName = $user->Name;
        }
        //Get All Patient List
        $myPatientList = PatientAppointment::where('drName', '=', $drName)->get();
        return view('Doctor.AppointmentList',['myPatientList' => $myPatientList]);
    }

    public function searchAppointment(Request $req){
            // $drName;
            // $username = session('username');
            // $password = session('password');
            // $userInformation = DB::table('logins')
            //             ->join('doctors', 'doctors.email', '=', 'logins.email')
            //             ->where('logins.username', '=', $username)
            //             ->where('logins.password', '=', $password)
            //             ->select('doctors.Name', 'doctors.DoctorId')
            //             ->get();
            // foreach($userInformation as $user){
            //     $drName = $user->Name;
            // }
        if($req->ajax()){
            $query = $req->get('query');
            error_log('Date ====== '.$query);
            $patientAppnt = '';
            $result = '';
            if($query != ''){
                error_log('Go to If Block');
                $patientAppnt = PatientAppointment::where('patientId', 'like', '%'. $query .'%')
                                            ->orWhere('patientName', 'like', '%'. $query .'%')
                                            ->orWhere('pContact', 'like', '%'. $query .'%')
                                            ->orWhere('appointmentDate ', 'like', '%'.$query .'%')
                                            ->get();
            }
            else{
                error_log('Go to Else Block');
                $patientAppnt = PatientAppointment::where('drName', '=', $drName)->get();
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


    //Settings
    public function settings(){
        $username = session('username');
        $password = session('password');
        $userInformation = DB::table('logins')
                        ->join('doctors', 'doctors.email', '=', 'logins.email')
                        ->where('logins.username', '=', $username)
                        ->where('logins.password', '=', $password)
                        ->get();

        return view('Doctor.Settings',['userInformation' => $userInformation]);
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
            error_log('Password Changed');
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

    //Cancel Appointment
    public function cancelAppointment(){
        return view('Doctor.CancelAppointment');
    }

    public function cancel(Request $req){
        if($req->ajax()){
            $date = $req->get('date');
            $list = PatientAppointment::where('appointmentDate', '=', $date)->get();
            return response()->json($list);
        }
    }

    public function cancelpatient($patientId){
        $patient = PatientAppointment::where('patientId', '=', $patientId)->get();
        return view('Doctor.Cancelpatient',['patient'=>$patient]);
    }

    public function removeApnt($patientId){
        DB::table('patient_appointments')
            ->where('patientId', '=', $patientId)
            ->delete();
        return redirect()->route('Doctor.cancelAppointment')->with('msg', 'Successfully Deleted');
    }
}
