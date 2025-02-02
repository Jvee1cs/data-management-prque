<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class PeopleController extends Controller
{
    // Show the form to create new people data
    public function create()
    {
        return view('data-management');
    }

    // Store the people data
    public function store(Request $request)
    {
        // Validation for profile picture upload
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'age' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate the image
        ]);

        // Handle the profile picture upload
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        } else {
            $imagePath = null; // No image uploaded
        }

        // Create a new People record
        People::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'gender' => $validated['gender'],
            'age' => $validated['age'],
            'location' => $validated['location'],
            'class' => $validated['class'],
            'profile_picture' => $imagePath, // Save the image path in the database
        ]);

        return redirect()->route('people-data'); // Redirect back to the people data page
    }
    
    // Display the people data
    public function index(Request $request)
    {
        $query = People::query();
    
        // Search by name
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%");
            });
        }
    
        // Apply filters
        foreach (['class', 'gender', 'location', 'age'] as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->get($filter));
            }
        }
    
        // Get the data with pagination (preserving filters)
        $people = $query->paginate(10)->appends($request->query());
    
        // Get filter options
        $classess = People::distinct()->pluck('class')->toArray();
        $genders = People::distinct()->pluck('gender')->toArray();
        $locations = People::distinct()->pluck('location')->toArray();
        $ages = People::distinct()->pluck('age')->toArray();
    
        return view('people.index', compact('people', 'classess', 'genders', 'locations', 'ages'));
    }
    

     // Show form to edit a People's data
     public function edit($id)
     {
         $People = People::findOrFail($id);
         return view('people.edit', compact('People'));
     }
 
     // Update People's data
     public function update(Request $request, $id)
     {
         $request->validate([
             'first_name' => 'required|string|max:255',
             'last_name' => 'required|string|max:255',
             'gender' => 'required|string|max:10',
             'age' => 'required|integer|min:1',
             'location' => 'required|string|max:255',
             'class' => 'required|string|max:255',
             'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
 
         $People = People::findOrFail($id);
         $data = $request->except('profile_picture');
 
         if ($request->hasFile('profile_picture')) {
             // Delete old profile picture if exists
             if ($People->profile_picture) {
                 \Storage::delete('public/' . $People->profile_picture);
             }
             $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
         }
 
         $People->update($data);
 
         return redirect()->route('people.index')->with('success', 'People updated successfully');
     }
 
     // Delete a People
     public function destroy($id)
     {
         $People = People::findOrFail($id);
 
         // Delete profile picture if exists
         if ($People->profile_picture) {
             \Storage::delete('public/' . $People->profile_picture);
         }
 
         $People->delete();
 
         return redirect()->route('people.index')->with('success', 'People deleted successfully');
     }
     public function bulkDelete(Request $request)
{
    // Ensure that 'ids' is an array
    $ids = explode(',', $request->input('ids')); // Convert string to array

    if (count($ids) > 0) {
        People::whereIn('id', $ids)->delete();
        return redirect()->route('people.index')->with('success', 'Selected records deleted successfully.');
    } else {
        return redirect()->route('people.index')->with('error', 'No records selected.');
    }
}

     
     
}
