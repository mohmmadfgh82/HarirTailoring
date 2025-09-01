<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت حریر</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap RTL --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Vazirmatn', Tahoma, sans-serif;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.collections.index') }}">پنل Harir</a>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    {{-- Bootstrap Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
