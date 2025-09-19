
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Head</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            /* width: 100%; */
        }

        .card {
            background-color: var(--card-bg);
            padding: 2.5rem 3rem;
            border-radius: 10px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 700px;
        }

        .main {
            width: 100%;
            max-width: 700px;
            background-color: var(--card-bg);
            padding: 2.5rem 3rem;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        h2 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-color);
        }

        .form-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: center;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 45%;
        }

        .form-group.full-width {
            flex: 1 100%;
        }

        label {
            font-weight: 300;
            color: #616161;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"],
        input[type="number"],
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

        .button-group {
            margin-top: 2.5rem;
            display: flex;
            gap: 1rem;
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

        .btn-submit {
            background-color: var(--primary-color);
            color: #fff;
        }

        .btn-submit:hover {
            background-color: #1976D2;
        }

        .btn-cancel {
            background-color: #616161;
            color: #fff;
        }

        .btn-cancel:hover {
            background-color: #424242;
        }

        .error-message,
        .jquery-error {
            color: var(--secondary-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .marital-status label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .marital-status {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .hobbies-section {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .hobby-input-group {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-bottom: 1rem;
        }

        .btn-remove-hobby {
            background-color: var(--tertiary-color);
            color: #fff;
            padding: 0.75rem 1rem;
        }

        .btn-remove-hobby:hover {
            background-color: #f5b000;
        }

        .hobby-controls {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .btn-add-hobby {
            background-color: var(--primary-color);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            border: none;
        }

        .btn-add-hobby:hover {
            background-color: #1976D2;
        }

        .btn-remove-all-hobbies {
            background-color: var(--secondary-color);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            border: none;
        }

        .btn-remove-all-hobbies:hover {
            background-color: #d32f2f;
        }

        .profile-photo {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .profile-photo img {
            height: 50px;
            width: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .admin-login {
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            background-color: var(--primary-color);
            color: #fff;
            text-decoration: none;
            text-align: center;
            flex-grow: 1;
        }

        .admin-login:hover {
            background-color: #1976D2;
        }

        .profile-photo {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .profile-photo input[type="file"] {
            display: block;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            box-sizing: border-box;
        }

        .profile-photo input[type="file"]::file-selector-button {
            font-weight: 600;
            color: var(--text-color);
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .profile-photo input[type="file"]::file-selector-button:hover {
            background-color: var(--bg-color);
        }

        .profile-photo img {
            max-width: 100px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
            margin-top: 1rem;
            border: 1px solid var(--border-color);
        }
    </style>
</head>

<body class="Registration-body">
    <div class="main">
        <h2>Edit Family Head</h2>
        @if(Session('heads'))
            <div class="" role="alert">
                <span class="" style="color:green">{{ Session('heads') }}</span>
            </div>
        @endif
        @error('heads')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <form action="/edit-family-head-data/{{$heads->id}}" id="form" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="put">
            <div class="form-grid">
                <div class="form-group">
                    <label for="">Family Head Name</label>
                    <input type="text" name="name" id="" placeholder="Family Head Name"
                        value="{{ old('name', $heads->name) }}">
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Surname</label>
                    <input type="text" name="surname" id="" placeholder="Family Head Surname"
                        value="{{ old('surname', $heads->surname) }}">
                    @error('surname')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Birth Date</label>
                    <input type="date" name="birthdate" id="" value="{{ old('birthdate', $heads->birthdate) }}">
                    @error('birthdate')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <!-- <div class="form-group">
                    <label for="">Mobile Number</label>
                    <input type="tel" name="mobile_number" id="mobile_number" placeholder="Enter Mobile Number"
                        value="{{ old('mobile_number', $heads->mobile_number) }}">
                    @error('mobile_number')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div> -->
                <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                   <input type="tel" name="mobile_number" id="mobile_number" placeholder="Enter Mobile Number"
                        value="{{ old('mobile_number', $heads->mobile_number) }}">
                     @error('mobile_number')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group full-width">
                    <label for="">Address</label>
                    <textarea name="address" id=""
                        placeholder="Enter Address">{{ old('address', $heads->address) }}</textarea>
                    @error('address')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <select name="state" id="state" class="state">
                        <option value="">Select State</option>
                        @foreach($states as $data)
                            <option value="{{ $data->state_id }}" {{ ($heads->state == $data->state_name) ? 'selected' : '' }}>
                                {{ $data->state_name }}
                            </option>
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
                        @if($heads->city)
                            <option value="{{ $heads->city }}" selected>{{ $heads->city }}</option>
                        @endif
                    </select>
                    @error('city')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Pincode</label>
                    <input type="number" name="pincode" id="" placeholder="Enter Pincode"
                        value="{{ old('pincode', $heads->pincode) }}">
                    @error('pincode')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Marital Status</label>
                    <div class="marital-status">
                        <div class="radio-options">
                            <div class="radio-group">
                               <input type="radio" id="married" name="status" value="married"
    {{ old('status', $heads->status) == 'married' ? 'checked' : '' }}>
<label for="married">Married</label>

<input type="radio" id="unmarried" name="status" value="unmarried"
    {{ old('status', $heads->status) == 'unmarried' ? 'checked' : '' }}>
<label for="unmarried">Unmarried</label>

                            </div>
                        </div>

                    </div>
                    @error('status')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    <div class="status-error-container"></div>
                </div>

                <div class="form-group full-width" id="wedding_date_field"
                    style="{{ old('status', $heads->status) == 'married' ? '' : 'display:none;' }}">
                    <label for="wedding_date">Wedding Date</label>
                    <input type="date" name="wedding_date" id="wedding_date"
                        value="{{ old('wedding_date', $heads->wedding_date) }}">
                </div>
                <div class="form-group full-width">
                    <label for="">Hobbies</label>
                    <div class="hobbies-section">
                        @php
                            $string = $heads->hobby;
                            $hobbies = [];
                            preg_match_all('/"(.*?)"/', $string, $matches);
                            if (!empty($matches[1]))
                                $hobbies = $matches[1];
                        @endphp
                        <div id="hobbies-container">
                            @if (!empty($hobbies))
                                @foreach ($hobbies as $hobby)
                                    <div class="hobby-input-group">
                                        <input type="text" name="hobbies[]" placeholder="Enter hobby here"
                                            class="form-control-hobby" value="{{$hobby}}">
                                        <button type="button" class="btn btn-remove-hobby">Remove</button>
                                    </div>
                                @endforeach
                            @else
                                <div class="hobby-input-group">
                                    <input type="text" name="hobbies[]" placeholder="Enter hobby here"
                                        class="form-control-hobby">
                                    <button type="button" class="btn btn-remove-hobby"
                                        style="display: none;">Remove</button>
                                </div>
                            @endif
                        </div>
                        <div class="hobby-controls">
                            <button type="button" id="addHobbyBtn" class="btn btn-add-hobby">Add Hobby</button>
                            <button type="button" id="removeAllHobbiesBtn" class="btn btn-remove-all-hobbies">Remove All
                                Hobbies</button>
                        </div>
                    </div>
                    @error('hobbies.*')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group full-width">
                    <label for="">Profile Photo</label>
                    <div class="profile-photo">
                        <input type="file" name="photo" accept="image/*" id="photo" />
                        @if($heads->photo)
                            <img src="{{ asset('storage/' . $heads->photo) }}" alt="Profile Photo" />
                        @else
                            <span class="text-gray-400 text-xs">No photo</span>
                        @endif
                    </div>
                   @error('photo')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                </div>
            </div>
            <div class="buttons">
                <button type="submit" name="submit" class="admin-login">Update Family Head</button>
                <button type="button" name="cancel" class="admin-login" style="background-color: #616161;"><a
                        style="color:white; text-decoration:none"
                        href="/view-family-details/{{$heads->id}}">Cancel</a></button>
            </div>
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

        $('#form').validate({
            errorElement: 'span',
            errorClass: 'jquery-error',
            errorPlacement: function (error, element) {
                if (element.attr("name") === "status") {
                    $(".status-error-container").html(error);
                } else if (element.attr("name").startsWith("hobbies")) {
                    const hobbyErrorContainer = $("#hobbies-container .error-message");
                    if (hobbyErrorContainer.length === 0) {
                        error.addClass("error-message").appendTo("#hobbies-container");
                    }
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                name: { required: true, maxlength: 50 },
                surname: { required: true, maxlength: 50 },
                birthdate: { required: true, date: true, isAdult: "2004-09-16" },
                address: { required: true },
                state: { required: true },
                city: { required: true },
                pincode: { required: true, digits: 6 },
                status: { required: true },
                'hobbies[]': { required: true },
                photo: {
                    required: false,
                    extension: "jpg|png",
                    filesize: 2048
                },
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
            messages: {
                'hobbies[]': { required: "At least 1 hobby is required." },
                mobile_number: {
                    remote: "This mobile number is already registered."
                }
            }
        });

       
        function loadCities(stateId, initialCityName) {
            $('.city').html('<option value="">Select City</option>');
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
                        $.each(cities, function (key, value) {
                            const option = $('<option></option>')
                                .attr('value', value.city_name)
                                .text(value.city_name);

                            if (initialCityName && value.city_name === initialCityName) {
                                option.attr('selected', 'selected');
                            }
                            $('.city').append(option);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("Failed to load cities: ", error);
                    }
                });
            }
        }

        const initialStateId = $('#state').val();
        const initialCityName = "{{ $heads->city }}";
        if (initialStateId) {
            loadCities(initialStateId, initialCityName);
        }

        $('.state').on('change', function () {
            const selectedStateId = $(this).val();
            loadCities(selectedStateId, null);
        });

        
        const marriedStatus = document.getElementById('married');
        const weddingDateField = document.getElementById('wedding_date_field');
        function toggleWeddingDate() {
            if (marriedStatus.checked) {
                weddingDateField.style.display = 'flex';
            } else {
                weddingDateField.style.display = 'none';
            }
        }
        document.querySelectorAll('input[name="status"]').forEach(radio => {
            radio.addEventListener('change', toggleWeddingDate);
        });
        window.addEventListener('load', toggleWeddingDate);

    
        const hobbiesContainer = document.getElementById('hobbies-container');
        const addHobbyBtn = document.getElementById('addHobbyBtn');
        const removeAllHobbiesBtn = document.getElementById('removeAllHobbiesBtn');

        function updateRemoveButtons() {
            const removeBtns = hobbiesContainer.querySelectorAll('.btn-remove-hobby');
            if (removeBtns.length <= 1) {
                removeBtns.forEach(btn => btn.style.display = 'none');
            } else {
                removeBtns.forEach(btn => btn.style.display = 'inline-block');
            }
        }

        addHobbyBtn.addEventListener('click', () => {
            const newHobbyDiv = document.createElement('div');
            newHobbyDiv.className = 'hobby-input-group';
            newHobbyDiv.innerHTML = `
                <input type="text" name="hobbies[]" placeholder="Enter hobby here" class="form-control-hobby">
                <button type="button" class="btn btn-remove-hobby">Remove</button>
            `;
            hobbiesContainer.appendChild(newHobbyDiv);
            updateRemoveButtons();
        });

      
        hobbiesContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('btn-remove-hobby')) {
                const hobbyGroup = event.target.closest('.hobby-input-group');
                if (hobbiesContainer.children.length > 1) {
                    hobbyGroup.remove();
                    updateRemoveButtons();
                }
            }
        });

        
        removeAllHobbiesBtn.addEventListener('click', () => {
            hobbiesContainer.innerHTML = '';
            
            const newHobbyDiv = document.createElement('div');
            newHobbyDiv.className = 'hobby-input-group';
            newHobbyDiv.innerHTML = `
                <input type="text" name="hobbies[]" placeholder="Enter hobby here" class="form-control-hobby">
                <button type="button" class="btn btn-remove-hobby">Remove</button>
            `;
            hobbiesContainer.appendChild(newHobbyDiv);
            updateRemoveButtons();
        });

       
        updateRemoveButtons();
    });
</script>

</body>

</html>