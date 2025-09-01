<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
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
        if ($gallery->image && file_exists(public_path($gallery->image))) {
            unlink(public_path($gallery->image));
        }

        $gallery->delete();
        return back()->with('success', 'تصویر حذف شد.');
    }
}
