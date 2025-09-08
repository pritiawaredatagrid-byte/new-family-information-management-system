<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Families</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <x-user-navbar>
        <a  href="/add-city" class="">Add Cities</a>
    </x-user-navbar>
    <div class=" mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-600">Cities</h1>
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
                        <th class="px-4 py-3 text-left ">City Name</th>
                        <th class="px-4 py-3 text-center ">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($cities as $city)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-2 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium whitespace-nowrap "> {{$city->state->state_name}}</td>
                            <td class="px-4 py-3 font-medium whitespace-nowrap ">{{$city->city_name}}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href=""
                                        class="p-2 rounded-full bg-yellow-100 hover:bg-yellow-200 text-yellow-600 transition">
                                        ✏️
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
            {{ $cities->links('pagination::tailwind') }}
        </div>

    </div>
</body>

</html>