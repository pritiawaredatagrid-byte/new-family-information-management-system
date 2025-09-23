<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Family Member</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>

    <style>
        :root {
            --primary-color: #2196F3;
            --secondary-color: #f44336;
            --tertiary-color: #ffc107;
            --text-color: #424242;
            --border-color: #bdbdbd;
            --bg-color: #F5F5F5;
            --card-bg: #FFFFFF;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        body.Family-Member-body {
            font-family: sans-serif;
            background-color: var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 3rem 1rem;
        }

        .main {
            background-color: var(--card-bg);
            padding: 2.5rem 3rem;
            border-radius: 10px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 700px;
        }

        h2 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-color);
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
            text-align: center;
        }

        .alert.success {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .alert.error {
            background-color: #f2dede;
            color: #a94442;
        }

        label {
            font-weight: 300;
            color: #616161;
            margin-bottom: 0.5rem;
            display: block;
        }

        input,
        select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
            transition: border-color 0.2s;
            margin-bottom: 1rem;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(33, 150, 243, 0.2);
        }

        .marital-status {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 1rem;
        }

        .marital-status label {
            margin: 0;
            font-weight: 300;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .marital-status input[type="radio"] {
            margin: 0;
            accent-color: #e91e63;
        }

        .WeddingDate {
            margin-bottom: 1rem;
        }

        .error {
            color: var(--secondary-color);
            font-size: 0.875rem;
            margin-top: 0.3rem;
            margin-bottom: 1rem;
            display: block;
            font-weight: 100;
        }


        .admin-login {
            background-color: var(--primary-color);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            margin-top: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .admin-login:hover {
            background-color: #1976D2;
        }

        .btn.back {
            display: inline-block;
            background-color: #616161;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            margin-top: 1rem;
            width: 100%;
            text-align: center;
            transition: background-color 0.2s;
        }

        .btn.back:hover {
            background-color: #424242;
        }
    </style>
</head>

<body class="Family-Member-body">
    <div class="main">
        @if(session('success'))
            <div class="alert success" role="alert">
                <span class="message">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert error" role="alert">
                <span class="message">{{ session('error') }}</span>
            </div>
        @endif

        <h2>Add Family Member</h2>
        @if(Session::has('headId'))
    <a href="{{ route('add-member-form', ['head_id' => Session::get('headId')]) }}" class="btn btn-secondary" style="color:white; text-decoration:none;">
        Add Family Member
    </a>
@endif

        @error('user')
            <p class="error">{{ $message }}</p>
        @enderror

        <form action="{{ route('add-member-submit') }}" method="post" class="form" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">Member Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Member Name">
            </div>
            <div>
                <label for="birthdate">Birth Date</label>
                <input type="date" name="birthdate" id="birthdate">
                @error('birthdate')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="marital-status">
                <label>Marital Status</label>
                <label>
                    <input type="radio" name="status" value="married" id="married-radio">
                    Married
                </label>
                <label>
                    <input type="radio" name="status" value="unmarried" id="unmarried-radio">
                    Unmarried
                </label>
            </div>
            <div id="marital-status-group"></div>
            <div class="WeddingDate">
                <label for="wedding_date">Wedding Date</label>
                <input type="date" name="wedding_date" id="wedding_date">
            </div>
            <div>
                <label for="education">Education <span style="color:red">(optional)</span></label>
                <input type="text" name="education" id="education" placeholder="Enter Education">
            </div>
            <div>
                <label for="photo">Profile Photo <span style="color:red">(optional)</span></label>
                <input type="file" name="photo" id="photo">
            </div>
            <input type="hidden" name="head_id" value="{{ $head_id }}">
            <button type="submit" name="submit" class="admin-login">Add Family Member</button>
            <a href="/" class="btn back">Go to home page</a>
        </form>
    </div>

    <script>
        $(document).ready(function () {

            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param * 1024);
            }, 'File size must be less than {0} KB.');

            $('.form').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50
                    },
                    surname: {
                        required: true,
                        maxlength: 50
                    },
                    birthdate: {
                        required: true,
                        date: true
                    },
                    status: {
                        required: true
                    },
                    wedding_date: {
                        required: {
                            depends: function (element) {
                                return $('input[name="status"]:checked').val() === 'married';
                            }
                        }
                    },
                    photo: {
                        extension: "jpg|png",
                        filesize: 2048
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a member name.",
                        maxlength: "Name cannot exceed 50 characters."
                    },
                    surname: {
                        required: "Please enter a member surname.",
                        maxlength: "Name cannot exceed 50 characters."
                    },
                    birthdate: {
                        required: "Please enter the birth date."
                    },
                    status: {
                        required: "Please select a marital status."
                    },
                    wedding_date: {
                        required: "Please enter a wedding date for married members."
                    },
                    photo: {
                        extension: "Only JPG and PNG files are allowed.",
                        filesize: "Photo size must be less than 2MB."
                    }
                },
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "status") {
                        error.appendTo("#marital-status-group");
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $('.WeddingDate').hide();
            $('input[name="status"]').on('change', function () {
                if ($(this).val() === "married") {
                    $('.WeddingDate').show();
                } else {
                    $('.WeddingDate').hide();
                }
            });
        });
    </script>
</body>

</html>