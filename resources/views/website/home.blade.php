@extends('layouts.website')

@section('content')

    {{-- Hero Section --}}
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content" data-aos="fade-right">
                    <h1 class="hero-title">مزون حریر</h1>
                    <p class="hero-subtitle">طراحی و دوخت لباس‌های خاص برای سلیقه‌های خاص</p>
                    <p class="text-light mb-4">با بیش از یک دهه تجربه در طراحی و دوخت لباس، ما به شما کمک می‌کنیم تا با استایل منحصر به فرد خود، در هر مناسبتی درخشان باشید.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#collections" class="btn btn-elegant">
                            <i class="fas fa-eye me-2"></i>مشاهده کالکشن‌ها
                        </a>
                        <a href="#contact" class="btn btn-outline-light">
                            <i class="fas fa-phone me-2"></i>تماس با ما
                        </a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="text-center">
                        @if($collections->isNotEmpty() && $collections->first()->image)
                            <img src="{{ $collections->first()->image }}" alt="مزون حریر" class="img-fluid rounded-3 shadow-lg" style="max-height: 400px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="height: 400px;">
                                <i class="fas fa-cut fa-5x text-muted"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- About Section --}} 
    <section class="about-section" id="about">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">درباره مزون حریر</h2>
                    <p class="lead mb-4">حریر برند تخصصی طراحی و دوخت لباس با تمرکز بر اصالت، کیفیت و سلیقه ایرانی است.</p>
                    <p>ما با ترکیب هنر سنتی خیاطی و طراحی‌های مدرن، لباس‌هایی خلق می‌کنیم که نه تنها زیبا هستند، بلکه بازتابی از شخصیت و سلیقه شما محسوب می‌شوند.</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-4">
                        <i class="fas fa-award fa-3x text-warning mb-3"></i>
                        <h4>کیفیت برتر</h4>
                        <p>استفاده از بهترین پارچه‌ها و متریال‌های درجه یک</p>
                    </div>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-4">
                        <i class="fas fa-palette fa-3x text-warning mb-3"></i>
                        <h4>طراحی منحصر به فرد</h4>
                        <p>طراحی‌های اختصاصی متناسب با سلیقه و نیاز شما</p>
                    </div>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-4">
                        <i class="fas fa-handshake fa-3x text-warning mb-3"></i>
                        <h4>خدمات حرفه‌ای</h4>
                        <p>مشاوره رایگان و خدمات پس از فروش</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Collections Section --}}
    <section class="py-5" id="collections">
        <div class="container">
            <h2 class="section-title text-center">جدیدترین کالکشن‌ها</h2>
            
            @if($collections->isNotEmpty())
                <div id="collectionsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="carousel-indicators">
                        @foreach($collections as $index => $collection)
                            <button type="button" data-bs-target="#collectionsCarousel" data-bs-slide-to="{{ $index }}" 
                                    class="{{ $index == 0 ? 'active' : '' }}"></button>
                        @endforeach
                    </div>
                    
                    <div class="carousel-inner">
                        @foreach($collections as $index => $collection)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="collection-card" data-aos="zoom-in">
                                            @if($collection->image)
                                                <img src="{{ $collection->image }}" class="card-img-top" alt="{{ $collection->title }}">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                                    <i class="fas fa-image fa-3x text-muted"></i>
                                                </div>
                                            @endif
                                            <div class="card-body p-4">
                                                <h3 class="card-title text-center mb-3">{{ $collection->title }}</h3>
                                                <p class="card-text text-center">{{ $collection->description }}</p>
                                                <div class="text-center">
                                                    <button class="btn btn-elegant">
                                                        <i class="fas fa-info-circle me-2"></i>جزئیات بیشتر
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#collectionsCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">قبلی</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#collectionsCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">بعدی</span>
                    </button>
                </div>
            @else
                <div class="text-center">
                    <div class="bg-light rounded-3 p-5">
                        <i class="fas fa-tshirt fa-4x text-muted mb-3"></i>
                        <h4>کالکشن‌های جدید به زودی...</h4>
                        <p class="text-muted">در حال آماده‌سازی جدیدترین طراحی‌های خود هستیم</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Gallery Section --}}
    <section class="py-5 bg-light" id="gallery">
        <div class="container">
            <h2 class="section-title text-center">گالری آثار حریر</h2>
            
            @if($galleries->isNotEmpty())
                <div class="row g-4">
                    @foreach($galleries->take(12) as $index => $image)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                            <div class="gallery-item">
                                <img src="{{ $image->image }}" alt="{{ $image->title ?? 'گالری حریر' }}" 
                                     data-bs-toggle="modal" data-bs-target="#galleryModal{{ $image->id }}" 
                                     style="cursor: pointer;">
                            </div>
                        </div>

                        {{-- Modal for each image --}}
                        <div class="modal fade" id="galleryModal{{ $image->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
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
                
                @if($galleries->count() > 12)
                    <div class="text-center mt-4">
                        <button class="btn btn-elegant" onclick="loadMoreGallery()">
                            <i class="fas fa-plus me-2"></i>مشاهده بیشتر
                        </button>
                    </div>
                @endif
            @else
                <div class="text-center">
                    <div class="bg-white rounded-3 p-5 shadow-sm">
                        <i class="fas fa-images fa-4x text-muted mb-3"></i>
                        <h4>گالری در حال بروزرسانی...</h4>
                        <p class="text-muted">به زودی تصاویر جدیدی از آثار ما اضافه خواهد شد</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Services Section --}}
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center">خدمات ما</h2>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center p-4 h-100 bg-white rounded-3 shadow-sm">
                        <i class="fas fa-user-tie fa-3x text-warning mb-3"></i>
                        <h5>لباس مردانه</h5>
                        <p>کت و شلوار، پیراهن و سایر لباس‌های مردانه</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center p-4 h-100 bg-white rounded-3 shadow-sm">
                        <i class="fas fa-female fa-3x text-warning mb-3"></i>
                        <h5>لباس زنانه</h5>
                        <p>مانتو، پیراهن و انواع لباس‌های زنانه</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center p-4 h-100 bg-white rounded-3 shadow-sm">
                        <i class="fas fa-ring fa-3x text-warning mb-3"></i>
                        <h5>لباس عروس</h5>
                        <p>طراحی و دوخت لباس عروس و داماد</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-center p-4 h-100 bg-white rounded-3 shadow-sm">
                        <i class="fas fa-edit fa-3x text-warning mb-3"></i>
                        <h5>طراحی سفارشی</h5>
                        <p>طراحی اختصاصی بر اساس سلیقه شما</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    <section class="py-5 bg-light" id="map-section">
        <div class="container">
            <h2 class="section-title text-center">موقعیت ما</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="map-container" data-aos="fade-up">
                        <div id="map" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="contact-section" id="contact">
        <div class="container" data-aos="fade-up">
            <h2 class="section-title text-center">ارتباط با ما</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form">
                        <form action="#" method="POST">
                            @csrf
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
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="09123456789">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>ایمیل (اختیاری)
                                </label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">
                                    <i class="fas fa-tag me-2"></i>موضوع
                                </label>
                                <select class="form-control" id="subject" name="subject" required>
                                    <option value="">انتخاب کنید...</option>
                                    <option value="consultation">مشاوره طراحی</option>
                                    <option value="order">سفارش جدید</option>
                                    <option value="pricing">استعلام قیمت</option>
                                    <option value="other">سایر موارد</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label">
                                    <i class="fas fa-comment me-2"></i>پیام شما
                                </label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="لطفاً پیام خود را بنویسید..." required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-elegant btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>ارسال پیام
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Leaflet Scripts --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize map
        var map = L.map('map').setView([34.075639, 49.7255], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Custom marker icon
        var customIcon = L.divIcon({
            html: '<i class="fas fa-map-marker-alt fa-2x" style="color: #DAA520;"></i>',
            iconSize: [30, 30],
            className: 'custom-div-icon'
        });

        L.marker([34.075639, 49.7255], {icon: customIcon}).addTo(map)
            .bindPopup('<div class="text-center"><strong>مزون حریر</strong><br>کوی صنعتی، منطقه 3، بلوک33، واحد 9<br><small>تلفن: 0912-345-6789</small></div>')
            .openPopup();

        // Load more gallery function
        function loadMoreGallery() {
            // This would typically load more images via AJAX
            alert('قابلیت بارگذاری تصاویر بیشتر به زودی اضافه خواهد شد');
        }
    </script>

@endsection