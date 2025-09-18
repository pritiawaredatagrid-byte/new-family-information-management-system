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
            background-color: #1F2937;
        }

        .logo {
            font-size: 1.7rem;
            font-weight: 700;
            letter-spacing: 1px;
            cursor: pointer;
            transition: color 0.3s ease;
            color: #FFFFFF;
        }

        .logo:hover {
            color: #007bff;
        }

        .search {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 600px;
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
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s, color 0.2s;
            text-decoration: none;
            color: #d1d5db;
        }

        .links a {
            text-decoration: none;
            color: #007BFF;
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .links a:hover {
            background-color: #374151;
            color: #ffffff;
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
        <div style="width: 50%;">
            <form action="/search-head" class="search" method="get">
                <input type="text" name="search" placeholder="Search by Name, State, City, Mobile number">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#1f1f1f">
                        <path
                            d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                    </svg>
                </button>
            </form>
        </div>
        <div class="links">
            <a href="/dashboard" class="">Dashboard</a>
            <a href="/user-registration" class="">Add Family</a>
            <a href="/admin-logout" class="">Logout</a>
        </div>
    </nav>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class=" mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-600">Family Heads</h1>
            <div class="flex justify-between items-center mb-6">

            </div>

        </div>


        <div class="bg-white rounded-xl shadow">
            <table class=" w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                    <tr>
                        <th class="px-2 py-2 text-center ">Sr.No</th>
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
                        <th class="px-3 py-3 text-center ">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($heads as $head)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if ($head->photo)
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
                            <td class="px-3 py-3 text-center">{{ $head->wedding_date ?? '-' }}</td>
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
                                    <a href="{{'view-family-details/' . $head->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#1f1f1f">
                                            <path
                                                d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $heads->links('pagination::tailwind') }}
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

        /* --- Collapsible Sidebar Styles --- */
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

        /* --- Page Content Styles for Collapsible Sidebar --- */
        .page-wrapper {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
        }

        .page-wrapper.collapsed {
            margin-left: 80px;
        }

        /* --- Navbar Styles --- */
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
            max-width: 600px;
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
            color: #007BFF;
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

    <aside class="sidebar h-screen flex flex-col">
        <div class="flex items-center space-x-3 mb-8 sidebar-header">
            <svg width="35" height="35" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="30" r="20" fill="currentColor" />
                <path d="M25 70 Q50 40 75 70 L75 80 Q50 110 25 80 Z" fill="currentColor" />
            </svg>
            <h1 class="text-3xl font-bold text-gray-200 sidebar-text">FIMS Admin</h1>
        </div>
        <nav class="flex-1 space-y-2">
            <a href="/dashboard" class="sidebar-link active">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                <span class="sidebar-text">Dashboard</span>
            </a>
            <a href="/family-list" class="sidebar-link">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM10 10a5 5 0 00-5 5v2a1 1 0 102 0v-2a3 3 0 013-3h4a3 3 0 013 3v2a1 1 0 102 0v-2a5 5 0 00-5-5H10z" />
                </svg>
                <span class="sidebar-text">Family Management</span>
            </a>
            <a href="/state-list" class="sidebar-link">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7z" />
                    <path fill-rule="evenodd"
                        d="M19 19a1 1 0 01-1 1H2a1 1 0 01-1-1V5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1V5a1 1 0 011-1h4a1 1 0 011 1v14zm-1-1v-3H4v3h14zm-4-7h-4a1 1 0 000 2h4a1 1 0 000-2z"
                        clip-rule="evenodd" />
                </svg>
                <span class="sidebar-text">State Management</span>
            </a>
        </nav>
        <div class="mt-auto">
            <a href="/admin-logout" class="sidebar-link mt-4">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <span class="sidebar-text">Logout</span>
            </a>
        </div>
    </aside>

    <div class="page-wrapper">
        <header class="main-header">
            <h1 class="text-2xl font-bold text-gray-600">Families</h1>
            <div style="width: 50%;">
                <form action="/search-head" class="search" method="get">
                    <input type="text" name="search" placeholder="Search by Name, State, City, Mobile number">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#1f1f1f">
                            <path
                                d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/user-registration-admin"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                    Add Family
                </a>

            </div>
        </header>

        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-600">Family Heads</h1>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow">
                @if ($heads->isEmpty())
                    <p class="text-center text-gray-500 text-sm py-10">No Family available.</p>
                @else
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                            <tr>
                                <th class="px-2 py-2 text-center">Sr.No</th>
                                <th class="text-center">Photo</th>
                                <th class="px-3 py-3 text-center">Name</th>
                                <th class="px-3 py-3 text-center">Birth Date</th>
                                <th class="px-3 py-3 text-center">Mobile</th>
                                <th class="px-3 py-3 text-center">Address</th>

                                <th class="px-3 py-3 text-center">Marital Status</th>
                                <th class="px-5 py-5 text-center">Wedding Date</th>
                                <th class="px-3 py-3 text-center">Hobbies</th>
                                <th class="px-3 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($heads as $head)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if ($head->photo)
                                            <img src="{{ asset('storage/' . $head->photo) }}"
                                                class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                                        @else
                                            <span class="text-gray-400 text-xs">No photo</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 font-medium whitespace-nowrap">{{ $head->name }} {{ $head->surname }}
                                    </td>
                                    <td class="px-3 py-3 text-center whitespace-nowrap">{{ $head->birthdate ?? '-' }}</td>
                                    <td class="px-3 py-3 text-center whitespace-nowrap">{{ $head->mobile_number ?? '-' }}</td>
                                    <td class="px-3 py-3 truncate max-w-[150px]">{{ $head->address ?? '-' }}</td>

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
                                            <a href="{{ 'view-family-details/' . $head->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                                    width="24px" fill="#1f1f1f">
                                                    <path
                                                        d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="mt-6">
                {{ $heads->links('pagination::tailwind') }}
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.querySelector('.sidebar');
            const pageWrapper = document.querySelector('.page-wrapper');
            const sidebarToggle = document.getElementById('sidebarToggle');

            if (sidebar && pageWrapper && sidebarToggle) {
                sidebarToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('collapsed');
                    pageWrapper.classList.toggle('collapsed');
                });
            }
        });
    </script>
</body>

</html>