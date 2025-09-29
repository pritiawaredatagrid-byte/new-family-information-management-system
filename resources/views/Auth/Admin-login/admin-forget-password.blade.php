

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
      background-color: var(--background-color);
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
      background-color: var(--card-background);
      padding: 3rem;
      border-radius: 1rem;
      box-shadow: 0 4px 12px var(--shadow-color);
      max-width: 450px;
      width: 90%;
      text-align: center;
    }

    .login-card h2 {
      color: #484E54;
      font-size: 1.7rem;
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

    .login-button {
      width: 100%;
      background-color: var(--primary-color);
      border: none;
      border-radius: 0.5rem;
      color: white;
      font-size: 1.1rem;
      font-weight: bold;
      padding: 0.75rem 2rem;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .login-button:hover {
      background-color: #0056b3;
      transform: translateY(-2px);
    }

    .error-message {
      color: #f44336;
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }

    .error-container {
      margin-bottom: 1rem;
    }
  </style>
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

  <script>
    $(document).ready(function () {
      $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
      });

      $('#email').on('input', function () {
        $('.email-error').text('');
        $('.error-container').text('');
      });

      $('#ajax-forget-form').on('submit', function (e) {
        e.preventDefault();
        $('.email-error').text('');
        $('.error-container').text('');

        $.ajax({
          type: 'POST',
          url: '/admin-forget-password',
          data: $(this).serialize(),
          success: function (response) {
            alert(response.message || 'Password reset link sent to your email.');
          },
          error: function (xhr) {
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;
              if (errors.email) {
                $('.email-error').text(errors.email[0]);
              }
            } else if (xhr.status === 400 || xhr.status === 401) {
              $('.error-container').html('<p class="error-message">Invalid request.</p>');
            } else {
              $('.error-container').html('<p class="error-message">Something went wrong.</p>');
            }
          }
        });
      });
    });
  </script>
</body>

</html>