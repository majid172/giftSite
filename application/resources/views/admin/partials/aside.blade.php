@push('css')
<style>
    .sidebar-premium {
        background: #064e3b; /* Deep Heritage Emerald */
        color: #ecf3f0;
    }
    .text-logo-container {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .logo-letter {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%);
        color: #064e3b;
        border-radius: 50%; /* Circle shape */
        box-shadow: 0 8px 12px -3px rgba(0, 0, 0, 0.4);
        position: relative;
        flex-shrink: 0;
    }
    .brand-text-area {
        display: flex;
        flex-direction: column;
        text-align: left;
    }
    .brand-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        font-weight: 900;
        letter-spacing: 0.1em;
        color: #fff;
        line-height: 1;
        margin-bottom: 0.25rem;
    }
    .brand-subtitle {
        font-size: 0.55rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        color: #fbbf24;
        text-transform: uppercase;
        margin: 0;
    }
    .menu-link-heritage {
        margin: 4px 8px;
        border-radius: 12px !important;
        transition: all 0.2s ease;
        color: rgba(236, 243, 240, 0.7) !important;
    }
    .menu-link-heritage:hover {
        background: rgba(251, 191, 36, 0.1) !important;
        color: #fbbf24 !important;
    }
    .menu-link-heritage.menu-active {
        background: #fbbf24 !important;
        color: #064e3b !important;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);
    }
    .sidebar-section-header {
        color: rgba(236, 243, 240, 0.3);
        padding: 1.5rem 1.5rem 0.5rem;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }
    .submenu-link-heritage {
        color: rgba(236, 243, 240, 0.8) !important;
        transition: all 0.2s ease;
    }
    .submenu-link-heritage:hover {
        color: #fff !important;
    }
    .submenu-link-heritage.active {
        color: #fbbf24 !important;
        font-weight: 700;
    }
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
@endpush

<aside id="layout-sidebar"
    class="overlay overlay-open:translate-x-0 drawer drawer-start sm:w-75 inset-y-0 start-0 hidden h-full [--auto-close:lg] lg:z-50 lg:block lg:translate-x-0 lg:shadow-none sidebar-premium border-e border-white/5"
    aria-label="Sidebar" tabindex="-1">

    <div class="drawer-body h-full p-0 flex flex-col">
        <div class="flex h-full max-h-full flex-col">
            
            <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3 lg:hidden text-white/50"
                aria-label="Close" data-overlay="#layout-sidebar">
                <span class="icon-[tabler--x] size-5"></span>
            </button>

            <!-- Horizontal Circular Logo Area -->
            <div class="px-6 py-10">
                <a href="{{ route('admin.dashboard') }}" class="text-logo-container group no-underline">
                    <div class="logo-letter transform transition-transform group-hover:scale-110 duration-300">H</div>
                    <div class="brand-text-area">
                        <div class="brand-name">HERITAGE</div>
                        <div class="brand-subtitle">Admin Console</div>
                    </div>
                </a>
            </div>

            <div class="h-full overflow-y-auto no-scrollbar">
                <ul class="accordion menu menu-sm p-0 gap-0">
                    
                    @if(auth()->user()?->role === 'admin')
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="menu-link-heritage {{ request()->is('admin/dashboard') ? 'menu-active' : '' }} flex items-center gap-3 px-4 py-3">
                            <span class="icon-[tabler--dashboard] size-5"></span>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-section-header">Catalog</li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="menu-link-heritage {{ request()->is('admin/categories*') ? 'menu-active' : '' }} flex items-center gap-3 px-4 py-3">
                            <span class="icon-[tabler--category] size-5"></span>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="menu-link-heritage {{ request()->is('admin/products*') ? 'menu-active' : '' }} flex items-center gap-3 px-4 py-3">
                            <span class="icon-[tabler--package] size-5"></span>
                            <span>Products</span>
                        </a>
                    </li>
                    @endif

                    <li class="sidebar-section-header">Sales</li>
                    
                    <li class="accordion-item" id="order-menu">
                        <button class="accordion-toggle menu-link-heritage inline-flex w-full items-center p-3 text-start transition"
                            aria-controls="order-collapse" aria-expanded="false">
                            <span class="flex size-6 items-center justify-center me-3">
                                <span class="icon-[tabler--receipt] size-5"></span>
                            </span>
                            <span class="grow font-medium">Orders</span>
                            <span class="icon-[tabler--chevron-right] accordion-item-active:rotate-90 size-4.5 shrink-0 transition-transform duration-300"></span>
                        </button>

                        <div id="order-collapse" class="accordion-content mt-1 hidden w-full overflow-hidden transition-[height] duration-300">
                            <ul class="space-y-1 ps-10 pb-2"> 
                                @if(auth()->user()?->role === 'admin')
                                    <li><a href="{{ route('admin.orders.index') }}" class="py-2 block text-sm submenu-link-heritage {{ request()->is('admin/orders*') ? 'active' : '' }} flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full {{ request()->is('admin/orders*') ? 'bg-amber-400' : 'bg-white/20' }}"></span>
                                        All Orders
                                    </a></li>
                                @else
                                    <li><a href="{{ route('orders.index') }}" class="py-2 block text-sm submenu-link-heritage {{ request()->is('orders*') ? 'active' : '' }} flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full {{ request()->is('orders*') ? 'bg-amber-400' : 'bg-white/20' }}"></span>
                                        My Orders
                                    </a></li>
                                @endif
                            </ul>
                        </div>
                    </li>

                    @if(auth()->user()?->role === 'admin')
                    <li>
                        <a href="#" class="menu-link-heritage flex items-center gap-3 px-4 py-3">
                            <span class="icon-[tabler--currency-dollar] size-5"></span>
                            <span>Payments</span>
                        </a>
                    </li>

                    <li class="sidebar-section-header">People</li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="menu-link-heritage {{ request()->is('admin/users*') ? 'menu-active' : '' }} flex items-center gap-3 px-4 py-3">
                            <span class="icon-[tabler--users] size-5"></span>
                            <span>Users</span>
                        </a>
                    </li>

                    <li class="sidebar-section-header">System</li>
                    <li>
                        <a href="{{ route('admin.settings.index') }}" class="menu-link-heritage {{ request()->is('admin/settings*') ? 'menu-active' : '' }} flex items-center gap-3 px-4 py-3">
                            <span class="icon-[tabler--settings] size-5"></span>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.shipping.index') }}" class="menu-link-heritage flex items-center gap-3 px-4 py-3">
                            <span class="icon-[tabler--file-description] size-5"></span>
                            <span>Shipping</span>
                        </a>
                    </li>   
                    @endif

                    <li class="sidebar-section-header">Account</li>
                    <li>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                           class="menu-link-heritage flex items-center gap-3 px-4 py-3 text-rose-400 hover:text-rose-100!">
                            <span class="icon-[tabler--logout] size-5 text-rose-500"></span>
                            <span class="ms-0">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</aside>