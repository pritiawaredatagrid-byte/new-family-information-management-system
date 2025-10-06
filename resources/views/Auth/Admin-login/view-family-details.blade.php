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
            /* justify-content: space-between; */
            text-align: left;
            align-items: center;
            padding: 1.5rem;
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            gap: 2rem;
        }

        .header-text {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <header class="main-header">

            <div class="header-text">
                <h1 class="text-2xl font-bold text-gray-600">Family Details</h1>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('add-member-form-admin', ['encrypted_id' => $encrypted_id]) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition
                        duration-300">
                        Add Family Member
                    </a>
                </div>
            </div>
        </header>

        <div class="mx-auto p-6">


            <div class="bg-white rounded-xl shadow p-6 mb-8">
                <div class="flex items-center space-x-6">
                    <div>
                        @if($head->photo)
                            <img src="{{ asset('storage/' . $head->photo) }}"
                                class="w-24 h-24 rounded-full object-cover border border-gray-300">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                                No photo
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-gray-700">{{ $head->name }} {{ $head->surname }}</h2>
                        <div class="text-gray-600 mt-2 space-y-1">
                            <p><strong>Birth Date:</strong>
                                {{ \Carbon\Carbon::parse($head->birthdate)->format('d-m-Y') ?? '-' }}</p>
                            <p><strong>Mobile:</strong> {{ $head->mobile_number ?? '-' }}</p>
                            <p><strong>Address:</strong> {{ $head->address ?? '-' }}, {{ $head->city ?? '-' }},
                                {{ $head->state ?? '-' }}, {{ $head->pincode ?? '-' }}
                            </p>
                            <p><strong>Status:</strong> {{ ucfirst($head->status) ?? '-' }}</p>
                            <p><strong>Wedding Date:</strong>
                                {{ $head->status == 'married' ? (\Carbon\Carbon::parse($head->wedding_date)->format('d-m-Y') ?? '-') : '-' }}
                            </p>

                            <div class="mt-2">
                                <strong>Hobbies:</strong>
                                @php
                                    $hobbyList = [];
                                    if ($head->hobby) {
                                        preg_match_all('/"(.*?)"/', $head->hobby, $m);
                                        if (!empty($m[1])) {
                                            $hobbyList = $m[1];
                                        }
                                    }
                                @endphp

                                @if(!empty($hobbyList))
                                    <div class="flex flex-wrap gap-2 mt-1">
                                        @foreach($hobbyList as $hobby)
                                            <span
                                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">{{ $hobby }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </div>

                            <p class="text-sm text-gray-500"><strong>Created At:</strong>
                                {{ \Carbon\Carbon::parse($head->created_at)->format('d-m-Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ url('/edit-family-head/' . $head->encrypted_id) }}"
                            class="text-gray-600 hover:text-gray-800">

                            Edit
                        </a>
                        <form method="POST" action="{{ route('delete-family-details', $head->id) }}"
                            onsubmit="return confirm('Are you sure?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Family Members Cards --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-600 mb-4">Family Members</h2>

                @if ($members->isEmpty())
                    <p class="text-center text-gray-500 text-sm py-10">No family members available.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                        @foreach ($members as $member)
                            <div class="bg-white rounded-lg shadow-md p-5 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center space-x-4">
                                        @if($member->photo)
                                            <img src="{{ asset('storage/' . $member->photo) }}"
                                                class="w-16 h-16 rounded-full object-cover border border-gray-300">
                                        @else
                                            <div
                                                class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                                                No photo
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-700">{{ $member->name }}</h3>
                                            <p class="text-gray-500 text-sm">
                                                {{ \Carbon\Carbon::parse($member->birthdate)->format('d-m-Y') ?? '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-3 space-y-1 text-gray-600 text-sm">
                                        <p><strong>Status:</strong> {{ ucfirst($member->status) ?? '-' }}</p>
                                        <p><strong>Wedding Date:</strong>
                                            {{ $member->status == 'married' ? (\Carbon\Carbon::parse($member->wedding_date)->format('d-m-Y') ?? '-') : '-' }}
                                        </p>
                                        <p><strong>Education:</strong> {{ $member->education ?? '-' }}</p>
                                        <p><strong>Relation:</strong> {{ $member->relation ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-end space-x-3">
                                    <a href="{{ url('/edit-family-member/' . urlencode(Crypt::encrypt($head->id)) . '/' . $member->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('delete-family-member', $member->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this member?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $members->links('pagination::tailwind') }}
                    </div>
                @endif
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