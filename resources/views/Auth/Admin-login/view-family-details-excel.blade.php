<table>
    <thead>
        <tr>
            <th>Sr. No</th>
            <th>Name</th>
            <th>Birth Date</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>State</th>
            <th>City</th>
            <th>Pincode</th>
            <th>Marital Status</th>
            <th>Wedding Date</th>
            <th>Hobbies</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>{{ $head->name }} {{ $head->surname }}</td>
            <td>{{ $head->birthdate ?? '-' }}</td>
            <td>{{ $head->mobile_number ?? '-' }}</td>
            <td>{{ $head->address ?? '-' }}</td>
            <td>{{ $head->state ?? '-' }}</td>
            <td>{{ $head->city ?? '-' }}</td>
            <td>{{ $head->pincode ?? '-' }}</td>
            <td>{{ $head->status ?? '-' }}</td>
            <td>{{ $head->wedding_date ?? '-' }}</td>
            <td>
                {{-- Handle hobbies as a simple, comma-separated string --}}
                @php
                    $hobbies = collect(json_decode($head->hobby))->map(function($h) { return str_replace('"', '', $h); });
                @endphp
                {{ $hobbies->implode(', ') }}
            </td>
        </tr>
    </tbody>
</table>

<br>

<table>
    <thead>
        <tr>
            <th>Sr. No</th>
            <th>Name</th>
            <th>Birth Date</th>
            <th>Marital Status</th>
            <th>Wedding Date</th>
            <th>Education</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($head->members as $member)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->birthdate ?? '-' }}</td>
                <td>{{ $member->status ?? '-' }}</td>
                <td>{{ $member->wedding_date ?? '-' }}</td>
                <td>{{ $member->education ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
