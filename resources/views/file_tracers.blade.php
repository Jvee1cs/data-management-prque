<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Tracers</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold mb-6 text-center">File Tracers</h1>
        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-4">File Title</th>
                    <th class="p-4">User</th>
                    <th class="p-4">Action</th>
                    <th class="p-4">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tracers as $tracer)
                    <tr>
                        <td class="p-4">{{ $tracer->file->title }}</td>
                        <td class="p-4">{{ $tracer->user ? $tracer->user->name : 'Guest' }}</td>
                        <td class="p-4">{{ ucfirst($tracer->action) }}</td>
                        <td class="p-4">{{ $tracer->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $tracers->links() }}
        </div>
    </div>
</body>
</html>
