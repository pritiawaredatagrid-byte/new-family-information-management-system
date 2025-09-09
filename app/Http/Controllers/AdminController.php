<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin;
use \Crypt;
use Mail;
use App\Mail\AdminForgotPassword;
use App\Models\UserRegistration;
use App\Models\Member;
use App\Models\State;
use App\Models\City;


use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    function login(Request $request)
    {

        $validation = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where([
            ['email', "=", $request->email],
            ['password', "=", $request->password],
        ])->first();

        if (!$admin) {
            $validation = $request->validate([
                'user' => 'required',
            ], [
                'user.required' => 'User does not exist',
            ]);
        }
        Session::put('admin', $admin);
        return redirect('dashboard');
    }

    function AdminForgetPassword(Request $request)
    {
        $link = Crypt::encryptString($request->email);
        $link = url('/admin-forget-password/' . $link);
        Mail::to($request->email)->send(new AdminForgotPassword($link));
        return redirect('/');
    }

    function AdminResetForgetPassword($email)
    {
        $argEmail = Crypt::decryptString($email);
        return view('admin-set-forget-password', ['email' => $argEmail]);

    }

    function AdminSetForgetPassword(Request $request)
    {
        $validate = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:3|confirmed'
            ]
        );
        $admin = Admin::where('email', $request->email)->first();
        if ($admin) {
            $admin->password = $request->password;
            if ($admin->save()) {
                return redirect('admin-login');
            }
        }
    }


    function dashboard()
    {
        $admin = Session::get('admin');
        $totalFamilies = UserRegistration::count();
        $totalMembers = Member::count();
        $totalStates = State::count();
        $totalCities = City::count();


        if ($admin) {
            return view('Auth.Admin-login.admin', ["name" => $admin->name, "totalFamilies" => $totalFamilies, "totalMembers" => $totalMembers, "totalStates" => $totalStates, "totalCities" => $totalCities]);
        } else {
            return redirect('/admin-login');
        }
        return view('admin', $admin);
    }

    function familyList()
    {
        $heads = UserRegistration::paginate(6);
        return view('Auth.Admin-login.family-list', ['heads' => $heads]);
    }

    function MemberList()
    {
        $members = Member::paginate(7);
        return view('Auth.Admin-login.member-list', ['members' => $members]);
    }

    function StateList()
    {
        $states = State::paginate(7);
        return view('Auth.Admin-login.state-list', ['states' => $states]);
    }

    function CityList()
    {
        $cities = City::with('state')->paginate(7);
        return view('Auth.Admin-login.city-list', ['cities' => $cities]);
    }

    function searchHead(Request $request)
    {
    $searchData = UserRegistration::where('name', 'like', '%' . $request->search . '%')
    ->orWhere('mobile_number', 'like', '%' . $request->search . '%')->orWhere('state', 'like', '%' . $request->search . '%')->orWhere('city', 'like', '%' . $request->search . '%')
   ->paginate(5);
    return view('Auth.Admin-login.search-head',['searchData'=>$searchData]);
    }

    function logout()
    {
        Session::forget('admin');
        return redirect('/admin-login');
    }

     function addState(Request $request){
      $state = new State();
      $validation = $request->validate([
            'state_name' => 'required|unique:states,state_name',
        ]);
      $state->state_name = $request->state_name;
      if ($state->save()) {
      Session::flash('state', 'State added Successfully.');
      return redirect('/add-city');
      } else { 
        return 'Something went wrong';
      }
     }

      public function addStates()
  {
    $states = State::select('state_id', 'state_name')->get();
    return view('add-city', compact('states'));
  }

      public function getCities(Request $request)
  {
    $cities = City::where('state_id', '=', $request->state_id)->get(['city_id', 'city_name']);
    return response()->json($cities);
  }

 function addCity(Request $request)
{
    $city = new City();
    $validator = $request->validate([
        'state_id' => 'required|exists:states,state_id',
        'city_name' => 'required|unique:cities,city_name',
    ], [
        'state_id.required' => 'State should be selected.',
        'city_name.required' => 'City name is required.',
        'city_name.unique' => 'This city name already exists.',
    ]);
  
    $city->state_id = $request->state_id;
    $city->city_name = $request->city_name;
     if ($city->save()) {
      Session::flash('city', 'City added Successfully.');
      return redirect('/city-list');
      } else { 
        return 'Something went wrong';
      }
}


}
