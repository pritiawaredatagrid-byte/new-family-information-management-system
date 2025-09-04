<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
</html>
