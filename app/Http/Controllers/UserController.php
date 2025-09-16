<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\UserRegistration;
use App\Models\Member;
use App\Models\State;
use App\Models\City;
use App\Models\AdminAction;

use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
  function userRegistration(Request $request)
  {
    $cutDate = Carbon::now()->subYears(21);
    $users = new UserRegistration();

    $validation = $request->validate([
      'name' => 'required|max:50',
      'surname' => 'required|max:50',
      'birthdate' => 'required|before_or_equal:' . $cutDate,
      'mobile_number' => 'required|unique:UserRegistration,mobile_number|numeric|digits:10',
      'address' => 'required',
      'state' => 'required',
      'city' => 'required',
      'pincode' => 'required|digits:6',
      'status' => 'required',
      'hobbies.*' => 'required',
      'photo' => 'required|image|mimes:jpg,png|max:2048'
    ], [
      'birthdate.before_or_equal' => 'Family head must be 21 years or older',
      'hobbies.*.required' => 'At least 1 hobby required',
    ]);

    $users->name = $request->name;
    $users->surname = $request->surname;
    $users->birthdate = $request->birthdate;
    $users->mobile_number = $request->mobile_number;
    $users->address = $request->address;
    $stateId = $request->state;
    $state = State::find($stateId);
    if ($state) {
      $users->state = $state->state_name;
    } else {
      $users->state = null;
    }
    $users->city = $request->city;
    $users->pincode = $request->pincode;
    $users->status = $request->status;
    $users->wedding_date = $request->wedding_date;
    $users->hobby = json_encode($request->hobbies);

    $imagePath = null;
    if ($request->hasFile('photo')) {
      $photoPath = $request->file('photo')->store('photos', 'public');
    }
    $users->photo = $photoPath;

    if ($users->save()) {
      $headId = $users->id;
       AdminAction::create([
        'admin_id' => auth()->id(),
        'action' => 'Head Added',
        'resource_type' => 'family',
        'resource_id' => $users->id,
        'details' => json_encode(['ip_address' => $request->ip()]),
    ]);
      return redirect()->back()
        ->with('users', 'Family Head Added Successfully!')
        ->with('family_head_added', true)
        ->with('headId', $headId)
        ->withErrors([]);
    }

    return redirect()->back()->with('users', 'Error: Family Head could not be added.');
  }

  public function addFamilyMemberForm($head_id)
  {
    return view('add-family-member', compact('head_id'));
  }


  public function addStates()
  {
    $states = State::select('state_id', 'state_name')->get();
    return view('user-registration', compact('states'));
  }

  public function getCities(Request $request)
  {
    $cities = City::where('state_id', '=', $request->state_id)->get(['city_id', 'city_name']);
    return response()->json($cities);
  }


  function addFamilyMember(Request $request)
  {
    $member = new Member();
    $head_id = $request->head_id;
    $cutDate = Carbon::now()->subYears(21);

    $validation = $request->validate([
      'name' => 'required|max:50',
      'birthdate' => 'required|before_or_equal:' . $cutDate,
      'status' => 'required',
      'education' => 'nullable',
      'photo' => 'nullable|image|mimes:jpg,png|max:2048'
    ], [
      'birthdate.before_or_equal' => 'Family member must be 21 years or older',
    ]);


    $member->head_id = $head_id;
    $member->name = $request->name;
    $member->birthdate = $request->birthdate;
    $member->status = $request->status;
    $member->wedding_date = $request->wedding_date;
    $member->education = $request->education;

    $photoPath = null;
    if ($request->hasFile('photo')) {
      $photoPath = $request->file('photo')->store('photos', 'public');
    }
    $member->photo = $photoPath;

    if ($member->save()) {
       AdminAction::create([
        'admin_id' => auth()->id(),
        'action' => 'Member Added',
        'resource_type' => 'member',
        'resource_id' => $member->id,
        'details' => json_encode(['ip_address' => $request->ip()]),
    ]);
      return redirect()->route('view-family-details', ['id' => $head_id]);
    }

    return redirect()->back()->with('error', 'Error: Family member could not be added.');
  }

}
