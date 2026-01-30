<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Dashboard || Gift Pack</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flasher JS -->
    <script src="{{ asset('assets/vendor/flasher/flasher.min.js') }}"></script>

    <!-- Custom CSS -->
    @include('admin.partials.custom-css')
    @stack('css')
</head>

<body>
    <div class="app-wrapper">
        <!-- Sidebar -->
        @include('admin.partials.aside')
        
        <!-- Mobile Sidebar Backdrop -->
        <div class="sidebar-backdrop fixed inset-0 z-40 bg-slate-900 bg-opacity-50 lg:hidden hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <main class="app-main">
            <!-- Header -->
            <header class="app-header">
                @include('admin.partials.header')
            </header>

            <!-- Body -->
            <div class="app-content">
                @yield('content')
            </div>

            <!-- Footer -->
            <!-- Included in content usually or separate footer if needed -->
            <!-- @include('admin.partials.footer') -->
        </main>
    </div>

    @stack('js')
    
    <script>
        // Simple Sidebar Toggle Logic if needed
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-open');
        }
    </script>
</body>
</html>
