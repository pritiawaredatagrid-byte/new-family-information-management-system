<!-- 
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

        .logo{
         color:#007BFF
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
<header class="main-header">
            <h1 class="text-2xl font-bold text-gray-600">Family Details</h1>
            <div style="width: 50%;">
                <form action="/search-head" class="search" method="get">
                    <input type="text" name="search" placeholder="Search by Name, State, City, Mobile number">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
                            <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                        </svg>
                    </button>
                </form>
            </div>
        </header>
    <div class=" mx-auto p-6">
      
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
                        <th class="px-3 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($searchData as $sd)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if ($sd->photo)
                                    <img src="{{ asset('storage/' . $sd->photo) }}"
                                        class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                                @else
                                    <span class="text-gray-400 text-xs">No photo</span>
                                @endif
                            </td>
                            <td class="px-3 py-3 font-medium whitespace-nowrap">{{ $sd->name }} {{ $sd->surname }}</td>
                            <td class="px-3 py-3 text-center whitespace-nowrap">{{ $sd->birthdate ?? '-' }}</td>
                            <td class="px-3 py-3 text-center whitespace-nowrap">{{ $sd->mobile_number ?? '-' }}</td>
                            <td class="px-3 py-3 truncate max-w-[150px]">{{ $sd->address ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $sd->state ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $sd->city ?? '-' }}</td>
                            <td class="px-3 py-3 text-center">{{ $sd->pincode ?? '-' }}</td>
                            <td class="px-3 py-3 text-center">{{ $sd->status ?? '-' }}</td>
                            <td class="px-3 py-3 text-center">{{ $sd->wedding_date ?? '-' }}</td>
                            <td class="px-3 py-3">
                                @php
                                    $string = $sd->hobby;
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
                                    <a href="{{'view-family-details/'.$sd->id}}">
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
            {{ $searchData->links('pagination::tailwind') }}
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
        /* This is the new parent container that uses Flexbox */
        .page-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling (assuming it's a separate component) */
        .sidebar {
            width: 280px; /* Fixed width for the sidebar */
            background-color: #2c3e50; /* A dark color to match your image */
            color: #ecf0f1;
            padding: 2rem 1rem;
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

        .logo{
         color:#007BFF
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
    <div class="page-container">
        <x-sidebar></x-sidebar>

        <div class="flex-grow">
            <header class="main-header">
                <h1 class="text-2xl font-bold text-gray-600">Family Details</h1>
                <div style="width: 50%;">
                    <form action="/search-head" class="search" method="get">
                        <input type="text" name="search" placeholder="Search by Name, State, City, Mobile number">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
                                <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </header>
            <div class="mx-auto p-6">
                <div class="bg-white rounded-xl shadow overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                            <tr>
                                <th class="px-2 py-2 text-center">Sr.No</th>
                                <th class="text-center">Photo</th>
                                <th class="px-3 py-3 text-left">Name</th>
                                <th class="px-3 py-3 text-center">Birth Date</th>
                                <th class="px-3 py-3 text-center">Mobile</th>
                                <th class="px-3 py-3 text-left">Address</th>
                                <th class="px-3 py-3 text-center">Marital Status</th>
                                <th class="px-5 py-5 text-center">Wedding Date</th>
                                <th class="px-3 py-3 text-left">Hobbies</th>
                                <th class="px-3 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($searchData as $sd)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if ($sd->photo)
                                            <img src="{{ asset('storage/' . $sd->photo) }}"
                                                class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                                        @else
                                            <span class="text-gray-400 text-xs">No photo</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 font-medium whitespace-nowrap">{{ $sd->name }} {{ $sd->surname }}</td>
                                    <td class="px-3 py-3 text-center whitespace-nowrap">{{ $sd->birthdate ?? '-' }}</td>
                                    <td class="px-3 py-3 text-center whitespace-nowrap">{{ $sd->mobile_number ?? '-' }}</td>
                                    <td class="px-3 py-3 truncate max-w-[200px] text-left">
                                        {{ $sd->address ?? '-' }}<br>
                                        {{ $sd->state ?? '-' }}, {{ $sd->city ?? '-' }},<br>
                                        {{ $sd->pincode ?? '-' }}
                                    </td>
                                    <td class="px-3 py-3 text-center">{{ $sd->status ?? '-' }}</td>
                                    <td class="px-3 py-3 text-center">{{ $sd->wedding_date ?? '-' }}</td>
                                    <td class="px-3 py-3">
                                        @php
                                            $string = $sd->hobby;
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
                                            <a href="{{'view-family-details/'.$sd->id}}">
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
                    {{ $searchData->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>