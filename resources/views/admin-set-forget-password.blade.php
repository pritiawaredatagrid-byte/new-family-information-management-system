<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

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
            background-color: var(--card-background);
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 4px 12px var(--shadow-color);
            max-width: 450px;
            width: 90%;
            text-align: center;
        }

        .main h2 {
            color: #484E54;
            font-size: 1.9rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group .label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 1.2rem;
            color: var(--secondary-color);
        }

        .form-group input {
            width: 100%;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            color: var(--text-color);
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-group input::placeholder {
            color: var(--secondary-color);
            opacity: 0.6;
        }

        .admin-login {
            width: 100%;
            background-color: var(--primary-color);
            border: none;
            border-radius: 0.5rem;
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            padding: 1rem 2rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .admin-login:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .error-message {
            color: red;
            font-size: 1rem;
            margin-top: 0.25rem;
        }

        .success-message {
            color: green;
            font-size: 1rem;
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

        <div class="error-container"></div>
        <div class="success-message" id="success-message"></div>

        <form id="resetPasswordForm" method="POST" action="/admin-set-forget-password">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <label for="password" class="label">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Admin Password">
                <div class="error-message" id="error-password"></div>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Confirm Admin Password">
                <div class="error-message" id="error-password_confirmation"></div>
            </div>

            <button type="submit" class="admin-login">Update Password</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });


            $("#resetPasswordForm").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 6 characters"
                    },
                    password_confirmation: {
                        required: "Confirm password is required",
                        equalTo: "Passwords do not match"
                    }
                },
                errorPlacement: function (error, element) {
                    let fieldName = element.attr("name");
                    $("#error-" + fieldName).html(error);
                },
                submitHandler: function (form, event) {
                    event.preventDefault();

                    $(".error-message").text("");
                    $("#success-message").text("");
                    $(".error-container").text("");

                    $.ajax({
                        type: "POST",
                        url: $(form).attr("action"),
                        data: $(form).serialize(),
                        success: function (response) {
                            $("#success-message").text(response.message || "Password updated successfully!");
                            $(form).trigger("reset");
                            window.location.href = "/admin-login";
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function (field, messages) {
                                    $("#error-" + field).text(messages[0]);
                                });
                            } else {
                                $(".error-container").html('<p class="error-message">Something went wrong.</p>');
                            }
                        }
                    });
                }
            });


            $("input").on("input", function () {
                let name = $(this).attr("name");
                $("#error-" + name).text("");
                $("#success-message").text("");
            });
        });
    </script>
</body>