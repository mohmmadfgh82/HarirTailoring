<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::latest()->get();
        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.collections.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $path = null;
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('collections', 'public');
    }

    Collection::create([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $path ? '/storage/' . $path : null,
    ]);

    return redirect()->route('admin.collections.index')->with('success', 'کالکشن جدید اضافه شد');
}

    public function edit($id)
    {
        $collection = Collection::findOrFail($id);
        return view('admin.collections.edit', compact('collection'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $collection = Collection::findOrFail($id);

    // حذف تصویر قبلی در صورت وجود و آپلود تصویر جدید
    if ($request->hasFile('image')) {
        // حذف عکس قبلی
        if ($collection->image) {
            $oldPath = str_replace('/storage/', '', $collection->image);
            \Storage::disk('public')->delete($oldPath);
        }

        // ذخیره تصویر جدید
        $path = $request->file('image')->store('collections', 'public');
        $collection->image = '/storage/' . $path;
    }

    $collection->title = $request->title;
    $collection->description = $request->description;
    $collection->save();

    return redirect()->route('admin.collections.index')->with('success', 'کالکشن ویرایش شد');
}

    public function destroy($id)
    {
        Collection::destroy($id);
        return redirect()->route('admin.collections.index')->with('success', 'کالکشن حذف شد');
    }
}
