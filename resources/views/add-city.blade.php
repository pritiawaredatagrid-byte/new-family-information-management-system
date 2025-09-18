<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>
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
            width: 97%;
            padding: 0.4rem 0.3rem;
            border-radius: 5px;
            margin-top: 0.5rem;
            margin-bottom: 0.8rem;
            border: 0.1rem solid #757575;
        }

        form div input:focus {
            outline: none;
        }

        body form div select{
    width: 100%;
    padding: 0.4rem 0.4rem;
    border-radius: 5px;
    margin-top: 0.5rem;
    margin-bottom: 1rem;
    border:0.1rem solid #757575;
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
<body>
    <div class="main">
         
        <h2>Add City</h2>
        <form action="/add-city" method="post">
          @csrf
        <div>
        
        @if(Session('city'))
            <p style="color:green" class="text-green-500 text-sm mt-1 py-2">{{ Session('city') }}</p>
        @endif
        <label for="state" class="text-gray-600 space-y-2">State</label>
   
        <select name="state_id" id="state" class="state_id">
            <option value="">Select State</option>
            @foreach($states as $data)
         
                <option value="{{ $data->state_id }}">{{ $data->state_name }}</option>
            @endforeach
        </select>
        @error('state_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="city_name_input" class="text-gray-600 space-y-2">City</label>
        <input name="city_name" id="city_name_input" class="city_name" placeholder="Enter City Name">
        @error('city_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <button type="submit" class="admin-login">Add City</button>
        </form>
    </div>


</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add City</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" xintegrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            width: 97%;
            padding: 0.4rem 0.3rem;
            border-radius: 5px;
            margin-top: 0.5rem;
            margin-bottom: 0.8rem;
            border: 0.1rem solid #757575;
        }

        form div input:focus {
            outline: none;
        }

        body form div select{
            width: 100%;
            padding: 0.4rem 0.4rem;
            border-radius: 5px;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
            border:0.1rem solid #757575;
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
        
        .success-message {
            color: #38a169;
            background-color: #d1fae5;
            border: 1px solid #68d391;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="main">
         
        <h2>Add City</h2>
        <form action="/add-city" method="post">
          @csrf
        <div>
        
        <label for="state" class="text-gray-600 space-y-2">State</label>
   
         <input type="text" value="{{ $stateNameToSelect ?? '' }}" class="state_id" readonly>
        <input type="hidden" name="state_id" value="{{ $stateIdToSelect ?? '' }}">
        @error('state_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="city_name_input" class="text-gray-600 space-y-2">City</label>
        <input name="city_name" id="city_name_input" class="city_name" placeholder="Enter City Name">
        @error('city_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <button type="submit" class="admin-login">Add City</button>
        </form>
    </div>


</body>
</html>