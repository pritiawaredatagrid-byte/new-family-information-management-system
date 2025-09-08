<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        body form div select{
    width: 100%;
    padding: 0.4rem 0.4rem;
    border-radius: 5px;
    margin-top: 0.5rem;
    margin-bottom: 0.7rem;
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
            <div>
                @if(Session('city'))
                  <p style="color:green" class="text-green-500 text-sm mt-1 py-2">{{ Session('city') }}</p>
                @endif  
                <label for="" class="text-gray-600 space-y-2">State</label>
                <select name="state_name" id="state" class="state">
                       <option value="">Select State</option>
                       @foreach($states as $data)
                        <option value="{{ $data->state_id }}">{{ $data->state_name }}</option>
                       @endforeach
                </select>
                @error('state')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
           <div>
                <label for="" class="text-gray-600 space-y-2">City</label>
                <input name="city_name" id="city" class="city" placeholder="Enter City Name">
   
                </input>
                @error('city_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            </div>
            <button type="submit" class="admin-login">Add City</button>
        </form>
    </div>
    <script>
        $(document).ready(function(){
        $('.state').on('change', function(){
        var idState = this.value;
        
        if (idState) {
            $.ajax({
                 url: "{{ route('add-city') }}", 
                 type: "POST",
                 data: {
                   state_id: idState,
                   _token: '{{ csrf_token() }}'
                 },
                 dataType: 'json',
            });
        }
    });
});
    </script>
</body>
</html>