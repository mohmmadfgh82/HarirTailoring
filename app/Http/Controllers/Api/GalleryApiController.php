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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        $gallery = Gallery::create([
            'title' => $request->title,
            'image' => asset('storage/' . $path),
        ]);

        return response()->json($gallery, 201);
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // حذف فایل از storage
        if ($gallery->image) {
            $imagePath = str_replace([asset('storage/'), '/storage/'], '', $gallery->image);
            Storage::disk('public')->delete($imagePath);
        }

        $gallery->delete();

        return response()->json(['message' => 'Deleted']);
    }
}