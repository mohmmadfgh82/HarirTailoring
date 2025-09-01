@extends('layouts.website')

@section('content')

    {{-- Collection Detail --}}
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="collection-card">
                        @if($collection->image)
                            <img src="{{ $collection->image }}" class="card-img-top" alt="{{ $collection->title }}" style="height: 500px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 500px;">
                                <i class="fas fa-image fa-5x text-muted"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-left">
                    <div class="p-4">
                        <h1 class="mb-4" style="color: var(--dark-color);">{{ $collection->title }}</h1>
                        
                        @if($collection->description)
                            <div class="mb-4">
                                <h5 style="color: var(--primary-color);">
                                    <i class="fas fa-info-circle me-2"></i>توضیحات
                                </h5>
                                <p class="text-muted">{{ $collection->description }}</p>
                            </div>
                        @endif

                        <div class="mb-4">
                            <h5 style="color: var(--primary-color);">
                                <i class="fas fa-calendar me-2"></i>تاریخ ایجاد
                            </h5>
                            <p class="text-muted">{{ $collection->created_at->format('Y/m/d') }}</p>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="#contact" class="btn btn-elegant btn-lg">
                                <i class="fas fa-phone me-2"></i>سفارش این طرح
                            </a>
                            <a href="{{ route('collections') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-right me-2"></i>بازگشت به کالکشن‌ها
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Collections --}}
    @if($relatedCollections->isNotEmpty())
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="section-title text-center">کالکشن‌های مرتبط</h2>
                <div class="row g-4">
                    @foreach($relatedCollections as $index => $related)
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <div class="collection-card h-100">
                                @if($related->image)
                                    <img src="{{ $related->image }}" class="card-img-top" alt="{{ $related->title }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body p-3">
                                    <h5 class="card-title">{{ $related->title }}</h5>
                                    <p class="card-text text-muted small">{{ Str::limit($related->description, 80) }}</p>
                                    <a href="{{ route('collection.detail', $related->id) }}" class="btn btn-elegant btn-sm">
                                        <i class="fas fa-eye me-1"></i>مشاهده
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Contact Section --}}
    <section class="contact-section" id="contact">
        <div class="container" data-aos="fade-up">
            <h2 class="section-title text-center">سفارش این طرح</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form">
                        <form action="#" method="POST">
                            @csrf
                            <input type="hidden" name="collection_id" value="{{ $collection->id }}">
                            <input type="hidden" name="collection_title" value="{{ $collection->title }}">
                            
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                شما در حال سفارش طرح "<strong>{{ $collection->title }}</strong>" هستید
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2"></i>نام و نام خانوادگی
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="نام شما" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone me-2"></i>شماره تماس
                                    </label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="09123456789" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="size" class="form-label">
                                    <i class="fas fa-ruler me-2"></i>سایز مورد نظر
                                </label>
                                <select class="form-control" id="size" name="size" required>
                                    <option value="">انتخاب کنید...</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                    <option value="custom">سایز سفارشی</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label">
                                    <i class="fas fa-comment me-2"></i>توضیحات اضافی
                                </label>
                                <textarea class="form-control" id="message" name="message" rows="4" placeholder="توضیحات خاص، تغییرات مورد نظر، زمان تحویل و..."></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-elegant btn-lg">
                                    <i class="fas fa-shopping-cart me-2"></i>ثبت سفارش
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection