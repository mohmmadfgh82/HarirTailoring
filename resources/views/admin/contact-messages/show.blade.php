@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="fas fa-envelope-open me-2"></i>جزئیات پیام
        </h2>
        <div>
            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right me-1"></i>بازگشت به لیست
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-comment me-2"></i>{{ $message->subject }}
                    </h5>
                    {!! $message->status_badge !!}
                </div>
                <div class="card-body">
                    <div class="message-content">
                        <p class="lead">{{ $message->message }}</p>
                    </div>

                    @if($message->collection_title)
                        <div class="alert alert-info mt-4">
                            <h6><i class="fas fa-tag me-2"></i>سفارش کالکشن</h6>
                            <p class="mb-1"><strong>کالکشن:</strong> {{ $message->collection_title }}</p>
                            @if($message->size)
                                <p class="mb-0"><strong>سایز:</strong> {{ $message->size }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- عملیات سریع --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-tools me-2"></i>عملیات سریع</h6>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        @if($message->status !== 'replied')
                            <div class="col-md-3">
                                <form method="POST" action="{{ route('admin.contact-messages.update-status', $message->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="replied">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-reply me-1"></i>پاسخ داده شده
                                    </button>
                                </form>
                            </div>
                        @endif
                        
                        @if($message->status !== 'archived')
                            <div class="col-md-3">
                                <form method="POST" action="{{ route('admin.contact-messages.update-status', $message->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="archived">
                                    <button type="submit" class="btn btn-warning w-100">
                                        <i class="fas fa-archive me-1"></i>آرشیو
                                    </button>
                                </form>
                            </div>
                        @endif

                        <div class="col-md-3">
                            <a href="tel:{{ $message->phone }}" class="btn btn-info w-100">
                                <i class="fas fa-phone me-1"></i>تماس
                            </a>
                        </div>

                        @if($message->email)
                            <div class="col-md-3">
                                <a href="mailto:{{ $message->email }}" class="btn btn-primary w-100">
                                    <i class="fas fa-envelope me-1"></i>ایمیل
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            {{-- اطلاعات فرستنده --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>اطلاعات فرستنده</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">نام:</label>
                        <p class="mb-0 fw-bold">{{ $message->name }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted">تلفن:</label>
                        <p class="mb-0">
                            <a href="tel:{{ $message->phone }}" class="text-decoration-none">
                                <i class="fas fa-phone me-1"></i>{{ $message->phone }}
                            </a>
                        </p>
                    </div>

                    @if($message->email)
                        <div class="mb-3">
                            <label class="form-label text-muted">ایمیل:</label>
                            <p class="mb-0">
                                <a href="mailto:{{ $message->email }}" class="text-decoration-none">
                                    <i class="fas fa-envelope me-1"></i>{{ $message->email }}
                                </a>
                            </p>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label text-muted">تاریخ ارسال:</label>
                        <p class="mb-0">{{ $message->created_at->format('Y/m/d H:i') }}</p>
                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                    </div>

                    @if($message->read_at)
                        <div class="mb-3">
                            <label class="form-label text-muted">تاریخ مطالعه:</label>
                            <p class="mb-0">{{ $message->read_at->format('Y/m/d H:i') }}</p>
                            <small class="text-muted">{{ $message->read_at->diffForHumans() }}</small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- آمار سریع --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>آمار سریع</h6>
                </div>
                <div class="card-body">
                    @php
                        $userMessages = \App\Models\ContactMessage::where('phone', $message->phone)->count();
                        $userEmailMessages = $message->email ? \App\Models\ContactMessage::where('email', $message->email)->count() : 0;
                    @endphp
                    
                    <p class="mb-2">
                        <i class="fas fa-history me-2"></i>
                        <strong>{{ $userMessages }}</strong> پیام از این شماره تلفن
                    </p>
                    
                    @if($message->email && $userEmailMessages > 0)
                        <p class="mb-0">
                            <i class="fas fa-envelope me-2"></i>
                            <strong>{{ $userEmailMessages }}</strong> پیام از این ایمیل
                        </p>
                    @endif
                </div>
            </div>

            {{-- حذف پیام --}}
            <div class="card mt-4 border-danger">
                <div class="card-header bg-danger text-white">
                    <h6 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>منطقه خطر</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">حذف این پیام غیرقابل بازگشت است.</p>
                    <form method="POST" action="{{ route('admin.contact-messages.destroy', $message->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('آیا از حذف این پیام مطمئن هستید؟')">
                            <i class="fas fa-trash me-1"></i>حذف پیام
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection