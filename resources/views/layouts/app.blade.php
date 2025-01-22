<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Application Name')</title>

    <!-- Include any necessary CSS files -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- You can also include other external CSS libraries -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

</head>
<body>
    <!-- Navigation / Header -->
    <header>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main content section -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Your Company Name. All rights reserved.</p>
    </footer>

    <!-- Include JavaScript files -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
