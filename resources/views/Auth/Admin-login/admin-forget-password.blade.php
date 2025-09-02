<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Forget Password</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
    <div class="main">
        <h2>Forgot Password</h2>
        @error('user')
            <p class="text-red-500 text-sm mt-1 py-2">{{ $message }}</p>
        @enderror
        <form action="/admin-forget-password" method="post">
            @csrf
            <div>
                <label for="">Admin Email</label>
                <input type="email" name="email" id="" placeholder="Enter Admin Email">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="admin-login">Submit</button>
        </form>
    </div>
</body>
</html>
