<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body class="Family-Member-body">
    <div class="main">
        <h2>Add Family Member</h2>
        @error('user')
            <p class="text-red-500 text-sm mt-1 py-2">{{ $message }}</p>
        @enderror
        <form action="/admin-login" method="post" class="space-y-4">
            @csrf
            <div>
                <label for="">Member Name</label>
                <input type="text" name="name" id="" placeholder="Enter Member Name">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
             <div>
                <label for="">Birth Date</label>
                <input type="date" name="birthdate" id="">
                @error('birthdate')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
             <div class="marital-status">
                <label for="">Marital Status </label>
                <input type="radio" name="marital-status" id="">Married</input>&nbsp &nbsp
                <input type="radio" name="marital-status" id="">Unmarried</input>
                @error('pincode')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="">Education</label>
                <input type="text" name="name" id="" placeholder="Enter Education">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="">Profile Photo</label>
                <input type="file" name="photo" id=""></input>
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="admin-login">Add Family Member</button>
        </form>
    </div>
</body>
</html>
