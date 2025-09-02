<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\UserRegistration;


class UserController extends Controller
{
   function userRegistration(Request $request){
    $validation = $request->validate([
     'name'=>'required',
     'surname'=>'required',
     'birthdate'=>'required',
     'mobile_number'=>'required',
     'address'=>'required',
     'state'=>'required',
     'city'=>'required',
     'pincode'=>'required',
     'marital-status'=>'required',
     'hobby'=>'required',
     'photo'=>'required'
    ]);
       $user = UserRegistration::where([
            ['name',"=", $request->name],
            ['surname',"=", $request->surname],
            ['birthdate',"=", $request->birthdate],
            ['mobile_number',"=", $request->mobile_number],
            ['address',"=", $request->address],
            ['state',"=", $request->state],
            ['city',"=", $request->city],
            ['pincode',"=", $request->pincode],
            ['marital-status',"=", $request->marital-status],
            ['hobby',"=", $request->hobby],
            ['photo',"=", $request->photo],
        ])->first();

       
   }
}
