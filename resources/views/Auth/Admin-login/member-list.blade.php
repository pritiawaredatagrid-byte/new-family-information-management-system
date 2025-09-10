<!DOCTYPE html>
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
        <div class="links">
            <a href="/dashboard" class="">Overview</a>
            <a href="/user-registration" class="">Add Families</a>
            <a href="/admin-logout" class="">Logout</a>
        </div>
    </nav>

    <div class=" mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-600">Family Members</h1>

        </div>

        <!-- Table Wrapper -->
        <div class="bg-white rounded-xl shadow">
            <table class=" w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                    <tr>
                        <th class="px-4 py-3 text-center ">Sr.No</th>
                        <th class="px-4 py-3 text-center ">Photo</th>
                        <th class="px-4 py-3 text-left ">Family Head Name</th>
                        <th class="px-4 py-3 text-left ">Name</th>
                        <th class="px-4 py-3 text-center ">Birth Date</th>
                        <th class="px-4 py-3 text-center ">Marital Status</th>
                        <th class="px-4 py-3 text-center">Wedding Date</th>
                        <th class="px-4 py-3 text-center">Education</th>
                        <th class="px-4 py-3 text-center ">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($members as $member)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-2 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="px-2 py-3 text-center">
                                @if ($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}"
                                        class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                                @else
                                    <span class="text-gray-400 text-xs">No photo</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium whitespace-nowrap">{{ $member->name }}</td>
                            <td class="px-4 py-3 font-medium whitespace-nowrap">{{ $member->name }}</td>
                            <td class="px-4 py-3 text-center">{{ $member->birthdate ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">{{$member->status ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">{{ $member->wedding_date ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">{{ $member->education ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/></svg>
                                    </a>
                                    <form method="POST" action="" onsubmit="return confirm('Are you sure?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                           >
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Pagination -->
        <div class="mt-6">
            {{ $members->links('pagination::tailwind') }}
        </div>

    </div>
</body>

</html>