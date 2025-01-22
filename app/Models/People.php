<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    // Define the table if it's not following the plural naming convention
    protected $table = 'people';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'age',
        'location',
        'class',
        'profile_picture', // Add this line

    ];

    // Optional: Add casts for data types if necessary
    protected $casts = [
        'age' => 'integer',
    ];
}