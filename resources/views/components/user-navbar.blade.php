<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .dashboard-body {
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #424242;
        }

        .navbar {
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .logo {
            font-size: 1.7rem;
            font-weight: 700;
            letter-spacing: 1px;
            cursor: pointer;
            transition: color 0.3s ease;
            color: #2196f3;
        }

        .logo:hover {
            color: #007bff;
        }

        .links {
            display: flex;
            gap: 1.5rem;
        }

        .links a {
            text-decoration: none;
            color: #555;
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: #2196f3;
        }

        .links a span {
            font-weight: 600;
            color: #2196f3;
        }

        .links a span:hover {
            color: #555;
        }

        .home {
            padding: 0.4rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 6.1rem;
            padding: 1rem;
        }

        .dashboard-card {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding: 1.5rem 2rem;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            min-width: 220px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card svg {
            width: 50px;
            height: 50px;
            flex-shrink: 0;
            fill: #2196F3;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #555;
        }

        .card-number {
            font-size: 1.6rem;
            font-weight: 700;
            color: #2196f3;
            margin-top: 4px;
        }

        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body class="dashboard-body">
    <nav class="navbar">
        <div class="logo">
            FIMS
        </div>
        <div>
        </div>
        <div class="links">
            <a href="/dashboard" class="">Dashboard</a>
            <a href="/user-registration" class="">{{$slot}}</a>
            <a href="/admin-logout" class="">Logout</a>
        </div>
    </nav>




    </div>

    </div>

</body>

</html>