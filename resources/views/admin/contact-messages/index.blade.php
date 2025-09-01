@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="fas fa-envelope me-2"></i>مدیریت پیام‌ها
            @if($newMessagesCount > 0)
                <span class="badge bg-danger ms-2">{{ $newMessagesCount }} جدید</span>
            @endif
        </h2>
        <div>
            <a href="{{ route('home') }}" class="btn btn-outline-primary" target="_blank">
                <i class="fas fa-external-link-alt me-1"></i>مشاهده سایت
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- فیلترها --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">وضعیت</label>
                    <select name="status" class="form-select">
                        <option value="">همه</option>
                        <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>جدید</option>
                        <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>خوانده شده</option>
                        <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>پاسخ داده شده</option>
                        <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>آرشیو شده</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">جستجو</label>
                    <input type="text" name="search" class="form-control" placeholder="نام، ایمیل، تلفن یا موضوع..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i>جستجو
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- عملیات گروهی --}}
    <div class="card mb-4" id="bulkActions" style="display: none;">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.contact-messages.bulk-action') }}" id="bulkForm">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">عملیات گروهی</label>
                        <select name="action" class="form-select" required>
                            <option value="">انتخاب کنید...</option>
                            <option value="mark_read">علامت‌گذاری به عنوان خوانده شده</option>
                            <option value="mark_replied">علامت‌گذاری به عنوان پاسخ داده شده</option>
                            <option value="archive">آرشیو</option>
                            <option value="delete">حذف</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-warning" onclick="return confirm('آیا مطمئن هستید؟')">
                            <i class="fas fa-check me-1"></i>اعمال
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="clearSelection()">
                            <i class="fas fa-times me-1"></i>لغو
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- لیست پیام‌ها --}}
    <div class="card">
        <div class="card-body">
            @if($messages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">
                                    <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                                </th>
                                <th>نام</th>
                                <th>تماس</th>
                                <th>موضوع</th>
                                <th>وضعیت</th>
                                <th>تاریخ</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                                <tr class="{{ $message->status === 'new' ? 'table-warning' : '' }}">
                                    <td>
                                        <input type="checkbox" name="selected_messages[]" value="{{ $message->id }}" class="message-checkbox" onchange="updateBulkActions()">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($message->status === 'new')
                                                <i class="fas fa-circle text-success me-2" style="font-size: 8px;"></i>
                                            @endif
                                            <div>
                                                <strong>{{ $message->name }}</strong>
                                                @if($message->collection_title)
                                                    <br><small class="text-muted">
                                                        <i class="fas fa-tag me-1"></i>{{ $message->collection_title }}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <i class="fas fa-phone me-1"></i>{{ $message->phone }}
                                            @if($message->email)
                                                <br><i class="fas fa-envelope me-1"></i>{{ $message->email }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $message->subject }}</span>
                                        @if($message->size)
                                            <br><small class="text-muted">سایز: {{ $message->size }}</small>
                                        @endif
                                    </td>
                                    <td>{!! $message->status_badge !!}</td>
                                    <td>
                                        <small>
                                            {{ $message->created_at->format('Y/m/d H:i') }}
                                            <br>{{ $message->created_at->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="btn btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class="fas fa-cog"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <form method="POST" action="{{ route('admin.contact-messages.update-status', $message->id) }}" style="display: inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="replied">
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="fas fa-reply me-2"></i>پاسخ داده شده
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form method="POST" action="{{ route('admin.contact-messages.update-status', $message->id) }}" style="display: inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="archived">
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="fas fa-archive me-2"></i>آرشیو
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form method="POST" action="{{ route('admin.contact-messages.destroy', $message->id) }}" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('حذف شود؟')">
                                                                <i class="fas fa-trash me-2"></i>حذف
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $messages->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                    <h4>هیچ پیامی یافت نشد</h4>
                    <p class="text-muted">
                        @if(request()->has('search') || request()->has('status'))
                            نتیجه‌ای برای جستجوی شما یافت نشد
                        @else
                            هنوز هیچ پیامی از طریق فرم تماس ارسال نشده است
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.message-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActions();
}

function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('.message-checkbox:checked');
    const bulkActions = document.getElementById('bulkActions');
    const bulkForm = document.getElementById('bulkForm');
    
    if (checkedBoxes.length > 0) {
        bulkActions.style.display = 'block';
        
        // اضافه کردن ID های انتخاب شده به فرم
        const existingInputs = bulkForm.querySelectorAll('input[name="messages[]"]');
        existingInputs.forEach(input => input.remove());
        
        checkedBoxes.forEach(checkbox => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'messages[]';
            input.value = checkbox.value;
            bulkForm.appendChild(input);
        });
    } else {
        bulkActions.style.display = 'none';
    }
}

function clearSelection() {
    document.getElementById('selectAll').checked = false;
    document.querySelectorAll('.message-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    updateBulkActions();
}
</script>
@endsection