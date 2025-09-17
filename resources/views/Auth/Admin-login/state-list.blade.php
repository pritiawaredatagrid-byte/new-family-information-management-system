<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>States</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <x-user-navbar>
        <a href="/add-state" class="">Add States</a>
    </x-user-navbar>
    <div class=" mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-600">States</h1>
 
        </div>

        <div class="bg-white rounded-xl shadow">
            <table class=" w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                    <tr>
                        <th class="px-4 py-3 text-center ">Sr.No</th>
                        <th class="px-4 py-3 text-left ">State Name</th>
                        <th class="px-9 py-2 text-center ">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($states as $state)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-2 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium whitespace-nowrap ">{{$state->state_name}}</td>
                        
                            <td class="px-9 py-2 text-center">
                                <div class="flex justify-center gap-1">
                                    
                                    <a href="{{'view-state-details/'.$state->state_id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="mt-6">
            {{ $states->links('pagination::tailwind') }}
        </div>

    </div>
</body>

</html> -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>States</title>
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
            min-height: 100vh;
        }

        .page-wrapper.collapsed {
            margin-left: 80px;
        }

        /* --- Custom Navbar Styles for this page --- */
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
        <header class="main-header">
            <h1 class="text-2xl font-bold text-gray-600">States</h1>
            <div class="flex items-center space-x-4">
                <a href="/add-state" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                    Add State
                </a>
                
            </div>
        </header>

        <div class="p-6">
            <div class="bg-white rounded-xl shadow">
                <table class="w-full text-sm text-gray-700">
                    <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                        <tr>
                            <th class="px-4 py-3 text-center">Sr.No</th>
                            <th class="px-4 py-3 text-left">State Name</th>
                            <th class="px-4 py-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($states as $state)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium whitespace-nowrap">{{$state->state_name}}</td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{'view-state-details/'.$state->state_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
                                        <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $states->links('pagination::tailwind') }}
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