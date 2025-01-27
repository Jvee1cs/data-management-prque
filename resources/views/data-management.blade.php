<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Management</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

<div class="max-w-7xl mx-auto p-6">
     <!-- Navigation Section -->
     <nav class="mb-6">
        <ul class="flex space-x-4">
            <li>
                <a href="{{ url('/people-data') }}" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                    People Data
                </a>
            </li>
            <li>
                <a href="{{ url('/data-management') }}" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                    Data Management
                </a>
            </li>
            <!-- Add more navigation items here as needed -->
        </ul>
    </nav>
    <!-- Title -->
    <h1 class="text-5xl font-bold text-gray-900 mb-10 text-center">Data Management Dashboard</h1>

    <!-- Statistics Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <!-- Total People -->
        <div class="bg-gradient-to-r from-teal-500 to-cyan-500 text-black p-8 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all">
            <h3 class="text-3xl font-semibold mb-4">Total People</h3>
            <p class="text-5xl font-extrabold">{{ $totalPeople }}</p>
        </div>

        <!-- Male Count -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white p-8 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all">
            <h3 class="text-3xl font-semibold mb-4">Male</h3>
            <p class="text-5xl font-extrabold">{{ $maleCount }}</p>
        </div>

        <!-- Female Count -->
        <div class="bg-gradient-to-r from-pink-500 to-red-500 text-white p-8 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all">
            <h3 class="text-3xl font-semibold mb-4">Female</h3>
            <p class="text-5xl font-extrabold">{{ $femaleCount }}</p>
        </div>
    </div>

    <!-- Location Dropdown -->
    <form method="GET" action="{{ route('data-management') }}" class="mb-8">
        <label for="location" class="text-lg font-semibold">Select Location</label>
        <select name="location" id="location" class="p-2 border rounded-md mt-2">
            <option value="">All Locations</option>
            @foreach($locationLabels as $location)
                <option value="{{ $location }}" {{ $selectedLocation == $location ? 'selected' : '' }}>{{ $location }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-4">Filter</button>
    </form>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Gender Distribution Chart (Pie Chart) -->
        <div class="bg-white p-8 rounded-xl shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Gender Distribution</h3>
            <canvas id="genderChart" class="w-full h-64 md:h-96"></canvas>
        </div>

        <!-- Location Distribution Chart -->
        <div class="bg-white p-8 rounded-xl shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Location Distribution</h3>
            <canvas id="locationChart" class="w-full h-64 md:h-96"></canvas>
            <div class="mt-6 space-y-2">
                @foreach($locationLabels as $key => $location)
                    <div class="flex justify-between items-center">
                        <p class="text-lg text-gray-700">{{ $location }}</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $locationCounts[$key] }} people</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Age Distribution Chart -->
        <div class="bg-white p-8 rounded-xl shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Age Distribution</h3>
            <canvas id="ageChart" class="w-full h-64 md:h-96"></canvas>
        </div>
    </div>

</div>

<script>
// Gender Distribution Chart (Pie Chart)
const genderCtx = document.getElementById('genderChart').getContext('2d');
const genderChart = new Chart(genderCtx, {
    type: 'pie',
    data: {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Gender Distribution',
            data: [{{ $maleCount }}, {{ $femaleCount }}],
            backgroundColor: ['#4CAF50', '#FF4081'],
            borderColor: ['#388E3C', '#F50057'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw;
                    }
                }
            }
        }
    }
});

// Location Distribution Chart
const locationCtx = document.getElementById('locationChart').getContext('2d');
const locationChart = new Chart(locationCtx, {
    type: 'bar',
    data: {
        labels: @json($locationLabels),
        datasets: [{
            label: 'Number of People',
            data: @json($locationCounts),
            backgroundColor: '#2196F3',
            borderColor: '#1976D2',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Age Distribution Chart
const ageCtx = document.getElementById('ageChart').getContext('2d');
const ageChart = new Chart(ageCtx, {
    type: 'line',
    data: {
        labels: @json($ageLabels),
        datasets: [{
            label: 'Number of People',
            data: @json($ageCounts),
            fill: false,
            borderColor: '#FFEB3B',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>
