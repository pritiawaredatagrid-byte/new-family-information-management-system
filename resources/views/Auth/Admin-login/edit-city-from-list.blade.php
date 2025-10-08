
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit City</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="/css/edit-city-from-list.css">
</head>

<body>
    <div class="main">
        <h2>Update City</h2>
        <form id="updateCityForm" action="{{ '/edit-city-data-from-list/' . $city->city_id }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="put">

            <div id="success-message" class="success-text" style="display:none;"></div>

            <div>
                <label for="city_name_input">City</label>
                <input name="city_name" id="city_name_input" class="city_name" placeholder="Enter City Name"
                    value="{{ old('city_name', $city->city_name) }}">
                <p class="error-text" id="city_name_error"></p>
            </div>

            <button type="submit" class="admin-login">Update City</button>
        </form>
    </div>

    <script src="/js/edit-city-from-list.js"></script>
</body>

</html>