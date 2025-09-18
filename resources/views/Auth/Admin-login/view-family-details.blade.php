<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Families</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .navbar {
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .logo {
            font-size: 1.7rem;
            font-weight: 700;
            letter-spacing: 1px;
            cursor: pointer;
            transition: color 0.3s ease;
            color: #2196f3;
        }

        .logo:hover {
            color: #007bff;
        }

        .search {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 400px;
            border: 1px solid #e0e0e0;
            border-radius: 25px;
            padding: 8px 15px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .search:hover {
            border-color: #ccc;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .search:focus-within {
            border-color: #2196f3;
            box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.25);
        }

        .search input[type="text"] {
            flex-grow: 1;
            border: none;
            background: transparent;
            padding: 2px 5px;
            font-size: 1rem;
            color: #333;
            outline: none;
        }

        .search input[type="text"]::placeholder {
            color: #999;
        }

        .search svg {
            cursor: pointer;
            height: 20px;
            width: 20px;
            fill: #555;
            transition: fill 0.3s ease;
        }

        .search svg:hover {
            fill: #2196f3;
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .links a {
            text-decoration: none;
            color: #555;
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: #2196f3;
        }

        .links a span {
            font-weight: 600;
            color: #2196f3;
        }

        .links a span:hover {
            color: #555;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <nav class="navbar">
        <div class="logo">
            FIMS
        </div>
        <div>
        </div>
        <div class="links">
            <a href="/dashboard" class="">Dashboard</a>
            <a href="{{ '/add-family-member/' . $head->id }}" class="">Add Family Member</a>
            <a href=" /admin-logout" class="">Logout</a>
        </div>
    </nav>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-600">Family Head Details</h1>
            <div class="flex justify-between items-center">
                <a href="{{ '/export-pdf/' . $head->id }}"
                    class="mr-5 px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700 transition">
                    Download PDF
                </a>
                <a class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700 transition"
                    href="{{ route('export-excel', ['id' => $head->id]) }}">
                    Export to Excel
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow mb-8">
            <table class="w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                    <tr>
                        <th class="px-3 py-3 text-center ">Sr. No</th>
                        <th class="text-center ">Photo</th>
                        <th class="px-3 py-3 text-center ">Name</th>
                        <th class="px-3 py-3 text-center ">Birth Date</th>
                        <th class="px-3 py-3 text-center">Mobile</th>
                        <th class="px-3 py-3 text-center ">Address</th>
                        <th class="px-3 py-3 text-center ">State</th>
                        <th class="px-3 py-3 text-center">City</th>
                        <th class="px-3 py-3 text-center">Pincode</th>
                        <th class="px-3 py-3 text-center ">Marital Status</th>
                        <th class="px-5 py-5 text-center">Wedding Date</th>
                        <th class="px-3 py-3 text-center">Hobbies</th>
                        <th class="px-3 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 font-medium whitespace-nowrap">1</td>
                        <td class="text-center">
                            @if($head->photo)
                                <img src="{{ asset('storage/' . $head->photo) }}"
                                    class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                            @else
                                <span class="text-gray-400 text-xs">No photo</span>
                            @endif
                        </td>
                        <td class="px-3 py-3 font-medium whitespace-nowrap">{{ $head->name }} {{ $head->surname }}</td>
                        <td class="px-3 py-3 text-center whitespace-nowrap">{{ $head->birthdate ?? '-' }}</td>
                        <td class="px-3 py-3 text-center whitespace-nowrap">{{ $head->mobile_number ?? '-' }}</td>
                        <td class="px-3 py-3 truncate max-w-[150px]">{{ $head->address ?? '-' }}</td>
                        <td class="px-3 py-3">{{ $head->state ?? '-' }}</td>
                        <td class="px-3 py-3">{{ $head->city ?? '-' }}</td>
                        <td class="px-3 py-3 text-center">{{ $head->pincode ?? '-' }}</td>
                        <td class="px-3 py-3 text-center">{{ $head->status ?? '-' }}</td>
                        <td class="px-3 py-3 text-center">
                            {{ $head->status == 'married' ? ($head->wedding_date ?? '-') : '-' }}
                        </td>
                        <td class="px-3 py-3">
                            @php
                                $string = $head->hobby;
                                $hobbies = [];
                                preg_match_all('/"(.*?)"/', $string, $matches);
                                if (!empty($matches[1]))
                                    $hobbies = $matches[1];
                              @endphp
                            @if (!empty($hobbies))
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($hobbies as $hobby)
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg">{{ $hobby }}</span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ '/edit-family-head/' . $head->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#1f1f1f">
                                        <path
                                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('delete-family-details', $head->id) }}"
                                    onsubmit="return confirm('Are you sure?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#1f1f1f">
                                            <path
                                                d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mb-6 mt-10">
            <h1 class="text-2xl font-bold text-gray-600">Family Members</h1>
        </div>

        <div class="bg-white rounded-xl shadow">
            <table class="w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                    <tr>
                        <th class="px-3 py-3 text-center ">Sr. No</th>
                        <th class="text-center ">Photo</th>
                        <th class="px-3 py-3 text-center ">Name</th>
                        <th class="px-3 py-3 text-center ">Birth Date</th>
                        <th class="px-3 py-3 text-center ">Marital Status</th>
                        <th class="px-5 py-5 text-center">Wedding Date</th>
                        <th class="px-3 py-3 text-center">Education</th>
                        <th class="px-3 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($head->members as $member)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 py-3 font-medium whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if ($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}"
                                        class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                                @else
                                    <span class="text-gray-400 text-xs">No photo</span>
                                @endif
                            </td>
                            <td class="px-3 py-3 font-medium whitespace-nowrap text-center">{{ $member->name }}</td>
                            <td class="px-3 py-3 text-center whitespace-nowrap ">{{ $member->birthdate ?? '-' }}</td>
                            <td class="px-3 py-3 text-center">{{ $member->status ?? '-' }}</td>
                            <td class="px-3 py-3 text-center">
                                {{ $member->status == 'married' ? ($member->wedding_date ?? '-') : '-' }}
                            </td>
                            <td class="px-3 py-3 text-center">{{ $member->education ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ '/edit-family-member/' . $head->id . '/' . $member->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#1f1f1f">
                                            <path
                                                d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('delete-family-member', $member->id) }}"
                                        onsubmit="return confirm('Are you sure?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                                width="24px" fill="#1f1f1f">
                                                <path
                                                    d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Families</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #e5e7eb;
        }


        .sidebar {
            width: 280px;
            background-color: #1F2937;
            color: #d1d5db;
            padding: 1.5rem 1rem;
            transition: width 0.3s ease;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 10;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .sidebar-text,
        .sidebar.collapsed .sidebar-header h1 {
            display: none;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s, color 0.2s;
            text-decoration: none;
            color: #d1d5db;
        }

        .sidebar-link:hover {
            background-color: #374151;
            color: #ffffff;
        }

        .sidebar-link.active {
            background-color: #2563eb;
            color: #ffffff;
            font-weight: 600;
        }


        .page-wrapper {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        .page-wrapper.collapsed {
            margin-left: 80px;
        }

        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <x-sidebar></x-sidebar>

    <div class="page-wrapper">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <header class="main-header">
            <h1 class="text-2xl font-bold text-gray-600">Family Details</h1>
            <div class="flex items-center space-x-4">
                <a href="{{ '/add-family-member-admin/' . $head->id }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                    Add Family Member
                </a>
            </div>
        </header>

        <div class="mx-auto p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-600">Family Head</h1>
                <div class="flex justify-between items-center">
                    <a href="{{ '/export-pdf/' . $head->id }}"
                        class="mr-5 px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700 transition">
                        Download PDF
                    </a>
                    <a class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700 transition"
                        href="{{ route('export-excel', ['id' => $head->id]) }}">
                        Export to Excel
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow mb-8">
                <table class="w-full text-sm text-gray-700">
                    <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                        <tr>
                            <th class="px-3 py-3 text-center">Sr. No</th>
                            <th class="text-center">Profile</th>

                            <th class="px-3 py-3 text-center">Birth Date</th>
                            <th class="px-3 py-3 text-center">Mobile</th>
                            <th class="px-3 py-3 text-left">Address</th>
                            <!-- <th class="px-3 py-3 text-center">State</th>
                            <th class="px-3 py-3 text-center">City</th>
                            <th class="px-3 py-3 text-center">Pincode</th> -->
                            <th class="px-3 py-3 text-center">Marital Status</th>
                            <th class="px-5 py-5 text-center">Wedding Date</th>
                            <th class="px-3 py-3 text-left">Hobbies</th>
                            <th class="px-3 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 py-3 text-center font-medium whitespace-nowrap">1</td>
                            <td class="text-center">
                                @if($head->photo)
                                    <img src="{{ asset('storage/' . $head->photo) }}"
                                        class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                                    <hr>
                                @else
                                    <span class="text-gray-400 text-xs">No photo</span>
                                    <hr>
                                @endif

                                {{ $head->name }} {{ $head->surname }}
                            </td>

                            <td class="px-3 py-3 text-center whitespace-nowrap">{{ $head->birthdate ?? '-' }}</td>
                            <td class="px-3 py-3 text-center whitespace-nowrap">{{ $head->mobile_number ?? '-' }}</td>

                            <td class="px-3 py-3 truncate max-w-[150px] text-left">
                                {{ $head->address ?? '-' }},<br>{{ $head->state ?? '-' }},<br>{{ $head->city ?? '-' }},<br>{{ $head->pincode ?? '-' }}
                            </td>

                            <td class="px-3 py-3 text-center">{{ $head->status ?? '-' }}</td>
                            <td class="px-3 py-3 text-center">
                                {{ $head->status == 'married' ? ($head->wedding_date ?? '-') : '-' }}
                            </td>
                            <td class="px-3 py-3 text-left">
                                @php
                                    $string = $head->hobby;
                                    $hobbies = [];
                                    preg_match_all('/"(.*?)"/', $string, $matches);
                                    if (!empty($matches[1]))
                                        $hobbies = $matches[1];
                                @endphp
                                @if (!empty($hobbies))
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($hobbies as $hobby)
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg">{{ $hobby }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ '/edit-family-head/' . $head->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#1f1f1f">
                                            <path
                                                d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('delete-family-details', $head->id) }}"
                                        onsubmit="return confirm('Are you sure?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
                                                <path
                                                    d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mb-6 mt-10">
                <h1 class="text-2xl font-bold text-gray-600">Family Members</h1>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                @if ($head->members->isEmpty())
                    <p class="text-center text-gray-500 text-sm py-10">No family members available.</p>
                @else
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                            <tr>
                                <th class="px-3 py-3 text-center">Sr. No</th>
                                <th class="text-center">Photo</th>
                                <th class="px-3 py-3 text-center">Name</th>
                                <th class="px-3 py-3 text-center">Birth Date</th>
                                <th class="px-3 py-3 text-center">Marital Status</th>
                                <th class="px-5 py-5 text-center">Wedding Date</th>
                                <th class="px-3 py-3 text-center">Education</th>
                                <th class="px-3 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($head->members as $member)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-3 py-3 text-center font-medium whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if ($member->photo)
                                            <img src="{{ asset('storage/' . $member->photo) }}"
                                                class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                                        @else
                                            <span class="text-gray-400 text-xs">No photo</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 font-medium text-center whitespace-nowrap">{{ $member->name }}</td>
                                    <td class="px-3 py-3 text-center whitespace-nowrap">{{ $member->birthdate ?? '-' }}</td>
                                    <td class="px-3 py-3 text-center">{{ $member->status ?? '-' }}</td>
                                    <td class="px-3 py-3 text-center">
                                        {{ $member->status == 'married' ? ($member->wedding_date ?? '-') : '-' }}
                                    </td>
                                    <td class="px-3 py-3 text-center">{{ $member->education ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ '/edit-family-member/' . $head->id . '/' . $member->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                                    width="24px" fill="#1f1f1f">
                                                    <path
                                                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('delete-family-member', $member->id) }}"
                                                onsubmit="return confirm('Are you sure?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                        viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
                                                        <path
                                                            d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</body>

</html>