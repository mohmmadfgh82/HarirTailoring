<?php

namespace App\Http\Controllers\Admin;

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
        $newMessagesCount = ContactMessage::where('status', 'new')->count();

        return view('admin.contact-messages.index', compact('messages', 'newMessagesCount'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // علامت‌گذاری به عنوان خوانده شده
        if ($message->status === 'new') {
            $message->markAsRead();
        }

        return view('admin.contact-messages.show', compact('message'));
    }

    public function updateStatus(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:new,read,replied,archived'
        ]);

        $message->update([
            'status' => $request->status,
            'read_at' => $request->status !== 'new' ? now() : null
        ]);

        return back()->with('success', 'وضعیت پیام با موفقیت تغییر کرد');
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return back()->with('success', 'پیام با موفقیت حذف شد');
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

        return back()->with('success', $successMessage);
    }
}