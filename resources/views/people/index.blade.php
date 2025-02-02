<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People Data</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-4 text-gray-800">People Data</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Search and Filters -->
    <form method="GET" action="{{ route('people.index') }}" class="mb-4 flex space-x-4">
        <input type="text" name="search" placeholder="Search by name..." value="{{ request()->get('search') }}" class="px-4 py-2 border border-gray-300 rounded-md">
        
        <select name="class" class="px-4 py-2 border border-gray-300 rounded-md">
            <option value="">Class</option>
            @foreach ($classess as $class)
                <option value="{{ $class }}" {{ request()->get('class') == $class ? 'selected' : '' }}>{{ $class }}</option>
            @endforeach
        </select>

        <select name="gender" class="px-4 py-2 border border-gray-300 rounded-md">
            <option value="">Gender</option>
            @foreach ($genders as $gender)
                <option value="{{ $gender }}" {{ request()->get('gender') == $gender ? 'selected' : '' }}>{{ $gender }}</option>
            @endforeach
        </select>

        <select name="location" class="px-4 py-2 border border-gray-300 rounded-md">
            <option value="">Location</option>
            @foreach ($locations as $location)
                <option value="{{ $location }}" {{ request()->get('location') == $location ? 'selected' : '' }}>{{ $location }}</option>
            @endforeach
        </select>

        <select name="age" class="px-4 py-2 border border-gray-300 rounded-md">
            <option value="">Age</option>
            @foreach ($ages as $age)
                <option value="{{ $age }}" {{ request()->get('age') == $age ? 'selected' : '' }}>{{ $age }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Filter</button>
    </form>

    <!-- Bulk Delete and Add People Data -->
    <div class="flex items-center mb-4 space-x-4">
        <form method="POST" action="{{ route('people.bulkDelete') }}" id="bulkDeleteForm">
            @csrf
            <input type="hidden" name="ids" id="bulkDeleteIds">
            <button type="button" id="bulkDeleteButton" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700">Bulk Delete</button>
        </form>
        
        <a href="{{ url('/add-people-data') }}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Add People Data</a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-indigo-600 text-white">
                    <th class="py-3 px-4 text-left">
                        <input type="checkbox" id="select-all" class="mr-2">
                    </th>
                    <th class="py-3 px-4 text-left">Profile Picture</th>
                    <th class="py-3 px-4 text-left">
                        <a href="{{ route('people.index', array_merge(request()->all(), ['sort_by' => 'first_name', 'sort_order' => request()->get('sort_order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-white">First Name</a>
                    </th>
                    <th class="py-3 px-4 text-left">
                        <a href="{{ route('people.index', array_merge(request()->all(), ['sort_by' => 'last_name', 'sort_order' => request()->get('sort_order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-white">Last Name</a>
                    </th>
                    <th class="py-3 px-4 text-left">Gender</th>
                    <th class="py-3 px-4 text-left">Age</th>
                    <th class="py-3 px-4 text-left">Location</th>
                    <th class="py-3 px-4 text-left">Class</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($people as $person)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-4">
                            <input type="checkbox" class="person-checkbox" value="{{ $person->id }}">
                        </td>
                        <td class="py-3 px-4">
                            @if($person->profile_picture)
                                <img src="{{ asset('storage/' . $person->profile_picture) }}" alt="Profile Picture" class="w-16 h-16 rounded-full object-cover">
                            @else
                                <p class="text-gray-500">No Profile Picture</p>
                            @endif
                        </td>
                        <td class="py-3 px-4">{{ $person->first_name }}</td>
                        <td class="py-3 px-4">{{ $person->last_name }}</td>
                        <td class="py-3 px-4">{{ $person->gender }}</td>
                        <td class="py-3 px-4">{{ $person->age }}</td>
                        <td class="py-3 px-4">{{ $person->location }}</td>
                        <td class="py-3 px-4">{{ $person->class }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('edit-person', $person->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a> |
                            <form action="{{ route('delete-person', $person->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $people->links() }}
    </div>
</div>

<script>
    // Select all checkboxes
    document.getElementById('select-all').addEventListener('click', function() {
        let checkboxes = document.querySelectorAll('.person-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    // Bulk delete function
    document.getElementById('bulkDeleteButton').addEventListener('click', function() {
        let selectedIds = Array.from(document.querySelectorAll('.person-checkbox:checked')).map(cb => cb.value);

        if (selectedIds.length > 0) {
            document.getElementById('bulkDeleteIds').value = selectedIds.join(',');
            document.getElementById('bulkDeleteForm').submit();
        } else {
            alert("Please select at least one person.");
        }
    });
</script>

</body>
</html>
