<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>States</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/view-state-details.css">
</head>

<body class="bg-gray-100 font-sans">
    <aside>
        <x-sidebar></x-sidebar>
    </aside>

    <div class="page-wrapper">

        <header class="main-header">


            <h1 class="text-2xl font-bold text-gray-600">State Details</h1>
            <div class="flex items-center space-x-4">

                <a href="{{ route('add-city-form') }}?state_name={{ urlencode(Crypt::encrypt($state->state_name)) }}&state_id={{ urlencode(Crypt::encrypt($state->state_id)) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                    Add City
                </a>

            </div>
        </header>
        <div class="mx-auto p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-600">State</h1>
            </div>

            <div class="bg-white rounded-xl shadow mb-8">
                <table class="w-full text-sm text-gray-700">
                    <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                        <tr>
                            <th class="px-3 py-3 text-center">Sr. No</th>
                            <th class="px-3 py-3 text-left">State Name</th>
                            <th class="px-3 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 py-3 text-center font-medium whitespace-nowrap">1</td>
                            <td class="px-3 py-3 text-left font-medium whitespace-nowrap">{{$state->state_name}}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a
                                        href="{{ route('edit-state', ['encrypted_state_id' => urlencode(Crypt::encrypt($state->state_id))]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="#1f1f1f">
                                            <path
                                                d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('delete-state-details', $state->state_id) }}"
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
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mb-6 mt-10">
                <h1 class="text-2xl font-bold text-gray-600">Cities</h1>
            </div>

            <div class="bg-white rounded-xl shadow">
                @if ($cities->isEmpty())
                    <p class="text-center text-gray-500 text-sm py-10">No city available.</p>
                @else
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
                            <tr>
                                <th class="px-3 py-3 text-center">Sr. No</th>
                                <th class="px-3 py-3 text-left">City Name</th>
                                <th class="px-3 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($cities as $city)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="text-center">
                                        {{ ($cities->currentPage() - 1) * $cities->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-3 py-3 font-medium text-left whitespace-nowrap">{{ $city->city_name }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ url('/edit-city/' . urlencode(Crypt::encrypt($state->state_id)) . '/' . $city->city_id) }}"
                                                class="text-blue-600 hover:text-blue-800 text-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                                    width="24px" fill="#1f1f1f">
                                                    <path
                                                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('delete-city', $city->city_id) }}"
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @endif
            </div>
            <div class="mt-6">
                {{ $cities->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
   
</body>

</html>