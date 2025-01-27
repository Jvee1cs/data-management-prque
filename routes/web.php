<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\DataManagementController;
use App\Http\Controllers\LibraryController;

// Home route (landing page)
Route::get('/', function () {
    return view('dashboard');
});

// Authentication routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegistrationController::class, 'create'])->name('register');
Route::post('/register', [RegistrationController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Dashboard route (only for authenticated users)
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Home page route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Data Management route (only for authenticated users)
Route::middleware(['auth'])->get('/data-management', [DataManagementController::class, 'index'])->name('data-management');

// Library route (only for authenticated users)
Route::middleware(['auth'])->get('/library', function () {
    return view('library');
})->name('library');

// Profile routes (only for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route to add new people data (form page)
Route::middleware(['auth'])->get('/add-people-data', function () {
    return view('add-people-data'); // Create this view next
})->name('add-people-data');

// Route to handle storing new people data
Route::middleware(['auth'])->get('/people-data', [PeopleController::class, 'index'])->name('people-data'); // Display people data

Route::middleware(['auth'])->get('/create-people-data', [PeopleController::class, 'create'])->name('create-people-data'); // Create people data form

Route::middleware(['auth'])->post('/store-people-data', [PeopleController::class, 'store'])->name('store-people-data'); // Store people data
// Authentication required for all routes after this line
Route::middleware('auth')->prefix('people')->group(function() {
    Route::get('/create', [PeopleController::class, 'create'])->name('people.create');  // Create person
    Route::post('/', [PeopleController::class, 'store'])->name('people.store');  // Store person
    Route::get('/{id}/edit', [PeopleController::class, 'edit'])->name('edit-person');  // Edit person
    Route::put('/{id}', [PeopleController::class, 'update'])->name('people.update');  // Update person
    Route::delete('/{id}', [PeopleController::class, 'destroy'])->name('delete-person');  // Delete person
    Route::get('/', [PeopleController::class, 'index'])->name('people.index'); // People index route
    Route::post('/bulk-delete', [PeopleController::class, 'bulkDelete'])->name('people.bulkDelete');


});
Route::middleware(['auth'])->get('/library', [LibraryController::class, 'index'])->name('library.index');
Route::middleware(['auth'])->post('/library/upload', [LibraryController::class, 'upload'])->name('library.upload');
Route::middleware(['auth'])->get('/library/download/{id}', [LibraryController::class, 'download'])->name('library.download');
Route::middleware(['auth'])->get('/library/view/{id}', [LibraryController::class, 'view'])->name('library.view');
Route::middleware(['auth'])->get('/file-tracers', [LibraryController::class, 'tracers'])->name('file.tracers');

require __DIR__.'/auth.php';
