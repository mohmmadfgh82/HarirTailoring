<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'collection_id',
        'collection_title',
        'size',
        'status',
        'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function markAsRead()
    {
        $this->update([
            'status' => 'read',
            'read_at' => now()
        ]);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'new' => '<span class="badge bg-success">جدید</span>',
            'read' => '<span class="badge bg-primary">خوانده شده</span>',
            'replied' => '<span class="badge bg-info">پاسخ داده شده</span>',
            'archived' => '<span class="badge bg-secondary">آرشیو شده</span>',
            default => '<span class="badge bg-light">نامشخص</span>'
        };
    }
}