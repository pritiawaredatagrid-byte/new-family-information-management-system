<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>All Family Details</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        h2 {
            /* margin-top: 40px; */
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f3f4f6;
            font-weight: bold;
        }

        .section-divider {
            border-top: 2px solid #9ca3af;
            margin: 30px 0;
        }
    </style>
</head>
<body>

<h1 style="text-align: center; margin-bottom: 30px;">All Family Details</h1>

@foreach ($families as $head)
    <h2>Family Head: {{ $head->name }} {{ $head->surname }}</h2>
    <table border="1" cellpadding="5" cellspacing="0">
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
                    @php
                        $hobbies = json_decode($head->hobby) ?? [];
                    @endphp
                    {{ implode(', ', $hobbies) }}
                </td>
            </tr>
        </tbody>
    </table>

    <br />

    <h3>Family Members</h3>
    <table border="1" cellpadding="5" cellspacing="0">
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

    <br /><br />
@endforeach


</body>
</html>
