<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin;
use \Crypt;
use Mail;
use Carbon\Carbon;
use App\Mail\AdminForgotPassword;
use App\Models\UserRegistration;
use App\Models\Member;
use App\Models\State;
use App\Models\City;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FamilyDetailsExcel;
use Illuminate\Support\Facades\Session;
use App\Models\AdminAction;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Models\Activity;


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
        $validation = $request->validate([
            'email' => 'required|email',
        ]);
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
            return view('Auth.Admin-login.admin', ["name" => $admin->name, "totalFamilies" => $totalFamilies,
             "totalMembers" => $totalMembers,
              "totalStates" => $totalStates,
               "totalCities" => $totalCities,
            "marriedHeads" => $marriedHeads,
            "unmarriedHeads" => $unmarriedHeads,
            "familiesPerState"=>$familiesPerState,
            "marriedMembers" => $marriedMembers,
            "unmarriedMembers" => $unmarriedMembers,
            "cumulativeData" => $cumulativeData,
            "labels" => $labels
        ]);

        } else {
            return redirect('/admin-login');
        }
        return view('admin', $admin);
    }

    function familyList()
    {
        $heads = UserRegistration::paginate(4);
        return view('Auth.Admin-login.family-list', ['heads' => $heads]);
    }

    function exportPDF($id)
    {

        $head = UserRegistration::with('members')->findOrFail($id);
        $pdf = PDF::loadView('Auth.Admin-login.view-family-details-pdf', ['head' => $head]);
        return $pdf->stream('Family Details.pdf');
        return $pdf->download('Family Details.pdf');
    }

    function exportExcel($id)
    {
        $head = UserRegistration::with('members')->findOrFail($id);
        $excel = Excel::download(new FamilyDetailsExcel($head), 'family_details.xlsx');
        return $excel;
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
        return view('Auth.Admin-login.search-head', ['searchData' => $searchData]);
    }

    function logout()
    {
        Session::forget('admin');
        return redirect('/admin-login');
    }

    function addState(Request $request)
    {
        $state = new State();
        $admin = new Admin();
    
        $validation = $request->validate([
            'state_name' => 'required|unique:states,state_name',
        ]);
        $state->state_name = $request->state_name;
        if ($state->save()) {
       AdminAction::create([
        'admin_id' =>auth()->id(),
        'action' => 'State Added',
        'resource_type' => 'State',
        'resource_id' => $state->state_id,
        'details' => json_encode(['ip_address' => $request->ip()]),
       ]);
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

    function editFamilyHead($id)
    {
        $heads = UserRegistration::findOrFail($id);
        $states = State::select('state_id', 'state_name')->get();
        return view('/Auth/Admin-login/edit-family-head', ['heads' => $heads, 'states' => $states]);
    }

  

function editFamilyHeadData(Request $request, $id)
{
    $heads = UserRegistration::findOrFail($id);
    $cutDate = Carbon::now()->subYears(21);

    $validation = $request->validate([
        'name' => 'required|max:50',
        'surname' => 'required|max:50',
        'birthdate' => 'required|before_or_equal:' . $cutDate,
        'mobile_number' => 'required|numeric|digits:10|unique:UserRegistration,mobile_number,' . $id,
        'address' => 'required',
        'state' => 'required',
        'city' => 'required',
        'pincode' => 'required|digits:6',
        'status' => 'required',
        'hobbies.*' => 'required',
        'photo' => 'sometimes|image|mimes:jpg,png|max:2048' 
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
        $photoPath = $request->file('photo')->store('photos', 'public');
    }
    $heads->photo = $photoPath;

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

    function editFamilyMember($head_id, $id)
    {
        $member = Member::where('head_id', $head_id)->findOrFail($id);
        return view('/Auth/Admin-login/edit-family-member', ['member' => $member]);
    }

    function editFamilyMemberData(Request $request, $head_id, $id)
    {
        $member = Member::where('head_id', $head_id)->findOrFail($id);
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

    function viewFamilyDetails($id)
    {
        $head = UserRegistration::with('members')->findOrFail($id);
        return view('/Auth/Admin-login/view-family-details', ['head' => $head]);
    }

    function deleteFamilyDetails($id,Request $request)
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
            ->with('success', $head->name . "'s Family details successfully deleted.");
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
            ->with('success', $member->name . " successfully deleted.");
    }

    function viewStateDetails($state_id)
    {
        $state = State::with('cities')->findOrFail($state_id);
        return view('/Auth/Admin-login/view-state-details', ['state' => $state]);
    }

  
    function editState($state_id)
    {
        $stateDetails = State::findOrFail($state_id);
        return view('/Auth/Admin-login/edit-state', ['stateDetails' => $stateDetails]);
    }

    function editStateData(Request $request, $state_id)
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

    function editCity($state_id, $city_id)
    {
        $city = City::where('state_id', $state_id)->findOrFail($city_id);
        $state = State::findOrFail($state_id);
        return view('/Auth/Admin-login/edit-city', ['city' => $city, 'state' => $state]);
    }

   public function deleteStateDetails($state_id,Request $request)
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
        ->with('success', $state->state_name . " successfully deleted.");
}

  public function deleteCity($city_id,Request $request)
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
        ->with('success', $city->city_name . " successfully deleted.");
}

    function editCityData(Request $request, $state_id, $city_id)
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
