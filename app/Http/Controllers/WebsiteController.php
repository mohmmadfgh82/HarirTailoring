<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    public function home()
    {
        $collections = Collection::latest()->get();
        $galleries = Gallery::latest()->get();

        return view('website.home', compact('collections', 'galleries'));
    }
}
