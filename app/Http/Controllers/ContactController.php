<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'collection_id' => 'nullable|exists:collections,id',
            'collection_title' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:10'
        ]);

        ContactMessage::create($request->all());

        return back()->with('success', 'پیام شما با موفقیت ارسال شد. به زودی با شما تماس خواهیم گرفت.');
    }
}