@extends('layouts.website')

@section('content')

    {{-- Hero Section --}}
    <section class="hero-section" style="min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 hero-content" data-aos="fade-down">
                    <h1 class="hero-title">کالکشن‌ها</h1>
                    <p class="hero-subtitle">جدیدترین و بهترین طراحی‌های مزون حریر</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Collections Grid --}}
    <section class="py-5">
        <div class="container">
            @if($collections->isNotEmpty())
                <div class="row g-4">
                    @foreach($collections as $index => $collection)
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index % 9) * 100 }}">
                            <div class="collection-card h-100">
                                @if($collection->image)
                                    <img src="{{ $collection->image }}" class="card-img-top" alt="{{ $collection->title }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body p-4">
                                    <h4 class="card-title mb-3">{{ $collection->title }}</h4>
                                    <p class="card-text text-muted mb-4">{{ Str::limit($collection->description, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('collection.detail', $collection->id) }}" class="btn btn-elegant">
                                            <i class="fas fa-eye me-2"></i>مشاهده جزئیات
                                        </a>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $collection->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-5">
                    {{ $collections->links() }}
                </div>
            @else
                <div class="text-center">
                    <div class="bg-white rounded-3 p-5 shadow-sm">
                        <i class="fas fa-tshirt fa-4x text-muted mb-3"></i>
                        <h4>کالکشن‌های جدید به زودی...</h4>
                        <p class="text-muted">در حال آماده‌سازی جدیدترین طراحی‌های خود هستیم</p>
                        <a href="{{ route('home') }}" class="btn btn-elegant mt-3">
                            <i class="fas fa-home me-2"></i>بازگشت به خانه
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection