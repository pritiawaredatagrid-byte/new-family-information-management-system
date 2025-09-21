<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #e5e7eb;
    }

    .sidebar {
      width: 280px;
      background-color: #1F2937;
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

    /* 
     @media screen and (max-width: 480px) {
      .sidebar {
      display:none;
    }
        } */
  </style>
</head>

<body class="flex">

  <aside class="sidebar h-screen flex flex-col">
    <div class="flex items-center space-x-3 mb-8">
      <svg width="35" height="35" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">

        <circle cx="50" cy="30" r="20" fill="currentColor" />

        <path d="M25 70 Q50 40 75 70 L75 80 Q50 110 25 80 Z" fill="currentColor" />
      </svg>
      <h1 class="text-3xl font-bold text-gray-200">FIMS Admin</h1>
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
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3H6.75A2.25 2.25 0 004.5 5.25v13.5A2.25 2.25 0 006.75 21h6.75a2.25 2.25 0 002.25-2.25V15a.75.75 0 011.5 0v3.75A3.75 3.75 0 0113.5 22.5H6.75A3.75 3.75 0 013 18.75V5.25A3.75 3.75 0 016.75 1.5h6.75a3.75 3.75 0 013.75 3.75V9a.75.75 0 01-1.5 0z"
            clip-rule="evenodd" />
          <path d="M21 12l-3-3m0 0l3 3m-3-3v6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
        Logout
      </a>
    </div>
  </aside>

</body>

</html>