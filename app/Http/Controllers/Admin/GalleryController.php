<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(20);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'image' => '/storage/' . $path,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'تصویر با موفقیت اضافه شد.');
    }

    public function destroy(Gallery $gallery)
    {
        // حذف فایل از storage
        if ($gallery->image) {
            $imagePath = str_replace('/storage/', '', $gallery->image);
            \Storage::disk('public')->delete($imagePath);
        }

        $gallery->delete();
        return back()->with('success', 'تصویر با موفقیت حذف شد.');
    }
}
