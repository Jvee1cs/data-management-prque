<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Person</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function previewImage(event) {
            const output = document.getElementById('profilePicturePreview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.style.display = 'block';
        }
    </script>
</head>
<body class="bg-gray-100">
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-4xl font-semibold text-gray-800 mb-6">Edit Person</h1>

    <!-- Form Start -->
    <form action="{{ route('people.update', $People->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white p-8 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <!-- Profile Picture Section -->
        <div class="flex items-center justify-between space-x-6">
            <div class="w-1/3">
                <label class="block text-lg font-medium text-gray-700 mb-2">Profile Picture</label>
                
                <!-- Input for profile picture with live preview -->
                <input type="file" name="profile_picture" accept="image/*" onchange="previewImage(event)" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                
                <!-- Profile picture preview -->
                @if ($People->profile_picture)
                    <img id="profilePicturePreview" src="{{ asset('storage/' . $People->profile_picture) }}" class="mt-4 h-32 w-32 rounded-lg object-cover" style="display: block;">
                @else
                    <img id="profilePicturePreview" class="mt-4 h-32 w-32 rounded-lg object-cover" style="display: none;">
                @endif
            </div>
        </div>

        <!-- Name Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-lg font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $People->first_name) }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                @error('first_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-lg font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $People->last_name) }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                @error('last_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Gender, Age, Location, and Class Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-lg font-medium text-gray-700">Gender</label>
                <input type="text" name="gender" value="{{ old('gender', $People->gender) }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                @error('gender')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-lg font-medium text-gray-700">Age</label>
                <input type="number" name="age" value="{{ old('age', $People->age) }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                @error('age')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-lg font-medium text-gray-700">Location</label>
                <input type="text" name="location" value="{{ old('location', $People->location) }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                @error('location')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-lg font-medium text-gray-700">Class</label>
                <input type="text" name="class" value="{{ old('class', $People->class) }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                @error('class')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Update Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white py-3 px-8 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                Update Person
            </button>
        </div>
    </form>
    <!-- Form End -->
</div>
<!-- End Container -->

<!-- Tailwind JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</body>
</html>
