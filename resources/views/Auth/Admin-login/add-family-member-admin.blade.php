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
        <h2>Add Family Member</h2>

        <div id="success-message" style="color:green;display:none;padding:1rem 0;"></div>

        <form id="add-family-member-form" action="{{ route('add-member-submit-admin') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="encrypted_id" value="{{ $encrypted_id }}">

            <div>
                <label for="name">Member Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Member Name">
                <span class="error-message" id="name_error"></span>
            </div>

            <div>
                <label for="birthdate">Birth Date</label>
                <input type="date" name="birthdate" id="birthdate">
                <span class="error-message" id="birthdate_error"></span>
            </div>

            <div class="marital-status" id="marital-status-group">
                <label>Marital Status</label>
                <label><input type="radio" name="status" value="married"> Married</label>
                <label><input type="radio" name="status" value="unmarried"> Unmarried</label>
                <span class="error-message" id="status_error"></span>
            </div>

            <div class="WeddingDate">
                <label for="wedding_date">Wedding Date</label>
                <input type="date" name="wedding_date" id="wedding_date">
                <span class="error-message" id="wedding_date_error"></span>
            </div>

            <div>
                <label for="education">Education <span style="color:red">(optional)</span></label>
                <input type="text" name="education" id="education" placeholder="Enter Education">
            </div>

            <div>
                <label for="relation">Relation</label>
                <input type="text" name="relation" id="relation" placeholder="Enter Relation">
                <span class="error-message" id="relation_error"></span>
            </div>

            <div>
                <label for="photo">Profile Photo <span style="color:red">(optional)</span></label>
                <input type="file" name="photo" id="photo">
                <span class="error-message" id="photo_error"></span>
            </div>

            <button type="submit" class="admin-login">Add Family Member</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            var headId = "{{ $encrypted_id }}";

            $('.WeddingDate').hide();
            $('input[name="status"]').on('change', function () {
                if ($(this).val() === "married") {
                    $('.WeddingDate').show();
                } else {
                    $('.WeddingDate').hide();
                }
            });


            $.validator.addMethod("beforeToday", function (value, element) {
                if (!value) return false;
                let inputDate = new Date(value);
                let today = new Date();
                today.setHours(0, 0, 0, 0);
                return inputDate < today;
            }, "Birthdate must be before today.");

            $.validator.addMethod("filesize", function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param * 1024);
            }, "File size must be less than {0} KB.");


            $("#add-family-member-form").validate({
                rules: {
                    name: { required: true, maxlength: 50 },
                    birthdate: { required: true, date: true, beforeToday: true },
                    status: { required: true },
                    wedding_date: {
                        required: function () { return $('input[name="status"]:checked').val() === 'married'; }
                    },
                    relation: { required: true, maxlength: 100 },
                    photo: { extension: "jpg|png", filesize: 2048 }
                },
                messages: {
                    name: { required: "Please enter a member name.", maxlength: "Name cannot exceed 50 characters." },
                    birthdate: { required: "Please enter birthdate.", beforeToday: "Birthdate must be earlier than today." },
                    status: { required: "Please select a marital status." },
                    wedding_date: { required: "Please enter wedding date for married members." },
                    relation: { required: "Please enter relation." },
                    photo: { extension: "Only JPG and PNG files allowed.", filesize: "Photo must be less than 2MB." }
                },
                errorPlacement: function (error, element) {
                    if (element.attr("name") === "status") {
                        error.appendTo("#marital-status-group");
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {

                    let formData = new FormData(form);
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $("#success-message").text(response.message).show();
                            form.reset();
                            setTimeout(function () {
                                window.location.href = '/view-family-details/' + headId;
                            }, 1000);
                        },
                        error: function (xhr) {
                            $(".error").remove();
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function (key, value) {
                                    $("[name='" + key + "']").after('<p class="error" style="color:red;">' + value[0] + '</p>');
                                });
                            }
                        }
                    });
                    return false;
                }
            });
        });
    </script>
</body>


</html>