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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
  <link rel="stylesheet" href="/css/admin.css">
</head>

<body class="flex">

  <aside class="sidebar h-screen flex flex-col">
    <div class="flex items-center space-x-3 mb-8 sidebar-header">
      <svg width="35" height="35" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="30" r="20" fill="currentColor" />
        <path d="M25 70 Q50 40 75 70 L75 80 Q50 110 25 80 Z" fill="currentColor" />
      </svg>
      <h1 class="text-3xl font-bold text-gray-200 sidebar-text">FIMS Admin</h1>
    </div>
    <nav class="flex-1 space-y-2">
      <a href="/dashboard" class="sidebar-link active">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
        </svg>
        <span class="sidebar-text">Dashboard</span>
      </a>
      <a href="/family-list" class="sidebar-link">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM10 10a5 5 0 00-5 5v2a1 1 0 102 0v-2a3 3 0 013-3h4a3 3 0 013 3v2a1 1 0 102 0v-2a5 5 0 00-5-5H10z" />
        </svg>
        <span class="sidebar-text">Family Management</span>
      </a>
      <a href="/member-list" class="sidebar-link">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM10 10a5 5 0 00-5 5v2a1 1 0 102 0v-2a3 3 0 013-3h4a3 3 0 013 3v2a1 1 0 102 0v-2a5 5 0 00-5-5H10z" />
        </svg>
        <span class="sidebar-text">Member Management</span>
      </a>
      <a href="/state-list" class="sidebar-link">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7z" />
          <path fill-rule="evenodd"
            d="M19 19a1 1 0 01-1 1H2a1 1 0 01-1-1V5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1V5a1 1 0 011-1h4a1 1 0 011 1v14zm-1-1v-3H4v3h14zm-4-7h-4a1 1 0 000 2h4a1 1 0 000-2z"
            clip-rule="evenodd" />
        </svg>
        <span class="sidebar-text">State Management</span>
      </a>
      <a href="/city-list" class="sidebar-link">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7z" />
          <path fill-rule="evenodd"
            d="M19 19a1 1 0 01-1 1H2a1 1 0 01-1-1V5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1V5a1 1 0 011-1h4a1 1 0 011 1v14zm-1-1v-3H4v3h14zm-4-7h-4a1 1 0 000 2h4a1 1 0 000-2z"
            clip-rule="evenodd" />
        </svg>
        <span class="sidebar-text">City Management</span>
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
        <span class="sidebar-text">Logout</span>
      </a>
    </div>
  </aside>
  <div class="page-wrapper">
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="flex justify-between items-center mb-8">
        <div class="header-text">
          <button id="sidebarToggle" class="p-2 text-gray-400 hover:text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        </div>
        <div class="flex items-center space-x-4">
          <div class="flex items-center space-x-2">
            <span class="text-gray-600">Welcome, {{$name}}</span>
            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
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
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-24 mt-8">
        <div class="graph-card h-72">
          <canvas id="marital_status"></canvas>
        </div>
        <div class="graph-card h-72">
          <canvas id="member_marital_status"></canvas>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-24 mt-8">

        <div class="graph-card h-72">
          <canvas id="familiesPerState"></canvas>
        </div>
        <div class="graph-card h-72">
          <canvas id="familyGrowth"></canvas>
        </div>
      </div>
    </main>
  </div>
  </div>

  <script>
    window.dashboardData = {
      marriedHeads: {{ $marriedHeads }},
      unmarriedHeads: {{ $unmarriedHeads }},
      marriedMembers: {{ $marriedMembers }},
      unmarriedMembers: {{ $unmarriedMembers }},
      familiesPerState: @json($familiesPerState),
      labels: @json($labels),
      cumulativeData: @json($cumulativeData)
    };
  </script>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


  <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>