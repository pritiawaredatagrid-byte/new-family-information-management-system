<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Family Member</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>

<style>
/* 
.Family-Member-body{
background-color: #F5F5F5;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
    padding-top: 5rem;
}

.Family-Member-body .marital-status{
    display: flex;
    align-items: center;
}

.Family-Member-body .marital-status label{
   padding-right: 1rem;
}

.Family-Member-body .marital-status input{
    width:auto;
    margin-right: 0.5rem;
}

.Family-Member-body .marital-status button{
    width: 50%;
    background-color: #2196F3;
    border-radius: 5px;
    padding: 0.5rem 0.3rem;
    color:white;
    border: none;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.Family-Member-body .main{
    background-color: white;
    padding: 2rem 3rem;
    border-radius: 5%;
}

.Family-Member-body .main h2{
    font-size: 2rem;
    text-align: center;
    margin-bottom: 2rem;
    color:#424242;
}

.Family-Member-body form div label{
     color:#757575; 
}

.Family-Member-body form div input{
    width: 100%;
    padding: 0.4rem 0.3rem;
    border-radius: 5px;
    margin-top: 0.5rem;
    margin-bottom: 0.7rem;
    border:0.1rem solid #757575;
}

.Family-Member-body form div input:focus{
   outline: none;
}

.Family-Member-body form .admin-login{
    width: 100%;
    background-color: #2196F3;
    border-radius: 5px;
    padding: 0.5rem 0.3rem;
    color:white;
    border: none;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.Family-Member-body form a{
    text-decoration: none;
}

.Family-Member-body .main p{
    color:red;
     margin-bottom: 1rem;
}
.error {
    color: red;
    font-size: 1rem; 
    margin-top: 0.25rem;
    margin-bottom: 0.5rem;
    display: block; 
}

.Family-Member-body form div input.error {
    border: 1px solid red;
} */


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
            color: red;
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
        <h2>Edit Family Member</h2>
        @error('user')
            <p class="text-red-500 text-sm mt-1 py-2">{{ $message }}</p>
        @enderror
   
        <form action="{{ '/edit-family-member-data/' . $member->head_id . '/' . $member->id }}" method="post" class="space-y-4 form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="put">
            <div>
                <label for="">Member Name</label>
                <input type="text" name="name" id="" placeholder="Enter Member Name" value="{{ old('name', $member->name) }}">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
             <div>
                <label for="">Birth Date</label>
                <input type="date" name="birthdate" id="" value="{{ old('birthdate', $member->birthdate) }}">
                @error('birthdate')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
         
            <div class="marital-status" id="marital-status-group">
                <label for="">Marital Status</label>
                <label>
                    <input type="radio" name="status" value="married" id="status_married" 
                        {{ old('status', $member->status) == 'married' ? 'checked' : '' }}>
                    Married
                </label>
                &nbsp;&nbsp;
                <label>
                    <input type="radio" name="status" value="unmarried" id="status_unmarried" 
                        {{ old('status', $member->status) == 'unmarried' ? 'checked' : '' }}>
                    unmarried
                </label>
            </div>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <div class="WeddingDate" id="wedding_date_field" 
                 style="{{ old('status', $member->status) == 'married' ? '' : 'display:none;' }}">
                <label for="wedding_date">Wedding Date</label>
                <input type="date" name="wedding_date" id="wedding_date" value="{{ old('wedding_date', $member->wedding_date) }}">
            </div>

            <div>
                <label for="education">Education <span style="color:red">(optional)</span></label>
                <input type="text" name="education" id="education" placeholder="Enter Education" value="{{ old('education', $member->education) }}">
            </div>

             <div>
                <label for="photo">Profile Photo <span style="color:red">(optional)</span></label>
                 @if($member->photo)
                   <input type="file" name="photo" accept="image/*" id="photo" value="">
                    <img src="{{ asset('storage/' . $member->photo) }}" style="height:50px; width:50px;">
                                         @else
                                         <input type="file" name="photo" accept="image/*" id="photo" value="">
                                  
                    @endif
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" name="submit" class="admin-login">Edit Family Member</button>
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
        });

        const marriedStatus = document.getElementById('status_married');
        const weddingDateField = document.getElementById('wedding_date_field');

        function toggleWeddingDate() {
            if (marriedStatus.checked) {
                weddingDateField.style.display = 'block';
            } else {
                weddingDateField.style.display = 'none';
            }
        }
        
        document.querySelectorAll('input[name="status"]').forEach(radio => {
            radio.addEventListener('change', toggleWeddingDate);
        });

        window.addEventListener('load', toggleWeddingDate);

    </script>
</body>
</html> 
