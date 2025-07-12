<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', \App\Models\Setting::get('site_name', 'MyBlogSite') . ' - ' . \App\Models\Setting::get('site_description', 'Your Ultimate Blog Destination'))</title>
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('default_meta_description', 'Discover amazing stories, insights, and knowledge on our blog platform.'))">
    <meta name="keywords" content="@yield('meta_keywords', \App\Models\Setting::get('default_meta_keywords', 'blog, articles, stories, insights'))">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', \App\Models\Setting::get('site_name', 'MyBlogSite'))">
    <meta property="og:description" content="@yield('og_description', \App\Models\Setting::get('default_meta_description', 'Your Ultimate Blog Destination'))">
    <meta property="og:image" content="@yield('og_image', \App\Models\Setting::get('site_logo') ? Storage::url(\App\Models\Setting::get('site_logo')) : asset('images/default-og.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ \App\Models\Setting::get('site_name', 'MyBlogSite') }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', \App\Models\Setting::get('site_name', 'MyBlogSite'))">
    <meta name="twitter:description" content="@yield('twitter_description', \App\Models\Setting::get('default_meta_description', 'Your Ultimate Blog Destination'))">
    <meta name="twitter:image" content="@yield('twitter_image', \App\Models\Setting::get('site_logo') ? Storage::url(\App\Models\Setting::get('site_logo')) : asset('images/default-twitter.jpg'))">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="{{ \App\Models\Setting::get('site_favicon') ? Storage::url(\App\Models\Setting::get('site_favicon')) : asset('favicon.ico') }}">

    <!-- Canonical URL -->
    @if (isset($canonical_url))
        <link rel="canonical" href="{{ $canonical_url }}">
    @else
        <link rel="canonical" href="{{ url()->current() }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Analytics -->
    @if (\App\Models\Setting::get('google_analytics_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ \App\Models\Setting::get('google_analytics_id') }}">
        </script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ \App\Models\Setting::get('google_analytics_id') }}');
        </script>
    @endif

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .ad-banner {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .ad-sidebar {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .ad-content {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #333;
        }

        .ad-footer {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            color: #333;
        }

        /* Schema Markup Styles */
        .schema-article {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.5rem;
        }

        /* Reading Progress Bar */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: 9999;
            transition: width 0.3s ease;
        }

        /* SEO Optimized Images */
        .seo-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 0.5rem;
        }

        /* Structured Data */
        .structured-data {
            display: none;
        }
    </style>

    @stack('styles')

    <!-- Schema Markup -->
    @if (\App\Models\Setting::get('enable_schema_markup', true))
        <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "{{ \App\Models\Setting::get('site_name', 'MyBlogSite') }}",
        "description": "{{ \App\Models\Setting::get('site_description', 'Your Ultimate Blog Destination') }}",
        "url": "{{ url('/') }}",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "{{ url('/search?q={search_term_string}') }}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
    @endif
</head>

<body class="bg-gray-50 text-gray-900">
    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="readingProgress"></div>

    <div class="z-[9999] sticky top-0 shadow">

        <!-- Header -->
        @include('frontend.layout.header')
    </div>

    <!-- Main Content -->
    <main class="min-h-screen z-[10]">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('frontend.layout.footer')

    <!-- Scripts -->
    <!-- Alpine.js is already loaded in header -->

    @stack('scripts')

    <!-- Advertisement Tracking Script -->
    <script>
        function trackAdClick(adId, position) {
            fetch('/track-ad-click', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    ad_id: adId,
                    position: position
                })
            });
        }

        function trackAdImpression(adId, position) {
            fetch('/track-ad-impression', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    ad_id: adId,
                    position: position
                })
            });
        }

        // Reading Progress Bar
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById('readingProgress').style.width = scrolled + '%';
        });

        // Track ad impressions on page load
        document.addEventListener('DOMContentLoaded', () => {
            const ads = document.querySelectorAll('[data-ad-id]');
            ads.forEach(ad => {
                const adId = ad.getAttribute('data-ad-id');
                const position = ad.getAttribute('data-ad-position');
                trackAdImpression(adId, position);
            });
        });

        // Social Sharing
        function shareOnSocial(platform, url, title, description) {
            const shareUrls = {
                facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`,
                twitter: `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`,
                linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`,
                whatsapp: `https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`
            };

            if (shareUrls[platform]) {
                window.open(shareUrls[platform], '_blank', 'width=600,height=400');
            }
        }
    </script>

    <!-- Structured Data for Current Page -->
    @yield('structured-data')
</body>

</html>
