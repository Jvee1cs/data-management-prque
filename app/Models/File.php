<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'path'];

    public function tracers()
    {
        return $this->hasMany(FileTracer::class);
    }
    public function uploader()
{
    return $this->belongsTo(User::class, 'uploaded_by');
}
}
