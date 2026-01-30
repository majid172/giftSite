<aside class="app-sidebar" id="sidebar">
    <div class="sidebar-header flex items-center justify-between px-6">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo flex items-center gap-2 text-xl font-bold text-indigo-600 no-underline">
            <span>🎁</span> {{ get_setting('site_name', config('app.name')) }}
        </a>
        <button type="button" class="lg:hidden text-slate-500 hover:text-slate-700" onclick="toggleSidebar()">
            <i class="ti ti-x text-xl"></i>
        </button>
    </div>

    <div class="sidebar-content">
        <div class="nav-label">Main Menu</div>
        
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="ti ti-dashboard"></i> Dashboard
        </a>

        <div class="nav-label">Catalog</div>
        
        <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="ti ti-package"></i> Products
        </a>
        
        <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="ti ti-category"></i> Categories
        </a>

        <div class="nav-label">Sales</div>

        <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <i class="ti ti-receipt"></i> Orders
        </a>
        
        <a href="{{ route('admin.shipping.index') }}" class="nav-item {{ request()->routeIs('admin.shipping.*') ? 'active' : '' }}">
           <i class="ti ti-truck-delivery"></i> Shipping
        </a>

        <div class="nav-label">Management</div>

        <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="ti ti-users"></i> Users
        </a>
        
        <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="ti ti-settings"></i> Settings
        </a>
    </div>

    <div style="padding: 24px; border-top: 1px solid var(--border-color);">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline" style="width: 100%; justify-content: flex-start; color: var(--danger); border-color: var(--border-color);">
                <i class="ti ti-logout"></i> Logout
            </button>
        </form>
    </div>
</aside>