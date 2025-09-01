@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="fas fa-images me-2"></i>مدیریت کالکشن‌ها
        </h2>
        <div>
            <a href="{{ route('home') }}" class="btn btn-outline-primary me-2" target="_blank">
                <i class="fas fa-external-link-alt me-1"></i>مشاهده سایت
            </a>
            <a href="{{ route('admin.collections.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-1"></i>افزودن کالکشن جدید
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse ($collections as $collection)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    @if ($collection->image)
                        <img src="{{ $collection->image }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $collection->title }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $collection->title }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($collection->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $collection->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.collections.edit', $collection->id) }}" class="btn btn-sm btn-warning flex-fill">
                                <i class="fas fa-edit me-1"></i>ویرایش
                            </a>
                            <form action="{{ route('admin.collections.destroy', $collection->id) }}" method="POST" class="flex-fill">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100" onclick="return confirm('آیا از حذف این کالکشن مطمئن هستید؟')">
                                    <i class="fas fa-trash me-1"></i>حذف
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                    <h4>هیچ کالکشنی ثبت نشده است</h4>
                    <p class="text-muted">برای شروع، اولین کالکشن خود را اضافه کنید</p>
                    <a href="{{ route('admin.collections.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>افزودن کالکشن جدید
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
