<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // JavaScript function to preview the image
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function() {
                const imagePreview = document.getElementById('image-preview');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block'; // Show the image preview
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans flex justify-center items-center min-h-screen">
    <div class="w-full max-w-lg bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Create Profile</h2>
        <form action="{{ route('store-people-data') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <!-- Profile Picture -->
                <div class="form-group">
                    <!-- Image Preview -->
                    <img id="image-preview" src="#" alt="Image Preview" class="mt-4 w-32 h-32 object-cover rounded-full mx-auto" style="display:none;">
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                    <input type="file" name="profile_picture" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" accept="image/*" onchange="previewImage(event)">
                    
                    
                </div>

                <!-- First Name -->
                <div class="form-group">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <!-- Last Name -->
                <div class="form-group">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

               <!-- Gender -->
               <div class="form-group">
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
                <!-- Age -->
                <div class="form-group">
                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number" name="age" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="form-group">
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <select name="location" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="Don Bosco">Don Bosco</option>
                        <option value="Sun valley">Sun valley</option>
                        <option value="San Antonio">San Antonio</option>
                        <option value="Moonwalk">Moonwalk</option>
                        <option value="Don Galo">Don Galo</option>
                        <option value="Merville">Merville</option>
                    </select>
                </div>
                

                <!-- Class -->
                <div class="form-group">
                    <label for="class" class="block text-sm font-medium text-gray-700">Class</label>
                    <input type="text" name="class" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="mt-4 w-full py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Save Profile
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
