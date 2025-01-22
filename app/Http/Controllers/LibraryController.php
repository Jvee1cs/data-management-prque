<?php
namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileTracer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('library', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Ordinance,Resolution,Memo',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
    
        $path = $request->file('file')->store('uploads/files');
    
        File::create([
            'title' => $request->title,
            'category' => $request->category,
            'path' => $path,
            'uploaded_by' => auth()->id(), // Track uploader
        ]);
    
        return back()->with('success', 'File uploaded successfully!');
    }
    
    public function download($id)
    {
        $file = File::findOrFail($id);
    
        FileTracer::create([
            'file_id' => $file->id,
            'user_id' => auth()->id(),
            'action' => 'download',
        ]);
    
        return Storage::download($file->path);
    }
    
    public function view($id)
    {
        $file = File::findOrFail($id);
    
        FileTracer::create([
            'file_id' => $file->id,
            'user_id' => auth()->id(),
            'action' => 'view',
        ]);
    
        return response()->file(storage_path('app/private/' . $file->path));
    }
    
    public function tracers()
    {
        $tracers = FileTracer::with(['file', 'user'])->latest()->paginate(10);
        return view('file_tracers', compact('tracers'));
    }
}
