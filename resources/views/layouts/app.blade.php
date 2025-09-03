<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت مزون حریر</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap RTL --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    {{-- فونت وزیر --}}
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-color) 100%) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--gold-color) !important;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--gold-color) 0%, #B8860B 100%);
            border: none;
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.collections.index') }}">
                <i class="fas fa-cut me-2"></i>پنل مدیریت حریر
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('admin.collections.index') }}">
                    <i class="fas fa-images me-1"></i>کالکشن‌ها
                </a>
                <a class="nav-link" href="{{ route('admin.gallery.index') }}">
                    <i class="fas fa-photo-video me-1"></i>گالری
                </a>
                <a class="nav-link position-relative" href="{{ route('admin.contact-messages.index') }}">
                    <i class="fas fa-envelope me-1"></i>پیام‌ها
                    @php
                        $newMessagesCount = \App\Models\ContactMessage::where('status', 'new')->count();
                    @endphp
                    @if($newMessagesCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ $newMessagesCount }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    {{-- Bootstrap Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>