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
        <form id="ajax-form" method="POST" >
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
                submitHandler: function (form, event) {
    event.preventDefault(); 

    $.ajax({
        type: "POST",
        url: "/add-state",
        data: $(form).serialize(),
        success: function (response) {
            console.log("Redirecting to add-city with:", response);
            let stateId = response.state_id;
            let stateName = encodeURIComponent(response.state_name);
            window.location.href = `/state-list`;
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

    return false;
                }
            });

            $("#state_name").on("input", function () {
                $(this).next("label.error").remove();
            });
        });
    </script>
</body>

</html>