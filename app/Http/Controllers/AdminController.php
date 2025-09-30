<?php

namespace App\Http\Controllers;

use App\Exports\FamilyDetailsExcel;
use App\Exports\SearchFamilyDetailsExcel;
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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Mail;

class AdminController extends Controller
{
    public function userRegistrationAdmin(Request $request)
    {
        $cutDate = Carbon::now()->subYears(21);

        $rules = [
            'head.name' => ['required', 'max:50', 'regex:/^[A-Za-z]+$/'],
            'head.surname' => ['required', 'max:50', 'regex:/^[A-Za-z]+$/'],
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

        DB::beginTransaction();

        try {

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

            DB::commit();

            return response()->json([
                'message' => 'Family Head and Members Added Successfully!',
                'headId' => $head->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Something went wrong while saving the data.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function checkMobileUniqueness(Request $request)
    {
        $mobileNumber = $request->input('mobile_number');

        $exists = UserRegistration::where('mobile_number', $mobileNumber)->exists();
        if ($exists) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
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
        } catch (\Exception $e) {
            \Log::error('Login error: '.$e->getMessage());

            if ($request->ajax()) {
                return response()->json(['message' => 'Something went wrong. Please try again.'], 500);
            }

            return back()->withErrors(['login' => 'Something went wrong. Please try again.']);
        }
    }

    public function AdminForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (! $admin) {
            return response()->json([
                'errors' => ['email' => ['Please enter a valid email.']],
            ], 422);
        }
        $encryptedEmail = Crypt::encryptString($request->email);

        $link = URL::temporarySignedRoute(
            'admin.reset-password',
            now()->addMinutes(15),
            ['encrypted' => $encryptedEmail]
        );

        Mail::to($request->email)->send(new AdminForgotPassword($link));

        return response()->json(['message' => 'Password reset link sent to your email.']);
    }

    public function AdminResetForgetPassword($encrypted)
    {
        try {
            $email = Crypt::decryptString($encrypted);

            $admin = Admin::where('email', $email)->firstOrFail();

            return view('admin.reset-password', ['email' => $email]);

        } catch (\Exception $e) {
            abort(403, 'Invalid or expired link.');
        }
    }

    public function AdminSetForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);

        try {
            $admin = Admin::where('email', $request->email)->first();

            if (! $admin) {
                return redirect()->back()->withErrors(['email' => 'Something went wrong.']);
            }

            $admin->password = Hash::make($request->password);
            $admin->save();

            return redirect('admin-login')->with('success', 'Password reset successfully.');
        } catch (\Exception $e) {
            Log::error('Admin password reset failed: '.$e->getMessage());

            return redirect()->back()->withErrors(['email' => 'An unexpected error occurred.']);
        }
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

    public function familyList(Request $request)
    {
        $heads = UserRegistration::withoutGlobalScopes()
            ->whereIn('op_status', [0, 1])
            ->orderBy('id', 'desc')
            ->paginate(10);
        foreach ($heads as $head) {
            $head->encrypted_id = urlencode(Crypt::encrypt($head->id));
        }
        if ($request->ajax()) {
            return view('Auth.Admin-login.family-table', compact('heads'))->render();
        }

        return view('Auth.Admin-login.family-list', compact('heads'));
    }

    public function memberList(Request $request)
    {
        $members = Member::withoutGlobalScopes()
            ->whereIn('op_status', [0, 1])
            ->orderBy('id', 'desc')
            ->paginate(10);

        foreach ($members as $member) {
            $member->encrypted_id = urlencode(Crypt::encrypt($member->id));
        }

        if ($request->ajax()) {
            return view('Auth.Admin-login.member-table', compact('members'))->render();
        }

        return view('Auth.Admin-login.member-list', compact('members'));
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

    public function exportPDFSearchHead(Request $request)
    {
        $search = $request->query('search');
        $families = UserRegistration::with('members')
            ->where('name', 'like', "%$search%")
            ->orWhere('mobile_number', 'like', "%$search%")
            ->orWhere('state', 'like', "%$search%")
            ->orWhere('city', 'like', "%$search%")
            ->get();

        $pdf = PDF::loadView('Auth.Admin-login.search-view-family-details-pdf', compact('families'));

        return $pdf->download('Filtered_Family_Details.pdf');
    }

    public function exportExcelSearchHead(Request $request)
    {
        $search = $request->query('search');

        $families = UserRegistration::with('members')
            ->where('name', 'like', "%$search%")
            ->orWhere('mobile_number', 'like', "%$search%")
            ->orWhere('state', 'like', "%$search%")
            ->orWhere('city', 'like', "%$search%")
            ->get();

        return Excel::download(new SearchFamilyDetailsExcel($families), 'Filtered_Family_Details.xlsx');
    }

    public function StateList(Request $request)
    {
        $states = State::withoutGlobalScopes()
            ->whereIn('op_status', [0, 1])
            ->orderBy('state_id', 'desc')
            ->paginate(10);

        foreach ($states as $state) {
            $state->encrypted_id = urlencode(Crypt::encrypt($state->state_id));
        }
        if ($request->ajax()) {
            return view('Auth.Admin-login.state-table', compact('states'))->render();
        }

        return view('Auth.Admin-login.state-list', compact('states'));
    }

    public function CityList(Request $request)
    {
        $cities = City::withoutGlobalScopes()
            ->whereIn('op_status', [0, 1])
            ->orderBy('city_id', 'desc')
            ->paginate(10);

        foreach ($cities as $city) {
            $city->encrypted_city_id = urlencode(Crypt::encrypt($city->city_id));
        }

        if ($request->ajax()) {
            return view('Auth.Admin-login.city-table', compact('cities'))->render();
        }

        return view('Auth.Admin-login.city-list', compact('cities'));
    }

    public function redirectToEncryptedSearch(Request $request, $type)
    {
        $search = $request->input('search');

        if (! $search) {
            return redirect()->route('search-'.$type);
        }

        $encryptedSearch = base64_encode(Crypt::encryptString($search));

        return redirect()->route('search-'.$type, ['search' => $encryptedSearch]);
    }

    public function searchHead(Request $request, $encrypted = null)
    {
        $search = '';

        if ($encrypted) {
            try {
                $search = Crypt::decryptString(base64_decode($encrypted));
            } catch (DecryptException $e) {
                $search = '';
            }
        }

        $searchData = UserRegistration::where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('mobile_number', 'like', "%{$search}%")
                ->orWhere('state', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%");
        })
            ->whereIn('op_status', [0, 1])
            ->paginate(10)
            ->appends(['search' => $encrypted]);

        if ($request->ajax()) {
            return view('Auth.Admin-login.searchHead-table', compact('searchData'))->render();
        }

        return view('Auth.Admin-login.search-head', [
            'searchData' => $searchData,
            'search' => $search,
        ]);
    }

    public function searchMember(Request $request, $encrypted = null)
    {
        $search = '';

        if ($encrypted) {
            try {
                $search = Crypt::decryptString(base64_decode($encrypted));
            } catch (DecryptException $e) {
                $search = '';
            }
        }

        $searchData = Member::where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })
            ->whereIn('op_status', [0, 1])
            ->paginate(10)
            ->appends(['search' => $encrypted]);

        if ($request->ajax()) {
            return view('Auth.Admin-login.searchMember-table', compact('searchData'))->render();
        }

        return view('Auth.Admin-login.search-member', [
            'searchData' => $searchData,
            'search' => $search,
        ]);
    }

