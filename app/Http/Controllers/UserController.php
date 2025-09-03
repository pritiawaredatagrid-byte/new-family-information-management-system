<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\UserRegistration;
use App\Models\Member;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
   function userRegistration(Request $request){
    $cutDate = Carbon::now()->subYears(21);
    $user = new UserRegistration();

    $validation = $request->validate([
     'name'=>'required|max:50',
     'surname'=>'required|max:50',
     'birthdate'=>'required|before_or_equal:' .$cutDate,
     'mobile_number'=>'required|unique:UserRegistration,mobile_number|numeric|digits:10',
     'address'=>'required',
     'state'=>'required',
     'city'=>'required',
     'pincode'=>'required|digits:6',
     'status'=>'required',
     'hobby'=>'required',
     'photo'=>'required|image|mimes:jpg,png|max:2048'
    ],[
      'birthdate.before_or_equal'=>'Family head must be 21 years or older',
    ]);

   $user->name = $request->name;
   $user->surname = $request->surname;
   $user->birthdate = $request->birthdate;
   $user->mobile_number = $request->mobile_number;
   $user->address = $request->address;
   $user->state = $request->state;
   $user->city = $request->city;
   $user->pincode = $request->pincode;
   $user->status = $request->status;
   $user->hobby = $request->hobby;

   $imagePath=null;
   if($request->hasFile('photo')){
       $photoPath = $request->file('photo')->store('photos','public');
   }

   $user->photo = $photoPath;
   
   if($user->save()){
        if($request->submit=="submit"){
            Session::put('user',$user);
            return redirect('/');
        }
      }
   }

   function addFamilyMember(Request $request){
    $member = new Member();
    $user =  Session::get('user');
    $cutDate = Carbon::now()->subYears(21);

    $validation = $request->validate([
     'name'=>'required|max:50',
     'birthdate'=>'required|before_or_equal:' .$cutDate,
     'status'=>'required',
     'hobby'=>'required',
     'education'=>'nullable',
     'photo'=>'nullable|image|mimes:jpg,png|max:2048'
    ],[
      'birthdate.before_or_equal'=>'Family head must be 21 years or older',
    ]);
    
   $member->head_id = $user->id;
   $member->name = $request->name;
   $member->birthdate = $request->birthdate;
   $member->status = $request->status;
   $member->hobby = $request->hobby;
   $member->education = $request->education;
   $member->photo = $request->photo;
   
   if($member->save()){
        if($request->submit=="submit"){
            return redirect('/');
        }
      }
   }

}
