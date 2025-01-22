<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-6 text-center">Digital File Cabinet</h1>

        <form action="{{ route('library.upload') }}" method="POST" enctype="multipart/form-data" class="mb-8">
            @csrf
            <div class="grid gap-4">
                <input type="text" name="title" placeholder="File Title" class="border p-2 rounded" required>
                <select name="category" class="border p-2 rounded" required>
                    <option value="">Select Category</option>
                    <option value="Ordinance">Ordinance</option>
                    <option value="Resolution">Resolution</option>
                    <option value="Memo">Memo</option>
                </select>
                <input type="file" name="file" class="border p-2 rounded" required>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                    Upload
                </button>
            </div>
        </form>
 <!-- Activity Button -->
 <div class="mb-6 text-center">
    <a href="{{ route('file.tracers') }}" class="bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-700">
        View File Activity
    </a>
</div>
        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-4">Title</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Uploaded By</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                    <tr>
                        <td class="p-4">{{ $file->title }}</td>
                        <td class="p-4">{{ $file->category }}</td>
                        <td class="p-4">{{ $file->uploader ? $file->uploader->name : 'Unknown' }}</td>
                        <td class="p-4">
                            <a href="{{ route('library.view', $file->id) }}" class="text-blue-500 hover:underline">View</a> |
                            <a href="{{ route('library.download', $file->id) }}" class="text-green-500 hover:underline">Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
