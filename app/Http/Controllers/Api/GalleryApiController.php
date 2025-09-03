<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryApiController extends Controller
{
    public function index()
    {
        return response()->json(Gallery::latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        $gallery = Gallery::create([
            'title' => $request->title,
            'image' => url('/storage/' . $path),
        ]);

        return response()->json($gallery, 201);
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // حذف فایل از storage
        $imagePath = str_replace(url('/'), '', $gallery->image); // حذف URL
        if (file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        $gallery->delete();

        return response()->json(['message' => 'Deleted']);
    }
}