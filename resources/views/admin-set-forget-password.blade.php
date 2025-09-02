<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
    <div class="main">
        <h2>Admin Login</h2>
        @error('user')
            <p class="text-red-500 text-sm mt-1 py-2">{{ $message }}</p>
        @enderror
        <form action="/admin-set-forget-password" method="post" class="space-y-4">
            @csrf
            <div>
                <input type="hidden" name="email" id="" value="{{$email}}" placeholder="Enter Admin Email">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 space-y-2">Password</label>
                <input type="password" name="password" id="" placeholder="Enter Admin Password">
                   
            </div>
            <div>
                <label for="" class="text-gray-600 space-y-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="" placeholder="Comfirm Admin Password">
            @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="admin-login">Update Password</button>
        </form>
    </div>
</body>
</html>