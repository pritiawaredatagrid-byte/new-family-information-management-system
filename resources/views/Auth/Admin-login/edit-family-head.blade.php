<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Family Information</title>
   
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    
   
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

        .existing-photo-note {
            font-size: 0.9em;
            color: #007bff;
            margin-top: 5px;
        }
    </style>
</head>
<body class="registration-body">
    <div class="card">
        <h2>Edit Family Information</h2>
        <div id="loading-spinner" style="display: none; text-align: center; color: #007bff;">
            <p>Updating form...</p>
        </div>
        <div id="success-message" style="display: none; text-align: center; color: #28a745;">
            <p>Family Information Updated Successfully! </p>
        </div>


        <form action="{{ route('edit-family-head-data', ['id' => $familyHead->id]) }}" method="POST" enctype="multipart/form-data" id="registrationForm">
            @csrf
            @method('PUT')

            <h3>Family Head Details</h3>

            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Family Head Name</label>
                    <input type="text" name="head[name]" id="name" placeholder="Family Head Name" value="{{ $familyHead->name }}">
                    <span id="head_name-error" class="jquery-error"></span>
                </div>

                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" name="head[surname]" id="surname" placeholder="Family Head Surname" value="{{ $familyHead->surname }}">
                    <span id="head_surname-error" class="jquery-error"></span>
                </div>

                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" name="head[birthdate]" id="birthdate" value="{{ $familyHead->birthdate }}">
                    <span id="head_birthdate-error" class="jquery-error"></span>
                </div>

                <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>

                    <input type="tel" name="head[mobile_number]" id="mobile_number" placeholder="Enter Mobile Number" value="{{ $familyHead->mobile_number }}">
                    <span id="head_mobile_number-error" class="jquery-error"></span>
                </div>

                <div class="form-group full-width">
                    <label for="address">Address</label>
                    <textarea name="head[address]" id="address" placeholder="Enter Address">{{ $familyHead->address }}</textarea>
                    <span id="head_address-error" class="jquery-error"></span>
                </div>

                <div class="form-group">
    <label for="state">State</label>
    <select name="head[state]" id="state" class="state form-control">
        <option value="">Select State</option>

        @foreach($states as $data)
            <option 
                value="{{ $data->state_id }}" 
                {{-- Compare the saved STATE NAME with the current State Name in the loop --}}
                @if($familyHead->state == $data->state_name) selected @endif>
                {{ $data->state_name }}
            </option>
        @endforeach
    </select>
    <span id="head_state-error" class="jquery-error"></span>
</div>

<div class="form-group">
    <label for="city">City</label>
    <select name="head[city]" id="city" class="city form-control">
        <option value="{{ $familyHead->city }}" selected>{{ $familyHead->city }}</option>
    </select>
    <span id="head_city-error" class="jquery-error"></span>
