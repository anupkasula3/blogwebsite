<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen bg-gray-50">
        @include('user.layouts.sidebar')

        <div class="flex flex-col flex-1">
            @include('user.layouts.navbar')
            <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>
</html>
