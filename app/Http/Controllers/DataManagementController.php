<?php
namespace App\Http\Controllers;

use App\Models\People; // Assuming the 'People' model is used for storing people data
use Illuminate\Http\Request;

class DataManagementController extends Controller
{
    // Function to fetch and return data for the Data Management page
  
    // Function to fetch and return data for the Data Management page
    public function index(Request $request)
    {
        // Fetch location from the request if any (for dropdown selection)
        $selectedLocation = $request->input('location', null);

        // Total count of people
        $totalPeople = People::when($selectedLocation, function ($query, $location) {
            return $query->where('location', $location);
        })->count();

        // Count of Male and Female people
        $maleCount = People::when($selectedLocation, function ($query, $location) {
            return $query->where('location', $location);
        })->where('gender', 'Male')->count();

        $femaleCount = People::when($selectedLocation, function ($query, $location) {
            return $query->where('location', $location);
        })->where('gender', 'Female')->count();

        // Location Distribution (Number of people per location)
        $locationData = People::when($selectedLocation, function ($query, $location) {
            return $query->where('location', $location);
        })->selectRaw('location, count(*) as count')
          ->groupBy('location')
          ->pluck('count', 'location');

        // Prepare the data for the view
        $locationLabels = $locationData->keys();
        $locationCounts = $locationData->values();

        // Age Distribution (Number of people per age)
        $ageData = People::when($selectedLocation, function ($query, $location) {
            return $query->where('location', $location);
        })->selectRaw('age, count(*) as count')
          ->groupBy('age')
          ->pluck('count', 'age');

        // Prepare the age data for the view
        $ageLabels = $ageData->keys();
        $ageCounts = $ageData->values();

        // Return the view with the data
        return view('data-management', compact(
            'totalPeople',
            'maleCount',
            'femaleCount',
            'locationLabels',
            'locationCounts',
            'ageLabels',
            'ageCounts',
            'selectedLocation'
        ));
    }


}