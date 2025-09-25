<?php

namespace App\Http\Controllers;

use App\Models\AdminAction;
use App\Models\City;
use App\Models\Member;
use App\Models\State;
use App\Models\UserRegistration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userRegistration(Request $request)
    {
        $cutDate = Carbon::now()->subYears(21);

        $rules = [
            'head.name' => 'required|max:50',
            'head.surname' => 'required|max:50',
            'head.birthdate' => 'required|date|before_or_equal:'.$cutDate,
            'head.mobile_number' => 'required|unique:UserRegistration,mobile_number|numeric|digits:10',
            'head.address' => 'required',
            'head.state' => 'required',
            'head.city' => 'required',
            'head.pincode' => 'required|digits:6',
            'head.status' => 'required|in:married,unmarried',
            'hobbies.*' => 'required|string',
            'head.photo' => 'required|image|mimes:jpg,png|max:2048',
            'members.*.name' => 'required|max:50',
            'members.*.birthdate' => 'required|date',
            'members.*.status' => 'required|in:married,unmarried',
            'members.*.wedding_date' => 'nullable|date',
            'members.*.education' => 'nullable|string|max:100',
            'members.*.relation' => 'string|max:100',
            'members.*.photo' => 'nullable|image|mimes:jpg,png|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $headData = $request->input('head');

        $head = new UserRegistration;
        $head->name = $headData['name'];
        $head->surname = $headData['surname'];
        $head->birthdate = $headData['birthdate'];
        $head->mobile_number = $headData['mobile_number'];
        $head->address = $headData['address'];

        $state = State::find($headData['state']);
        $head->state = $state ? $state->state_name : null;

        $head->city = $headData['city'];
        $head->pincode = $headData['pincode'];
        $head->status = $headData['status'];
        $head->wedding_date = $headData['wedding_date'] ?? null;

        $hobbies = $request->input('hobbies');
        if ($hobbies) {
            $head->hobby = json_encode($hobbies);
        }

        if ($request->hasFile('head.photo')) {
            $head->photo = $request->file('head.photo')->store('photos', 'public');
        }

        $head->save();

        if ($request->has('members')) {
            foreach ($request->members as $index => $memberData) {
                $member = new Member;
                $member->head_id = $head->id;
                $member->name = $memberData['name'];
                $member->birthdate = $memberData['birthdate'];
                $member->status = $memberData['status'];
                $member->wedding_date = $memberData['wedding_date'] ?? null;
                $member->education = $memberData['education'] ?? null;
                $member->relation = $memberData['relation'] ?? null;
                if ($request->hasFile("members.$index.photo")) {
                    $member->photo = $request->file("members.$index.photo")->store('photos', 'public');
                }
                $member->save();
            }
        }

        AdminAction::create([
            'admin_id' => auth()->id(),
            'action' => 'Head Added with Members',
            'resource_type' => 'family',
            'resource_id' => $head->id,
            'details' => json_encode(['ip_address' => $request->ip()]),
        ]);

        return response()->json(['message' => 'Family Head and Members Added Successfully!', 'headId' => $head->id]);
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
            'relation' => 'required',
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
