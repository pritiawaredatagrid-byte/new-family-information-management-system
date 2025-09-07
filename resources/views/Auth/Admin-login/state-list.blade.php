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
            <h1 class="text-2xl font-bold text-gray-800">States</h1>
            <!-- <a href="" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700 transition">
                + Add Family
            </a> -->
        </div>

        <!-- Table Wrapper -->
        <div class="bg-white rounded-xl shadow">
            <table class=" w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                    <tr>
                        <th class="px-4 py-3 text-center ">Sr.No</th>
                        <th class="px-4 py-3 text-left ">State Name</th>
                        <th class="px-4 py-3 text-center ">Longitude</th>
                        <th class="px-4 py-3  text-center ">Latitude</th>
                        <th class="px-4 py-3 text-center ">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($states as $state)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-2 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium whitespace-nowrap ">{{$state->state_name}}</td>
                            <td class="px-4 py-3 truncate max-w-[150px] text-center">{{ $state->longitude ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">{{$state->latitude ?? '-' }}</td>
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
            {{ $states->links('pagination::tailwind') }}
        </div>

    </div>
</body>

</html>