    public function searchState(Request $request, $encrypted = null)
    {
        $search = '';

        if ($encrypted) {
            try {
                $search = Crypt::decryptString(base64_decode($encrypted));
            } catch (DecryptException $e) {
                $search = '';
            }
        }

        $searchData = State::where(function ($query) use ($search) {
            $query->where('state_name', 'like', "%{$search}%");
        })
            ->whereIn('op_status', [0, 1])
            ->paginate(10)
            ->appends(['search' => $encrypted]);

        if ($request->ajax()) {
            return view('Auth.Admin-login.searchState-table', compact('searchData'))->render();
        }

        return view('Auth.Admin-login.search-state', [
            'searchData' => $searchData,
            'search' => $search,
        ]);
    }

    public function searchCity(Request $request, $encrypted = null)
    {
        $search = '';

        if ($encrypted) {
            try {
                $search = Crypt::decryptString(base64_decode($encrypted));
            } catch (DecryptException $e) {
                $search = '';
            }
        }

        $searchData = City::where(function ($query) use ($search) {
            $query->where('city_name', 'like', "%{$search}%");
        })
            ->whereIn('op_status', [0, 1])
            ->paginate(10)
            ->appends(['search' => $encrypted]);

        if ($request->ajax()) {
            return view('Auth.Admin-login.searchCity-table', compact('searchData'))->render();
        }

        return view('Auth.Admin-login.search-city', [
            'searchData' => $searchData,
            'search' => $search,
        ]);
    }

