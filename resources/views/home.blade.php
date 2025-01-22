<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    

    <!-- Main Content -->
    <main class="container mx-auto mt-10 px-6">
        

        <!-- Features Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
            
            <!-- Login Card -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center hover:shadow-lg transition-shadow duration-200">
                <h2 class="text-xl font-semibold mb-4">Login</h2>
                <p class="text-gray-600 mb-6">Sign in to access your personalized dashboard.</p>
                <a href="{{ url('/login') }}" class="text-teal-500 font-bold hover:text-teal-700">
                    Login →
                </a>
            </div>

            <!-- Register Card -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center hover:shadow-lg transition-shadow duration-200">
                <h2 class="text-xl font-semibold mb-4">Register</h2>
                <p class="text-gray-600 mb-6">Create an account to unlock all features.</p>
                <a href="{{ url('/register') }}" class="text-teal-500 font-bold hover:text-teal-700">
                    Register →
                </a>
            </div>
        </div>
    </main>

   
</body>
</html>
