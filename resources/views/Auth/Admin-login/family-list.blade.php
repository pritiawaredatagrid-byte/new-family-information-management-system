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
        <div>
            <form action="/searchData" class="search" method="get">
                <input type="text" name="search">
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
            <a href="/dashboard" class="">Overview</a>
            <a href="/user-registration" class="">Add Families</a>
            <a href="/admin-logout" class="">Logout</a>
        </div>
    </nav>

    <div class=" mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-600">Family Heads</h1>
        </div>

        <!-- Table Wrapper -->
        <div class="bg-white rounded-xl shadow">
            <table class=" w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                    <tr>
                        <th class="px-2 py-2 text-center ">Sr.No</th>
                        <th class="text-center ">Photo</th>
                        <th class="px-3 py-3 text-left ">Name</th>
                        <th class="px-3 py-3 text-center ">Birth Date</th>
                        <th class="px-3 py-3 text-center">Mobile</th>
                        <th class="px-3 py-3 text-left ">Address</th>
                        <th class="px-3 py-3 text-left ">State</th>
                        <th class="px-3 py-3 text-left">City</th>
                        <th class="px-3 py-3 text-center">Pincode</th>
                        <th class="px-3 py-3 text-center ">Marital Status</th>
                        <th class="px-5 py-5 text-center">Wedding Date</th>
                        <th class="px-3 py-3 text-left">Hobbies</th>
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
                                    <a href=""
                                        class="p-2 rounded-full bg-yellow-100 hover:bg-yellow-200 text-yellow-600 transition">
                                        ✏️
                                    </a>
                                    <form method="POST" action="" onsubmit="return confirm('Are you sure?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-2 rounded-full bg-red-100 hover:bg-red-200 text-red-600 transition">
                                            🗑️
                                        </button>
                                    </form>
                                    <a href=""
                                        class="p-2 rounded-full bg-blue-100 hover:bg-blue-200 text-blue-600 transition inline-flex items-center justify-center">
                                        👁️
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Pagination -->
        <div class="mt-6">
            {{ $heads->links('pagination::tailwind') }}
        </div>

    </div>
</body>

</html>