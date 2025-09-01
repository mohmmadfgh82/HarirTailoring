<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Gallery;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home()
    {
        $collections = Collection::latest()->take(6)->get();
        $galleries = Gallery::latest()->take(12)->get();

        return view('website.home', compact('collections', 'galleries'));
    }

    public function gallery()
    {
        $galleries = Gallery::latest()->paginate(20);
        return view('website.gallery', compact('galleries'));
    }

    public function collections()
    {
        $collections = Collection::latest()->paginate(12);
        return view('website.collections', compact('collections'));
    }

    public function collection($id)
    {
        $collection = Collection::findOrFail($id);
        $relatedCollections = Collection::where('id', '!=', $id)->latest()->take(3)->get();
        return view('website.collection-detail', compact('collection', 'relatedCollections'));
    }
}
