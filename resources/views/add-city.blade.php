<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add City</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="/css/add-city.css">
</head>

<body>
    <div class="main">
        <h2>Add City</h2>

        <form id="add-city-form" method="POST">
            @csrf
            <input type="hidden" name="state_id" value="{{ $state_id }}">

            <div class="form-group">
                <label for="state_name">State</label>
                <input type="text" name="state_name" value="{{ $state_name }}" readonly>
            </div>

            <div class="form-group">
                <label for="city_name">City Name</label>
                <input type="text" name="city_name" id="city_name" placeholder="Enter City Name"
                    value="{{ old('city_name') }}">
            </div>

            <button type="submit" class="admin-login">Add City</button>
        </form>
    </div>
   
   <script>
    const checkCityUrl = "{{ route('check-city') }}";
   </script>
   <script src="/js/add-city.js"></script>

</body>

</html>