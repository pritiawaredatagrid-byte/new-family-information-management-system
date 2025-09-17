<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <style>
        body {
            background-color: #F5F5F5;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            padding-top: 5rem;
        }

        .main {
            background-color: white;
            padding: 2rem 3rem;
            border-radius: 5%;
        }

        .main h2 {
            text-align: center;
            color: #484E54;
      font-size: 1.8rem;
      font-weight: 700;
            margin-bottom: 2rem;
        }

        form div label {
             margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color);
        }

        form div input {
            width: 100%;
            padding: 0.4rem 0.3rem;
            border-radius: 5px;
            margin-top: 0.5rem;
            margin-bottom: 0.7rem;
            border: 0.1rem solid #757575;
        }

        form div input:focus {
            outline: none;
        }

        form .admin-login {
            width: 100%;
            background-color: #2196F3;
            border-radius: 5px;
            padding: 0.5rem 0.3rem;
            color: white;
            border: none;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        form a {
            text-decoration: none;
        }

        .main p {
            color: red;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="main">
        <h2>Reset Password</h2>
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

</html> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <style>
        body {
            background-color: #F5F5F5;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            padding-top: 5rem;
        }

        .main {
            background-color: white;
            padding: 2rem 3rem;
            border-radius: 5%;
            width: 100%;
            max-width: 400px;
        }

        .main h2 {
            text-align: center;
            color: #484E54;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        form div label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color, #757575);
        }

        form div input {
            width: 100%;
            padding: 0.4rem 0.3rem;
            border-radius: 5px;
            margin-top: 0.5rem;
            margin-bottom: 0.7rem;
            border: 0.1rem solid #757575;
        }

        form div input:focus {
            outline: none;
        }

        form .admin-login {
            width: 100%;
            background-color: #2196F3;
            border-radius: 5px;
            padding: 0.5rem 0.3rem;
            color: white;
            border: none;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
        }

        form a {
            text-decoration: none;
        }

        .main p {
            color: red;
            margin-bottom: 1rem;
        }

   
        @media (max-width: 768px) {
            .main {
                padding: 1.5rem 2rem;
            }
            .main h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>
    <div class="main">
        <h2>Reset Password</h2>
        @error('user')
            <p class="text-red-500 text-sm mt-1 py-2">{{ $message }}</p>
        @enderror
        <form action="/admin-set-forget-password" method="post" class="space-y-4">
            @csrf
            <div>
                <input type="hidden" name="email" value="{{$email}}" placeholder="Enter Admin Email">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="text-gray-600 space-y-2">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Admin Password">
            </div>
            <div>
                <label for="password_confirmation" class="text-gray-600 space-y-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Admin Password">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="admin-login">Update Password</button>
        </form>
    </div>
</body>

</html>
