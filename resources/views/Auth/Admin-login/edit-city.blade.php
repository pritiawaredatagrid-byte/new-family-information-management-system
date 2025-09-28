<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Edit City</title>
</head>
<style>
    :root {
        --primary-color: #007bff;
        --secondary-color: #6c757d;
        --background-color: #f4f7f6;
        --card-background: #ffffff;
        --text-color: #333;
        --shadow-color: rgba(0, 0, 0, 0.1);
        --border-color: #d1d5db;
    }

    body {
        background-color: #F5F5F5;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100vh;
        padding-top: 5rem;
    }

    .main {
        background-color: #ffff;
        padding: 3rem;
        border-radius: 1rem;
        box-shadow: 0 4px 12px var(--shadow-color);
        max-width: 450px;
        width: 90%;
        text-align: center;
    }


    .main h2 {
        color: #484E54;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 2rem;
    }

    form div label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--secondary-color);
        text-align: left;
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

    body form div select {
        width: 100%;
        padding: 0.4rem 0.4rem;
        border-radius: 5px;
        margin-top: 0.5rem;
        margin-bottom: 1rem;
        border: 0.1rem solid #757575;
    }

    form .admin-login {
        width: 100%;
        background-color: #0ea5e9;
        color: #fff;
        border: none;
        border-radius: 0.5rem;
        color: white;
        font-size: 1.1rem;
        font-weight: bold;
        font-size: 1.1rem;
        padding: 0.75rem 2rem;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        text-decoration: none;
        font-weight: bold;
        font-size: 1.1rem;
    }

    form .admin-login:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
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

        <h2>Update City</h2>
        <form action="{{ '/edit-city-data/' . $city->state_id . '/' . $city->city_id }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="put">
            <div>

                @if(Session('city'))
                    <p style="color:green" class="text-green-500 text-sm mt-1 py-2">{{ Session('city') }}</p>
                @endif
                <label for="state" class="text-gray-600 space-y-2">State</label>

                <input type="text" name="state_name" value="{{$state->state_name}}" disabled></input>

                @error('state_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="city_name_input" class="text-gray-600 space-y-2">City</label>
                <input name="city_name" id="city_name_input" class="city_name" placeholder="Enter City Name"
                    value="{{ old('city_name', $city->city_name) }}">
                @error('city_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="admin-login">Update City</button>
        </form>
    </div>


</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit City</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --background-color: #f4f7f6;
            --card-background: #ffffff;
            --text-color: #333;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --border-color: #d1d5db;
        }

        body {
            background-color: #F5F5F5;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            padding-top: 5rem;
            font-family: 'Poppins', sans-serif;
        }

        .main {
            background-color: #fff;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 4px 12px var(--shadow-color);
            max-width: 450px;
            width: 90%;
            text-align: center;
        }

        .main h2 {
            color: #484E54;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        form div label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color);
            text-align: left;
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
            background-color: #0ea5e9;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            font-size: 1.1rem;
            font-weight: bold;
            padding: 0.75rem 2rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        form .admin-login:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .error-text {
            color: red;
            font-size: 0.9rem;
            margin-top: 0.2rem;
            margin-bottom: 1rem;
            text-align: left;
        }

        .success-text {
            color: green;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="main">
        <h2>Update City</h2>
        <form id="updateCityForm" action="{{ '/edit-city-data/' . $city->state_id . '/' . $city->city_id }}"
            method="post">
            @csrf
            <input type="hidden" name="_method" value="put">

            <div id="success-message" class="success-text" style="display:none;"></div>

            <div>
                <label for="state" class="text-gray-600 space-y-2">State</label>
                <input type="text" name="state_name" value="{{$state->state_name}}" disabled>
            </div>

            <div>
                <label for="city_name_input" class="text-gray-600 space-y-2">City</label>
                <input name="city_name" id="city_name_input" placeholder="Enter City Name"
                    value="{{ old('city_name', $city->city_name) }}">
                <p class="error-text" id="city_name_error"></p>
            </div>

            <button type="submit" class="admin-login">Update City</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            var stateId = {{ $city->state_id  }};
            $('#city_name_input').on('input', function () {
                $('#city_name_error').text('');
                $('#success-message').hide();
            });

            $('#updateCityForm').submit(function (e) {
                e.preventDefault();

                var formData = {
                    _token: $('input[name="_token"]').val(),
                    _method: 'put',
                    city_name: $('#city_name_input').val(),
                };

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#success-message').text(response.message).show();
                        $('#city_name_error').text('');

                        setTimeout(function () {
                            window.location.href = '/view-state-details/' + stateId;
                        }, 1000);
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            if (errors.city_name) {
                                $('#city_name_error').text(errors.city_name[0]);
                            }
                        } else {
                            alert('Something went wrong! Please try again.');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>