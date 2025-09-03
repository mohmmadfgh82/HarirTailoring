<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::latest()->paginate(12);
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('collections', 'public');
        }

        Collection::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path ? asset('storage/' . $path) : null,
        ]);

        return redirect()->route('admin.collections.index')->with('success', 'کالکشن جدید با موفقیت اضافه شد');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $collection = Collection::findOrFail($id);

        // حذف تصویر قبلی در صورت وجود و آپلود تصویر جدید
        if ($request->hasFile('image')) {
            // حذف عکس قبلی
            if ($collection->image) {
                $oldPath = str_replace([asset('storage/'), '/storage/'], '', $collection->image);
                \Storage::disk('public')->delete($oldPath);
            }

            // ذخیره تصویر جدید
            $path = $request->file('image')->store('collections', 'public');
            $collection->image = asset('storage/' . $path);
        }

        $collection->title = $request->title;
        $collection->description = $request->description;
        $collection->save();

        return redirect()->route('admin.collections.index')->with('success', 'کالکشن با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);
        
        // حذف تصویر از storage در صورت وجود
        if ($collection->image) {
            $imagePath = str_replace('/storage/', '', $collection->image);
            \Storage::disk('public')->delete($imagePath);
        }
        
        $collection->delete();
        return redirect()->route('admin.collections.index')->with('success', 'کالکشن با موفقیت حذف شد');
    }
}
