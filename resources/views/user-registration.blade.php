<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     
  <style>
    .Registration-body 
{
   background-color: #F5F5F5;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
    padding-top: 5rem;
}
.Registration-body .main{
    background-color: white;
    padding: 2rem 3rem;
    border-radius: 5%;
}
.Registration-body .main h2{
    font-size: 2rem;
    text-align: center;
    margin-bottom: 2rem;
    color:#424242;
}

.Registration-body form div textarea{
    width: 100%;
    padding: 0.4rem 0.3rem;
    border-radius: 5px;
    margin-top: 0.5rem;
    margin-bottom: 0.7rem;
    border:0.1rem solid #757575;
}
.Registration-body form div select{
    width: 100%;
    padding: 0.4rem 0.3rem;
    border-radius: 5px;
    margin-top: 0.5rem;
    margin-bottom: 0.7rem;
    border:0.1rem solid #757575;
}

.Registration-body .marital-status{
    display: flex;
    align-items: center;
}

.Registration-body .marital-status label{
   padding-right: 1rem;
}

.Registration-body .marital-status input{
    width:auto;
    margin-right: 0.5rem;
}

.Registration-body .marital-status button{
    width: 50%;
    background-color: #2196F3;
    border-radius: 5px;
    padding: 0.5rem 0.3rem;
    color:white;
    border: none;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.Registration-body form .hobbies{
    display:flex;
    align-items: center;
    justify-content: space-between;
}

.Registration-body form .hobbies label{
    margin-right: 0.5rem;
}

.Registration-body form .hobbies button{
    width: 100%;
    background-color: #2196F3;
    border-radius: 5px;
    padding: 0.5rem 0.5rem;
    color:white;
    border: none;
    font-size: 0.9rem;
    margin-bottom: 0.9rem;
    margin-left:2.2rem;
}

.Registration-body .main button{
    margin-top: 0.5rem;
}

.Registration-body form div label{
    color:#757575;
}

.Registration-body form div input{
    width: 100%;
    padding: 0.4rem 0.3rem;
    border-radius: 5px;
    margin-top: 0.5rem;
    margin-bottom: 0.7rem;
    border:0.1rem solid #757575;
}

.Registration-body form div input:focus{
   outline: none;
}

.Registration-body form .admin-login{
    width: 100%;
    background-color: #2196F3;
    border-radius: 5px;
    padding: 0.5rem 0.3rem;
    color:white;
    border: none;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.Registration-body form a{
    text-decoration: none;
}

.Registration-body .main p{
    color:red;
     margin-bottom: 1rem;
}

  </style>
</head>
<body class="Registration-body">
       @if(Session('users'))
        <div class="" role="alert">
            <span class="" style="color:green">{{ Session('users') }}</span>
        </div>
      @endif
     <div class="main">
        <h2>Registration Form</h2>
        @error('user')
            <p class="text-red-500 text-sm mt-1 py-2">{{ $message }}</p>
        @enderror
        <form action="/user-registration" method="post" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="">Family Head Name</label>
                <input type="text" name="name" id="" placeholder="Family Head Name">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="">Surname</label>
                <input type="text" name="surname" id="" placeholder="Family Head Surname">
                @error('surname')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
             <div>
                <label for="">Birth Date</label>
                <input type="date" name="birthdate" id="">
                @error('birthdate')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 space-y-2">Mobile Number</label>
                <input type="tel" name="mobile_number" id="" placeholder="Enter Mobile Number">
                @error('mobile_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 space-y-2">Address</label>
                <textarea type="" name="address" id="" placeholder="Enter Address"></textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 space-y-2">State</label>
                <select name="state" id="state" class="state">
                       <option value="">Select State</option>
                       @foreach($states as $data)
                        <option value="{{ $data->state_id }}">{{ $data->state_name }}</option>
                       @endforeach
                </select>
                @error('state')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 space-y-2">City</label>
                <select name="city" id="city" class="city">
                    <option value="">Select City</option>
                </select>
                @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
              <div>
                <label for="">Pincode</label>
                <input type="number" name="pincode" id="" placeholder="Enter Pincode">
                @error('pincode')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="marital-status">
                <label for="">Marital Status </label>
                <input type="radio" name="status" value="married" id="">Married</input>&nbsp &nbsp
                <input type="radio" name="status" value="unmarried" id="">Unmarried</input>
            </div>
            <div>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="WeddingDate">
                 <label for="">Wedding Date</label>
                 <input type="date" name="wedding_date" id=""></input>
            </div>

            <div class="hobbies">
                <label for="">Hobbies</label>
            </div>
            <div class="hobbies">
                <table id="table">
                    <tr>
                        <td>
                             <input type="text" name="hobbies[]" placeholder="Enter hobby here"  class="form-control" id=""></input>
                        </td>
                        <td>
                           <button type="button" name="add" id="add" class="btn btn-success">Add Hobby</button>
                        </td>
                     
                    </tr>
                </table>
            </div>
            <div>
                 @error('hobbies.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="">Profile Photo</label>
                <input type="file" name="photo" accept="image/*" id=""></input>
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" name="submit" class="admin-login">Add Family Head</button>
            <button type="button" name="add" class="admin-login"><a href="/add-family-member" style="color:white">Add Family Member</a>
            </button>
        </form>
    </div>


    <script>
        var i = 0;
        $('#add').click(function(){
            ++i;
            $('#table').append(
                `<tr>
                   <td>
                <input type="text" name="hobbies[`+i+`]" placeholder="Enter hobby here"  class="form-control" id=""></input>
                </td>
                <td>
                <button type="button" name="add" id="add" class="remove-table-row" style="background-color:red">Remove</button>
                </td>
                 </tr>
               
                `
            );
        });

        $(document).on('click','.remove-table-row',function(){
            $(this).parents('tr').remove();
        });

       $(document).ready(function(){
             $('.WeddingDate').hide();
             $('input[name="status"]').on('change', function() {
               if ($(this).val() === "married") {
                     $('.WeddingDate').show();
                } else {
                  $('.WeddingDate').hide();
            }
       });
     });

    $(document).ready(function(){
    $('.state').on('change', function(){
        var idState = this.value;
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
                 success: function(cities){
                     $.each(cities, function(key, value){
                        $('.city').append('<option value="' + value.city_name + '">' + value.city_name + '</option>');
                     });
                 }
            });
        }
    });
});

    </script>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     
  <style>
    .Registration-body 
{
   background-color: #F5F5F5;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
    padding-top: 5rem;
}
.Registration-body .main{
    background-color: white;
    padding: 2rem 3rem;
    border-radius: 5%;
}
.Registration-body .main h2{
    font-size: 2rem;
    text-align: center;
    margin-bottom: 2rem;
    color:#424242;
}

.Registration-body form div textarea{
    width: 100%;
    padding: 0.4rem 0.3rem;
    border-radius: 5px;
    margin-top: 0.5rem;
    margin-bottom: 0.7rem;
    border:0.1rem solid #757575;
}
.Registration-body form div select{
    width: 100%;
    padding: 0.4rem 0.3rem;
    border-radius: 5px;
    margin-top: 0.5rem;
    margin-bottom: 0.7rem;
    border:0.1rem solid #757575;
}

.Registration-body .marital-status{
    display: flex;
    align-items: center;
}

.Registration-body .marital-status label{
   padding-right: 1rem;
}

.Registration-body .marital-status input{
    width:auto;
    margin-right: 0.5rem;
}

.Registration-body .marital-status button{
    width: 50%;
    background-color: #2196F3;
    border-radius: 5px;
    padding: 0.5rem 0.3rem;
    color:white;
    border: none;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.Registration-body form .hobbies{
    display:flex;
    align-items: center;
    justify-content: space-between;
}

.Registration-body form .hobbies label{
    margin-right: 0.5rem;
}

.Registration-body form .hobbies button{
    width: 100%;
    background-color: #2196F3;
    border-radius: 5px;
    padding: 0.5rem 0.5rem;
    color:white;
    border: none;
    font-size: 0.9rem;
    margin-bottom: 0.9rem;
    margin-left:2.2rem;
}

.Registration-body .main button{
    margin-top: 0.5rem;
}

.Registration-body form div label{
    color:#757575;
}

.Registration-body form div input{
    width: 100%;
    padding: 0.4rem 0.3rem;
    border-radius: 5px;
    margin-top: 0.5rem;
    margin-bottom: 0.7rem;
    border:0.1rem solid #757575;
}

.Registration-body form div input:focus{
   outline: none;
}

.Registration-body form .admin-login{
    width: 100%;
    background-color: #2196F3;
    border-radius: 5px;
    padding: 0.5rem 0.3rem;
    color:white;
    border: none;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.Registration-body form a{
    text-decoration: none;
}

.Registration-body .main p{
    color:red;
     margin-bottom: 1rem;
}


 .hobbies-section { 
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    .hobbies-section label {
        display: block;
        margin-bottom: 0.5rem;
        color: #757575;
    }
    #hobbiesTable {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    #hobbiesTable td {
        display:flex;
    
    }

    #hobbiesTable th {
        background-color: #f2f2f2;
    }
    .form-control-hobby {
        width: calc(100% - 16px); 
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .btn-remove-hobby {
        background-color: #ffc107; 
        color: #333;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
    }
    .hobby-controls {
        text-align: center;
        margin-top: 0.1rem;
        display:flex;
        justify-content:space-between;
    }
    .btn-add-hobby, .btn-remove-all-hobbies { 
        padding: 0.5rem 1rem;
        border-radius: 5px;
        border: none;
        color: white;
        cursor: pointer;
        font-size: 0.9rem;
    }
    .btn-add-hobby {
        background-color: #2196F3;
    }
    .btn-remove-all-hobbies {
        background-color: #f44336; 
        margin-left: 10px;
    }

  </style>
</head>
<body class="Registration-body">
       @if(Session('users'))
        <div class="" role="alert">
            <span class="" style="color:green">{{ Session('users') }}</span>
        </div>
      @endif
     <div class="main">
        <h2>Registration Form</h2>
        @error('user')
            <p class="text-red-500 text-sm mt-1 py-2">{{ $message }}</p>
        @enderror
        <form action="/user-registration" method="post" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="">Family Head Name</label>
                <input type="text" name="name" id="" placeholder="Family Head Name">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="">Surname</label>
                <input type="text" name="surname" id="" placeholder="Family Head Surname">
                @error('surname')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
             <div>
                <label for="">Birth Date</label>
                <input type="date" name="birthdate" id="">
                @error('birthdate')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 space-y-2">Mobile Number</label>
                <input type="tel" name="mobile_number" id="" placeholder="Enter Mobile Number">
                @error('mobile_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 space-y-2">Address</label>
                <textarea type="" name="address" id="" placeholder="Enter Address"></textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 space-y-2">State</label>
                <select name="state" id="state" class="state">
                       <option value="">Select State</option>
                       @foreach($states as $data)
                        <option value="{{ $data->state_id }}">{{ $data->state_name }}</option>
                       @endforeach
                </select>
                @error('state')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 space-y-2">City</label>
                <select name="city" id="city" class="city">
                    <option value="">Select City</option>
                </select>
                @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
              <div>
                <label for="">Pincode</label>
                <input type="number" name="pincode" id="" placeholder="Enter Pincode">
                @error('pincode')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="marital-status">
                <label for="">Marital Status </label>
                <input type="radio" name="status" value="married" id="">Married</input>&nbsp &nbsp
                <input type="radio" name="status" value="unmarried" id="">Unmarried</input>
            </div>
            <div>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="WeddingDate">
                 <label for="">Wedding Date</label>
                 <input type="date" name="wedding_date" id=""></input>
            </div>

            <div class="hobbies-section"> 
                <label for="">Hobbies</label>
                <table id="hobbiesTable">
                    <tbody>
                       
                    </tbody>
                     <div>
            </div>
            
                </table>
                 @error('hobbies.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror 
                <div class="hobby-controls">
                    <button type="button" id="addHobbyBtn" class="btn-add-hobby">Add Hobby</button>
                    <button type="button" id="removeAllHobbiesBtn" class="btn-remove-all-hobbies">Remove All Hobbies</button>
                </div>
            </div>
            <div>
                 @error('hobbies.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="">Profile Photo</label>
                <input type="file" name="photo" accept="image/*" id=""></input>
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" name="submit" class="admin-login">Add Family Head</button>
            <button type="button" name="add" class="admin-login"><a href="/add-family-member" style="color:white">Add Family Member</a>
            </button>
        </form>
    </div>


    <script>
        var i = 0;
        $('#add').click(function(){
            ++i;
            $('#table').append(
                `<tr>
                   <td>
                <input type="text" name="hobbies[`+i+`]" placeholder="Enter hobby here"  class="form-control" id=""></input>
                </td>
                <td>
                <button type="button" name="add" id="add" class="remove-table-row" style="background-color:red">Remove</button>
                </td>
                 </tr>
               
                `
            );
        });

        $(document).on('click','.remove-table-row',function(){
            $(this).parents('tr').remove();
        });

       $(document).ready(function(){
             $('.WeddingDate').hide();
             $('input[name="status"]').on('change', function() {
               if ($(this).val() === "married") {
                     $('.WeddingDate').show();
                } else {
                  $('.WeddingDate').hide();
            }
       });
     });

    $(document).ready(function(){
    $('.state').on('change', function(){
        var idState = this.value;
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
                 success: function(cities){
                     $.each(cities, function(key, value){
                        $('.city').append('<option value="' + value.city_name + '">' + value.city_name + '</option>');
                     });
                 }
            });
        }
    });
});


document.addEventListener('DOMContentLoaded', () => {
            const hobbiesTableBody = document.querySelector('#hobbiesTable tbody');
            const addHobbyBtn = document.getElementById('addHobbyBtn');
            const removeAllHobbiesBtn = document.getElementById('removeAllHobbiesBtn');

            let hobbyCount = 0;
            function addHobbyRow() {
                hobbyCount++;
                const newRow = hobbiesTableBody.insertRow();
                newRow.id = `hobbyRow-${hobbyCount}`;

                const hobbyCell = newRow.insertCell(0);
                hobbyCell.innerHTML = `<input type="text" name="hobbies[]" placeholder="Enter hobby here" class="form-control-hobby" id="hobby-${hobbyCount}">`;

                const actionCell = newRow.insertCell(1);
                actionCell.innerHTML = `<button type="button" class="btn-remove-hobby" data-row-id="hobbyRow-${hobbyCount}">Remove</button>`;
            }

            addHobbyRow();

            addHobbyBtn.addEventListener('click', addHobbyRow);

            hobbiesTableBody.addEventListener('click', (event) => {
                if (event.target.classList.contains('btn-remove-hobby')) {
                    const rowIdToRemove = event.target.dataset.rowId;
                    const rowToRemove = document.getElementById(rowIdToRemove);
                    if (rowToRemove) {
                        rowToRemove.remove();
                    }
                }
            });
            
            removeAllHobbiesBtn.addEventListener('click', () => {
                hobbiesTableBody.innerHTML = ''; 
                hobbyCount = 0; 
                addHobbyRow(); 
            });
        });

    </script>
</body>
</html>
