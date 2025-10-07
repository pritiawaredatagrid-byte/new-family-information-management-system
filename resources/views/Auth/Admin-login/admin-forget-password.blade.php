<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Forget Password</title>
  <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
  <link rel="stylesheet" href="/css/admin-forget-password.css">
</head>

<body>
  <div class="login-card">
    <h2>Forgot Password</h2>

    <div class="error-container"></div>

    <form id="ajax-forget-form" method="POST">
      @csrf
      <div class="form-group">
        <label for="email">Admin Email</label>
        <input type="email" name="email" id="email" placeholder="Enter Admin Email">
        <div class="email-error error-message"></div>
      </div>
      <button type="submit" class="login-button">Submit</button>
    </form>
  </div>
  <script src="/js/admin-forget-password.js"></script>
</body>

</html>