</div>

                <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="tel" name="head[pincode]" id="pincode" placeholder="Enter Pincode" maxlength="6" value="{{ $familyHead->pincode }}">
                    <span id="head_pincode-error" class="jquery-error"></span>
                </div>

                <div class="form-group">
                    <label>Marital Status</label>
                    <div class="radio-options">
                        <label><input type="radio" name="head[status]" value="married" @if($familyHead->status == 'married') checked @endif> Married</label>
                        <label><input type="radio" name="head[status]" value="unmarried" @if($familyHead->status == 'unmarried') checked @endif> Unmarried</label>
                    </div>
                    <span id="head_status-error" class="jquery-error"></span>
                </div>

                <div class="form-group @if($familyHead->status !== 'married') hidden @endif" id="wedding-date-group">
                    <label for="wedding_date">Wedding Date</label>
                    <input type="date" name="head[wedding_date]" id="wedding_date" value="{{ $familyHead->wedding_date }}">
                    <span id="head_wedding_date-error" class="jquery-error"></span>
                </div>


                <div class="form-group full-width hobbies-section">
                    <label for="">Hobbies</label>
                    <div id="hobbies-container">

                    </div>
                    <span id="hobbies-error" class="jquery-error"></span>
                    <div class="hobby-controls">
                        <button type="button" id="addHobbyBtn" class="btn btn-add">Add Hobby</button>
                        <button type="button" id="removeAllHobbiesBtn" class="btn btn-remove-all">Remove All Hobbies</button>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="photo">Profile Photo</label>
                    <input type="file" name="head[photo]" accept="image/*" id="photo" class="ignore-validation">
                    <span id="head_photo-error" class="jquery-error"></span>
                    @if($familyHead->photo)
                    <p class="existing-photo-note">Current photo: {{ $familyHead->photo }}.</p>
                    @endif
                </div>
            </div>

            <hr>

            <div id="member-section">

            </div>

            <button type="button" id="addMemberBtn" class="btn btn-add">
                ➕ Add New Family Member
            </button>

            <br><br>

            <button type="submit" class="btn btn-submit">Update Information</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {

            const headData = @json($familyHead);
            const memberData = @json($familyHead->members ?? []);
            const hobbyData = @json($hobbies ?? []);

            let memberIndex = 0;
            const hobbiesContainer = $('#hobbies-container');


              function loadCities(stateId, selectedCity) {
            const citySelect = $('#city');
                citySelect.html('<option value="">Loading Cities...</option>');
                if (stateId) {
                    $.ajax({
                        url: "{{ route('get.cities') }}",
                        type: "POST",
                        data: {
                            state_id: stateId,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function (cities) {
                        citySelect.html('<option value="">Select City</option>');
                        $.each(cities, function (key, value) {
                            const isSelected = (value.city_name === selectedCity) ? 'selected' : ''; 
                            citySelect.append(`<option value="${value.city_name}" ${isSelected}>${value.city_name}</option>`);
                        });
                    },
                        error: function() {
                             citySelect.html('<option value="">Error loading cities</option>');
                        }
                    });
                } else {
                    citySelect.html('<option value="">Select State First</option>');
                }
            }

            function getHobbyRow(value = '') {
    return `
        <div class="hobby-row d-flex align-items-center mb-2">
            <input type="text" name="hobbies[]" placeholder="Enter hobby here" class="hobby-input form-control" value="${value.trim()}">
            
            <button type="button" class="btn btn-danger btn-remove-hobby ms-2">
                Remove 
            </button> 
        </div>
    `;
}


            function addHobbyRow(value = '') {
                hobbiesContainer.append(getHobbyRow(value));
            }


            function getMemberForm(index, member = {}) {
                const isMarried = member.status === 'married';
                const hiddenClass = isMarried ? '' : 'hidden';

                return `
                <div class="member-form" data-index="${index}">
                    <h4>Member ${index + 1}</h4>
                    ${member.id ? `<input type="hidden" name="members[${index}][id]" value="${member.id}">` : ''}
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="members[${index}][name]" required value="${member.name || ''}">
                            <span id="members_${index}_name-error" class="jquery-error"></span>
                        </div>
                        <div class="form-group">
                            <label>Birthdate</label>
                            <input type="date" name="members[${index}][birthdate]" required value="${member.birthdate || ''}">
                            <span id="members_${index}_birthdate-error" class="jquery-error"></span>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="radio-options">
                                <label><input type="radio" name="members[${index}][status]" value="married" class="member-status" ${member.status === 'married' ? 'checked' : ''}> Married</label>
                                <label><input type="radio" name="members[${index}][status]" value="unmarried" class="member-status" ${member.status === 'unmarried' ? 'checked' : ''}> Unmarried</label>
                            </div>
                            <span id="members_${index}_status-error" class="jquery-error"></span>
                        </div>
                        <div class="form-group wedding-date-member ${hiddenClass}">
                            <label>Wedding Date (optional)</label>
                            <input type="date" name="members[${index}][wedding_date]" value="${member.wedding_date || ''}">
                            <span id="members_${index}_wedding_date-error" class="jquery-error"></span>
                        </div>
                        <div class="form-group">
                            <label>Education (optional)</label>
                            <input type="text" name="members[${index}][education]" value="${member.education || ''}">
                            <span id="members_${index}_education-error" class="jquery-error"></span>
                        </div>
                        <div class="form-group">
                            <label>Relation</label>
                            <input type="text" name="members[${index}][relation]" value="${member.relation || ''}">
                            <span id="members_${index}_relation-error" class="jquery-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="member-photo-${index}">Profile Photo <span style="color:red">(optional)</span></label>
                            <input type="file" name="members[${index}][photo]" id="member-photo-${index}">
                            <span id="members_${index}_photo-error" class="jquery-error"></span>
                            ${member.photo ? `<p class="existing-photo-note">Current photo: **${member.photo}**</p>` : ''}
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <button type="button" class="btn btn-remove-member" onclick="removeMemberForm(this, ${member.id ? member.id : 'null'})">Remove Member</button>
                    </div>
                    <hr>
                </div>
                `;
            }

         
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
                                mobile_number: function () { return $('#mobile_number').val(); },
                                user_id: headData.id,
                                _token: function () { return $('meta[name="csrf-token"]').attr('content'); }
                            }
                        }
                    },
                    'head[address]': { required: true },
                    'head[state]': { required: true },
                    'head[city]': { required: true },
                    'head[pincode]': { required: true, digits: 6 },
                    'head[status]': { required: true },
                    'hobbies[]': { required: true },
                    'head[photo]': { extension: "jpg|png", filesize: 2048 * 1024 }
                },
                messages: {
                    'head[mobile_number]': {
                        remote: "This mobile number is already registered by another user."
                    },
                },
                errorPlacement: function (error, element) {

                    const name = element.attr("name").replace(/\[|\]/g, '_');
                    $(`#${name}-error`).html(error);
                },
                submitHandler: function (form) {
                    submitFormAjax($(form));
                }
            });

          
            const initialStateId = $('#state').val();
            const initialCityName = headData.city; 
        
            if (initialStateId) {
                loadCities(initialStateId, initialCityName);
            } else {
                $('#city').html('<option value="">Select State First</option>');
            }
        
            $('.state').on('change', function () {
                const idState = $(this).val();
                loadCities(idState, ''); 
            });

       
            if (hobbyData.length > 0) {
                hobbiesContainer.empty();
                hobbyData.forEach(hobby => addHobbyRow(hobby));
            } else {
                addHobbyRow();
            }

           
            const memberSection = $('#member-section');
            if (memberData.length > 0) {
                memberData.forEach(member => {
                    memberSection.append(getMemberForm(memberIndex, member));
                    memberIndex++;
                });
            }

          
            function toggleWeddingDate() {
                const selectedStatus = $('input[name="head[status]"]:checked').val();
                if (selectedStatus === 'married') {
                    $('#wedding-date-group').removeClass('hidden');
                } else {
                    $('#wedding-date-group').addClass('hidden');
                    $('#wedding_date').val('');
                    $('#wedding_date').rules('remove');
                }
            }

            $('input[name="head[status]"]').on('change', toggleWeddingDate);
            toggleWeddingDate();

    
            $('#addHobbyBtn').on('click', function() {
                addHobbyRow();
            });

            hobbiesContainer.on('click', '.btn-remove-hobby', function (e) {
                e.preventDefault(); 
                $(this).closest('.hobby-row').remove();
            });
            
             $('#removeAllHobbiesBtn').on('click', function () {
                hobbiesContainer.empty();
                addHobbyRow();
            });

            $('#addMemberBtn').on('click', function () {
                const container = $('#member-section');
                container.append(getMemberForm(memberIndex));
                $('#registrationForm').validate().form();
                memberIndex++;
            });


            window.removeMemberForm = function(button, memberId) {
                const form = $(button).closest('.member-form');
                form.remove();


                if (memberId) {

                    $('#registrationForm').append(`<input type="hidden" name="members_to_delete[]" value="${memberId}">`);
                }
            };


            $('#member-section').on('change', '.member-status', function() {
                const status = $(this).val();
                const weddingDateGroup = $(this).closest('.member-form').find('.wedding-date-member');
                if (status === 'married') {
                    weddingDateGroup.removeClass('hidden');
                } else {
                    weddingDateGroup.addClass('hidden');
                    weddingDateGroup.find('input[type="date"]').val('');
                }
            });


            function submitFormAjax(form) {
                $('#loading-spinner').show();
                $('#success-message').hide();
                $('.jquery-error').html('');

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: new FormData(form[0]),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#loading-spinner').hide();
                        $('#success-message').show();

                    },
                    error: function (xhr) {
                        $('#loading-spinner').hide();
                        $('#success-message').hide();
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {

                                const formattedKey = key.replace(/\./g, '_');
                                $(`#${formattedKey}-error`).html(value[0]);
                            });
                        } else {
                            alert('An unexpected error occurred during update. Please try again.');
                        }
                    }
                });
            }
        });
    </script>

</body>
</html>