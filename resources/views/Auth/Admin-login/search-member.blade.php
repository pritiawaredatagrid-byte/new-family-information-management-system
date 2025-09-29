

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
        }

        .page-wrapper.collapsed {
            margin-left: 80px;
        }

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
            text-align: left;
            padding: 1.5rem;
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .header-text {
            /* width:100%; */
            display: flex;
            /* justify-content: space-between;  */
            align-items: center;
            gap: 1rem;
        }

        .header-text #sidebarToggle {
            display: none;
        }

        @media (max-width: 1024px) {
            .sidebar {
                width: 280px;
                height: auto;
                top: -100%;
                left: 0;
                padding: 1rem;
                transition: top 0.3s ease;
            }

            .sidebar.active {
                top: 0;
                width: 100%;
                height: auto;
                position: fixed;
            }

            .sidebar.collapsed {
                top: -100%;
                width: 100%;
            }

            .sidebar.collapsed .sidebar-text,
            .sidebar.collapsed .sidebar-header h1 {
                display: initial;
            }

            .page-wrapper {
                margin-left: 280px;
            }

            .page-wrapper.collapsed {
                margin-left: 100px;
            }

            .main-header {
                display: flex;
                text-align: left;
                padding: 1.5rem;
                background-color: #ffffff;
                border-bottom: 1px solid #e5e7eb;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                gap: 2rem;
            }

            .header-text {
                display: flex;
                justify-content: space-between;
                gap: 0.5rem;

            }

            .header-text #sidebarToggle {
                display: initial;
            }

        }

        @media (max-width: 768px) {
            .sidebar {
                display: block;
                top: -100%;
                width: 100%;
                padding: 1rem;
            }

            .sidebar.active {
                top: 0;
                width: 100%;
                height: auto;
            }

            .page-wrapper {
                margin-left: 0;
            }

            .page-wrapper.collapsed {
                margin-left: 0;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                padding: 0.5rem;
            }

            .main-header {
                padding: 1rem;
            }

            .header-text h1 {
                font-size: 1.5rem;
            }
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
             <a href="/member-list" class="sidebar-link">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM10 10a5 5 0 00-5 5v2a1 1 0 102 0v-2a3 3 0 013-3h4a3 3 0 013 3v2a1 1 0 102 0v-2a5 5 0 00-5-5H10z" />
        </svg>
        <span class="sidebar-text">Member Management</span>
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
            <a href="/city-list" class="sidebar-link">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7z" />
          <path fill-rule="evenodd"
            d="M19 19a1 1 0 01-1 1H2a1 1 0 01-1-1V5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1V5a1 1 0 011-1h4a1 1 0 011 1v14zm-1-1v-3H4v3h14zm-4-7h-4a1 1 0 000 2h4a1 1 0 000-2z"
            clip-rule="evenodd" />
        </svg>
        <span class="sidebar-text">City Management</span>
      </a>
        </nav>
        <div class="mt-auto">
            <a href="/admin-logout" class="sidebar-link mt-4">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3H6.75A2.25 2.25 0 004.5 5.25v13.5A2.25 2.25 0 006.75 21h6.75a2.25 2.25 0 002.25-2.25V15a.75.75 0 011.5 0v3.75A3.75 3.75 0 0113.5 22.5H6.75A3.75 3.75 0 013 18.75V5.25A3.75 3.75 0 016.75 1.5h6.75a3.75 3.75 0 013.75 3.75V9a.75.75 0 01-1.5 0z"
                        clip-rule="evenodd" />
                    <path d="M21 12l-3-3m0 0l3 3m-3-3v6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="sidebar-text">Logout</span>
            </a>
        </div>
    </aside>

    <div class="page-wrapper">
        <header class="main-header">
            <div class="header-text">
                <button id="sidebarToggle" class="p-2 text-gray-400 hover:text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-2xl font-bold text-gray-600">Member Management</h1>
            </div>


            <div style="width: 50%;">
                <form action="{{ route('redirect-search') }}" class="search" method="get">
                    <input type="text" name="search" placeholder="Search by Name, State, City, Mobile number"
                    value="{{ old('search', $search ?? '') }}">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#1f1f1f">
                            <path
                                d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                        </svg>
                    </button>
                </form>
            </div>
           
        </header>

        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-600">Members</h1>
                 <div class="flex justify-between items-center">
                <!-- <a href="{{ route('search-view-family-details-pdf', ['search' => request('search')]) }}"
                    class="mr-5 px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700 transition">
                    Download PDF
                </a>
                <a class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700 transition"
                    href="{{ route('search-view-family-details-excel', ['search' => request('search')]) }}">
                    Export to Excel
                </a> -->
            </div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow">
                @if ($searchData->isEmpty())
                    <p class="text-center text-gray-500 text-sm py-10">No data available.</p>
                @else
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                           <tr>
                                <th class="px-1 py-1 text-center">Sr.No</th>
                                <th class="text-center">Photo</th>
                                <th class="px-1 py-1 text-center">Name</th>
                                <th class="px-1 py-1 text-center">Birth Date</th>
                                <th class="px-1 py-1 text-center">Marital Status</th>
                                <th class="px-1 py-1 text-center">Wedding Date</th>
                                <th class="px-1 py-1 text-center">Education</th>
                                <th class="px-1 py-1 text-center">Relation</th>
                                <th class="px-1 py-1 text-center">Status</th>
                                <th class="px-1 py-1 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($searchData as $sd)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="text-center">
                                        {{ ($searchData->currentPage() - 1) * $searchData->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="text-center">
                                        @if ($sd->photo)
                                            <img src="{{ asset('storage/' . $sd->photo) }}"
                                                class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                                        @else
                                            <span class="text-gray-400 text-xs">No photo</span>
                                        @endif
                                    </td>
                                    <td class="px-1 py-1 font-medium whitespace-nowrap">{{ $sd->name }}
                                    </td>
                                    <td class="px-1 py-1 text-center whitespace-nowrap">{{ $sd->birthdate ?? '-' }}</td>
                             
                                    <td class="px-1 py-1 text-center">{{ $sd->status ?? '-' }}</td>
                                    <td class="px-1 py-1 text-center">
                                        {{ $sd->status == 'married' ? ($sd->wedding_date ?? '-') : '-' }}
                                    </td>
                                   
                                     </td>
            <td class="px-1 py-1 text-center">
                                        {{ $sd->education}}
                                    </td>
                                    <td class="px-1 py-1 text-center">
                                        {{ $sd->relation}}
                                    </td>
                                    <td class="px-1 py-1 text-center">
                                       
                                        <div class="flex justify-center gap-2">
                                            @if($sd->op_status==1)
                                                 <h6>Active</h6>
                                            @elseif ($sd->op_status==0)
                                                 <h6>Inctive</h6>
                                            @endif
                                    </div>
                                    
                                    </td>
                                    <td class="px-1 py-1 text-center">
                                        <div class="flex justify-center gap-2">

                                    <a href="{{ '/edit-family-member/' . $sd->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#1f1f1f">
                                            <path
                                                d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                        </svg>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('delete-family-details', $sd->id) }}"
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
                                    </div>
                                </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="mt-6">
                {{ $searchData->links('pagination::tailwind') }}
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