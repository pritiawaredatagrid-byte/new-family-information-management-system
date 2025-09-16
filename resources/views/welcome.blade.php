<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to FIMS</title>
    <link rel="stylesheet" href="home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --background-color: #f4f7f6;
            --card-background: #ffffff;
            --text-color: #333;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }

        .welcome-container {
            background-color: var(--card-background);
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px var(--shadow-color);
            width: 100%;
            max-width: 600px;
        }

        .welcome-header {
            margin-bottom: 2rem;
        }

        .logo img {
            max-width: 100px;
            height: auto;
            margin-bottom: 1rem;
        }

        h1 {
            color: var(--primary-color);
            font-size: 2rem;
            margin: 0;
        }

        .tagline {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .description {
            font-size: 1rem;
            color: var(--text-color);
            margin-bottom: 2rem;
        }

        .cta-button {
            display: inline-block;
            background-color: var(--primary-color);
            color: #fff;
            padding: 1rem 2.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .cta-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <div class="welcome-container">
        <header class="welcome-header">
            <div class="logo">
                <!-- <img src="{{ asset('storage/photos/fims_logo.png') }}" alt="FIMS Logo"> -->
                 <h1>FIMS</h1>
            </div>
            <h1>Family Information Management System</h1>
        </header>

        <main class="welcome-content">
            <p class="tagline">Easily store and manage your family's information.</p>
            <p class="description">
                Welcome to FIMS, a simple and secure system to help you keep track of your family's details.
                Get started by registering your family today.
            </p>
            <div class="button-group">
                <a href="/user-registration" class="cta-button">Register Family</a>
                <a href="/admin-login" class="cta-button">Admin Login</a>
            </div>
        </main>
    </div>
</body>

</html>