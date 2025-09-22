<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration in admin</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
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

        body {
            font-family: sans-serif;
            background-color: var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 3rem 1rem;
        }

        .card {
            background-color: var(--card-bg);
            padding: 2.5rem 3rem;
            border-radius: 10px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 900px;
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

        .error-message {
            color: var(--secondary-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem 2.5rem;
            align-items: flex-start;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 600;
            color: #616161;
            margin-bottom: 0.5rem;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(33, 150, 243, 0.2);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        label {
            font-weight: normal;
            color: #616161;
            margin-bottom: 0.5rem;
        }


        .radio-options {
            display: flex;
            gap: 2rem;
        }

        .radio-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }


        .radio-group input[type="radio"]+label {
            margin-left: 0.3rem;
        }

        .status-error-container label.error {
            color: red;
            font-size: 14px;
        }

        .hobbies-section {
            position: relative;
            padding-bottom: 4rem;
        }

        #hobbies-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .hobby-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .hobby-input {
            flex-grow: 1;
        }

        .btn-remove-hobby {
            background-color: var(--tertiary-color);
            color: #333;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.2s;
        }

        .btn-remove-hobby:hover {
            background-color: #ffb300;
        }

        .hobby-controls {
            display: flex;
            gap: 1rem;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            justify-content: flex-end;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.2s;
        }

        .btn-add {
            background-color: var(--primary-color);
            color: #fff;
        }

        .btn-add:hover {
            background-color: #1976D2;
        }

        .btn-remove-all {
            background-color: var(--secondary-color);
            color: #fff;
        }

        .btn-remove-all:hover {
            background-color: #d32f2f;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: #fff;
            flex-grow: 1;
        }

        .btn-submit:hover {
            background-color: #1976D2;
        }

        .btn-secondary {
            background-color: #616161;
            color: #fff;
            flex-grow: 1;
        }

        .btn-secondary:hover {
            background-color: #424242;
        }

        .button-group {
            margin-top: 2.5rem;
            display: flex;
            gap: 1rem;
        }

        .hidden {
            display: none;
        }

        .back-btn {
            text-decoration: none;
            color: #616161;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 2rem;
            display: inline-block;
            transition: color 0.2s;
        }

        .back-btn:hover {
            color: #000;
        }

        .error-message {
            color: var(--secondary-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .jquery-error {
            color: var(--secondary-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }
    </style>
</head>

<body class="registration-body">

    <div class="card">
        <!-- <a href="/home-page" class="back-btn" aria-label="Go back to the previous page">&#8592; Back</a> -->
        <div style="display:flex justify-content:space-between">
            @if(Session('users'))
                <div class="alert success" role="alert">
                    <span class="message">{{ Session('users') }}</span>
                </div>
            @endif
            @if(Session::has('family_head_added'))
                <button type="button" class="btn btn-secondary">
                    <a href="/add-family-member-admin/{{ Session::get('headId') }}" style="color:white; text-decoration:none;">Add
                        Family Member</a>
                </button>
            @endif
        </div>
        <h2>Add Family Head</h2>
        @error('user')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <form action="/user-registration-admin" method="post" class="form" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Family Head Name</label>
                    <input type="text" name="name" id="name" placeholder="Family Head Name">
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" id="surname" placeholder="Family Head Surname">
                    @error('surname')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" name="birthdate" id="birthdate">
                    @error('birthdate')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="tel" name="mobile_number" id="mobile_number" placeholder="Enter Mobile Number">
                    @error('mobile_number')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group full-width">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" placeholder="Enter Address"></textarea>
                    @error('address')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <select name="state" id="state" class="state">
                        <option value="">Select State</option>
                        @foreach($states as $data)
                            <option value="{{ $data->state_id }}">{{ $data->state_name }}</option>
                        @endforeach
                    </select>
                    @error('state')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <select name="city" id="city" class="city">
                        <option value="">Select City</option>
                    </select>
                    @error('city')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="tel" name="pincode" id="pincode" placeholder="Enter Pincode" maxlength="6">
                    @error('pincode')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Marital Status</label>
                    <div class="marital-status">
                        <div class="radio-options">
                            <div class="radio-group">
                                <input type="radio" id="married" name="status" value="married">
                                <label for="married">Married</label>
                                <input type="radio" id="unmarried" name="status" value="unmarried">
                                <label for="unmarried">Unmarried</label>
                            </div>
                        </div>

                    </div>
                    <div class="status-error-container"></div>
                </div>
                <div class="form-group full-width hidden" id="wedding-date-group">
                    <label for="wedding_date">Wedding Date</label>
                    <input type="date" name="wedding_date" id="wedding_date">
                </div>
                <div class="form-group hobbies-section full-width">
                    <label for="">Hobbies</label>
                    <div id="hobbies-container">

                    </div>
                    @error('hobbies.*')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    <div class="hobby-controls">
                        <button type="button" id="addHobbyBtn" class="btn btn-add">Add Hobby</button>
                        <button type="button" id="removeAllHobbiesBtn" class="btn btn-remove-all">Remove All
                            Hobbies</button>
                    </div>
                </div>
                <div class="form-group full-width">
                    <label for="photo">Profile Photo</label>
                    <input type="file" name="photo" accept="image/*" id="photo">
                    @error('photo')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="button-group">
                <button type="submit" name="submit" class="btn btn-submit">Add Family Head</button>
            </div>
        </form>
    </div>


    <script>
    $(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.validator.addMethod('isAdult', function (value, element, params) {
        if (!value) return true;
        const birthDate = new Date(value);
        const cutOffDate = new Date(params);
        return birthDate <= cutOffDate;
    }, 'Family head must be 21 years or older.');

    $.validator.addMethod('uniqueMobile', function (value, element) {
        let isUnique = false;
        $.ajax({
            type: "POST",
            url: "/check-mobile-uniqueness",
            data: { mobile_number: value },
            dataType: "json",
            async: false,
            success: function (response) {
                isUnique = response.isUnique;
            }
        });
        return isUnique;
    }, 'This mobile number is already registered.');

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1024);
    }, 'File size must be less than {0} KB.');


    $('.form').validate({
        errorElement: 'span',
        errorClass: 'jquery-error',
        rules: {
            name: { required: true, maxlength: 50 },
            surname: { required: true, maxlength: 50 },
            birthdate: { required: true, date: true, isAdult: "2004-09-16" },
            mobile_number: { required: true, numeric: true, digits: 10, uniqueMobile: true },
            address: { required: true },
            state: { required: true },
            city: { required: true },
            pincode: { required: true, digits: 6 },
            status: { required: true },
            'hobbies[]': { required: true },
            photo: { required: true, extension: "jpg|png", filesize: 2048 }
        },
        messages: {
            'hobbies[]': { required: "At least 1 hobby is required." }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") === "status") {
                $(".status-error-container").html(error);
            } else if (element.attr("name").startsWith("hobbies")) {
                $("#hobbies-container .error-message").remove();
                error.addClass("error-message").appendTo("#hobbies-container");
            } else {
                error.insertAfter(element);
            }
        },
    });


    $('.form').on('submit', function (e) {
        e.preventDefault();

        $('.alert').remove();
        $('.error-message').remove();

        if ($(this).valid()) {
            const formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('.card').prepend('<div class="alert success" role="alert"><span class="message">' + response.users + '</span></div>');

                    if (response.family_head_added) {
                        $('.card').find('.btn-secondary').remove();
                        $('.card').prepend('<button type="button" class="btn btn-secondary"><a href="/add-family-member-admin/' + response.headId + '" style="color:white; text-decoration:none;">Add Family Member</a></button>');
                    }

                    $('.form')[0].reset();
                    $('#wedding-date-group').addClass('hidden');
                    $('#hobbies-container').empty();
                    addHobbyRow();
                },
                error: function (xhr) {
                    const errors = xhr.responseJSON.errors;
                    if (xhr.status === 422 && errors) {
                        $.each(errors, function (field, messages) {
                            let inputField = $('[name="' + field + '"]');
                            if (!inputField.length && field.includes('.')) {
                                inputField = $('[name="' + field.replace(/\.\d+/, '[]') + '"]');
                            }
                            if (inputField.length) {
                                inputField.after('<span class="jquery-error">' + messages[0] + '</span>');
                            } else {
                                $('.button-group').before('<p class="error-message">' + messages[0] + '</p>');
                            }
                        });
                    } else {
                        $('.card').prepend('<div class="alert error" role="alert"><span class="message">An unexpected error occurred. Please try again.</span></div>');
                    }
                }
            });
        }
    });

    const weddingDateGroup = $('#wedding-date-group');
    $('input[name="status"]').on('change', function () {
        if ($(this).val() === 'married') {
            weddingDateGroup.removeClass('hidden');
        } else {
            weddingDateGroup.addClass('hidden');
            $('#wedding_date').rules('remove', 'required');
        }
    });

    $('.state').on('change', function () {
        const idState = $(this).val();
        $('.city').html('<option value="">Select City</option>');
        if (idState) {
            $.ajax({
                url: "{{ route('get.cities') }}",
                type: "POST",
                data: {
                    state_id: idState,
                },
                dataType: 'json',
                success: function (cities) {
                    $.each(cities, function (key, value) {
                        $('.city').append('<option value="' + value.city_name + '">' + value.city_name + '</option>');
                    });
                }
            });
        }
    });

    const hobbiesContainer = $('#hobbies-container');

    function addHobbyRow() {
        const newHobbyRow = `
            <div class="hobby-row">
                <input type="text" name="hobbies[]" placeholder="Enter hobby here" class="hobby-input">
                <button type="button" class="btn btn-remove-hobby">Remove</button>
            </div>
        `;
        hobbiesContainer.append(newHobbyRow);
    }

    $('#addHobbyBtn').on('click', addHobbyRow);

    hobbiesContainer.on('click', '.btn-remove-hobby', function () {
        if (hobbiesContainer.find('.hobby-row').length > 1) {
            $(this).closest('.hobby-row').remove();
        }
    });

    $('#removeAllHobbiesBtn').on('click', function () {
        hobbiesContainer.empty();
        addHobbyRow();
    });

    addHobbyRow();
});
</script>
</body>

</html>