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

        <a class="dashboard-card" href="/city-list">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
            <path
              d="M120-120v-560h240v-80l120-120 120 120v240h240v400H120Zm80-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm240 320h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm240 480h80v-80h-80v80Zm0-160h80v-80h-80v80Z" />
          </svg>
          <div class="card-content">
            <div class="card-title">Cities</div>
            <div class="card-number">{{ $totalCities }}</div>
          </div>
        </a>
      </div>


    </div>

  </div>

</body>

</html>