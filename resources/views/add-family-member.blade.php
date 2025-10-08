<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Family Member</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>

    <link rel="stylesheet" href="/css/add-family-member.css">
</head>

<body class="Family-Member-body">
    <div class="main">
        @if(session('success'))
            <div class="alert success" role="alert">
                <span class="message">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert error" role="alert">
                <span class="message">{{ session('error') }}</span>
            </div>
        @endif

        <h2>Add Family Member</h2>
        @if(Session::has('headId'))
    <a href="{{ route('add-member-form', ['head_id' => Session::get('headId')]) }}" class="btn btn-secondary" style="color:white; text-decoration:none;">
        Add Family Member
    </a>
@endif

        @error('user')
            <p class="error">{{ $message }}</p>
        @enderror

        <form action="{{ route('add-member-submit') }}" method="post" class="form" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">Member Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Member Name">
            </div>
            <div>
                <label for="birthdate">Birth Date</label>
                <input type="date" name="birthdate" id="birthdate">
                @error('birthdate')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="marital-status">
                <label>Marital Status</label>
                <label>
                    <input type="radio" name="status" value="married" id="married-radio">
                    Married
                </label>
                <label>
                    <input type="radio" name="status" value="unmarried" id="unmarried-radio">
                    Unmarried
                </label>
            </div>
            <div id="marital-status-group"></div>
            <div class="WeddingDate">
                <label for="wedding_date">Wedding Date</label>
                <input type="date" name="wedding_date" id="wedding_date">
            </div>
            <div>
                <label for="education">Education <span style="color:red">(optional)</span></label>
                <input type="text" name="education" id="education" placeholder="Enter Education">
            </div>
            <div>
                <label for="photo">Profile Photo <span style="color:red">(optional)</span></label>
                <input type="file" name="photo" id="photo">
            </div>
            <input type="hidden" name="head_id" value="{{ $head_id }}">
            <button type="submit" name="submit" class="admin-login">Add Family Member</button>
            <a href="/" class="btn back">Go to home page</a>
        </form>
    </div>

    <script src="/js/add-family-member.js"></script>
</body>

</html>