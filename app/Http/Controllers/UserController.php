<?php

namespace App\Http\Controllers;

use App\Models\AdminAction;
use App\Models\City;
use App\Models\Member;
use App\Models\State;
use App\Models\UserRegistration;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userRegistration(Request $request)
    {
        $cutDate = Carbon::now()->subYears(21);
        $users = new UserRegistration;

        $validation = $request->validate([
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'birthdate' => 'required|date|before:today|before_or_equal:'.$cutDate,
            'mobile_number' => 'required|unique:UserRegistration,mobile_number|numeric|digits:10',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:6',
            'status' => 'required',
            'hobbies.*' => 'required',
            'photo' => 'required|image|mimes:jpg,png|max:2048',
        ], [
            'birthdate.before_or_equal' => 'Family head must be 21 years or older',
            'hobbies.*.required' => 'At least 1 hobby required',
        ]);

        $users->name = $request->name;
        $users->surname = $request->surname;
        $users->birthdate = $request->birthdate;
        $users->mobile_number = $request->mobile_number;
        $users->address = $request->address;

        $state = State::find($request->state);
        $users->state = $state ? $state->state_name : null;

        $users->city = $request->city;
        $users->pincode = $request->pincode;
        $users->status = $request->status;
        $users->wedding_date = $request->wedding_date;
        $users->hobby = json_encode($request->hobbies);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $users->photo = $photoPath;
        }

        if ($users->save()) {
            $headId = $users->id;

            session()->put('headId', $headId);

            return redirect()->back()
                ->with('users', 'Family Head Added Successfully!')
                ->with('family_head_added', true)
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

    public function addFamilyMember(Request $request)
    {
        $member = new Member;
        $head_id = $request->head_id;

        $validation = $request->validate([
            'name' => 'required|max:50',
            'birthdate' => 'required|date|before:today',
            'status' => 'required',
            'education' => 'nullable',
            'photo' => 'nullable|image|mimes:jpg,png|max:2048',
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

            return redirect()->back()->with('success', 'Family member added successfully!');

        }

        return redirect()->back()->with('error', 'Error: Family member could not be added.');
    }
}
