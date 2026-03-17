<!-- Admin Header Content - Uses full width of app-header container -->
<div class="flex items-center justify-end w-full gap-4">
    
    <!-- Mobile Menu Toggle (Left) -->
    <button type="button"
        class="lg:hidden p-2 text-slate-500 hover:bg-slate-100 rounded-lg mr-auto"
        onclick="toggleSidebar()">
        <i class="ti ti-menu-2 text-xl"></i>
    </button>

    <!-- View Shop -->
    <a href="{{ route('home') }}" target="_blank"
        class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-slate-600 border border-slate-200 rounded-lg hover:bg-slate-50">
        <i class="ti ti-external-link text-lg"></i>
        <span class="hidden sm:inline">View Shop</span>
    </a>

    <!-- User Profile -->
    <div class="relative group">
        <div class="flex items-center gap-3 pl-4 border-l border-slate-200 cursor-pointer">
            <div
                class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center text-white font-semibold text-sm">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>

            <div class="hidden md:flex flex-col text-right">
                <span class="text-sm font-semibold text-slate-700">
                    {{ Auth::user()->name }}
                </span>
                <span class="text-xs text-slate-500">Admin</span>
            </div>

            <i class="ti ti-chevron-down text-slate-400 hidden sm:block"></i>
        </div>

        <!-- Dropdown -->
        <div
            class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
            <a href="{{ route('admin.settings.index') }}"
                class="block px-4 py-2 text-sm hover:bg-slate-50">
                <i class="ti ti-settings mr-2"></i> Settings
            </a>
            
            <a href="{{ route('password') }}"
                class="block px-4 py-2 text-sm hover:bg-slate-50">
                <i class="ti ti-lock mr-2"></i> Change Password
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                    <i class="ti ti-logout mr-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>
