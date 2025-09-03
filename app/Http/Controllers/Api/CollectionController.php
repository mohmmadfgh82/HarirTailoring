<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

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
            'image' => 'nullable|string',
        ]);

        $collection = Collection::create($request->all());

        return response()->json($collection, 201);
    }

    public function show($id)
    {
        return Collection::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);
        $collection->update($request->all());

        return response()->json($collection);
    }

    public function destroy($id)
    {
        Collection::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}