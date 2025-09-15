<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Families</title>
    <style>
    body {
        font-family: sans-serif;
        background-color: #f3f4f6;
        margin: 0;
        padding: 20px;
    }
    h2 {
        font-weight: bold;
        color: #4b5563;
        margin-bottom: 1.5rem;
        margin-top: 2rem;
    }
    .container {
        width: 100%;
        margin: auto;
    }
    .table-container {
        background-color: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        overflow: hidden;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        color: #374151;
    }
    /* Adjusted padding and font size for better fit */
    th, td {
        padding: 4px; /* Reduced padding */
        border: 1px solid #d1d5db;
        text-align: center;
        vertical-align: top;
        font-size: 10px; /* Reduced font size */
    }
    thead {
        background-color: #f3f4f6;
        color: #4b5563;
        text-transform: uppercase;
        font-size: 10px; /* Reduced font size */
        letter-spacing: 0.05em;
    }
    img.photo-thumbnail {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #d1d5db;
        margin: auto;
        display: block;
    }
    .no-photo {
        color: #9ca3af;
        font-size: 8px; /* Reduced font size */
    }
    .hobby-tag {
        background-color: #e0f2fe;
        color: #1e40af;
        font-size: 8px; /* Reduced font size */
        padding: 2px 5px; /* Reduced padding */
        border-radius: 8px;
        display: inline-block;
        margin: 2px;
    }
</style>
<h2>Family Head</h2>
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Photo</th>
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
                <td>{{ $head->name }} {{ $head->surname }}</td>
                 <td style="white-space: nowrap;">{{ $head->birthdate ?? '-' }}</td>
                <td>{{ $head->mobile_number ?? '-' }}</td>
                <td style="word-wrap: break-word; max-width: 150px;">{{ $head->address ?? '-' }}</td>
                <td>{{ $head->state ?? '-' }}</td>
                <td>{{ $head->city ?? '-' }}</td>
                <td>{{ $head->pincode ?? '-' }}</td>
                <td>{{ $head->status ?? '-' }}</td>
                <td>{{ $head->wedding_date ?? '-' }}</td>
                <td>
                    @php
                        $string = $head->hobby;
                        $hobbies = [];
                        preg_match_all('/"(.*?)"/', $string, $matches);
                        if (!empty($matches[1]))
                            $hobbies = $matches[1];
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
</div>
        <h2>Family Members</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Photo</th>
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
                        <td>
                            @php
                                $memberPhotoPath = storage_path('app/public/' . $member->photo);
                                $memberPhotoSrc = null;
                                if ($member->photo && file_exists($memberPhotoPath)) {
                                    $memberPhotoData = file_get_contents($memberPhotoPath);
                                    $memberPhotoSrc = 'data:image/' . pathinfo($memberPhotoPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($memberPhotoData);
                                }
                            @endphp
                            @if ($memberPhotoSrc)
                                <img src="{{ $memberPhotoSrc }}" class="photo-thumbnail" />
                            @else
                                <span class="no-photo">No photo</span>
                            @endif
                        </td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->birthdate ?? '-' }}</td>
                        <td>{{ $member->status ?? '-' }}</td>
                        <td>{{ $member->wedding_date ?? '-' }}</td>
                        <td>{{ $member->education ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>