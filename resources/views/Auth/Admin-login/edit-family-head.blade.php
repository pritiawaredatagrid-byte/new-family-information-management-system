<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Family Information</title>

    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

        h2,
        h3,
        h4 {
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

        input[type="text"],
        input[type="tel"],
        input[type="date"],
        input[type="file"],
        textarea,
        select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus,
        select:focus {
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

        .hobby-row,
        .member-form {
            padding: 15px;
            margin-top: 15px;
            border-radius: 8px;
            border: 1px solid #eee;
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
            word-wrap: break-word;
        }

        #loading-spinner,
        #success-message {
            text-align: center;
            padding: 10px;
            margin-bottom: 10px;
            display: none;
            border-radius: 4px;
        }

        #loading-spinner {
            color: #007bff;
        }

        #success-message {
            color: #28a745;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Edit Family Information</h2>

        <div id="loading-spinner">Updating form...</div>
        <div id="success-message"></div>

       <form id="registrationForm" action="{{ route('edit-family-head-data', ['encrypted_id' => $familyHead->encrypted_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h3>Family Head Details</h3>

            <div class="form-grid">
                
                <div class="form-group">
                    <label for="name">Family Head Name</label>
                    <input type="text" name="head[name]" id="head_name" placeholder="Family Head Name"
                        value="{{ $familyHead->name }}">
                    <span id="head_name-error" class="jquery-error"></span>
                </div>

         
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" name="head[surname]" id="head_surname" placeholder="Family Head Surname"
                        value="{{ $familyHead->surname }}">
                    <span id="head_surname-error" class="jquery-error"></span>
                </div>

                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" name="head[birthdate]" id="head_birthdate" value="{{ $familyHead->birthdate }}">
                    <span id="head_birthdate-error" class="jquery-error"></span>
                </div>

              
                <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="tel" name="head[mobile_number]" id="head_mobile_number"
                        placeholder="Enter Mobile Number" value="{{ $familyHead->mobile_number }}">
                    <span id="head_mobile_number-error" class="jquery-error"></span>
                </div>

               
                <div class="form-group full-width">
                    <label for="address">Address</label>
                    <textarea name="head[address]" id="head_address"
                        placeholder="Enter Address">{{ $familyHead->address }}</textarea>
                    <span id="head_address-error" class="jquery-error"></span>
                </div>


                <div class="form-group">
                    <label for="state">State</label>
                    <select name="head[state]" id="head_state" class="state">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                            <option value="{{ $state->state_id }}" @if($familyHead->state == $state->state_name) selected
                            @endif>{{ $state->state_name }}</option>
                        @endforeach
                    </select>
                    <span id="head_state-error" class="jquery-error"></span>
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <select name="head[city]" id="head_city">
                        <option value="{{ $familyHead->city }}" selected>{{ $familyHead->city }}</option>
                    </select>
                    <span id="head_city-error" class="jquery-error"></span>
                </div>

               
                <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="tel" name="head[pincode]" id="head_pincode" maxlength="6"
                        value="{{ $familyHead->pincode }}">
                    <span id="head_pincode-error" class="jquery-error"></span>
                </div>

              
                <div class="form-group">
                    <label>Marital Status</label>
                    <div class="radio-options">
                        <label><input type="radio" name="head[status]" value="married"
                                @if($familyHead->status == 'married') checked @endif> Married</label>
                        <label><input type="radio" name="head[status]" value="unmarried"
                                @if($familyHead->status == 'unmarried') checked @endif> Unmarried</label>
                    </div>
                    <span id="head_status-error" class="jquery-error"></span>
                </div>

                <div class="form-group @if($familyHead->status != 'married') hidden @endif" id="head_wedding_date_group">
                    <label>Wedding Date</label>
                    <input type="date" name="head[wedding_date]" id="head_wedding_date"
                        value="{{ $familyHead->wedding_date }}">
                    <span id="head_wedding_date-error" class="jquery-error"></span>
                </div>

      
                <div class="form-group full-width">
                    <label>Hobbies</label>
                    <div id="hobbies-container"></div>
                    <span id="hobbies-error" class="jquery-error"></span>
                    <div class="hobby-controls">
                        <button type="button" class="btn btn-add" id="addHobbyBtn">Add Hobby</button>
                        <button type="button" class="btn btn-remove-all" id="removeAllHobbiesBtn">Remove All
                            Hobbies</button>
                    </div>
                </div>

       
                <div class="form-group full-width">
                    <label>Profile Photo</label>
                    <input type="file" name="head[photo]" id="head_photo">
                    @if($familyHead->photo)
                        <p class="existing-photo-note">Current photo: {{ $familyHead->photo }}</p>
                    @endif
                    <span id="head_photo-error" class="jquery-error"></span>
                </div>
            </div>

            <hr>

            <div id="member-section"></div>
            <button type="button" class="btn btn-add" id="addMemberBtn">➕ Add New Family Member</button>

            <br><br>
            <button type="submit" class="btn btn-submit">Update Information</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            const headData = @json($familyHead);
            const membersData = @json($familyHead->members ?? []);
            const hobbiesData = @json($hobbies ?? []);

            let memberIndex = 0;
            const hobbiesContainer = $('#hobbies-container');

            function loadCities(stateId, selectedCity = '') {
                const citySelect = $('#head_city');
                if (!stateId) { citySelect.html('<option value="">Select State First</option>'); return; }
                citySelect.html('<option value="">Loading...</option>');
                $.post("{{ route('get.cities') }}", { state_id: stateId, _token: '{{ csrf_token() }}' }, function (cities) {
                    citySelect.html('<option value="">Select City</option>');
                    $.each(cities, function (_, city) {
                        const selected = city.city_name === selectedCity ? 'selected' : '';
                        citySelect.append(`<option value="${city.city_name}" ${selected}>${city.city_name}</option>`);
                    });
                }, 'json');
            }

 
            const initialState = $('#head_state').val();
            if (initialState) loadCities(initialState, headData.city);

            $('#head_state').change(function () { loadCities($(this).val()); });

            function getHobbyRow(value = '') {
                return `<div class="hobby-row">
                            <input type="text" name="hobbies[]" class="hobby-input" placeholder="Enter hobby" value="${value}">
                            <button type="button" class="btn btn-remove-hobby">Remove</button>
                        </div>`;
            }

            function addHobbyRow(value = '') { hobbiesContainer.append(getHobbyRow(value)); }

            if (hobbiesData.length > 0) { hobbiesContainer.empty(); hobbiesData.forEach(addHobbyRow); }
            else addHobbyRow();

            $('#addHobbyBtn').click(() => addHobbyRow());
            $('#removeAllHobbiesBtn').click(() => { hobbiesContainer.empty(); addHobbyRow(); });
            hobbiesContainer.on('click', '.btn-remove-hobby', function () { $(this).closest('.hobby-row').remove(); });

            function getMemberForm(index, member = {}) {
                const isMarried = member.status === 'married';
                return `<div class="member-form" data-index="${index}">
                            <h4>Member ${index + 1}</h4>
                            ${member.id ? `<input type="hidden" name="members[${index}][id]" value="${member.id}">` : ''}
                            <div class="form-grid">
                                <div class="form-group"><label>Name</label><input type="text" name="members[${index}][name]" value="${member.name || ''}"><span class="jquery-error"></span></div>
                                <div class="form-group"><label>Birthdate</label><input type="date" name="members[${index}][birthdate]" value="${member.birthdate || ''}"><span class="jquery-error"></span></div>
                                <div class="form-group"><label>Relation</label><input type="text" name="members[${index}][relation]" value="${member.relation || ''}"><span class="jquery-error"></span></div>
                                <div class="form-group"><label>Education</label><input type="text" name="members[${index}][education]" value="${member.education || ''}"><span class="jquery-error"></span></div>
                                <div class="form-group"><label>Status</label>
                                    <div class="radio-options">
                                        <label><input type="radio" name="members[${index}][status]" value="married" ${isMarried ? 'checked' : ''}> Married</label>
                                        <label><input type="radio" name="members[${index}][status]" value="unmarried" ${!isMarried ? 'checked' : ''}> Unmarried</label>
                                    </div>
                                    <span class="jquery-error"></span>
                                </div>
                                <div class="form-group ${!isMarried ? 'hidden' : ''}" id="members_${index}_wedding_date_group">
                                    <label>Wedding Date</label>
                                    <input type="date" name="members[${index}][wedding_date]" value="${member.wedding_date || ''}">
                                    <span class="jquery-error"></span>
                                </div>
                                <div class="form-group"><label>Photo</label><input type="file" name="members[${index}][photo]"></div>
                                ${member.photo ? `<p class="existing-photo-note">Current photo: ${member.photo}</p>` : ''}
                                <button type="button" class="btn btn-remove-member">Remove Member</button>
                            </div>
                            <hr>
                        </div>`;
            }

            const memberSection = $('#member-section');
            membersData.forEach((member) => {
                memberSection.append(getMemberForm(memberIndex++, member));
            });

            $('#addMemberBtn').click(() => { memberSection.append(getMemberForm(memberIndex++)); });

            memberSection.on('click', '.btn-remove-member', function () {
                const form = $(this).closest('.member-form');
                const memberId = form.find('input[name*="[id]"]').val();
                if (memberId) { form.append(`<input type="hidden" name="members_to_delete[]" value="${memberId}">`); }
                form.remove();
            });

            $(document).on('change', 'input[name="head[status]"]', function () {
                if ($(this).val() == 'married') { $('#head_wedding_date_group').removeClass('hidden'); }
                else { $('#head_wedding_date_group').addClass('hidden'); $('#head_wedding_date').val(''); }
            });

            memberSection.on('change', 'input[type=radio][name*="[status]"]', function () {
                const group = $(this).closest('.form-grid').find('[id*="_wedding_date_group"]');
                if ($(this).val() == 'married') group.removeClass('hidden'); else { group.addClass('hidden'); group.find('input').val(''); }
            });

            $('#registrationForm').submit(function (e) {
                e.preventDefault();
                $('#loading-spinner').show();
                $('#success-message').hide();
                $('.jquery-error').html('');

                const formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#loading-spinner').hide();
                        $('#success-message').show().text(response.message);
                        if (response.redirect_url) {
                            setTimeout(() => window.location.href = response.redirect_url, 2000);
                        }
                    },
                    error: function (xhr) {
                        $('#loading-spinner').hide();
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                const formattedKey = key.replace(/\./g, '_');
                                const errorEl = $('#' + formattedKey + '-error');
                                if (errorEl.length) { errorEl.html(value[0]); }
                                else { $(`[name="${key}"]`).after(`<span class="jquery-error">${value[0]}</span>`); }
                            });
                        } else { alert('An unexpected error occurred.'); }
                    }
                });
            });

        });
    </script>
</body>

</html>