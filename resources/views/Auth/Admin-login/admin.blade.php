
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

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #e5e7eb;
    }

    .page-container {
      display: flex;
      min-height: 100vh;
      width: 100%;
    }

    .sidebar {
      width: 280px;
      background-color: #1F2937;
      color: #d1d5db;
      padding: 1.5rem 1rem;
      transition: all 0.3s ease;
      position: fixed;
      height: 100%;
      top: 0;
      left: 0;
      z-index: 10;
    }

    .sidebar.collapsed {
      width: 100px;
    }

    .sidebar.collapsed .sidebar-text,
    .sidebar.collapsed .sidebar-header h1 {
      display: none;
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

    .page-wrapper {
      margin-left: 300px;
      transition: margin-left 0.3s ease;
      min-height: 100vh;
    }

    .page-wrapper.collapsed {
      margin-left: 100px;
    }

    .stats-card {
      background-color: #ffffff;
      border-radius: 0.75rem;
      padding: 2rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .graph-card {
      background-color: #ffffff;
      border-radius: 0.75rem;
      padding: 1rem 7rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .stats-card:hover,
    .graph-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .main-header {
      display: flex;
      text-align: left;
      align-items: center;
      padding: 1.5rem;
      background-color: #ffffff;
      border-bottom: 1px solid #e5e7eb;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
      gap: 2rem;
    }

    .header-text {
      display: flex;
      justify-content: space-between;
      gap: 1rem;
      align-items: center;
    }

    .header-text #sidebarToggle {
      display: none;
    }

    @media (max-width: 1024px) {
      .sidebar {
        width: 280px;
        height: auto;
        top: -100%;
        left: 0;
        padding: 1rem;
        transition: top 0.3s ease;
      }

      .sidebar.active {
        top: 0;
        width: 100%;
        height: auto;
        position: fixed;
      }

      .sidebar.collapsed {
        top: -100%;
        width: 100%;
      }

      .sidebar.collapsed .sidebar-text,
      .sidebar.collapsed .sidebar-header h1 {
        display: initial;
      }

      .page-wrapper {
        margin-left: 280px;
      }

      .page-wrapper.collapsed {
        margin-left: 100px;
      }

      .main-header {
        display: flex;
        text-align: left;
        padding: 1.5rem;
        background-color: #ffffff;
        border-bottom: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        gap: 2rem;
      }

      .header-text {
        display: flex;
        justify-content: space-between;
        gap: 0.5rem;

      }

      .header-text #sidebarToggle {
        display: initial;
      }

    }

    @media (max-width: 768px) {
      .sidebar {
        display: block;
        top: -100%;
        width: 100%;
        padding: 1rem;
      }

      .sidebar.active {
        top: 0;
        width: 100%;
        height: auto;
      }

      .page-wrapper {
        margin-left: 0;
      }

      .page-wrapper.collapsed {
        margin-left: 0;
      }
    }

    @media (max-width: 480px) {
      .sidebar {
        padding: 0.5rem;
      }

      .main-header {
        padding: 1rem;
      }

      .header-text h1 {
        font-size: 1.5rem;
      }
    }
  </style>
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
    Chart.register(ChartDataLabels);

    const ctx1 = document.getElementById('marital_status');
    new Chart(ctx1, {
      type: 'pie',
      data: {
        labels: ['Married', 'Unmarried'],
        datasets: [{
          label: '# of Family Heads',
          data: [{{ $marriedHeads }}, {{ $unmarriedHeads }}],
          backgroundColor: [
            '#3B82F6',
            'rgba(34, 197, 94, 0.6)'
          ],
          borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        datalabels: {
        color: '#fff',
        formatter: (value, ctx) => {
          let label = ctx.chart.data.labels[ctx.dataIndex];
          return `${value}`;
        }
      },
          legend: { position: 'top' },
          title: { display: true, text: 'Marital Status of Family Heads' }
        }
      }
    });

    const ctx2 = document.getElementById('familiesPerState');
    new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: Object.keys(@json($familiesPerState)),
        datasets: [{
          label: 'Number of Families',
          data: Object.values(@json($familiesPerState)),
          backgroundColor: '#3B82F6',
          borderColor: '#1D4ED8',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        datalabels: {
        anchor: 'end',
        align: 'top',
        color: '#fff',
        font: {
          weight: 'bold'
        }
      },
        plugins: {
          legend: { display: false },
          title: { display: true, text: 'Families Per State' }
        },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
      }
    });

    const ctx3 = document.getElementById('member_marital_status');
    new Chart(ctx3, {
      type: 'doughnut',
      data: {
        labels: ['Married', 'Unmarried'],
        datasets: [{
          label: '# of Family Members',
          data: [{{ $marriedMembers }}, {{ $unmarriedMembers }}],
          backgroundColor: [
            '#3B82F6',
            'rgba(34, 197, 94, 0.6)'
          ],
          borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'top' },
          title: { display: true, text: 'Marital Status of Members' }
        }
      }
    });

    const ctx4 = document.getElementById('familyGrowth');
    new Chart(ctx4, {
      type: 'line',
      data: {
        labels: @json($labels),
        datasets: [{
          label: 'Cumulative Family Registrations',
          data: @json($cumulativeData),
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 2,
          fill: true,
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          title: { display: true, text: 'Family Registration Growth Over Time' }
        },
        scales: {
          x: { title: { display: true, text: 'Month' } },
          y: { beginAtZero: true, title: { display: true, text: 'Cumulative Registrations' }, ticks: { stepSize: 1 } }
        }
      }
    });

    document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.querySelector('.sidebar');
      const pageWrapper = document.querySelector('.page-wrapper');
      const sidebarToggle = document.getElementById('sidebarToggle');

      if (sidebar && pageWrapper && sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
          sidebar.classList.toggle('active');
        });

        const sidebarLinks = document.querySelectorAll('.sidebar-link');
        sidebarLinks.forEach(link => {
          link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
              sidebar.classList.remove('active');
            }
          });
        });
      }
    });
  </script>
</body>

</html>