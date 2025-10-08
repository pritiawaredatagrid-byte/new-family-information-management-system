<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
    <link rel="stylesheet" href="/css/user-registration.css">
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

        <form  method="POST" enctype="multipart/form-data" id="registrationForm">

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
                        <label><input type="radio" name="head[status]" value="married"
                                @if(old('head.status') == 'married') checked @endif> Married</label>
                        <label><input type="radio" name="head[status]" value="unmarried"
                                @if(old('head.status') == 'unmarried') checked @endif> Unmarried</label>
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
                        <button type="button" id="removeAllHobbiesBtn" class="btn btn-remove-all">Remove All
                            Hobbies</button>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="photo">Profile Photo</label>
                    <input type="file" name="head[photo]" accept="image/jpeg,image/jpg,image/png" id="photo">
                </div>
            </div>
            <hr>
            <div id="member-section">
            </div>
            <button type="button" id="addMemberBtn" class="btn btn-add">
                ➕ Add Family Member
            </button>

            <br><br>

            <button type="submit" class="btn btn-submit">Submit</button>
        </form>
    </div>

    <script src="/js/user-registration.js"></script>
</body>

</html>