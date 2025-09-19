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
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #e5e7eb;
    }

    .sidebar {
      width: 280px;
      background-color:  #1F2937;
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
    .graphs{
      padding-top:3.5rem;
      display:flex;
      gap:1.5rem;
    }

  </style>
</head>

<body class="flex">

  <x-sidebar></x-sidebar>
  
  <main class="flex-1 p-8 overflow-y-auto">

    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
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

      <div class="graphs">
          <canvas id="marital_status" width="1000" height="1000"></canvas>
          <canvas id="member_marital_status" width="1000" height="1000"></canvas>
          <canvas id="familiesPerState" width="1000" height="1000"></canvas>
          <canvas id="familyGrowth" width="1000" height="1000"></canvas>

      </div>
    </div>
  </main>

  <script>
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
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Marital Status of Family Heads'
        }
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
      plugins: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          text: 'Families Per State'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      }
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
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Marital Status of Members'
        }
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
      plugins: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          text: 'Family Registration Growth Over Time'
        }
      },
      scales: {
        x: {
          title: {
            display: true,
            text: 'Month'
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Cumulative Registrations'
          },
          ticks: {
            stepSize: 1
          }
        }
      }
    }
});
</script>
</body>

</html> 


