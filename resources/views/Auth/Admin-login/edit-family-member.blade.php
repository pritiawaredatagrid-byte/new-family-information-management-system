<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Family Member</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>

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

</style>

</head>
<body class="Family-Member-body">
    <div class="main">
        <h2>Edit Family Member</h2>
        @error('user')
            <p class="text-red-500 text-sm mt-1 py-2">{{ $message }}</p>
        @enderror
        <form action="{{ '/edit-family-member-data/' . $member->head_id . '/' . $member->id }}" method="post" class="space-y-4" enctype="multipart/form-data">
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
            
              <div class="marital-status">
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
    @error('status')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="WeddingDate" id="wedding_date_field" 
     style="{{ old('status', $member->status) == 'married' ? '' : 'display:none;' }}">
    <label for="wedding_date">Wedding Date</label>
    <input type="date" name="wedding_date" id="wedding_date" value="{{ old('wedding_date', $member->wedding_date) }}">
</div>

            <div>
                <label for="">Education </label>&nbsp<span style="color:red"> (optional)</span>
                <input type="text" name="education" id="" placeholder="Enter Education" value="{{ old('education', $member->education) }}">
            </div>

             <div>
                <label for="">Profile Photo</label>
                 @if($member->photo)
                   <input type="file" name="photo" accept="image/*" id="photo" value="">
                    <img src="{{ asset('storage/' . $member->photo) }}" style="height:50px; width:50px;">
                                         @else
                                    <span class="text-gray-400 text-xs">No photo</span>
                    @endif
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" name="submit" class="admin-login">Update Family Member</button>
        </form>
    </div>


    <script>
    

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
