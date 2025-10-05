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

    <style>
        body {
            background-color: #F5F5F5;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            padding-top: 5rem;
            font-family: 'Arial', sans-serif;
        }

        .main {
            background-color: white;
            padding: 2.5rem 3rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            transition: transform 0.2s ease-in-out;
        }

        .main:hover {
            transform: translateY(-2px);
        }

        .main h2 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            color: #424242;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        form div {
            position: relative;
        }

        form div label {
            color: #757575;
            font-size: 0.95rem;
            font-weight: 500;
            display: block;
            margin-bottom: 0.3rem;
        }

        form div input {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border-radius: 6px;
            margin-top: 0.3rem;
            border: 1px solid #757575;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        form div input:focus {
            outline: none;
            border-color: #2196F3;
            box-shadow: 0 0 5px rgba(33, 150, 243, 0.3);
        }

        form div input:read-only {
            background-color: #E0E0E0;
            cursor: not-allowed;
        }

        form div input::placeholder {
            color: #9E9E9E;
        }

        form div select {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border-radius: 6px;
            margin-top: 0.3rem;
            border: 1px solid #757575;
            font-size: 1rem;
            appearance: none;

            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        form div select:focus {
            outline: none;
            border-color: #2196F3;
            box-shadow: 0 0 5px rgba(33, 150, 243, 0.3);
        }

        form .admin-login {
            width: 100%;
            background-color: #2196F3;
            border-radius: 6px;
            padding: 0.7rem 1rem;
            color: white;
            border: none;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;

        }

        form .admin-login:hover {
            background-color: #1976D2;
            transform: translateY(-1px);
        }

        form .admin-login:active {
            transform: translateY(0);
        }

        .main p {
            color: red;
            /* margin-bottom: 1rem; */
            font-size: 0.9rem;
            /* text-align: center; */
        }

        .success-message {
            color: #38a169;
            border: 1px solid #68d391;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.95rem;
            margin-bottom: 0.8rem;
            text-align: center;
            transition: opacity 0.3s ease;
        }

        .text-red-500 {
            color: red;
            padding: 0.5rem;
            border-radius: 4px;
            font-size: 0.95rem;

        }

        label.error {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }

        @media (max-width: 480px) {
            .main {
                padding: 1.5rem 2rem;
                max-width: 90%;
            }

            .main h2 {
                font-size: 1.5rem;
            }

            form .admin-login {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="main">
        <h2>Add City</h2>

        <form id="add-city-form" method="POST" action="{{ route('add-city') }}">
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
        $("#add-city-form").validate({
            rules: {
                city_name: {
                    required: true,
                    minlength: 2,
                    remote: {
                        url: "{{ route('check-city') }}",
                        type: "post",
                        data: {
                            city_name: function () {
                                return $("#city_name").val();
                            },
                            state_id: function () {
                                return $("input[name=state_id]").val();
                            },
                            _token: $('meta[name="csrf-token"]').attr("content")
                        }
                    }
                }
            },
            messages: {
                city_name: {
                    required: "City name is required",
                    minlength: "City name must be at least 2 characters",
                    remote: "This city name already exists in the selected state"
                }
            },
            errorPlacement: function (error, element) {
                error.addClass("text-red-500 text-sm mt-1");
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    </script>
</body>

</html>