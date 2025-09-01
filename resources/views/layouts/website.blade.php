<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مزون حریر</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap RTL --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    {{-- فونت وزیر --}}
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">

    {{-- AOS برای انیمیشن --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    {{-- استایل سفارشی --}}
    <style>
        body {
            font-family: 'Vazirmatn', Tahoma, sans-serif;
            background-color: #f9f9f9;
        }
        h1, h2, h3 {
            font-weight: bold;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">حریر</a>
        </div>
    </nav>

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-secondary text-white text-center py-3 mt-5">
        <p>© 2025 Harir Tailoring - تمامی حقوق محفوظ است.</p>
    </footer>

    {{-- Bootstrap Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- AOS JS --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>
</html>
