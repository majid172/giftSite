<aside class="app-sidebar" id="sidebar">
    <!--<div class="sidebar-header flex items-center justify-between px-6">-->
    <!--    <a href="{{ route('admin.dashboard') }}" class="brand-logo flex items-center gap-2 text-xl font-bold text-indigo-600 no-underline">-->
    <!--        <span>🎁</span> {{ get_setting('site_name', config('app.name')) }}-->
    <!--    </a>-->
    <!--    <button type="button" class="lg:hidden text-slate-500 hover:text-slate-700" onclick="toggleSidebar()">-->
    <!--        <i class="ti ti-x text-xl"></i>-->
    <!--    </button>-->
    <!--</div>-->
    
    <div class="sidebar-header flex items-center justify-between px-6">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo flex items-center gap-3 no-underline" style="text-decoration:none;">
            {{-- Icon Badge --}}
            <div style="
                width: 38px; height: 38px;
                background: linear-gradient(135deg, #064e3b 0%, #065f46 60%, #047857 100%);
                border-radius: 10px;
                display: flex; align-items: center; justify-content: center;
                box-shadow: 0 2px 8px rgba(6,78,59,0.35);
                flex-shrink: 0;
            ">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="10" width="18" height="11" rx="1.5" fill="#fbbf24" fill-opacity="0.15" stroke="#fbbf24" stroke-width="1.5"/>
                    <rect x="2" y="7" width="20" height="4" rx="1.5" fill="#fbbf24" fill-opacity="0.25" stroke="#fbbf24" stroke-width="1.5"/>
                    <path d="M12 7V21" stroke="#fbbf24" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M12 7C12 7 9 4 7.5 4C6 4 6 6 7.5 6.5C9 7 12 7 12 7Z" fill="#fbbf24" stroke="#fbbf24" stroke-width="1" stroke-linejoin="round"/>
                    <path d="M12 7C12 7 15 4 16.5 4C18 4 18 6 16.5 6.5C15 7 12 7 12 7Z" fill="#fbbf24" stroke="#fbbf24" stroke-width="1" stroke-linejoin="round"/>
                </svg>
            </div>
            {{-- Brand Text --}}
            <div style="line-height:1.1;">
                <div style="font-size:15px; font-weight:700; color:#1e293b; letter-spacing:-0.3px; font-family:'Segoe UI',system-ui,sans-serif;">
                    {{ get_setting('site_name', config('app.name')) }}
                </div>
                <div style="font-size:10px; font-weight:600; color:#f59e0b; letter-spacing:2px; text-transform:uppercase; margin-top:1px;">
                    Admin Panel
                </div>
            </div>
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