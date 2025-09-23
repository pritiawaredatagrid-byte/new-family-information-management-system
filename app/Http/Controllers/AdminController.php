<?php

namespace App\Http\Controllers;

use App\Exports\FamilyDetailsExcel;
use App\Mail\AdminForgotPassword;
use App\Models\Admin;
use App\Models\AdminAction;
use App\Models\City;
use App\Models\Member;
use App\Models\State;
use App\Models\UserRegistration;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use Mail;

class AdminController extends Controller
{
    public function userRegistrationAdmin(Request $request)
    {
        $cutDate = Carbon::now()->subYears(21);

        $validated = $request->validate([
            'head.name' => 'required|max:50',
            'head.surname' => 'required|max:50',
            'head.birthdate' => 'required|date|before_or_equal:'.$cutDate,
            'head.mobile_number' => 'required|unique:UserRegistration,mobile_number|numeric|digits:10',
            'head.address' => 'required',
            'head.state' => 'required',
            'head.city' => 'required',
            'head.pincode' => 'required|digits:6',
            'head.status' => 'required|in:married,unmarried',
            'head.hobbies.*' => 'required|string',
            'head.photo' => 'required|image|mimes:jpg,png|max:2048',

            'members.*.name' => 'required|max:50',
            'members.*.birthdate' => 'required|date',
            'members.*.status' => 'required|in:married,unmarried',
            'members.*.wedding_date' => 'nullable|date',
            'members.*.education' => 'nullable|string|max:100',
            'members.*.photo' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

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
        $head->hobby = json_encode($headData['hobbies']);

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

                if (isset($memberData['photo']) && $request->hasFile("members.$index.photo")) {
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

        return redirect()->back()
            ->with('users', 'Family Head and Members Added Successfully!')
            ->with('family_head_added', true)
            ->with('headId', $head->id);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            if ($request->ajax()) {

                return response()->json(['message' => 'Invalid credentials.'], 401);
            }

            return back()->withErrors(['login' => 'Invalid credentials'])->withInput();
        }

        Session::put('admin', $admin);

        if ($request->ajax()) {
            return response()->json(['message' => 'Login successful'], 200);
        }

        return redirect('dashboard');
    }

    public function AdminForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (! $admin) {
            return redirect()->back()->withErrors(['email' => 'Please enter valid email.'])->withInput();
        }

        $link = URL::temporarySignedRoute(
            'admin.reset-password',
            now()->addMinutes(15),
            ['email' => $request->email]
        );

        Mail::to($request->email)->send(new AdminForgotPassword($link));

        return redirect('/')->with('status', 'Password reset link sent to your email.');
    }

    public function AdminResetForgetPassword($email)
    {
        $admin = Admin::where('email', $email)->first();

        if (! $admin) {
            abort(404);
        }

        return view('admin-set-forget-password', ['email' => $email]);
    }

    public function AdminSetForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin) {
            $admin->password = Hash::make($request->password);
            $admin->save();

            return redirect('admin-login')->with('success', 'Password reset successfully.');
        }

