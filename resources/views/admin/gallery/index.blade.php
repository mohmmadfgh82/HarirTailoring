@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="fas fa-images me-2"></i>مدیریت گالری
        </h2>
        <div>
            <a href="{{ route('gallery') }}" class="btn btn-outline-primary me-2" target="_blank">
                <i class="fas fa-external-link-alt me-1"></i>مشاهده گالری سایت
            </a>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-1"></i>افزودن تصویر جدید
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
        @forelse ($galleries as $gallery)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $gallery->image }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $gallery->title ?? 'گالری' }}">
                    <div class="card-body text-center">
                        @if($gallery->title)
                            <h6 class="card-title">{{ $gallery->title }}</h6>
                        @endif
                        <small class="text-muted d-block mb-2">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $gallery->created_at->diffForHumans() }}
                        </small>
                        <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('حذف شود؟')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash me-1"></i>حذف
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-images fa-4x text-muted mb-3"></i>
                    <h4>هیچ تصویری در گالری وجود ندارد</h4>
                    <p class="text-muted">برای شروع، اولین تصویر خود را اضافه کنید</p>
                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>افزودن تصویر جدید
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
