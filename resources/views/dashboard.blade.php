<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-gray-100 text-black py-4 ">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold"></h1>
                <nav>
                    <ul class="flex space-x-4">
                        
                        <li>
                            <!-- Logout Form -->
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="hover:text-gray-500 focus:outline-none">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
                
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4 py-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">PORTAL</h2>
                <p class="text-gray-600 mb-8">Manage your data and explore resources with ease.</p>
            </div>

            <!-- Links Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Data Management Card -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-bold text-blue-600 mb-2">Data Management</h3>
                    <p class="text-gray-600">Access and manage your organization's data efficiently.</p>
                    <a href="{{ url('/data-management') }}" class="block mt-4 bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700">
                        Go to Data Management
                    </a>
                </div>

                <!-- Library Card -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-bold text-blue-600 mb-2">Digital File Cabinet</h3>
                    <p class="text-gray-600">Browse and manage ordinances, resolutions, and memos.</p>
                    <a href="{{ url('/library') }}" class="block mt-4 bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700">
                        Go to Library
                    </a>
                </div>
            </div>
        </main>

       
    </div>
</body>
</html>
