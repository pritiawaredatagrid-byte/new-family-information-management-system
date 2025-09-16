<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #1F2937;
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
      background-color: #E5E7EB;
      padding: 3rem;
      border-radius: 1rem;
      box-shadow: 0 4px 12px var(--shadow-color);
      max-width: 450px;
      width: 90%;
      text-align: center;
    }

    .login-card h2 {
      font-size: 2rem;
      font-weight: 700;
      text-transform: uppercase;
      color: #1F2937;
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

    .error-message {
      color: #ef4444;
      background-color: #fee2e2;
      border: 1px solid #fca5a5;
      padding: 0.75rem;
      border-radius: 0.5rem;
      font-size: 0.875rem;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .login-button {
      width: 100%;
      background-color: #0ea5e9;
      color: #fff;
      border: none;
      border-radius: 0.5rem;
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
  </style>
</head>



<body>
  <div class="login-card">
    <h2>Admin Login</h2>
    @error('user')
      <p class="error-message-style">{{ $message }}</p>
    @enderror
    <form action="/admin-login" method="post">
      @csrf
      <div class="form-group">
        <label for="email">Admin Email</label>
        <input type="email" id="email" name="email" placeholder="Enter Admin Email" />
        @error('email')
          <p class="error-message-style">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Admin Password" />
        @error('password')
          <p class="error-message-style">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="login-button">Login</button>

      <p class="link-text">
        <a href="/admin-forget-password">Forgot Your Password?</a>
      </p>
    </form>
  </div>
</body>

</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/bootstrap-5.3.8-dist/css/bootstrap.css" rel="stylesheet">

</head>
<body>
  <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div data-mdb-input-init class="form-outline form-white mb-4">
                <input type="email" id="typeEmailX" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX">Email</label>
              </div>

              <div data-mdb-input-init class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX">Password</label>
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

              <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="/bootstrap-5.3.8-dist/js/bootstrap.js"></script>
</body>
</html> -->