<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'GiftPack - Premium Gift Boxes')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: 'Playfair Display', serif;
        }
        [x-cloak] { display: none !important; }

        /* Custom Color Palette & Sidebar Styles */
        :root {
            --color-primary-dark: #064E3B;  /* Emerald 900 */
            --color-primary: #059669;       /* Emerald 600 */
            --color-accent: #D97706;        /* Amber 600 */
            --color-bg: #F5F5F4;            /* Stone 100 */
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

        .slider-wrapper { display: flex; transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1); }
        .slide { min-width: 100%; transition: opacity 0.5s ease; }
        
        /* Hide scrollbar for clean UI */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    @stack('styles')
    @stack('scripts')
</head>
<body class="font-sans text-gray-900 antialiased h-full bg-gray-50">
  <div class="flex min-h-screen bg-[#F5F5F4] overflow-hidden">
    @include('partials.aside')
    <main class="flex-1 lg:ml-80 relative flex flex-col min-h-screen">
        @include('partials.header')
        @yield('content')
        @include('partials.footer')    
    </main>
    
  </div>
  
  @include('partials.cart-drawer')
</body>

</html>
