<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Login;

class LoginController extends Controller
{
    public function index(){
        return view('Login.index');
    }

    public function verifyUser(Request $req){
        $username =  $req->username;
        $password =  $req->password;

        //Null Validation

        $this->validate($req,[
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = Login::where('username', '=', $username)
                    ->where('password', '=', $password)
                    ->first();
        
        if($user != null){
            if($user['type'] == 'Doctor'){
                $req->session()->put('username', $username);
                $req->session()->put('password', $password);
                return redirect()->route('Doctor.index');
            }
            if($user['type'] == 'Receiptionist'){
                $req->session()->put('username', $username);
                $req->session()->put('password', $password);
                return redirect()->route('Reception.index');
            }
            if($user['type'] == 'Admin'){
                $req->session()->put('username', $username);
                $req->session()->put('password', $password);
                return redirect()->route('HR.index');
            }
        }
        else{
            return redirect()->route('Login.index')->with('msg', 'Invalid Username or Password');
        }
        
    }
}
