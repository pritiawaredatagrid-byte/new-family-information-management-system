<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\UserRegistration;


class UserController extends Controller
{
   function userRegistration(Request $request){
    $cutDate = Carbon::now()->subYears(21);

    $validation = $request->validate([
     'name'=>'required|max:50',
     'surname'=>'required|max:50',
     'birthdate'=>'required|before_or_equal:' .$cutDate,
     'mobile_number'=>'required|unique:UserRegistration,mobile_number|numeric|digits:10',
     'address'=>'required',
     'state'=>'required',
     'city'=>'required',
     'pincode'=>'required|digits:6',
     'marital-status'=>'required',
     'hobby'=>'required',
     'photo'=>'required|mimes:jpg,png|max:2048'
    ],[
      'birthdate.before_or_equal'=>'Family head must be 21 years or older',
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

   function familyMember(Request $request){
    $cutDate = Carbon::now()->subYears(21);

    $validation = $request->validate([
     'name'=>'required|max:50',
     'birthdate'=>'required|before_or_equal:' .$cutDate,
     'marital-status'=>'required',
     'hobby'=>'required',
     'education'=>'nullable',
     'photo'=>'nullable|mimes:jpg,png|max:2048'
    ],[
      'birthdate.before_or_equal'=>'Family head must be 21 years or older',
    ]);
    echo $request;
   }
}
