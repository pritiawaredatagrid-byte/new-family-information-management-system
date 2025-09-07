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
            <h1 class="text-2xl font-bold text-gray-800">Family Members</h1>

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
                        <th class="px-4 py-3 text-left ">Address</th>
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

                            <td class="px-4 py-3 truncate max-w-[150px]">{{ $member->address ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">{{$member->status ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">{{ $member->wedding_date ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">{{ $member->education ?? '-' }}</td>
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