        return redirect()->back()->withErrors(['email' => 'Something went wrong.']);
    }

    public function dashboard()
    {
        $admin = Session::get('admin');
        $totalFamilies = UserRegistration::count();
        $totalMembers = Member::count();
        $totalStates = State::count();
        $totalCities = City::count();
        $marriedHeads = UserRegistration::where('status', 'married')->count();
        $unmarriedHeads = UserRegistration::where('status', 'unmarried')->count();
        $marriedMembers = Member::where('status', 'married')->count();
        $unmarriedMembers = Member::where('status', 'unmarried')->count();

        $familiesPerState = UserRegistration::select('state', \DB::raw('count(*) as total'))
            ->groupBy('state')
            ->get()
            ->pluck('total', 'state')
            ->toArray();

        $registrationsByMonth = UserRegistration::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('count(*) as count')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $cumulativeData = [];
        $labels = [];
        $cumulativeCount = 0;

        foreach ($registrationsByMonth as $registration) {
            $cumulativeCount += $registration->count;
            $cumulativeData[] = $cumulativeCount;
            $labels[] = Carbon::parse($registration->month)->format('M Y');
        }

        if ($admin) {
            return view('Auth.Admin-login.admin', [
                'name' => $admin->name,
                'totalFamilies' => $totalFamilies,
                'totalMembers' => $totalMembers,
                'totalStates' => $totalStates,
                'totalCities' => $totalCities,
                'marriedHeads' => $marriedHeads,
                'unmarriedHeads' => $unmarriedHeads,
                'familiesPerState' => $familiesPerState,
                'marriedMembers' => $marriedMembers,
                'unmarriedMembers' => $unmarriedMembers,
                'cumulativeData' => $cumulativeData,
                'labels' => $labels,
            ]);

        } else {
            return redirect('/admin-login');
        }

        return view('admin', $admin);
    }

    public function familyList()
    {
        $heads = UserRegistration::paginate(5);

        return view('Auth.Admin-login.family-list', ['heads' => $heads]);
    }

    public function exportPDF()
    {

        $families = UserRegistration::with('members')->get();

        $pdf = PDF::loadView('Auth.Admin-login.view-family-details-pdf', compact('families'));

        return $pdf->download('All_Family_Details.pdf');

    }

    public function exportExcel()
    {
        $families = UserRegistration::with('members')->get();

        return Excel::download(new FamilyDetailsExcel($families), 'family_details.xlsx');
    }

    public function exportPDFSearchHead()
    {

        $families = UserRegistration::with('members')->get();

        $pdf = PDF::loadView('Auth.Admin-login.view-search-family-details-pdf', compact('families'));

        return $pdf->download('All_Family_Details.pdf');

    }

    public function exportExcelSearchHead()
    {
        $families = UserRegistration::with('members')->get();

        return Excel::download(new FamilyDetailsExcel($families), 'family_details.xlsx');
    }

    public function StateList()
    {
        $states = State::paginate(7);

        return view('Auth.Admin-login.state-list', ['states' => $states]);
    }

    public function CityList()
    {
        $cities = City::with('state')->paginate(7);

        return view('Auth.Admin-login.city-list', ['cities' => $cities]);
    }

    public function searchHead(Request $request)
    {
        $searchData = UserRegistration::where('name', 'like', '%'.$request->search.'%')
            ->orWhere('mobile_number', 'like', '%'.$request->search.'%')->orWhere('state', 'like', '%'.$request->search.'%')->orWhere('city', 'like', '%'.$request->search.'%')
            ->paginate(5);

        return view('Auth.Admin-login.search-head', ['searchData' => $searchData]);
    }

    public function searchState(Request $request)
    {
        $searchData = State::where('state_name', 'like', '%'.$request->search.'%')
            ->paginate(5);

        return view('Auth.Admin-login.search-state', ['searchData' => $searchData]);
    }

    public function logout()
    {
        Session::forget('admin');

        return redirect('/admin-login');
    }

    public function addState(Request $request)
    {
        $state = new State;
        $admin = new Admin;

        $validation = $request->validate([
            'state_name' => 'required|unique:states,state_name',
        ]);
        $state->state_name = $request->state_name;
        if ($state->save()) {
            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'State Added',
                'resource_type' => 'State',
                'resource_id' => $state->state_id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);
            Session::flash('state', 'State added Successfully.');

            // return redirect('/add-city');
            return redirect('/add-city')->with([
                'state_id_to_select' => $state->state_id,
                'state_name_to_select' => $state->state_name,
            ]);

        } else {
            return 'Something went wrong';
        }
    }

    public function addStates()
    {
        $states = State::select('state_id', 'state_name')->get();

        return view('/Auth/Admin-login/user-registration-admin', compact('states'));
    }

    public function addStates_state()
    {
        $states = State::select('state_id', 'state_name')->get();
        // return view('add-city', compact('states'));

        $stateIdToSelect = session('state_id_to_select');
        $stateNameToSelect = session('state_name_to_select');

        return view('add-city', compact('states', 'stateIdToSelect', 'stateNameToSelect'));
    }

    public function getCities(Request $request)
    {
        $cities = City::where('state_id', '=', $request->state_id)->get(['city_id', 'city_name']);

        return response()->json($cities);
    }

    public function addCity(Request $request)
    {
        $city = new City;
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
            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'City Added',
                'resource_type' => 'City',
                'resource_id' => $city->city_id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);
            $state_id = $request->state_id;

            return redirect()->route('view-state-details', ['state_id' => $state_id]);
        } else {
            return 'Something went wrong';
        }
    }

    public function editFamilyHead($id)
    {
        $heads = UserRegistration::findOrFail($id);
        $states = State::select('state_id', 'state_name')->get();

        return view('/Auth/Admin-login/edit-family-head', ['heads' => $heads, 'states' => $states]);
    }

    public function editFamilyHeadData(Request $request, $id)
    {
        $heads = UserRegistration::findOrFail($id);
        $cutDate = Carbon::now()->subYears(21);

        $validation = $request->validate([
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'birthdate' => 'required|before_or_equal:'.$cutDate,
            'mobile_number' => 'required|numeric|digits:10|unique:UserRegistration,mobile_number,'.$id,
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:6',
            'status' => 'required',
            'hobbies.*' => 'required',
            'photo' => 'sometimes|image|mimes:jpg,png|max:2048',
        ], [
            'birthdate.before_or_equal' => 'Family head must be 21 years or older',
            'hobbies.*.required' => 'At least 1 hobby required',
        ]);

        $heads->name = $request->name;
        $heads->surname = $request->surname;
        $heads->birthdate = $request->birthdate;
        $heads->mobile_number = $request->mobile_number;
        $heads->address = $request->address;
        $stateId = $request->state;
        $state = State::find($stateId);
        if ($state) {
            $heads->state = $state->state_name;
        }
        $heads->city = $request->city;
        $heads->pincode = $request->pincode;
        $heads->status = $request->status;
        $heads->wedding_date = $request->wedding_date;
        $heads->hobby = json_encode($request->hobbies);

        $photoPath = $heads->photo;
        $imagePath = null;

        if ($request->hasFile('photo')) {

            if ($heads->photo) {
                Storage::disk('public')->delete($heads->photo);
            }

            $path = $request->file('photo')->store('photos', 'public');
            $heads->photo = $path;
        }

        if ($heads->save()) {
            Session::flash('heads', 'Head updated Successfully.');
            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'Head edited',
                'resource_type' => 'head',
                'resource_id' => $heads->id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);
        } else {
            return 'Something went wrong';
        }

        return redirect()->route('view-family-details', ['id' => $id]);
    }

    public function editFamilyMember($head_id, $id)
    {
        $member = Member::where('head_id', $head_id)->findOrFail($id);

        return view('/Auth/Admin-login/edit-family-member', ['member' => $member]);
    }

    public function editFamilyMemberData(Request $request, $head_id, $id)
    {
        $member = Member::where('head_id', $head_id)->findOrFail($id);
        $cutDate = Carbon::now()->subYears(21);
        $validation = $request->validate([
            'name' => 'required|max:50',
            'birthdate' => 'required|date',
            'status' => 'required',
            'education' => 'nullable',
            'photo' => 'nullable|image|mimes:jpg,png|max:2048',
        ], [
            'birthdate.before_or_equal' => 'Family member must be 21 years or older',
        ]);

        $member->name = $request->name;
        $member->birthdate = $request->birthdate;
        $member->status = $request->status;
        $member->wedding_date = $request->wedding_date;
        $member->education = $request->education;

        $photoPath = $member->photo;
        $imagePath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }
        $member->photo = $photoPath;

        if ($member->save()) {
            Session::flash('member', 'Member updated Successfully.');
            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'Member edited',
                'resource_type' => 'member',
                'resource_id' => $member->id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);
        } else {
            return 'Something went wrong';
        }

        return redirect()->route('view-family-details', ['id' => $head_id]);
    }

    public function viewFamilyDetails($id, Request $request)
    {
        $head = UserRegistration::findOrFail($id);
        $members = $head->members()->paginate(3);

        return view('Auth.Admin-login.view-family-details', [
            'head' => $head,
            'members' => $members,
            'id' => $id,
        ]);

    }

    public function deleteFamilyDetails($id, Request $request)
    {
        $head = UserRegistration::with('members')->findOrFail($id);
        $head->update(['op_status' => 9]);
        $head->delete();
        AdminAction::create([
            'admin_id' => auth()->id(),
            'action' => 'Head deleted',
            'resource_type' => 'head',
            'resource_id' => $head->id,
            'details' => json_encode(['ip_address' => $request->ip()]),
        ]);

        return redirect('/family-list')
            ->with('success', $head->name."'s Family details successfully deleted.");
    }

    public function deleteFamilyMember($id, Request $request)
    {
        $member = Member::findOrFail($id);

        $head_id = $member->head_id;
        $member->update(['op_status' => 9]);
        $member->delete();
        AdminAction::create([
            'admin_id' => auth()->id(),
            'action' => 'Member deleted',
            'resource_type' => 'member',
            'resource_id' => $member->id,
            'details' => json_encode(['ip_address' => $request->ip()]),
        ]);

        return redirect()->route('view-family-details', ['id' => $head_id])
            ->with('success', $member->name.' successfully deleted.');
    }

    public function viewStateDetails($state_id, Request $request)
    {
        $state = State::findOrFail($state_id);
        $cities = $state->cities()->paginate(3);

        return view('Auth.Admin-login.view-state-details', [
            'state' => $state,
            'cities' => $cities,
            'stateId' => $state_id,
        ]);

    }

    public function showAddCityForm(Request $request)
    {
        $stateId = $request->query('state_id');

        if (! $stateId) {
            return redirect()->back()->with('error', 'State ID is required.');
        }

        $state = State::findOrFail($stateId);

        return view('add-city', [
            'state' => $state,
            'stateId' => $stateId,
        ]);
    }

    public function editState($state_id)
    {
        $stateDetails = State::findOrFail($state_id);

        return view('/Auth/Admin-login/edit-state', ['stateDetails' => $stateDetails]);
    }

    public function editStateData(Request $request, $state_id)
    {
        $stateDetails = State::findOrFail($state_id);
        $stateDetails->state_name = $request->state_name;

        if ($stateDetails->save()) {
            Session::flash('$stateDetails', 'State updated Successfully.');
            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'State edited',
                'resource_type' => 'state',
                'resource_id' => $stateDetails->state_id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);
        } else {
            return 'Something went wrong';
        }

        return redirect()->route('view-state-details', ['state_id' => $state_id]);
    }

    public function editCity($state_id, $city_id)
    {
        $city = City::where('state_id', $state_id)->findOrFail($city_id);
        $state = State::findOrFail($state_id);

        return view('/Auth/Admin-login/edit-city', ['city' => $city, 'state' => $state]);
    }

    public function deleteStateDetails($state_id, Request $request)
    {
        $state = State::findOrFail($state_id);
        AdminAction::create([
            'admin_id' => auth()->id(),
            'action' => 'State deleted',
            'resource_type' => 'state',
            'resource_id' => $state->state_id,
            'details' => json_encode(['ip_address' => $request->ip()]),
        ]);

        $state->update(['op_status' => 9]);
        $state->delete();

        return redirect('/state-list')
            ->with('success', $state->state_name.' successfully deleted.');
    }

    public function deleteCity($city_id, Request $request)
    {
        $city = City::findOrFail($city_id);

        $state_id = $city->state_id;
        $city->update(['op_status' => 9]);
        $city->delete();

        AdminAction::create([
            'admin_id' => auth()->id(),
            'action' => 'City deleted',
            'resource_type' => 'city',
            'resource_id' => $city->city_id,
            'details' => json_encode(['ip_address' => $request->ip()]),
        ]);

        return redirect()->route('view-state-details', ['state_id' => $state_id])
            ->with('success', $city->city_name.' successfully deleted.');
    }

    public function editCityData(Request $request, $state_id, $city_id)
    {
        $city = City::where('state_id', $state_id)->findOrFail($city_id);

        $city->city_name = $request->city_name;
        if ($city->save()) {
            Session::flash('city', 'City updated Successfully.');
            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'City edited',
                'resource_type' => 'city',
                'resource_id' => $city->city_id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);
        } else {
            return 'Something went wrong';
        }

        return redirect()->route('view-state-details', ['state_id' => $state_id]);
    }

    public function index()
    {
        $logs = AdminAction::with('admin')->latest()->paginate(20);

        return $logs;
    }
}
