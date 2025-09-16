<!-- <!DOCTYPE html>
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

    .search {
      position: relative;
      display: flex;
      align-items: center;
      width: 100%;
      max-width: 400px;
      border: 1px solid #e0e0e0;
      border-radius: 25px;
      padding: 8px 15px;
      background-color: #f8f9fa;
      transition: all 0.3s ease;
    }

    .search:hover {
      border-color: #ccc;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .search:focus-within {
      border-color: #2196f3;
      box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.25);
    }

    .search input[type="text"] {
      flex-grow: 1;
      border: none;
      background: transparent;
      padding: 2px 5px;
      font-size: 1rem;
      color: #333;
      outline: none;
    }

    .search input[type="text"]::placeholder {
      color: #999;
    }

    .search svg {
      cursor: pointer;
      height: 20px;
      width: 20px;
      fill: #555;
      transition: fill 0.3s ease;
    }

    .search svg:hover {
      fill: #2196f3;
    }

    .links {
      display: flex;
      gap: 2rem;
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

    .container {
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    iframe {
      border: none;
      width: 90%;
      height: 90vh;
      border-radius: 12px;
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
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
      <a href="/dashboard" class="">Overview</a>
      <a href="/user-registration" class="">Add Family</a>
      <a href="" class="">Welcome <span>{{$name}}</span></a>
      <a href="/admin-logout" class="">Logout</a>
    </div>
  </nav>
  <div>
    <div class="home">

      <div class="dashboard-container">
        <a class="dashboard-card" href="/family-list">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
            <path
              d="M185-80q-17 0-29.5-12.5T143-122v-105q0-90 56-159t144-88q-40 28-62 70.5T259-312v190q0 11 3 22t10 20h-87Zm147 0q-17 0-29.5-12.5T290-122v-190q0-70 49.5-119T459-480h189q70 0 119 49t49 119v64q0 70-49 119T648-80H332Zm148-484q-66 0-112-46t-46-112q0-66 46-112t112-46q66 0 112 46t46 112q0 66-46 112t-112 46Z" />
          </svg>
          <div class="card-content">
            <div class="card-title">Families</div>
            <div class="card-number">{{ $totalFamilies }}</div>
          </div>
        </a>

        <div class="dashboard-card" href="">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
            <path
              d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z" />
          </svg>
          <div class="card-content">
            <div class="card-title">Members</div>
            <div class="card-number">{{ $totalMembers }}</div>
          </div>
  </div>

        <a class="dashboard-card" href="/state-list">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
            <path
              d="M480-160q18 0 34.5-2t33.5-6l-48-72H360v-40q0-33 23.5-56.5T440-360h80v-120h-80q-17 0-28.5-11.5T400-520v-80h-18q-26 0-44-17.5T320-661q0-9 2.5-18t7.5-17l62-91q-101 29-166.5 113T160-480h40v-40q0-17 11.5-28.5T240-560h80q17 0 28.5 11.5T360-520v40q0 17-11.5 28.5T320-440v40q0 33-23.5 56.5T240-320h-37q42 72 115 116t162 44Zm304-222q8-23 12-47.5t4-50.5q0-112-68-197.5T560-790v110q33 0 56.5 23.5T640-600v80q19 0 34 4.5t29 18.5l81 115ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z" />
          </svg>
          <div class="card-content">
            <div class="card-title">States</div>
            <div class="card-number">{{ $totalStates }}</div>
          </div>
        </a>

        <div class="dashboard-card" href="/city-list">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
            <path
              d="M120-120v-560h240v-80l120-120 120 120v240h240v400H120Zm80-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm240 320h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm240 480h80v-80h-80v80Zm0-160h80v-80h-80v80Z" />
          </svg>
          <div class="card-content">
            <div class="card-title">Cities</div>
            <div class="card-number">{{ $totalCities }}</div>
          </div>
  </div>
      </div>


    </div>

  </div>

</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #e5e7eb;
    }

    .sidebar {
      width: 280px;
      background-color: #1f2937;
      color: #d1d5db;
      padding: 1.5rem 1rem;
    }

    .sidebar-link {
      display: flex;
      align-items: center;
      padding: 0.75rem 1rem;
      border-radius: 0.5rem;
      transition: background-color 0.2s, color 0.2s;
      text-decoration: none;
      color: #d1d5db;
    }

    .sidebar-link:hover {
      background-color: #374151;
      color: #ffffff;
    }

    .sidebar-link.active {
      background-color: #2563eb;
      color: #ffffff;
      font-weight: 600;
    }

    .stats-card {
      background-color: #ffffff;
      border-radius: 0.75rem;
      padding: 2rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .stats-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body class="flex">
  <!-- Sidebar -->
  <aside class="sidebar h-screen flex flex-col">
    <div class="flex items-center space-x-3 mb-8">
      <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM6 9a4 4 0 014-4 4 4 0 014 4 4 4 0 01-4 4 4 4 0 01-4-4z" />
      </svg>
      <h1 class="text-2xl font-bold text-gray-200">FIMS Admin</h1>
    </div>
    <nav class="flex-1 space-y-2">
      <a href="/dashboard" class="sidebar-link active">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
        </svg>
        Dashboard
      </a>
      <a href="/family-list" class="sidebar-link">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM10 10a5 5 0 00-5 5v2a1 1 0 102 0v-2a3 3 0 013-3h4a3 3 0 013 3v2a1 1 0 102 0v-2a5 5 0 00-5-5H10z" />
        </svg>
        Family Management
      </a>
      <a href="/state-list" class="sidebar-link">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7z" />
          <path fill-rule="evenodd"
            d="M19 19a1 1 0 01-1 1H2a1 1 0 01-1-1V5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1V5a1 1 0 011-1h4a1 1 0 011 1v14zm-1-1v-3H4v3h14zm-4-7h-4a1 1 0 000 2h4a1 1 0 000-2z"
            clip-rule="evenodd" />
        </svg>
        State Management
      </a>
    </nav>
    <div class="mt-auto">
      <a href="/admin-logout" class="sidebar-link mt-4">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
            clip-rule="evenodd" />
        </svg>
        Logout
      </a>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8 overflow-y-auto">
    <!-- Top Nav -->
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
      <div class="flex items-center space-x-4">

        <div class="flex items-center space-x-2">
          <span class="text-gray-600">Hi, {{$name}}</span>
          <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="stats-card flex items-center justify-between">
        <div>
          <div class="text-sm font-semibold text-gray-500">Total Families</div>
          <div class="text-3xl font-bold text-gray-800 mt-1">{{ $totalFamilies }}</div>
        </div>
        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
          <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM10 10a5 5 0 00-5 5v2a1 1 0 102 0v-2a3 3 0 013-3h4a3 3 0 013 3v2a1 1 0 102 0v-2a5 5 0 00-5-5H10z" />
          </svg>
        </div>
      </div>

      <div class="stats-card flex items-center justify-between">
        <div>
          <div class="text-sm font-semibold text-gray-500">Total Members</div>
          <div class="text-3xl font-bold text-gray-800 mt-1">{{ $totalMembers }}</div>
        </div>
        <div class="p-3 rounded-full bg-green-100 text-green-500">
          <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
          </svg>
        </div>
      </div>

      <div class="stats-card flex items-center justify-between">
        <div>
          <div class="text-sm font-semibold text-gray-500">Total States</div>
          <div class="text-3xl font-bold text-gray-800 mt-1">{{ $totalStates }}</div>
        </div>
        <div class="p-3 rounded-full bg-purple-100 text-purple-500">
          <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm4.848 6.551a1 1 0 001.304 1.5l3-3a1 1 0 00-1.304-1.5l-2.28 2.279a1 1 0 01-1.414 0l-1.293-1.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0z"
              clip-rule="evenodd" />
          </svg>
        </div>
      </div>

      <div class="stats-card flex items-center justify-between">
        <div>
          <div class="text-sm font-semibold text-gray-500">Total Cities</div>
          <div class="text-3xl font-bold text-gray-800 mt-1">{{ $totalCities }}</div>
        </div>
        <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
          <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10 2a6 6 0 00-6 6c0 4.418 5.768 11.238 5.975 11.45L10 20l.025-.555C10.232 19.238 16 12.418 16 8a6 6 0 00-6-6zM8 8a2 2 0 114 0 2 2 0 01-4 0z" />
          </svg>
        </div>
      </div>
    </div>

    <!-- <div class="bg-white p-6 rounded-lg shadow-md mt-8">
      <h2 class="text-xl font-bold text-gray-800 mb-4">Family Management</h2>
      <p class="text-gray-600">This is where the table for viewing and managing families will go.</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mt-8">
      <h2 class="text-xl font-bold text-gray-800 mb-4">Member Management</h2>
      <p class="text-gray-600">This is where the table for viewing and managing members will go.</p>
    </div> -->
  </main>

</body>

</html