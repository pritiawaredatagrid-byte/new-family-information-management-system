<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Families</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        table, th, td {
            border-collapse: collapse;
            border: 1px solid #d1d5db; 
        }
        th, td {
            padding: 8px 8px;
        }

    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h2 class="font-bold text-gray-600">Family Head Details</h1>
    </div>

    <div class="bg-white rounded-xl shadow mb-8">
        <table class="w-full text-gray-700 border-collapse">
            <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider sticky top-0">
                <tr class="border border-gray-300">
                    <th class="px-3 py-3 text-center border border-gray-300">Sr. No</th>
                    <th class="text-center ">Photo</th>
                    <th class="px-3 py-3 text-center ">Name</th>
                    <th class="px-3 py-3 text-center ">Birth Date</th>
                    <th class="px-3 py-3 text-center">Mobile</th>
                    <th class="px-3 py-3 text-center ">Address</th>
                    <th class="px-3 py-3 text-center ">State</th>
                    <th class="px-3 py-3 text-center">City</th>
                    <th class="px-3 py-3 text-center">Pincode</th>
                    <th class="px-3 py-3 text-center ">Marital Status</th>
                    <th class="px-5 py-5 text-center">Wedding Date</th>
                    <th class="px-3 py-3 text-center">Hobbies</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-3 py-3 font-medium whitespace-nowrap">1</td>
                    <td class="text-center">
                        @if($head->photo)
                            <img src="{{ asset('storage/' . $head->photo) }}" class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
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
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mb-6 mt-10">
        <h2 class="font-bold text-gray-600">Family Members</h2>
    </div>

    <div class="bg-white rounded-xl shadow">
        <table class="w-full text-gray-700 border-collapse">
    <thead class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider sticky top-0">
        <tr class="border border-gray-300">
            <th class="px-3 py-3 text-center border border-gray-300">Sr. No</th>
            <th class="text-center border border-gray-300">Photo</th>
            <th class="px-3 py-3 text-center border border-gray-300">Name</th>
            <th class="px-3 py-3 text-center border border-gray-300">Birth Date</th>
            <th class="px-3 py-3 text-center border border-gray-300">Marital Status</th>
            <th class="px-5 py-5 text-center border border-gray-300">Wedding Date</th>
            <th class="px-3 py-3 text-center border border-gray-300">Education</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @foreach ($head->members as $member)
            <tr class="hover:bg-gray-50 transition border border-gray-300">
                <td class="px-3 py-3 font-medium whitespace-nowrap border border-gray-300">{{ $loop->iteration }}</td>
                <td class="text-center border border-gray-300">
                    @if ($member->photo)
                        <img src="{{ asset('storage/' . $member->photo) }}"
                            class="w-10 h-10 rounded-full object-cover border border-gray-300 mx-auto">
                    @else
                        <span class="text-gray-400">No photo</span>
                    @endif
                </td>
                <td class="px-3 py-3 font-medium whitespace-nowrap text-center border border-gray-300">{{ $member->name }}</td>
                <td class="px-3 py-3 text-center whitespace-nowrap border border-gray-300">{{ $member->birthdate ?? '-' }}</td>
                <td class="px-3 py-3 text-center border border-gray-300">{{ $member->status ?? '-' }}</td>
                <td class="px-5 py-5 text-center border border-gray-300">{{ $member->wedding_date ?? '-' }}</td>
                <td class="px-3 py-3 text-center border border-gray-300">{{ $member->education ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

    </div>
</div>

</body>

</html>