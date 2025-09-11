<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update State</title>
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
            font-size: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            color: #424242;
        }

        form div label {
            color: #757575;
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
         
        <h2>Update State</h2>
        <form action="/edit-state-data/{{$stateDetails->state_id}}" method="post">
           
           @csrf
           <input type="hidden" name="_method" value="put">
            <div>
                <div>
                @if(Session('$stateDetails'))
                  <p style="color:green" class="text-green-500 text-sm mt-1 py-2">{{ Session('$stateDetails') }}</p>
                @endif  
                <label for="" class="text-gray-600 space-y-2">State</label>
                <input type="text" name="state_name" placeholder="Enter State Here" value="{{ old('state_name', $stateDetails->state_name) }}"></input>
                @error('state_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            </div>
            <button type="submit" class="admin-login">Update State</button>
        </form>
    </div>
</body>

</script>
</html>