    public function logout()
    {
        Session::forget('admin');

        return redirect('/admin-login');
    }

    public function addState(Request $request)
    {
        $request->validate([
            'state_name' => 'required|unique:states,state_name',
        ]);

        $state = State::create([
            'state_name' => $request->state_name,
        ]);

        AdminAction::create([
            'admin_id' => auth()->id(),
            'action' => 'State Added',
            'resource_type' => 'State',
            'resource_id' => $state->state_id,
            'details' => json_encode(['ip_address' => $request->ip()]),
        ]);

        return response()->json([
            'message' => 'State added successfully!',
            'state_id' => $state->state_id,
            'state_name' => $state->state_name,
        ]);
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

    public function showAddCityForm(Request $request)
    {
        $state_id = $request->query('state_id');
        $state_name = $request->query('state_name');

        return view('add-city', compact('state_id', 'state_name'));
    }

    public function addCity(Request $request)
    {
        $request->validate([
            'state_id' => 'required|exists:states,state_id',
            'city_name' => [
                'required',
                Rule::unique('cities')->where(function ($query) use ($request) {
                    return $query->where('state_id', $request->state_id);
                }),
            ],
        ], [
            'city_name.required' => 'City name is required.',
            'city_name.unique' => 'This city already exists in the selected state.',
        ]);

        $city = City::create([
            'state_id' => $request->state_id,
            'city_name' => $request->city_name,
        ]);

        AdminAction::create([
            'admin_id' => auth()->id(),
            'action' => 'City Added',
            'resource_type' => 'City',
            'resource_id' => $city->city_id,
            'details' => json_encode(['ip_address' => $request->ip()]),
        ]);

        return redirect()->route('view-state-details', ['state_id' => $request->state_id])
            ->with('city', 'City added successfully!');
    }

    public function checkCity(Request $request)
    {
        $exists = City::where('state_id', $request->state_id)
            ->where('city_name', $request->city_name)
            ->exists();

        if ($exists) {
            return response()->json('This city name already exists in the selected state');
        } else {
            return response()->json(true);
        }
    }

    public function editFamilyHead($encrypted_id)
    {
        $id = Crypt::decrypt(urldecode($encrypted_id));
        $familyHead = UserRegistration::with('members')->findOrFail($id);
        $states = State::select('state_id', 'state_name')->get();

        $hobbies = json_decode($familyHead->hobby ?? '[]', true);

        $familyHead->encrypted_id = urlencode(Crypt::encrypt($familyHead->id));

        return view('/Auth/Admin-login/edit-family-head', [
            'familyHead' => $familyHead,
            'states' => $states,
            'hobbies' => $hobbies,
        ]);
    }

    public function editFamilyHeadData(Request $request, $id)
    {
        $heads = UserRegistration::findOrFail($id);
        $cutDate = Carbon::now()->subYears(21)->format('Y-m-d');

        $request->validate([
            'head.name' => 'required|max:50',
            'head.surname' => 'required|max:50',
            'head.birthdate' => 'required|date|before_or_equal:'.$cutDate,
            'head.mobile_number' => 'required|numeric|digits:10|unique:UserRegistration,mobile_number,'.$id,
            'head.address' => 'required',
            'head.state' => 'required',
            'head.city' => 'required',
            'head.pincode' => 'required|digits:6',
            'head.status' => 'required|in:married,unmarried',
            'head.wedding_date' => 'nullable|date',

            'hobbies' => 'nullable|array|min:1',
            'hobbies.*' => 'required|string|max:50',

            'head.photo' => 'nullable|image|mimes:jpg,png|max:2048',

            'members' => 'nullable|array',
            'members.*.id' => 'nullable|integer',
            'members.*.name' => 'required|max:50',
            'members.*.birthdate' => 'required|date',
            'members.*.status' => 'required|in:married,unmarried',
            'members.*.wedding_date' => 'nullable|date',
            'members.*.education' => 'nullable|string|max:100',
            'members.*.relation' => 'required|string|max:50',
            'members.*.photo' => 'nullable|image|mimes:jpg,png|max:2048',

            'members_to_delete' => 'nullable|array',
            'members_to_delete.*' => 'integer',
        ], [
            'head.birthdate.before_or_equal' => 'Family head must be 21 years or older.',
            'hobbies.min' => 'At least one hobby is required.',
        ]);

        $headData = $request->input('head');

        $heads->name = $headData['name'];
        $heads->surname = $headData['surname'];
        $heads->birthdate = $headData['birthdate'];
        $heads->mobile_number = $headData['mobile_number'];
        $heads->address = $headData['address'];

        $state = State::select('state_name')->where('state_id', $headData['state'])->first();
        $heads->state = $state ? $state->state_name : $headData['state'];

        $heads->city = $headData['city'];
        $heads->pincode = $headData['pincode'];
        $heads->status = $headData['status'];
        $heads->wedding_date = ($headData['status'] == 'married') ? $headData['wedding_date'] : null;

        $heads->hobby = json_encode($request->input('hobbies', []));

        if ($request->hasFile('head.photo')) {
            $file = $request->file('head.photo');

            if ($heads->photo) {
                Storage::disk('public')->delete($heads->photo);
            }

            $path = $file->store('photos', 'public');
            $heads->photo = $path;
        }

        if ($heads->save()) {

            $membersToDelete = $request->input('members_to_delete', []);
            if (! empty($membersToDelete)) {
                $deletedMembers = Member::whereIn('id', $membersToDelete)->get();
                foreach ($deletedMembers as $member) {
                    if ($member->photo) {
                        Storage::disk('public')->delete($member->photo);
                    }
                }
                Member::whereIn('id', $membersToDelete)->delete();
            }

            $memberFiles = $request->file('members') ?? [];
            if ($request->has('members')) {
                foreach ($request->input('members') as $index => $memberData) {

                    if (isset($memberData['id'])) {
                        $member = Member::findOrFail($memberData['id']);
                    } else {
                        $member = new Member;
                        $member->head_id = $heads->id;
                    }

                    $member->name = $memberData['name'];
                    $member->birthdate = $memberData['birthdate'];
                    $member->status = $memberData['status'];
                    $member->wedding_date = ($memberData['status'] == 'married') ? ($memberData['wedding_date'] ?? null) : null;
                    $member->education = $memberData['education'] ?? null;
                    $member->relation = $memberData['relation'] ?? null;

                    if (isset($memberFiles[$index]['photo'])) {
                        $file = $memberFiles[$index]['photo'];
                        if ($member->photo) {
                            Storage::disk('public')->delete($member->photo);
                        }
                        $path = $file->store('photos', 'public');
                        $member->photo = $path;
                    }

                    $member->save();
                }
            }

            Session::flash('heads', 'Head updated Successfully.');
            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'Head edited',
                'resource_type' => 'head',
                'resource_id' => $heads->id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            return response()->json(['message' => 'Update successful', 'redirect_url' => route('view-family-details', ['id' => $id])], 200);

        } else {
            return response()->json(['message' => 'Something went wrong while saving head data.'], 500);
        }
    }

    public function addFamilyMemberFormAdmin($head_id)
    {

        return view('/Auth/Admin-login/add-family-member-admin', compact('head_id'));
    }

    public function addFamilyMemberAdmin(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'birthdate' => 'required|date|before:today',
            'status' => 'required|in:married,unmarried',
            'wedding_date' => 'nullable|date|required_if:status,married',
            'education' => 'nullable|string|max:100',
            'relation' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $member = new Member;
        $member->head_id = $request->head_id;
        $member->name = $request->name;
        $member->birthdate = $request->birthdate;
        $member->status = $request->status;
        $member->wedding_date = $request->status === 'married' ? $request->wedding_date : null;
        $member->education = $request->education;
        $member->relation = $request->relation;

        if ($request->hasFile('photo')) {
            $filename = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/'), $filename);
            $member->photo = $filename;
        }

        $member->save();

        return response()->json(['message' => 'Family member added successfully!']);
    }

    public function editFamilyMember($encrypted_head_id, $id)
    {
        try {
            $head_id = Crypt::decrypt(urldecode($encrypted_head_id));
        } catch (\Exception $e) {
            abort(404, 'Invalid ID.');
        }

        $member = Member::where('head_id', $head_id)->findOrFail($id);

        return view('Auth.Admin-login.edit-family-member', [
            'member' => $member,
            'encrypted_head_id' => $encrypted_head_id,
        ]);
    }

    public function editFamilyMemberData(Request $request, $encrypted_head_id, $id)
    {
        $head_id = Crypt::decrypt(urldecode($encrypted_head_id));
        $member = Member::where('head_id', $head_id)->findOrFail($id);
        $cutDate = Carbon::now()->subYears(21);
        $validation = $request->validate([
            'name' => 'required|max:50',
            'birthdate' => 'required|date',
            'status' => 'required',
            'education' => 'nullable',
            'relation' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        $member->name = $request->name;
        $member->birthdate = $request->birthdate;
        $member->status = $request->status;
        $member->wedding_date = $request->wedding_date;
        $member->education = $request->education;
        $member->relation = $request->relation;
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

        return redirect()->route('view-family-details', [
            'id' => urlencode(Crypt::encrypt($head_id)),
        ]);
    }

    public function editFamilyMemberFromList($encrypted_id)
    {
        $id = Crypt::decrypt(urldecode($encrypted_id));
        $member = Member::findOrFail($id);

        return view('/Auth/Admin-login/edit-family-member', ['member' => $member]);
    }

    public function editFamilyMemberDataFromList(Request $request, $encrypted_id)
    {
        $id = Crypt::decrypt(urldecode($encrypted_id));
        $member = Member::findOrFail($id);
        $cutDate = Carbon::now()->subYears(21);
        $validation = $request->validate([
            'name' => 'required|max:50',
            'birthdate' => 'required|date',
            'status' => 'required',
            'education' => 'nullable',
            'relation' => 'requird',
            'photo' => 'nullable|image|mimes:jpg,png|max:2048',
        ], [
            'birthdate.before_or_equal' => 'Family member must be 21 years or older',
        ]);

        $member->name = $request->name;
        $member->birthdate = $request->birthdate;
        $member->status = $request->status;
        $member->wedding_date = $request->wedding_date;
        $member->education = $request->education;
        $member->relation = $request->relation;

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

        return redirect()->route('view-family-details', ['id' => $id]);
    }

    public function viewFamilyDetails($encrypted_id, Request $request)
    {
        $id = Crypt::decrypt(urldecode($encrypted_id));
        $head = UserRegistration::findOrFail($id);
        $members = $head->members()->paginate(10);

        $head->encrypted_id = urlencode(Crypt::encrypt($head->id));

        return view('Auth.Admin-login.view-family-details', [
            'head' => $head,
            'members' => $members,
            'head_id' => $encrypted_id,
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

    public function viewStateDetails($encrypted_id, Request $request)
    {
        $id = Crypt::decrypt(urldecode($encrypted_id));
        $state = State::findOrFail($id);
        $cities = $state->cities()->paginate(10);

        return view('Auth.Admin-login.view-state-details', [
            'state' => $state,
            'cities' => $cities,
            'stateId' => $encrypted_id,
        ]);

    }

    public function editState($encrypted_state_id)
    {
        try {
            $state_id = Crypt::decrypt(urldecode($encrypted_state_id));
            $stateDetails = State::findOrFail($state_id);

            return view('Auth.Admin-login.edit-state', ['stateDetails' => $stateDetails]);

        } catch (\Exception $e) {
            return redirect()->route('view-state-details')->with('error', 'Invalid State ID or State not found.');
        }
    }

    public function editStateData(Request $request, $encrypted_state_id)
    {
        $state_id = Crypt::decrypt(urldecode($encrypted_id));
        $stateDetails = State::findOrFail($state_id);

        $validator = \Validator::make($request->all(), [
            'state_name' => [
                'required',
                Rule::unique('states')->ignore($state_id, 'state_id'),
            ],
        ]);

        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $stateDetails->state_name = $request->state_name;

        if ($stateDetails->save()) {
            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'State edited',
                'resource_type' => 'state',
                'resource_id' => $stateDetails->state_id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            if ($request->ajax()) {
                return response()->json(['message' => 'State updated successfully!']);
            }

            Session::flash('$stateDetails', 'State updated Successfully.');

            return redirect()->route('view-state-details', ['state_id' => $encrypted_state_id]);
        } else {
            if ($request->ajax()) {
                return response()->json(['message' => 'Something went wrong'], 500);
            }

            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function editCity($state_id, $city_id)
    {
        $city = City::where('state_id', $state_id)->findOrFail($city_id);
        $state = State::findOrFail($state_id);

        return view('Auth.Admin-login.edit-city', [
            'city' => $city,
            'state' => $state,
        ]);
    }

    public function editCityData(Request $request, $state_id, $city_id)
    {
        $city = City::where('state_id', $state_id)->findOrFail($city_id);

        $validator = \Validator::make($request->all(), [
            'city_name' => [
                'required',
                Rule::unique('cities')->where(fn ($query) => $query->where('state_id', $state_id))->ignore($city_id, 'city_id'),
            ],
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $city->city_name = $request->city_name;

        if ($city->save()) {
            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'City edited',
                'resource_type' => 'city',
                'resource_id' => $city->city_id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            if ($request->ajax()) {
                return response()->json(['message' => 'City updated successfully!']);
            }

            Session::flash('city', 'City updated Successfully.');

            return redirect()->route('view-state-details', ['state_id' => $state_id]);
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function deleteStateDetails($state_id, Request $request)
    {
        $state = State::findOrFail($state_id);
        $state->update(['op_status' => 9]);
        $state->delete();
        AdminAction::create([
            'admin_id' => auth()->id(),
            'action' => 'State deleted',
            'resource_type' => 'state',
            'resource_id' => $state->state_id,
            'details' => json_encode(['ip_address' => $request->ip()]),
        ]);

        return redirect('/state-list')
            ->with('success', $state->state_name.' successfully deleted.');
    }

    public function editCityFromList($encrypted_city_id)
    {
        $city_id = Crypt::decrypt(urldecode($encrypted_city_id));
        $city = City::findOrFail($city_id);

        return view('Auth.Admin-login.edit-city-from-list', ['city' => $city]);
    }

    public function editCityDataFromList(Request $request, $city_id)
    {
        $city = City::findOrFail($city_id);

        $validator = \Validator::make($request->all(), [
            'city_name' => [
                'required',
                Rule::unique('cities')->ignore($city_id, 'city_id'),
            ],
        ]);

        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $city->city_name = $request->city_name;
        if ($city->save()) {

            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'City edited',
                'resource_type' => 'city',
                'resource_id' => $city->city_id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            if ($request->ajax()) {
                return response()->json(['message' => 'City updated successfully!']);
            }

            Session::flash('city', 'City updated Successfully.');

            return redirect('city-list');
        } else {
            if ($request->ajax()) {
                return response()->json(['message' => 'Something went wrong'], 500);
            }

            return redirect()->back()->with('error', 'Something went wrong');
        }
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

    public function index()
    {
        $logs = AdminAction::with('admin')->latest()->paginate(10);

        return $logs;
    }
}
