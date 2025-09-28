<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin State</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
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
            max-width: 400px;
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

        form div input::placeholder {
            color: #9E9E9E;

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
            transition: background-color 0.3s ease, transform 0.2s ease;
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
            margin-bottom: 1rem;
            margin-top: 1rem;
            font-size: 0.9rem;
            /* text-align: center; */
        }

        .text-green-500 {
            color: #2e7d32;
            background-color: #e8f5e9;
            padding: 0.5rem;
            border-radius: 4px;
            font-size: 0.95rem;
            text-align: center;
        }

        .text-red-500 {
            color: #a94442;
            font-size: 0.95rem;
            text-align: left;
        }

        .error-message-style {
            color: red;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            margin-top: 1rem;
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
        <h2>Add State</h2>
        <div class="error-container"></div>
        <form action="/add-state" method="post" id="ajax-form">
            @csrf
            <div>
                @if(Session('state'))
                    <p class="text-green-500">{{ Session('state') }}</p>
                @endif
                <label for="" class="text-gray-600 space-y-2">State</label>
                <input type="text" value="" name="state_name" placeholder="Enter State Here">
                <div class="state_name-error error-message-style"></div>
            </div>
            <button type="submit" class="admin-login">Add State</button>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $('#ajax-form').on('submit', function (e) {
                e.preventDefault();


                $('.error-message-style').text('');
                $('.error-container').text('');

                $.ajax({
                    type: 'POST',
                    url: '/admin-login',
                    data: $(this).serialize(),
                    success: function (response) {

                        window.location.href = '/dashboard';
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.email) {
                                $('.email-error').text(errors.email[0]);
                            }
                            if (errors.password) {
                                $('.password-error').text(errors.password[0]);
                            }
                        } else if (xhr.status === 401 || xhr.status === 400) {
                            $('.error-container').html(`<p class="error-message">Invalid credentials.</p>`);
                        } else {
                            $('.error-container').html(`<p class="error-message">Something went wrong.</p>`);
                        }
                    }
                });
            });
        });
    </script>

</body>

</html> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin State</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            max-width: 400px;
        }

        .main h2 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            color: #424242;
            font-weight: 600;
        }

        label {
            display: block;
            margin-bottom: 0.3rem;
            font-size: 0.95rem;
            font-weight: 500;
            color: #757575;
        }

        input {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border-radius: 6px;
            border: 1px solid #757575;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #2196F3;
            box-shadow: 0 0 5px rgba(33, 150, 243, 0.3);
        }

        .admin-login {
            width: 100%;
            background-color: #2196F3;
            border-radius: 6px;
            padding: 0.7rem 1rem;
            color: white;
            border: none;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 1rem;
        }

        .admin-login:hover {
            background-color: #1976D2;
        }

        .error {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.4rem;
        }

        #success-message {
            color: green;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="main">
        <h2>Add State</h2>
        <div id="success-message"></div>
        <form id="ajax-form" method="POST" action="/add-state">
            @csrf
            <div>
                <label for="state_name">State</label>
                <input type="text" name="state_name" id="state_name" placeholder="Enter State Here">
            </div>
            <button type="submit" class="admin-login">Add State</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });


            $("#ajax-form").validate({
                rules: {
                    state_name: {
                        required: true,
                        minlength: 2
                    }
                },
                messages: {
                    state_name: {
                        required: "State name is required",
                        minlength: "State name must be at least 2 characters"
                    }
                },
                errorClass: "error",
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: "/add-state",
                        data: $(form).serialize(),
                        success: function (response) {

                            let stateId = response.state_id;
                            let stateName = encodeURIComponent(response.state_name);
                            window.location.href = `/add-city?state_id=${stateId}&state_name=${stateName}`;
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                if (errors.state_name) {
                                    $("#state_name").after('<label class="error">' + errors.state_name[0] + '</label>');
                                }
                            } else {
                                $("#success-message").text("Something went wrong.").css("color", "red");
                            }
                        }
                    });
                }
            });

            $("#state_name").on("input", function () {
                $(this).next("label.error").remove();
            });
        });
    </script>
</body>

</html>