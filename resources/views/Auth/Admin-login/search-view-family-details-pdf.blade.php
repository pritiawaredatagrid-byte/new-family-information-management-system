<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<title>Searched Families Report</title>
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
h3 {
font-size: 16px;
margin-top: 20px;
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
border-radius: 50%;
object-fit: cover;
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

@php

function getBase64PhotoSrc($photoPath) {
$fullPath = storage_path('app/public/' . $photoPath);
if ($photoPath && file_exists($fullPath)) {
$photoData = file_get_contents($fullPath);
return 'data:image/' . pathinfo($fullPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($photoData);
}
return null;
}
@endphp

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
$headPhotoSrc = getBase64PhotoSrc($head->photo);
@endphp
@if ($headPhotoSrc)
<img src="{{ $headPhotoSrc }}" class="photo-thumbnail" />
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

$hobbies = json_decode($head->hobby, true);
@endphp
@if (is_array($hobbies) && !empty($hobbies))
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
                            // Use the member's photo path instead of the head's.
                            $memberPhotoSrc = getBase64PhotoSrc($member->photo);
                        @endphp
                        @if ($memberPhotoSrc)
                            <img src="{{ $memberPhotoSrc }}" class="photo-thumbnail" />
                        @else
                            <span class="no-photo">No photo</span>
                        @endif
                    </td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->birthdate ?? '-' }}</td>
                    <td>{{ ucfirst($member->status) ?? '-' }}</td>
                    <td>
                        {{-- Check the member's status for their wedding date --}}
                        {{ $member->status == 'married' ? ($member->wedding_date ?? '-') : '-' }}
                    </td>
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
