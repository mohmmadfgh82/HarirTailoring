@extends('layouts.website')

@section('content')

    {{-- Hero Section --}}
    <section class="hero-section" style="min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 hero-content" data-aos="fade-down">
                    <h1 class="hero-title">گالری آثار</h1>
                    <p class="hero-subtitle">مجموعه‌ای از بهترین طراحی‌ها و آثار مزون حریر</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Grid --}}
    <section class="py-5">
        <div class="container">
            @if($galleries->isNotEmpty())
                <div class="row g-4">
                    @foreach($galleries as $index => $image)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ ($index % 12) * 50 }}">
                            <div class="gallery-item">
                                <img src="{{ $image->image }}" alt="{{ $image->title ?? 'گالری حریر' }}" 
                                     data-bs-toggle="modal" data-bs-target="#galleryModal{{ $image->id }}" 
                                     style="cursor: pointer;">
                            </div>
                        </div>

                        {{-- Modal for each image --}}
                        <div class="modal fade" id="galleryModal{{ $image->id }}" tabindex="-1">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">{{ $image->title ?? 'گالری حریر' }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        <img src="{{ $image->image }}" class="img-fluid w-100" alt="{{ $image->title }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-5">
                    {{ $galleries->links() }}
                </div>
            @else
                <div class="text-center">
                    <div class="bg-white rounded-3 p-5 shadow-sm">
                        <i class="fas fa-images fa-4x text-muted mb-3"></i>
                        <h4>گالری در حال بروزرسانی...</h4>
                        <p class="text-muted">به زودی تصاویر جدیدی از آثار ما اضافه خواهد شد</p>
                        <a href="{{ route('home') }}" class="btn btn-elegant mt-3">
                            <i class="fas fa-home me-2"></i>بازگشت به خانه
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection