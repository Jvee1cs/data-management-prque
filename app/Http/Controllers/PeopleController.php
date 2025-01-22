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
        if ($request->has('search') && $request->get('search') !== '') {
            $search = $request->get('search');
            $query->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%");
        }

        // Filter by class
        if ($request->has('class') && $request->get('class') !== '') {
            $query->where('class', $request->get('class'));
        }

        // Filter by gender
        if ($request->has('gender') && $request->get('gender') !== '') {
            $query->where('gender', $request->get('gender'));
        }

        // Filter by location
        if ($request->has('location') && $request->get('location') !== '') {
            $query->where('location', $request->get('location'));
        }

        // Filter by age
        if ($request->has('age') && $request->get('age') !== '') {
            $query->where('age', $request->get('age'));
        }

        // Get the data with pagination
        $people = $query->paginate(10);

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
         $ids = $request->get('ids');
         People::whereIn('id', $ids)->delete();
         // Delete profile picture if exists
         if ($ids->profile_picture) {
            \Storage::delete('public/' . $ids->profile_picture);
        }
 
         return redirect()->route('people.index')->with('success', 'People deleted successfully!');
     }
     
}
