<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Families Report</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            color: #333;
        }
        .family-section {
            margin-bottom: 40px;
        }
        .family-section:not(:first-child) {
            page-break-before: always;
        }
        h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #222;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 6px;
            font-size: 12px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f5f5f5;
        }
        .photo-thumbnail {
            width: 40px;
            height: 40px;
            border-radius:50%;
            object-fit:cover;
        }
        .no-photo {
            font-size: 10px;
            color: #999;
        }
        .hobby-tag {
            display: inline-block;
            background-color: #e0f2fe;
            color: #1e40af;
            border-radius: 4px;
            padding: 2px 5px;
            font-size: 10px;
            margin: 1px;
        }
    </style>
</head>
<body>

@foreach ($families as $familyIndex => $head)
    <div class="family-section">
        <h2>Family Head {{ $familyIndex + 1 }}: {{ $head->name }} {{ $head->surname }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
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
                    <td>
                        @php
                            $photoPath = storage_path('app/public/' . $head->photo);
                            $photoSrc = null;
                            if ($head->photo && file_exists($photoPath)) {
                                $photoData = file_get_contents($photoPath);
                                $photoSrc = 'data:image/' . pathinfo($photoPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($photoData);
                            }
                        @endphp
                        @if ($photoSrc)
                            <img src="{{ $photoSrc }}" class="photo-thumbnail" />
                        @else
                            <span class="no-photo">No photo</span>
                        @endif
                    </td>
                    <td>{{ $head->birthdate ?? '-' }}</td>
                    <td>{{ $head->mobile_number ?? '-' }}</td>
                    <td>{{ $head->address ?? '-' }}</td>
                    <td>{{ $head->state ?? '-' }}</td>
                    <td>{{ $head->city ?? '-' }}</td>
                    <td>{{ $head->pincode ?? '-' }}</td>
                    <td>{{ ucfirst($head->status) ?? '-' }}</td>
                    <td>{{ $head->status == 'married' ? ($head->wedding_date ?? '-') : '-' }}</td>
                    <td>
                        @php
                            $hobbies = [];
                            preg_match_all('/"(.*?)"/', $head->hobby, $matches);
                            if (!empty($matches[1])) {
                                $hobbies = $matches[1];
                            }
                        @endphp
                        @if (!empty($hobbies))
                            @foreach ($hobbies as $hobby)
                                <span class="hobby-tag">{{ $hobby }}</span>
                            @endforeach
                        @else
                            <span class="no-photo">-</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>Members</h3>
        <table>
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Birth Date</th>
                    <th>Status</th>
                    <th>Wedding Date</th>
                    <th>Education</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($head->members as $memberIndex => $member)
                    <tr>
                        <td>{{ $memberIndex + 1 }}</td>
                        <td>
                            @php
                                $mPath = storage_path('app/public/' . $member->photo);
                                $mSrc = null;
                                if ($member->photo && file_exists($mPath)) {
                                    $mData = file_get_contents($mPath);
                                    $mSrc = 'data:image/' . pathinfo($mPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($mData);
                                }
                            @endphp
                            @if ($mSrc)
                                <img src="{{ $mSrc }}" class="photo-thumbnail" />
                            @else
                                <span class="no-photo">No photo</span>
                            @endif
                        </td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->birthdate ?? '-' }}</td>
                        <td>{{ ucfirst($member->status) ?? '-' }}</td>
                        <td>{{ $member->status == 'married' ? ($member->wedding_date ?? '-') : '-' }}</td>
                        <td>{{ $member->education ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No members</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endforeach

</body>
</html>
