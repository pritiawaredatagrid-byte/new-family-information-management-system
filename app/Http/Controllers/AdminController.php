<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin;
use \Crypt;
use Mail;
use App\Mail\AdminForgotPassword;

use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    function login(Request $request){
        
        $validation = $request->validate([
            'email' => 'required|email|unique:admin,email',
            'password' => 'required',
        ]);

        $admin = Admin::where([
            ['email',"=", $request->email],
            ['password',"=", $request->password],
        ])->first();

        if(!$admin){
             $validation = $request->validate([
            'user' => 'required',
        ],[
            'user.required' => 'User does not exist',
        ]);
        }
        Session::put('admin',$admin);
        return redirect('dashboard');
    }

    function AdminForgetPassword(Request $request){
      $link = Crypt::encryptString($request->email);
      $link = url('/admin-forget-password/'.$link);
      Mail::to($request->email)->send(new AdminForgotPassword($link));
      return redirect('/');
    }

    function AdminResetForgetPassword($email){
    $argEmail = Crypt::decryptString($email);
    return view('admin-set-forget-password',['email'=>$argEmail]);
    }

    function AdminSetForgetPassword(Request $request){
    $validate=$request->validate(
    [
        'email'=>'required|email',
        'password'=>'required|min:3|confirmed'
    ]
    );
    $admin = Admin::where('email', $request->email)->first();
    if($admin){
      $admin->password = $request->password;
      if($admin->save()){
         return redirect('admin-login');
      }
    }
    }


    function dashboard(){
        $admin =  Session::get('admin');
        if($admin){
            return view('/Auth/Admin-login/admin',["name"=>$admin->name]);
        }else{
           return redirect('/admin-login'); 
        }
        return view('admin',$admin);
    }

}
