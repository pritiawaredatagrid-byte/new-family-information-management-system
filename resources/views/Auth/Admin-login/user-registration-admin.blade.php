

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration in admin</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
      h3 {
       margin-top: 2rem;
        margin-bottom: 2rem;
        color: var(--text-color);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem 2rem;
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
        font-weight: normal;
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

    .radio-options {
        display: flex;
        gap: 2rem;
    }

    .radio-group {
        display: flex;
        align-items: center;
        gap: 1rem;
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
        margin-top:2rem;
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
        width: 100%;
    }

    .btn-submit:hover {
        background-color: #1976D2;
    }

    .error-message {
        color: var(--secondary-color);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .member-form {
        background-color: #f9f9f9;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border: 1px solid #e0e0e0;
    }

    .member-form h4 {
        margin-top: 0;
        margin-bottom: 1rem;
        color: var(--text-color);
    }

    .btn-remove-member {
        background-color: var(--secondary-color);
        color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-remove-member:hover {
        background-color: #d32f2f;
    }


</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
        }

        h2, h3, h4 {
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="tel"], input[type="date"], input[type="file"], textarea, select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="tel"]:focus, input[type="date"]:focus, textarea:focus, select:focus {
            border-color: #007bff;
            outline: none;
        }

        .radio-options {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .radio-options label {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: normal;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        .jquery-error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            font-weight: bold;
        }

        .btn-add {
            background-color: #28a745;
            color: #fff;
        }
        .btn-add:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-submit {
            background-color: #007bff;
            color: #fff;
            width: 100%;
            font-size: 16px;
        }
        .btn-submit:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        
        .btn-remove-member {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-remove-member:hover {
            background-color: #c82333;
        }

        .hobby-row, .member-form {
            border: 1px dashed #ccc;
            padding: 15px;
            margin-top: 15px;
            border-radius: 8px;
        }
        
        .hobby-row {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .hobby-input {
            flex-grow: 1;
        }

        .btn-remove-hobby {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-remove-all {
            background-color: #f0ad4e;
            color: #fff;
        }

        .hobby-controls {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        
        .hidden {
            display: none;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: #ccc;
            margin: 20px 0;
        }
    </style>
</head>
<body class="registration-body">
    <div class="card">
        <h2>Registration Form</h2>
        <div id="loading-spinner" style="display: none; text-align: center; color: #007bff;">
            <p>Submitting form...</p>
        </div>
        <div id="success-message" style="display: none; text-align: center; color: #28a745;">
            <p>Family Head and Members Added Successfully!</p>
        </div>

        <form action="/user-registration" method="POST" enctype="multipart/form-data" id="registrationForm">
            @csrf

            <h3>Family Head Details</h3>

            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Family Head Name</label>
                    <input type="text" name="head[name]" id="name" placeholder="Family Head Name">
                </div>

                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" name="head[surname]" id="surname" placeholder="Family Head Surname">
                </div>

                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" name="head[birthdate]" id="birthdate">
                </div>

                <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="tel" name="head[mobile_number]" id="mobile_number" placeholder="Enter Mobile Number">
                </div>

                <div class="form-group full-width">
                    <label for="address">Address</label>
                    <textarea name="head[address]" id="address" placeholder="Enter Address"></textarea>
                </div>

                <div class="form-group">
                    <label for="state">State</label>
                    <select name="head[state]" id="state" class="state">
                        <option value="">Select State</option>
                        @foreach($states as $data)
                            <option value="{{ $data->state_id }}">{{ $data->state_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <select name="head[city]" id="city" class="city">
                        <option value="">Select City</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="tel" name="head[pincode]" id="pincode" placeholder="Enter Pincode" maxlength="6">
                </div>

                <div class="form-group">
                    <label>Marital Status</label>
                    <div class="radio-options">
                        <label><input type="radio" name="head[status]" value="married" @if(old('head.status') == 'married') checked @endif> Married</label>
                        <label><input type="radio" name="head[status]" value="unmarried" @if(old('head.status') == 'unmarried') checked @endif> Unmarried</label>
                    </div>
                </div>

                <div class="form-group" id="wedding-date-group">
                    <label for="wedding_date">Wedding Date</label>
                    <input type="date" name="head[wedding_date]" id="wedding_date">
                </div>


                <div class="form-group full-width hobbies-section">
                    <label for="">Hobbies</label>
                    <div id="hobbies-container"></div>
                    <div class="hobby-controls">
                        <button type="button" id="addHobbyBtn" class="btn btn-add">Add Hobby</button>
                        <button type="button" id="removeAllHobbiesBtn" class="btn btn-remove-all">Remove All Hobbies</button>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="photo">Profile Photo</label>
                    <input type="file" name="head[photo]" accept="image/*" id="photo">
                </div>
            </div>

            <hr>

            <div id="member-section">
                
            </div>

            <button type="button" id="addMemberBtn" class="btn btn-add">
                ➕ Add Family Member
            </button>

            <br><br>

            <button type="submit" class="btn btn-submit">Submit All</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
           
            $.validator.addMethod('isAdult', function (value, element, params) {
                if (!value) return true;
                const birthDate = new Date(value);
                const cutOffDate = new Date(params);
                return birthDate <= cutOffDate;
            }, 'Family head must be 21 years or older.');

          
            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param);
            }, 'File size must be less than {0} bytes.');

            
            const form = $('#registrationForm');
            form.validate({
                errorElement: 'span',
                errorClass: 'jquery-error',
                ignore: ':hidden:not(.ignore-validation)',
                rules: {
                    'head[name]': { required: true, maxlength: 50 },
                    'head[surname]': { required: true, maxlength: 50 },
                    'head[birthdate]': { required: true, date: true, isAdult: "2004-09-16" },
                    'head[mobile_number]': {
                        required: true,
                        numeric: true,
                        digits: 10,
                        remote: {
                            url: '/check-mobile-uniqueness',
                            type: 'POST',
                            data: {
                                mobile_number: function () {
                                    return $('#mobile_number').val();
                                },
                                _token: '{{ csrf_token() }}' 
                            }
                        }
                    },
                    'head[address]': { required: true },
                    'head[state]': { required: true },
                    'head[city]': { required: true },
                    'head[pincode]': { required: true, digits: 6 },
                    'head[status]': { required: true },
                    'head[wedding_date]': {
                        required: {
                            depends: function(element) {
                                return $('input[name="head[status]"]:checked').val() === 'married';
                            }
                        },
                        date: true
                    },
                    'hobbies[]': { required: true },
                    'head[photo]': { required: true, extension: "jpg|png", filesize: 2048 * 1024 }
                },
                messages: {
                    'head[mobile_number]': {
                        remote: "This mobile number is already registered."
                    },
                },
                errorPlacement: function (error, element) {
                    if (element.attr("name") === "head[status]") {
                        error.insertAfter(element.closest('.radio-options'));
                    } else if (element.attr("name") === "hobbies[]") {
                        error.insertAfter($('#hobbies-container'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    submitFormAjax($(form));
                }
            });

            function submitFormAjax(form) {
                $('#loading-spinner').show();
                $('.jquery-error').remove(); 
                
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: new FormData(form[0]),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#loading-spinner').hide();
                        $('#success-message').show();
                        form.trigger('reset'); 
                        $('#member-section').empty(); 
                        hobbiesContainer.empty();
                        addHobbyRow();
                    },
                    error: function (xhr) {
                        $('#loading-spinner').hide();
                        if (xhr.status === 422) { 
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                const element = form.find('[name="' + key.replace(/\./g, '\\]\\[') + '"]');
                                const errorSpan = $(`<span class="jquery-error">${value[0]}</span>`);
                                
                                if (element.length) {
                                    if (element.is(':radio')) {
                                        errorSpan.insertAfter(element.closest('.radio-options'));
                                    } else {
                                        errorSpan.insertAfter(element.last());
                                    }
                                }
                            });
                        } else {
                            alert('An unexpected error occurred. Please try again.');
                        }
                    }
                });
            }

           
            function toggleWeddingDate() {
                const selectedStatus = $('input[name="head[status]"]:checked').val();
                if (selectedStatus === 'married') {
                    $('#wedding-date-group').removeClass('hidden');
                } else {
                    $('#wedding-date-group').addClass('hidden');
                }
                $('#wedding_date').valid();
            }

            $('input[name="head[status]"]').on('change', toggleWeddingDate);
            toggleWeddingDate();
            
       
            $('.state').on('change', function () {
                const idState = $(this).val();
                $('.city').html('<option value="">Select City</option>');
                if (idState) {
                    $.ajax({
                        url: "{{ route('get.cities') }}",
                        type: "POST",
                        data: {
                            state_id: idState,
                            _token: '{{ csrf_token() }}'
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
                form.validate().element('[name="hobbies[]"]');
            });

            $('#removeAllHobbiesBtn').on('click', function () {
                hobbiesContainer.empty();
                addHobbyRow();
                form.validate().element('[name="hobbies[]"]');
            });

            addHobbyRow();

            
            let memberIndex = 0;

            function getMemberForm(index) {
                const formHtml = `
                <div class="member-form" data-index="${index}">
                    <h4>Member ${index + 1}</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="members[${index}][name]" id="member_name_${index}">
                        </div>
                        <div class="form-group">
                            <label>Birthdate</label>
                            <input type="date" name="members[${index}][birthdate]" id="member_birthdate_${index}">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="radio-options" id="member_status_options_${index}">
                                <label><input type="radio" name="members[${index}][status]" value="married" class="member-status"> Married</label>
                                <label><input type="radio" name="members[${index}][status]" value="unmarried" class="member-status"> Unmarried</label>
                            </div>
                        </div>
                        <div class="form-group wedding-date-member hidden">
                            <label>Wedding Date (optional)</label>
                            <input type="date" name="members[${index}][wedding_date]" id="member_wedding_date_${index}">
                        </div>
                        <div class="form-group">
                            <label>Education (optional)</label>
                            <input type="text" name="members[${index}][education]">
                        </div>
                        <div class="form-group">
                            <label>Relation</label>
                            <input type="text" name="members[${index}][relation]">
                        </div>
                        <div class="form-group">
                            <label for="member-photo-${index}">Profile Photo <span style="color:red">(optional)</span></label>
                            <input type="file" name="members[${index}][photo]" id="member-photo-${index}">
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <button type="button" class="btn btn-remove-member" onclick="removeMemberForm(this)">Remove Member</button>
                    </div>
                    <hr>
                </div>
                `;
                return formHtml;
            }

            document.getElementById('addMemberBtn').addEventListener('click', function () {
                const container = document.getElementById('member-section');
                container.insertAdjacentHTML('beforeend', getMemberForm(memberIndex));
                
                $(`input[name="members[${memberIndex}][name]"]`).rules('add', { required: true });
                $(`input[name="members[${memberIndex}][birthdate]"]`).rules('add', { required: true, date: true });
                $(`input[name="members[${memberIndex}][status]"]`).rules('add', { required: true });
                $(`input[name="members[${memberIndex}][wedding_date]"]`).rules('add', { 
                    date: true,
                    depends: function(element) {
                        return $(`input[name="members[${memberIndex}][status]"]:checked`).val() === 'married';
                    }
                });

                memberIndex++;
            });

            window.removeMemberForm = function(button) {
                const memberForm = $(button).closest('.member-form');
                memberForm.remove();
            };

       
            $('#member-section').on('change', '.member-status', function() {
                const status = $(this).val();
                const memberForm = $(this).closest('.member-form');
                const weddingDateGroup = memberForm.find('.wedding-date-member');
                const weddingDateInput = weddingDateGroup.find('input[type="date"]');
                
                if (status === 'married') {
                    weddingDateGroup.removeClass('hidden');
                } else {
                    weddingDateGroup.addClass('hidden');
                }
                
                weddingDateInput.valid();
            });
        });
    </script>
</body>


</html>