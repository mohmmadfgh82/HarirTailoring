@extends('layouts.website')

@section('content')

    {{-- Hero --}}
    <section class="bg-dark text-white text-center py-5">
        <div class="container" data-aos="fade-down">
            <h1 class="display-4">مزون حریر</h1>
            <p class="lead">طراحی و دوخت لباس‌های خاص برای سلیقه‌های خاص</p>
            <a href="#collections" class="btn btn-outline-light mt-3">مشاهده کالکشن‌ها</a>
        </div>
    </section>

    {{-- About --}} 
    <section class="py-5 bg-light text-center">
        <div class="container" data-aos="fade-up">
            <h2>درباره حریر</h2>
            <p>حریر برند تخصصی طراحی لباس با تمرکز بر اصالت، کیفیت و سلیقه ایرانی است.</p>
        </div>
    </section>

    {{-- Collections --}}
    <section class="py-5" id="collections">
        <div class="container">
            <h2 class="text-center mb-4">جدیدترین کالکشن‌ها</h2>
            <div id="collectionsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($collections as $index => $collection)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card shadow text-center">
                                        <img src="{{ $collection->image }}" class="card-img-top" alt="{{ $collection->title }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $collection->title }}</h5>
                                            <p class="card-text">{{ $collection->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#collectionsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">قبلی</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#collectionsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">بعدی</span>
                </button>
            </div>
        </div>
    </section>

    {{-- Gallery --}}
    <section class="py-5 bg-light" id="gallery">
        <div class="container">
            <h2 class="text-center mb-4">گالری حریر</h2>
            <div class="row g-3">
                @forelse($galleries as $image)
                    <div class="col-6 col-md-4" data-aos="zoom-in">
                        <div class="card shadow-sm">
                            <img src="{{ $image->image }}" class="img-fluid rounded" alt="{{ $image->title }}">
                        </div>
                    </div>
                @empty
                    <p class="text-center">هیچ تصویری در گالری ثبت نشده است.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Map --}}
    <section class="py-5" id="map-section">
        <div class="container">
            <h2 class="text-center mb-4">موقعیت ما</h2>
            <div id="map" style="height: 400px; border-radius: 16px;"></div>
        </div>
    </section>

    {{-- Contact --}}
    <section class="py-5 bg-light" id="contact">
        <div class="container" data-aos="fade-up">
            <h2 class="text-center mb-4">ارتباط با ما</h2>
            <form action="#" method="POST" class="w-75 mx-auto">
                <div class="mb-3">
                    <label for="name" class="form-label">نام</label>
                    <input type="text" class="form-control" id="name" placeholder="نام شما">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">پیام</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="متن پیام..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">ارسال</button>
            </form>
        </div>
    </section>

    {{-- Leaflet Scripts --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([34.075639, 49.7255], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker([34.075639, 49.7255]).addTo(map)
            .bindPopup('مزون حریر<br>کوی صنعتی، منطقه 3، بلوک33، واحد 9')
            .openPopup();
    </script>

@endsection
