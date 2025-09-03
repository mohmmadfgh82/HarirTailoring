<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
    public function index()
    {
        return Collection::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('collections', 'public');
            $data['image'] = asset('storage/' . $path);
        }

        $collection = Collection::create($data);

        return response()->json($collection, 201);
    }

    public function show($id)
    {
        return Collection::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            // حذف تصویر قبلی
            if ($collection->image) {
                $oldPath = str_replace([asset('storage/'), '/storage/'], '', $collection->image);
                Storage::disk('public')->delete($oldPath);
            }

            // ذخیره تصویر جدید
            $path = $request->file('image')->store('collections', 'public');
            $data['image'] = asset('storage/' . $path);
        }

        $collection->update($data);

        return response()->json($collection);
    }

    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);
        
        // حذف تصویر از storage
        if ($collection->image) {
            $imagePath = str_replace([asset('storage/'), '/storage/'], '', $collection->image);
            Storage::disk('public')->delete($imagePath);
        }
        
        $collection->delete();
        
        return response()->json(['message' => 'Deleted']);
    }
}