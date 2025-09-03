<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::latest();

        // فیلتر بر اساس وضعیت
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // جستجو
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $messages = $query->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $messages->items(),
            'pagination' => [
                'current_page' => $messages->currentPage(),
                'last_page' => $messages->lastPage(),
                'per_page' => $messages->perPage(),
                'total' => $messages->total(),
            ]
        ]);
    }

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

        $contactMessage = ContactMessage::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'پیام شما با موفقیت ارسال شد',
            'data' => $contactMessage
        ], 201);
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // علامت‌گذاری به عنوان خوانده شده
        if ($message->status === 'new') {
            $message->markAsRead();
        }

        return response()->json([
            'success' => true,
            'data' => $message
        ]);
    }

    public function update(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:new,read,replied,archived'
        ]);

        $message->update([
            'status' => $request->status,
            'read_at' => $request->status !== 'new' ? now() : null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'وضعیت پیام با موفقیت تغییر کرد',
            'data' => $message
        ]);
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'پیام با موفقیت حذف شد'
        ]);
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:mark_read,mark_replied,archive,delete',
            'messages' => 'required|array',
            'messages.*' => 'exists:contact_messages,id'
        ]);

        $messages = ContactMessage::whereIn('id', $request->messages);

        switch ($request->action) {
            case 'mark_read':
                $messages->update(['status' => 'read', 'read_at' => now()]);
                $successMessage = 'پیام‌های انتخاب شده به عنوان خوانده شده علامت‌گذاری شدند';
                break;
            case 'mark_replied':
                $messages->update(['status' => 'replied']);
                $successMessage = 'پیام‌های انتخاب شده به عنوان پاسخ داده شده علامت‌گذاری شدند';
                break;
            case 'archive':
                $messages->update(['status' => 'archived']);
                $successMessage = 'پیام‌های انتخاب شده آرشیو شدند';
                break;
            case 'delete':
                $messages->delete();
                $successMessage = 'پیام‌های انتخاب شده حذف شدند';
                break;
        }

        return response()->json([
            'success' => true,
            'message' => $successMessage
        ]);
    }

    public function stats()
    {
        $stats = [
            'total' => ContactMessage::count(),
            'new' => ContactMessage::where('status', 'new')->count(),
            'read' => ContactMessage::where('status', 'read')->count(),
            'replied' => ContactMessage::where('status', 'replied')->count(),
            'archived' => ContactMessage::where('status', 'archived')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}