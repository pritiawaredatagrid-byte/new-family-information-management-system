<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reset Password</title>
    <!-- Add your CSS here, e.g., <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="/css/admin-set-forget-password.css">
</head>

<body>
    <div class="main">
        <h2>Reset Password</h2>

        <div class="error-container"></div>
        <div class="success-message" id="success-message"></div>

        <form id="resetPasswordForm" method="POST" action="/admin-set-forget-password">
    @csrf
    <input type="hidden" name="email" value="{{ $email ?? '' }}">
    <input type="hidden" name="token" value="{{ $token ?? '' }}">

            <div class="form-group">
                <label for="password" class="label">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Admin Password">
                <div class="error-message" id="error-password"></div>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Confirm Admin Password">
                <div class="error-message" id="error-password_confirmation"></div>
            </div>

            <button type="submit" class="admin-login">Update Password</button>
        </form>
    </div>

    <script src="/js/admin-set-forget-password.js"></script>
</body>
</html>