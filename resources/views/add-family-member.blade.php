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
        .Family-Member-body {
            background-color: #F5F5F5;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            padding-top: 3.5rem;
        }

        .Family-Member-body .marital-status {
            display: flex;
            align-items: center;
        }

        .Family-Member-body .marital-status label {
            padding-right: 1rem;
        }

        .Family-Member-body .marital-status input {
            width: auto;
            margin-right: 0.5rem;
        }

        .Family-Member-body .marital-status button {
            width: 50%;
            background-color: #2196F3;
            border-radius: 5px;
            padding: 0.5rem 0.3rem;
            color: white;
            border: none;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .Family-Member-body .main {
            background-color: white;
            padding: 2rem 3rem;
            border-radius: 5%;
        }

        .Family-Member-body .main h2 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            color: #424242;
        }

        .Family-Member-body form div input {
            width: 100%;
            padding: 0.4rem 0.3rem;
            border-radius: 5px;
            margin-top: 0.5rem;
            margin-bottom: 0.7rem;
            border: 0.1rem solid #757575;
            font-size: 0.95rem;
           
        }

        .Family-Member-body form div input:focus {
            outline: none;
        }

        .Family-Member-body form .admin-login {
            width: 100%;
            background-color: #2196F3;
            border-radius: 5px;
            padding: 0.5rem 0.3rem;
            color: white;
            border: none;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .Family-Member-body form a {
            text-decoration: none;
        }

        .Family-Member-body .main p {
            color: red;
            margin-bottom: 1rem;
        }

      
        .error {
            color: red;
            font-size: 1rem;
            margin-top: 0.4rem;
            margin-bottom: 1rem;
            display: block;
        }

        
        ::placeholder {
            font-size: 0.95rem;
            color: #999;
        }
    </style>

</head>

<body class="Family-Member-body">
    <div class="main">
        <h2>Add Family Member</h2>
        @if(Session::has('family_head_added'))
            <button type="button" class="btn btn-secondary">
                <a href="{{ route('add-member-form', ['head_id' => Session::get('headId')]) }}"
                    style="color:white; text-decoration:none;">Add Family Member</a>
            </button>
        @endif
        @error('user')
            <p class="text-red-500 text-sm mt-1 py-2">{{ $message }}</p>
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
            </div>
            <div class="marital-status" >
                <label>Marital Status </label>
                <input type="radio" name="status" value="married" id="married-radio">Married &nbsp;&nbsp;
                <input type="radio" name="status" value="unmarried" id="unmarried-radio">Unmarried
            </div>
            <div id="marital-status-group">
               
            </div>

            <div>
                @error('status')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="WeddingDate">
                <label for="wedding_date">Wedding Date</label>
                <input type="date" name="wedding_date" id="wedding_date">
            </div>
            <div>
                <label for="education">Education </label>&nbsp;<span style="color:red"> (optional)</span>
                <input type="text" name="education" id="education" placeholder="Enter Education">
            </div>
            <div>
                <label for="photo">Profile Photo</label>&nbsp;<span style="color:red">(optional)</span>
                <input type="file" name="photo" id="photo">
            </div>
            <input type="hidden" name="head_id" value="{{ $head_id }}">
            <button type="submit" name="submit" class="admin-login">Add Family Member</button>
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
                errorPlacement: function(error, element) {
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