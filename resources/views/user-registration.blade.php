

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

<body class="registration-body">
    <div class="card">
        <h2>Registration Form</h2>

        <form action="/user-registration" method="POST" enctype="multipart/form-data" id="registrationForm">
            @csrf

            <h3>Family Head Details</h3>

            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Family Head Name</label>
                    <input type="text" name="head[name]" id="name" placeholder="Family Head Name">
                    @error('name')<p class="error-message">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" name="head[surname]" id="surname" placeholder="Family Head Surname">
                    @error('surname')<p class="error-message">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" name="head[birthdate]" id="birthdate">
                    @error('birthdate')<p class="error-message">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="tel" name="head[mobile_number]" id="mobile_number" placeholder="Enter Mobile Number">
                    @error('mobile_number')<p class="error-message">{{ $message }}</p>@enderror
                </div>

                <div class="form-group full-width">
                    <label for="address">Address</label>
                    <textarea name="head[address]" id="address" placeholder="Enter Address"></textarea>
                    @error('address')<p class="error-message">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="state">State</label>
                    <select name="head[state]" id="state" class="state">
                        <option value="">Select State</option>
                        @foreach($states as $data)
                            <option value="{{ $data->state_id }}">{{ $data->state_name }}</option>
                        @endforeach
                    </select>
                    @error('state')<p class="error-message">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <select name="head[city]" id="city" class="city">
                        <option value="">Select City</option>
                    </select>
                    @error('city')<p class="error-message">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="tel" name="head[pincode]" id="pincode" placeholder="Enter Pincode" maxlength="6">
                    @error('pincode')<p class="error-message">{{ $message }}</p>@enderror
                </div>

<div class="form-group">
    <label>Marital Status</label>
    <div class="radio-options">
        <label><input type="radio" name="head[status]" value="married"> Married</label>
        <label><input type="radio" name="head[status]" value="unmarried"> Unmarried</label>
    </div>
</div>

<div class="form-group" id="wedding-date-group">
    <label for="wedding_date">Wedding Date</label>
    <input type="date" name="head[wedding_date]" id="wedding_date">
</div>


                <div class="form-group full-width hobbies-section">
                    <label for="">Hobbies</label>
                    <div id="hobbies-container"></div>
                    @error('hobbies.*')<p class="error-message">{{ $message }}</p>@enderror
                    <div class="hobby-controls">
                        <button type="button" id="addHobbyBtn" class="btn btn-add">Add Hobby</button>
                        <button type="button" id="removeAllHobbiesBtn" class="btn btn-remove-all">Remove All Hobbies</button>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="photo">Profile Photo</label>
                    <input type="file" name="head[photo]" accept="image/*" id="photo">
                    @error('photo')<p class="error-message">{{ $message }}</p>@enderror
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
                return this.optional(element) || (element.files[0].size <= param * 1024);
            }, 'File size must be less than {0} KB.');


            $('#registrationForm').validate({

    errorElement: 'span',
    errorClass: 'jquery-error',

    rules: {
        name: { required: true, maxlength: 50 },
        surname: { required: true, maxlength: 50 },
        birthdate: { required: true, date: true, isAdult: "2004-09-16" },
        mobile_number: {
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
            _token: function () {
                return $('meta[name="csrf-token"]').attr('content');
            }
        }
    }
},
        address: { required: true },
        state: { required: true },
        city: { required: true },
        pincode: { required: true, digits: 6 },
        status: { required: true },
        'hobbies[]': { required: true },
        photo: { required: true, extension: "jpg|png", filesize: 2048 }
    },

    messages: {
        mobile_number: {
            remote: "This mobile number is already registered."
        }
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
    }

});

function toggleWeddingDate() {
    const selectedStatus = $('input[name="head[status]"]:checked').val();
    if (selectedStatus === 'married') {
        $('#wedding-date-group').addClass('hidden');
    } else {
         $('#wedding-date-group').removeClass('hidden');
    }
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
            });

            $('#removeAllHobbiesBtn').on('click', function () {
                hobbiesContainer.empty();
                addHobbyRow();
            });

            addHobbyRow();
        });


    
       
    let memberIndex = 0;

   function getMemberForm(index) {
    return `
    <h3>Family Members</h3>
        <div class="member-form" data-index="${index}">
            <h4>Member ${index + 1}</h4>
            <div class="form-grid">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="members[${index}][name]" required>
                </div>
                <div class="form-group">
                    <label>Birthdate</label>
                    <input type="date" name="members[${index}][birthdate]" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <div class="radio-options">
                        <label><input type="radio" name="members[${index}][status]" value="married"> Married</label>
                        <label><input type="radio" name="members[${index}][status]" value="unmarried"> Unmarried</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Wedding Date (optional)</label>
                    <input type="date" name="members[${index}][wedding_date]">
                </div>
                <div class="form-group">
                    <label>Education (optional)</label>
                    <input type="text" name="members[${index}][education]">
                </div>
                <div>
                <label for="photo">Profile Photo <span style="color:red">(optional)</span></label>
                <input type="file" name="photo" id="photo">
            </div>
                <div class="form-group">
                    <label>Relation (optional)</label>
                    <input type="text" name="members[${index}][relation]">
                </div>
                <div class="form-group full-width">
                    <button type="button" class="btn btn-remove-member" onclick="removeMemberForm(this)">Remove Member</button>
                </div>
            </div>
            <hr>
        </div>
    `;
}
function removeMemberForm(button) {
    $(button).closest('.member-form').remove();
}
    document.getElementById('addMemberBtn').addEventListener('click', function () {
        const container = document.getElementById('member-section');
        container.insertAdjacentHTML('beforeend', getMemberForm(memberIndex));
        memberIndex++;
    });


    </script>
</body>

</html>