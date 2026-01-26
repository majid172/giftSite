<!doctype html>

<html lang="en" data-assets-path="../assets/" data-layout-path="dashboard-free/" dir="ltr"
    class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title> Dashboards || Gift Pack</title>

    <meta name="description"
        content="Gift Pack is the best dashboard for responsive web apps. Streamline your app development process with ease." />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/logo_2.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Core CSS -->
    <!-- endbuild -->

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/dist/libs/apexcharts/dist/apexcharts.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/dist/libs/flyonui/src/vendor/apexcharts.css') }}" />

    <!-- build:css -->
    <link rel="stylesheet" href="{{ asset('/assets/dist/css/output.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/flasher/flasher.min.css') }}">

    <!-- Flasher JS -->
    <script src="{{ asset('assets/vendor/flasher/flasher.min.js') }}"></script>


    <!-- Theme JS -->
    {{-- <script type="text/javascript">
        (function() {
            try {
                const root = document.documentElement;
                const layoutPath = root.getAttribute('data-layout-path')?.replace('/', '') || 'dashboard-default';
                const localStorageKey = `${layoutPath}-theme`;

                // Theme configuration loaded from page-config.json at build time
                window.THEME_CONFIG = {
                    'dashboard-free': {
                        default: 'light',
                        light: 'light',
                        dark: 'dark',
                        system: {
                            light: 'light',
                            dark: 'dark'
                        }
                    }
                };

                // Get current system theme preference
                const getSystemPreference = () => window.matchMedia('(prefers-color-scheme: dark)').matches;

                // Resolve theme based on user selection and layout configuration
                const resolveTheme = (selectedTheme, layoutPath) => {
                    const layoutConfig = window.THEME_CONFIG[layoutPath];
                    if (!layoutConfig) return selectedTheme === 'system' ? (getSystemPreference() ? 'dark' :
                        'light') : selectedTheme;

                    if (selectedTheme === 'system') {
                        const systemConfig = layoutConfig.system;
                        const prefersDark = getSystemPreference();
                        return prefersDark ? systemConfig.dark : systemConfig.light;
                    }

                    return layoutConfig[selectedTheme] || selectedTheme || layoutConfig.default || 'light';
                };

                const savedTheme = localStorage.getItem(localStorageKey) || 'system';
                const resolvedTheme = resolveTheme(savedTheme, layoutPath);

                root.setAttribute('data-theme', resolvedTheme);
            } catch (e) {
                console.warn('Early theme script error:', e);
            }
        })();
    </script> --}}
</head>

<body>
    <!-- Layout wrapper -->
    <div class="bg-base-200 flex min-h-screen flex-col">
        <!-- Layout Navbar -->

        <!-- ---------- HEADER ---------- -->
        @include('admin.partials.header')


        @include('admin.partials.aside')
        <!-- / Menu -->

        <!-- Layout Container -->
        <div class="lg:ps-75 flex grow flex-col">
            <!-- Content -->
            <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">
                <!-- Stats -->
                @yield('content')
            </main>
            <!-- / Content -->

            <!-- Footer: Start -->
            @include('admin.partials.footer')
            <!-- Footer: End -->
        </div>
        <!-- / Layout Container -->
    </div>
    <!-- / Layout Wrapper -->
    @stack('css')
    @stack('js')
    @stack('plugins')
    <!-- Vendors JS -->
    <script src="{{ asset('/assets/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/assets/dist/libs/flyonui/dist/helper-apexcharts.js') }}"></script>

    <!-- FlyonUI JS -->
    <script src="{{ asset('/assets/dist/libs/flyonui/flyonui.js') }}"></script>

    <!-- Theme Utils JS -->
    {{-- <script src="{{ asset('/assets/dist/js/theme-utils.js') }}"></script> --}}

    <!-- Main JS -->
    <script src="{{ asset('/assets/dist/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('/assets/dist/js/common-dashboard-free.js') }}"></script>


    @flasher_render
</body>

</html>
