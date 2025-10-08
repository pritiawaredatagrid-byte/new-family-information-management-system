<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin State</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="/css/add-state.css">
</head>

<body>
    <div class="main">
        <h2>Add State</h2>
        <div id="success-message"></div>
        <form id="ajax-form" method="POST" >
            @csrf
            <div>
                <label for="state_name">State</label>
                <input type="text" name="state_name" id="state_name" placeholder="Enter State Here">
            </div>
            <button type="submit" class="admin-login">Add State</button>
        </form>
    </div>

    <script src="/js/add-state.js"></script>
</body>

</html>