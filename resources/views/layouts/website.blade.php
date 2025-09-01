<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مزون حریر - طراحی و دوخت لباس‌های خاص</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap RTL --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    {{-- فونت وزیر --}}
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- AOS برای انیمیشن --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    {{-- استایل سفارشی --}}
    <style>
        :root {
            --primary-color: #8B4513;
            --secondary-color: #D2691E;
            --accent-color: #F4A460;
            --dark-color: #2C1810;
            --light-color: #FFF8DC;
            --gold-color: #DAA520;
        }

        body {
            font-family: 'Vazirmatn', Tahoma, sans-serif;
            background: linear-gradient(135deg, #FFF8DC 0%, #F5F5DC 100%);
            line-height: 1.6;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--gold-color) !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .navbar {
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-color) 100%) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 70vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.4);
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--light-color);
            margin-bottom: 2rem;
            font-weight: 300;
        }

        .btn-elegant {
            background: linear-gradient(135deg, var(--gold-color) 0%, #B8860B 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(218, 165, 32, 0.3);
        }

        .btn-elegant:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(218, 165, 32, 0.4);
            color: white;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 3rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(135deg, var(--gold-color) 0%, var(--secondary-color) 100%);
            border-radius: 2px;
        }

        .collection-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            background: white;
        }

        .collection-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .collection-card img {
            height: 300px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .collection-card:hover img {
            transform: scale(1.05);
        }

        .gallery-item {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .about-section {
            background: linear-gradient(135deg, white 0%, var(--light-color) 100%);
            padding: 5rem 0;
        }

        .contact-section {
            background: linear-gradient(135deg, var(--light-color) 0%, white 100%);
            padding: 5rem 0;
        }

        .contact-form {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--gold-color);
            box-shadow: 0 0 0 0.2rem rgba(218, 165, 32, 0.25);
        }

        .map-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        footer {
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-color) 100%);
            color: white;
            padding: 3rem 0 2rem;
        }

        .footer-content {
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h5 {
            color: var(--gold-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer-section a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--gold-color);
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background: var(--gold-color);
            transform: translateY(-3px);
        }

        .carousel-item img {
            height: 500px;
            object-fit: cover;
            border-radius: 15px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: var(--gold-color);
            border-radius: 50%;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-cut me-2"></i>حریر
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">خانه</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">درباره ما</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#collections">کالکشن‌ها</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">گالری</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">تماس</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main style="padding-top: 80px;">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <div class="col-md-4 footer-section">
                        <h5><i class="fas fa-cut me-2"></i>مزون حریر</h5>
                        <p>طراحی و دوخت لباس‌های خاص برای سلیقه‌های خاص با بیش از 10 سال تجربه در صنعت مد و پوشاک.</p>
                        <div class="social-icons mt-3">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-telegram"></i></a>
                            <a href="#"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 footer-section">
                        <h5><i class="fas fa-phone me-2"></i>تماس با ما</h5>
                        <p><i class="fas fa-map-marker-alt me-2"></i>کوی صنعتی، منطقه 3، بلوک33، واحد 9</p>
                        <p><i class="fas fa-phone me-2"></i>0912-345-6789</p>
                        <p><i class="fas fa-envelope me-2"></i>info@harir.com</p>
                    </div>
                    <div class="col-md-4 footer-section">
                        <h5><i class="fas fa-clock me-2"></i>ساعات کاری</h5>
                        <p>شنبه تا چهارشنبه: 9:00 - 18:00</p>
                        <p>پنج‌شنبه: 9:00 - 14:00</p>
                        <p>جمعه: تعطیل</p>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <p class="mb-0">© 2025 مزون حریر - تمامی حقوق محفوظ است</p>
            </div>
        </div>
    </footer>

    {{-- Bootstrap Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- AOS JS --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'linear-gradient(135deg, rgba(44, 24, 16, 0.95) 0%, rgba(139, 69, 19, 0.95) 100%)';
                navbar.style.backdropFilter = 'blur(10px)';
            } else {
                navbar.style.background = 'linear-gradient(135deg, var(--dark-color) 0%, var(--primary-color) 100%)';
                navbar.style.backdropFilter = 'none';
            }
        });
    </script>

</body>
</html>