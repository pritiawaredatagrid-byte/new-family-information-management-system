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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Mail;

class AdminController extends Controller
{
    protected $baseViewPath = 'Auth.Admin-login';

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
            'email' => 'required|email|exists:admin,email',
        ]);

        $user = Admin::where('email', $request->email)->first();

        $token = Password::broker('admin')->createToken($user);

        $link = url('/admin-reset-password?email='.urlencode(Crypt::encryptString($user->email)).'&token='.$token);

        Mail::to($user->email)->send(new AdminForgotPassword($link));

        return response()->json(['message' => 'Password reset link sent!']);
    }

    public function AdminResetForgetPassword(Request $request)
    {
        $email = Crypt::decryptString(urldecode($request->query('email')));
        $token = $request->query('token');

        if (! $email || ! $token) {
            abort(403, 'Invalid or expired reset link.');
        }

        return view('admin-set-forget-password', [
            'email' => $email,
            'token' => $token,
        ]);
    }

    public function AdminSetForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admin,email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');

        $status = Password::broker('admin')->reset($credentials, function ($admin, $password) {
            $admin->password = Hash::make($password);
            $admin->save();
        });

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successfully.']);
        }

        return response()->json([
            'errors' => ['email' => ['Invalid token or email.']],
        ], 422);
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
            return view($this->baseViewPath.'.admin', [
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
            $head->encrypted_id = Crypt::encrypt($head->id);
        }
        if ($request->ajax()) {
            return view($this->baseViewPath.'.family-table', compact('heads'))->render();
        }

        return view($this->baseViewPath.'.family-list', compact('heads'));
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
            return view($this->baseViewPath.'.member-table', compact('members'))->render();
        }

        return view($this->baseViewPath.'.member-list', compact('members'));
    }

    public function exportPDF()
    {

        $families = UserRegistration::with('members')->get();

        $pdf = PDF::loadView($this->baseViewPath.'.view-family-details-pdf', compact('families'));

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

        $pdf = PDF::loadView($this->baseViewPath.'.search-view-family-details-pdf', compact('families'));

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
            return view($this->baseViewPath.'.state-table', compact('states'))->render();
        }

        return view($this->baseViewPath.'.state-list', compact('states'));
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
            return view($this->baseViewPath.'.city-table', compact('cities'))->render();
        }

        return view($this->baseViewPath.'.city-list', compact('cities'));
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

        if (! empty($encrypted)) {
            try {
                $search = Crypt::decryptString(base64_decode($encrypted));
            } catch (DecryptException $e) {
                $search = '';
            }
        }

        $query = UserRegistration::whereIn('op_status', [0, 1]);

        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('mobile_number', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        $searchData = $query->paginate(10)->appends(['search' => $encrypted]);

        if ($request->ajax()) {
            return view($this->baseViewPath.'.searchHead-table', compact('searchData'))->render();
        }

        return view($this->baseViewPath.'.search-head', [
            'searchData' => $searchData,
            'search' => $search,
        ]);
    }

    public function searchMember(Request $request, $encrypted = null)
    {
        $search = '';

        if (! empty($encrypted)) {
            try {
                $search = Crypt::decryptString(base64_decode($encrypted));
            } catch (DecryptException $e) {
                $search = '';
            }
        }

        $query = Member::whereIn('op_status', [0, 1]);

        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $searchData = $query->paginate(10)->appends(['search' => $encrypted]);

        if ($request->ajax()) {
            return view($this->baseViewPath.'.searchMember-table', compact('searchData'))->render();
        }

        return view($this->baseViewPath.'.search-member', [
            'searchData' => $searchData,
            'search' => $search,
        ]);
    }

    public function searchState(Request $request, $encrypted = null)
    {
        $search = '';

        if (! empty($encrypted)) {
            try {
                $search = Crypt::decryptString(base64_decode($encrypted));
            } catch (DecryptException $e) {
                $search = '';
            }
        }

        $query = State::whereIn('op_status', [0, 1]);

        if (! empty($search)) {
            $query->where('state_name', 'like', "%{$search}%");
        }

        $searchData = $query->paginate(10)->appends(['search' => $encrypted]);

        if ($request->ajax()) {
            return view($this->baseViewPath.'.searchState-table', compact('searchData'))->render();
        }

        return view($this->baseViewPath.'.search-state', [
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
            return view($this->baseViewPath.'.searchCity-table', compact('searchData'))->render();
        }

        return view($this->baseViewPath.'.search-city', [
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

        DB::beginTransaction();

        try {

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

            DB::commit();

            return response()->json([
                'message' => 'State added successfully!',
                'state_id' => $state->state_id,
                'state_name' => $state->state_name,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Failed to add state.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function addStates()
    {
        $states = State::select('state_id', 'state_name')->get();

        return view($this->baseViewPath.'.user-registration-admin', compact('states'));
    }

    public function addStates_state()
    {
        $states = State::select('state_id', 'state_name')->get();

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
        $encryptedStateName = $request->query('state_name');
        $encryptedStateId = $request->query('state_id');

        if (! $encryptedStateName || ! $encryptedStateId) {
            return redirect()->back()->with('error', 'Missing state details.');
        }

        try {
            $stateName = Crypt::decrypt(urldecode($encryptedStateName));
            $stateId = Crypt::decrypt(urldecode($encryptedStateId));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid or expired state details.');
        }

        return view('add-city', [
            'state_name' => $stateName,
            'state_id' => $stateId,
            'encrypted_state_id' => $encryptedStateId,
            'encrypted_state_name' => $encryptedStateName,
        ]);
    }

    public function addCity(Request $request)
    {
        $request->validate([
            'state_id' => 'required|exists:states,state_id',
            'city_name' => [
                'required',
                Rule::unique('cities')->where(fn ($q) => $q->where('state_id', $request->state_id)),
            ],
        ], [
            'city_name.required' => 'City name is required.',
            'city_name.unique' => 'This city already exists in the selected state.',
        ]);

        try {
            DB::beginTransaction();

            $city = City::create([
                'state_id' => $request->state_id,
                'city_name' => $request->city_name,
            ]);

            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'City Added',
                'resource_type' => 'City',
                'resource_id' => $city->city_id,
                'details' => json_encode([
                    'ip_address' => $request->ip(),
                ]),
            ]);

            DB::commit();

            return redirect()->route('view-state-details', [
                'encrypted_state_id' => urlencode(Crypt::encrypt($request->state_id)),
            ])->with('city', 'City added successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Failed to add city. Please try again.']);
        }
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

        return view($this->baseViewPath.'.edit-family-head', [
            'familyHead' => $familyHead,
            'states' => $states,
            'hobbies' => $hobbies,
        ]);
    }

    public function editFamilyHeadData(Request $request, $encrypted_id)
    {
        $id = Crypt::decrypt(urldecode($encrypted_id));
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

        DB::beginTransaction();

        try {
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

            $heads->save();

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

            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'Head edited',
                'resource_type' => 'head',
                'resource_id' => $heads->id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            DB::commit();

            Session::flash('heads', 'Head updated Successfully.');

            return response()->json([
                'message' => 'Update successful',
                'redirect_url' => route('view-family-details', ['encrypted_id' => $encrypted_id]),
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Something went wrong while updating the data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function addFamilyMemberFormAdmin($encrypted_id)
    {
        try {
            $head_id = Crypt::decrypt($encrypted_id);
        } catch (\Exception $e) {
            abort(404, 'Invalid ID.');
        }

        return view($this->baseViewPath.'.add-family-member-admin', [
            'encrypted_id' => $encrypted_id,
        ]);
    }

    public function addFamilyMemberAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'birthdate' => 'required|date|before:today',
            'status' => 'required|in:married,unmarried',
            'wedding_date' => 'nullable|date|required_if:status,married|before:today',
            'education' => 'nullable|string|max:100',
            'relation' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png|max:2048',
            'encrypted_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $head_id = Crypt::decrypt($request->encrypted_id);
        } catch (\Exception $e) {
            return response()->json(['errors' => ['head_id' => ['Invalid Head ID']]], 422);
        }

        DB::beginTransaction();

        try {
            $member = new Member;
            $member->head_id = $head_id;
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

            DB::commit();

            return response()->json(['message' => 'Family member added successfully!']);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to add family member.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function editFamilyMember($encrypted_id, $id)
    {
        try {
            $head_id = Crypt::decrypt(urldecode($encrypted_id));
        } catch (\Exception $e) {
            abort(404, 'Invalid encrypted ID.');
        }

        $member = Member::where('head_id', $head_id)->findOrFail($id);

        return view($this->baseViewPath.'.edit-family-member', [
            'member' => $member,
            'encrypted_id' => $encrypted_id,
        ]);
    }

    public function editFamilyMemberData(Request $request, $encrypted_id, $id)
    {
        $head_id = Crypt::decrypt(urldecode($encrypted_id));
        $member = Member::where('head_id', $head_id)->findOrFail($id);

        $cutDate = Carbon::now()->subYears(21);

        $request->validate([
            'name' => 'required|max:50',
            'birthdate' => 'required|date|before:today',
            'status' => 'required|in:married,unmarried',
            'wedding_date' => 'nullable|date|required_if:status,married|before:today',
            'education' => 'nullable|string|max:100',
            'relation' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $member->name = $request->name;
            $member->birthdate = $request->birthdate;
            $member->status = $request->status;
            $member->wedding_date = $request->status === 'married' ? $request->wedding_date : null;
            $member->education = $request->education;
            $member->relation = $request->relation;

            if ($request->hasFile('photo')) {

                if ($member->photo) {
                    Storage::disk('public')->delete($member->photo);
                }

                $photoPath = $request->file('photo')->store('photos', 'public');
                $member->photo = $photoPath;
            }

            $member->save();

            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'Member edited',
                'resource_type' => 'member',
                'resource_id' => $member->id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            DB::commit();

            Session::flash('member', 'Member updated successfully.');

            return redirect()->route('view-family-details', [
                'encrypted_id' => $encrypted_id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Something went wrong while updating member.']);
        }
    }

    public function editFamilyMemberFromList($encrypted_id)
    {
        $id = Crypt::decrypt(urldecode($encrypted_id));
        $member = Member::findOrFail($id);

        return view($this->baseViewPath.'.edit-family-member', ['member' => $member]);
    }

    public function editFamilyMemberDataFromList(Request $request, $encrypted_id)
    {
        $id = Crypt::decrypt(urldecode($encrypted_id));
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:50',
            'birthdate' => 'required|date|before:today',
            'status' => 'required|in:married,unmarried',
            'wedding_date' => 'nullable|date|required_if:status,married|before:today',
            'education' => 'nullable|string|max:100',
            'relation' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpg,png|max:2048',
        ], [
            'birthdate.before' => 'Birthdate must be a past date.',
            'wedding_date.before' => 'Wedding date must be a past date.',
            'wedding_date.required_if' => 'Wedding date is required if member is married.',
        ]);

        DB::beginTransaction();

        try {
            $member->name = $request->name;
            $member->birthdate = $request->birthdate;
            $member->status = $request->status;
            $member->wedding_date = $request->status === 'married' ? $request->wedding_date : null;
            $member->education = $request->education;
            $member->relation = $request->relation;

            if ($request->hasFile('photo')) {

                if ($member->photo) {
                    Storage::disk('public')->delete($member->photo);
                }

                $photoPath = $request->file('photo')->store('photos', 'public');
                $member->photo = $photoPath;
            }

            $member->save();

            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'Member edited',
                'resource_type' => 'member',
                'resource_id' => $member->id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            DB::commit();

            Session::flash('member', 'Member updated successfully.');

            return redirect()->route('view-family-details', ['id' => $encrypted_id]);

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Something went wrong while updating member.']);
        }
    }

    public function viewFamilyDetails($encrypted_id, Request $request)
    {
        try {
            $id = Crypt::decrypt($encrypted_id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(403, 'Invalid encrypted ID.');
        }

        $head = UserRegistration::findOrFail($id);
        $members = $head->members()->paginate(10);

        $head->encrypted_id = Crypt::encrypt($head->id);

        return view($this->baseViewPath.'.view-family-details', [
            'head' => $head,
            'members' => $members,
            'encrypted_id' => $encrypted_id,
        ]);
    }

    public function deleteFamilyDetails($id, Request $request)
    {
        DB::beginTransaction();

        try {
            $head = UserRegistration::with('members')->findOrFail($id);
            $head->update(['op_status' => 9]);

            if ($head->members) {
                foreach ($head->members as $member) {
                    $member->delete();
                }
            }

            $head->delete();

            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'Head deleted',
                'resource_type' => 'head',
                'resource_id' => $head->id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            DB::commit();

            return redirect('/family-list')
                ->with('success', $head->name."'s family details successfully deleted.");

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Family deletion failed: '.$e->getMessage());

            return redirect('/family-list')
                ->withErrors(['error' => 'Failed to delete family details. Please try again.']);
        }
    }

    public function deleteFamilyMember($encrypted_id, Request $request)
    {
        DB::beginTransaction();

        try {
            $id = Crypt::decrypt($encrypted_id);
            $member = Member::findOrFail($id);

            $member->update(['op_status' => 9]);

            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }

            $member->delete();

            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'Member deleted',
                'resource_type' => 'member',
                'resource_id' => $id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            DB::commit();

            return redirect('/member-list')
                ->with('success', $member->name.' successfully deleted.');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to delete family member: '.$e->getMessage());

            return redirect('/member-list')
                ->withErrors(['error' => 'Failed to delete member. Please try again.']);
        }
    }

    public function viewStateDetails($encrypted_state_id, Request $request)
    {
        $id = Crypt::decrypt(urldecode($encrypted_state_id));
        $state = State::findOrFail($id);
        $cities = $state->cities()->paginate(10);

        return view($this->baseViewPath.'.view-state-details', [
            'state' => $state,
            'cities' => $cities,
            'encrypted_state_id' => $encrypted_state_id,
        ]);

    }

    public function editState($encrypted_state_id)
    {
        try {
            $state_id = Crypt::decrypt(urldecode($encrypted_state_id));
            $stateDetails = State::findOrFail($state_id);

            return view($this->baseViewPath.'.edit-state', ['stateDetails' => $stateDetails]);

        } catch (\Exception $e) {
            return redirect()->route('view-state-details')->with('error', 'Invalid State ID or State not found.');
        }
    }

    public function editStateData(Request $request, $encrypted_state_id)
    {
        $state_id = Crypt::decrypt(urldecode($encrypted_state_id));
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

        DB::beginTransaction();

        try {
            $stateDetails->state_name = $request->state_name;

            if (! $stateDetails->save()) {
                throw new \Exception('Failed to save state details');
            }

            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'State edited',
                'resource_type' => 'state',
                'resource_id' => $stateDetails->state_id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            DB::commit();

            if ($request->ajax()) {
                return response()->json(['message' => 'State updated successfully!']);
            }

            Session::flash('stateDetails', 'State updated Successfully.');

            return redirect()->route('view-state-details', ['encrypted_state_id' => $encrypted_state_id]);

        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json(['message' => 'Something went wrong: '.$e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    public function editCity($encrypted_state_id, $city_id)
    {
        try {
            $state_id = Crypt::decrypt(urldecode($encrypted_state_id));

            $city = City::where('state_id', $state_id)->findOrFail($city_id);
            $state = State::findOrFail($state_id);

            return view($this->baseViewPath.'.edit-city', [
                'city' => $city,
                'state' => $state,
                'encrypted_state_id' => $encrypted_state_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid or expired state ID.');
        }
    }

    public function editCityData(Request $request, $encrypted_state_id, $city_id)
    {
        try {
            $state_id = Crypt::decrypt(urldecode($encrypted_state_id));
            $city = City::where('state_id', $state_id)->findOrFail($city_id);

            $validator = \Validator::make($request->all(), [
                'city_name' => [
                    'required',
                    Rule::unique('cities')->where(
                        fn ($query) => $query->where('state_id', $state_id)
                    )->ignore($city_id, 'city_id'),
                ],
            ]);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $city->city_name = $request->city_name;

            if (! $city->save()) {
                throw new \Exception('Failed to update city.');
            }

            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'City edited',
                'resource_type' => 'city',
                'resource_id' => $city->city_id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            DB::commit();

            if ($request->ajax()) {
                return response()->json(['message' => 'City updated successfully!']);
            }

            Session::flash('city', 'City updated successfully.');

            return redirect()->route('view-state-details', [
                'encrypted_state_id' => $encrypted_state_id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json(['message' => 'Something went wrong: '.$e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    public function deleteStateDetails($state_id, Request $request)
    {
        DB::beginTransaction();

        try {
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

            DB::commit();

            return redirect('/state-list')
                ->with('success', $state->state_name.' successfully deleted.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('/state-list')
                ->with('error', 'Failed to delete state: '.$e->getMessage());
        }
    }

    public function editCityFromList($encrypted_city_id)
    {
        $city_id = Crypt::decrypt(urldecode($encrypted_city_id));
        $city = City::findOrFail($city_id);

        return view($this->baseViewPath.'.edit-city-from-list', ['city' => $city]);
    }

    public function editCityDataFromList(Request $request, $city_id)
    {
        DB::beginTransaction();

        try {
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

            if (! $city->save()) {
                throw new \Exception('Failed to save city');
            }

            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'City edited',
                'resource_type' => 'city',
                'resource_id' => $city->city_id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            DB::commit();

            if ($request->ajax()) {
                return response()->json(['message' => 'City updated successfully!']);
            }

            Session::flash('city', 'City updated successfully.');

            return redirect('city-list');

        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json(['message' => 'Error: '.$e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    public function deleteCity($encrypted_city_id, Request $request)
    {
        DB::beginTransaction();
        try {
            $city_id = Crypt::decrypt($encrypted_city_id);
            $city = City::findOrFail($city_id);

            $state_id = $city->state_id;

            $city->op_status = 9;
            $city->save();

            $city->delete();

            AdminAction::create([
                'admin_id' => auth()->id(),
                'action' => 'City deleted',
                'resource_type' => 'city',
                'resource_id' => $city_id,
                'details' => json_encode(['ip_address' => $request->ip()]),
            ]);

            DB::commit();

            return redirect('/city-list')
                ->with('success', $city->city_name.' successfully deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('/city-list')
                ->with('error', 'Failed to delete city: '.$e->getMessage());
        }

    }

    public function index()
    {
        $logs = AdminAction::with('admin')->latest()->paginate(10);

        return $logs;
    }
}
