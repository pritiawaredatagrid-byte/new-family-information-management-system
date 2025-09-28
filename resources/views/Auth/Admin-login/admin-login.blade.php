<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
  <style>
    :root {
      --primary-color: #007bff;
      --secondary-color: #6c757d;
      --background-color: #f4f7f6;
      --card-background: #ffffff;
      --text-color: #333;
      --shadow-color: rgba(0, 0, 0, 0.1);
      --border-color: #d1d5db;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f7f6;
      color: var(--text-color);
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .login-card {
      background-color: #ffff;
      padding: 3rem;
      border-radius: 1rem;
      box-shadow: 0 4px 12px var(--shadow-color);
      max-width: 450px;
      width: 90%;
      text-align: center;
    }

    .login-card h2 {
      color: #484E54;
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 2rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
      text-align: left;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: var(--secondary-color);
    }

    .form-group input {
      width: 100%;
      border: 1px solid var(--border-color);
      border-radius: 0.5rem;
      padding: 0.75rem 1rem;
      font-size: 1rem;
      color: var(--text-color);
      transition: border-color 0.3s ease;
    }

    .form-group input:focus {
      outline: none;
      border-color: var(--primary-color);
    }

    .form-group input::placeholder {
      color: var(--secondary-color);
      opacity: 0.6;
    }

    .error-message-style {
      color: red;
      font-size: 0.875rem;
      margin-bottom: 1.5rem;
      margin-top: 1rem;
    }

    .login-button {
      width: 100%;
      background-color: #0ea5e9;
      color: #fff;
      border: none;
      border-radius: 0.5rem;
      color: white;
      font-size: 1.1rem;
      font-weight: bold;
      font-size: 1.1rem;
      padding: 0.75rem 2rem;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
      text-decoration: none;
      font-weight: bold;
      font-size: 1.1rem;
    }

    .login-button:hover {
      background-color: #0056b3;
      transform: translateY(-2px);
    }

    .link-text {
      display: block;
      text-align: center;
      font-size: 0.9rem;
      margin-top: 1.5rem;
    }

    .link-text a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .link-text a:hover {
      color: #0056b3;
      text-decoration: underline;
    }

    .error-message {
      color: red;
      font-size: 0.875rem;
      margin-top: 0.3rem;
      margin-bottom: 1rem;
      display: block;
      font-weight: 100;
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

<body>
  <div class="login-card">
    <h2>Admin Login</h2>

    <div class="error-container"></div>

    <form action="/admin-login" method="POST" id="ajax-form">
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
  <script>
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      });

      // Clear errors as user types
      $('#email').on('input', function () {
        $('.email-error').text('');
        $('.error-container').text('');
      });

      $('#password').on('input', function () {
        $('.password-error').text('');
        $('.error-container').text('');
      });

      $('#ajax-form').on('submit', function (e) {
        e.preventDefault();

        // Clear errors on submit
        $('.error-message-style').text('');
        $('.error-container').text('');

        $.ajax({
          type: 'POST',
          url: '/admin-login',
          data: $(this).serialize(),
          success: function (response) {
            window.location.href = '/dashboard';
          },
          error: function (xhr) {
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;
              if (errors.email) {
                $('.email-error').text(errors.email[0]);
              }
              if (errors.password) {
                $('.password-error').text(errors.password[0]);
              }
            } else if (xhr.status === 401 || xhr.status === 400) {
              $('.error-container').html(`<p class="error-message">Invalid credentials.</p>`);
            } else {
              $('.error-container').html(`<p class="error-message">Something went wrong.</p>`);
            }
          }
        });
      });
    });

  </script>

</body>

</html>