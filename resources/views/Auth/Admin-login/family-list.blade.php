<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Families</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <x-user-navbar></x-user-navbar>

    <div class=" mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Family Heads</h1>
        </div>

        <!-- Table Wrapper -->
        <div class="bg-white rounded-xl shadow">
            <table class=" w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                    <tr>
                        <th class="px-4 py-3 text-center ">Sr.No</th>
                        <th class="px-4 py-3 text-center ">Photo</th>
                        <th class="px-4 py-3 text-left ">Name</th>
                        <th class="px-4 py-3 text-center ">Birth Date</th>
                        <th class="px-4 py-3 text-center">Mobile</th>
                        <th class="px-4 py-3 text-left ">Address</th>
                        <th class="px-4 py-3 text-left ">State</th>
                        <th class="px-4 py-3 text-left">City</th>
                        <th class="px-4 py-3 text-center">Pincode</th>
                        <th class="px-4 py-3 text-center ">Marital Status</th>
                        <th class="px-4 py-3 text-center">Wedding Date</th>
                        <th class="px-4 py-3 text-left">Hobbies</th>
                        <th class="px-4 py-3 text-center ">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($heads as $head)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-2 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="px-2 py-3 text-center">
                                @if ($head->photo)
                                    <img src="{{ asset('storage/' . $head->photo) }}"
                                        class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                                @else
                                    <span class="text-gray-400 text-xs">No photo</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium whitespace-nowrap">{{ $head->name }} {{ $head->surname }}</td>
                            <td class="px-4 py-3 text-center whitespace-nowrap">{{ $head->birthdate ?? '-' }}</td>
                            <td class="px-4 py-3 text-center whitespace-nowrap">{{ $head->mobile_number ?? '-' }}</td>
                            <td class="px-4 py-3 truncate max-w-[150px]">{{ $head->address ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $head->state ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $head->city ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">{{ $head->pincode ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">{{ $head->status ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">{{ $head->wedding_date ?? '-' }}</td>
                            <td class="px-4 py-3">
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