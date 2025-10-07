<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
  <link rel="stylesheet" href="/css/admin-login.css">
</head>

<body>
  <div class="login-card">
    <h2>Admin Login</h2>

    <div class="error-container"></div>

    <form method="POST" id="ajax-form">
      @csrf
      <div class="form-group">
        <label for="email">Admin Email</label>
        <input type="email" id="email" name="email" placeholder="Enter Admin Email" />
        <div class="email-error error-message-style"></div>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Admin Password" />
        <div class="password-error error-message-style"></div>
      </div>

      <button type="submit" class="login-button">Login</button>

      <p class="link-text">
        <a href="/admin-forget-password">Forgot Your Password?</a>
      </p>
      <a href="/" class="btn back">Back</a>
    </form>
  </div>
  <script src="/js/admin-login.js"></script>

</body>

</html>