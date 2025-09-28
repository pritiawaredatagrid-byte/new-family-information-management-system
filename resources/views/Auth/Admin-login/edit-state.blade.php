<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update State</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
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
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
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
            text-align: left;
            color: var(--secondary-color);
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
            margin-top: -0.5rem;
            margin-bottom: 0.7rem;
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
        <h2>Update State</h2>
        <form id="updateStateForm" action="/edit-state-data/{{$stateDetails->state_id}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="put">

            <div id="success-message" class="success-text" style="display:none;"></div>

            <div>
                <label for="state_name_input">State</label>
                <input type="text" name="state_name" id="state_name_input" placeholder="Enter State Here"
                    value="{{ old('state_name', $stateDetails->state_name) }}">
                <p class="error-text" id="state_name_error"></p>
            </div>

            <button type="submit" class="admin-login">Update State</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            var stateId = {{ $stateDetails->state_id }};
            $('#state_name_input').on('input', function () {
                $('#state_name_error').text('');
                $('#success-message').hide();
            });

            $('#updateStateForm').submit(function (e) {
                e.preventDefault();

                var formData = {
                    _token: $('input[name="_token"]').val(),
                    _method: 'put',
                    state_name: $('#state_name_input').val(),
                };

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#success-message').text(response.message).show();
                        $('#state_name_error').text('');
                        setTimeout(function () {
                            window.location.href = '/view-state-details/' + stateId;
                        }, 1000);
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            if (errors.state_name) {
                                $('#state_name_error').text(errors.state_name[0]);
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