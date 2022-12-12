<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminLogController extends Controller
{
    public function login(Request $request){
       $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:15',
       ],[
           'email.exists' => 'This email does not exist',
       ]);

       $creds = $request->only('email','password');

       if(Auth::guard('admin')->attempt($creds)){
           return redirect()->route('dashboard.index');
       }else{
           return redirect()->route('adminLogin')->with('loginFail','Failed to login');
       }


    }



    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('adminLogin');
    }
}
