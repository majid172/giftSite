<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', get_setting('seo_meta_title', get_setting('site_name', config('app.name'))))</title>
    <meta name="description" content="@yield('meta_description', get_setting('seo_meta_description'))">
    <meta name="keywords" content="@yield('meta_keywords', get_setting('seo_meta_keywords'))">

    {{-- Open Graph / Social --}}
    <meta property="og:title"
        content="@yield('title', get_setting('seo_meta_title', get_setting('site_name', config('app.name'))))">
    <meta property="og:description" content="@yield('meta_description', get_setting('seo_meta_description'))">
    @if(get_setting('seo_social_image'))
        <meta property="og:image" content="{{ asset(get_setting('seo_social_image')) }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    {{-- Analytics --}}
    @if(get_setting('seo_analytics_id'))
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ get_setting('seo_analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', '{{ get_setting('seo_analytics_id') }}');
        </script>
    @endif

    @if(env('META_PIXEL_ID') || get_setting('seo_pixel_id'))
        <!-- Facebook Pixel -->
        <script>
            !function (f, b, e, v, n, t, s) {
                if (f.fbq) return; n = f.fbq = function () {
                    n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
                n.queue = []; t = b.createElement(e); t.async = !0;
                t.src = v; s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ env('META_PIXEL_ID') ?: get_setting('seo_pixel_id') }}');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id={{ env('META_PIXEL_ID') ?: get_setting('seo_pixel_id') }}&ev=PageView&noscript=1" /></noscript>
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Custom Color Palette & Sidebar Styles */
        :root {
            --color-primary-dark: #064E3B;
            /* Emerald 900 */
            --color-primary: #059669;
            /* Emerald 600 */
            --color-accent: #D97706;
            /* Amber 600 */
            --color-bg: #F5F5F4;
            /* Stone 100 */
        }

        .sidebar-gradient {
            background: linear-gradient(180deg, #064E3B 0%, #065F46 100%);
        }

        .sidebar-pattern {
            background-color: #064E3B;
            background-image:
                linear-gradient(rgba(6, 78, 59, 0.9), rgba(6, 78, 59, 0.95)),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 30c0-10 10-20 20-20s10 10 10 20-10 20-20 20-20-10-20-20z' fill='%2310B981' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .slide {
            min-width: 100%;
            transition: opacity 0.5s ease;
        }

        /* Hide scrollbar for clean UI */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    @stack('styles')
    @stack('scripts')
</head>

<body class="font-sans text-gray-900 antialiased h-full bg-stone-50">
    <div class="flex flex-col min-h-screen">

        <!-- 1. Topbar -->
        @include('partials.topbar')

        <!-- 2. Header / Navbar -->
        @include('partials.header')

        <!-- 3. Banner / Hero (Optional per page) -->
        @yield('hero')

        <!-- 4. Content Area -->
        <div class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Main Content -->
            <main class="w-full">
                @yield('content')
            </main>
        </div>

        @include('partials.footer')
    </div>

    @include('partials.cart-drawer')
</body>

</html>