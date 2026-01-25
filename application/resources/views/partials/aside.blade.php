    <aside class="hidden lg:flex flex-col w-80 sidebar-pattern text-white fixed h-screen z-50 shadow-2xl">
        <div class="p-10 flex flex-col h-full">
            <!-- Brand -->
            <a href="{{ route('home') }}" class="flex items-center gap-4 mb-16">
                <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center font-serif font-bold text-emerald-900 text-xl shadow-lg shadow-amber-500/20">H</div>
                <div>
                    <h1 class="text-2xl font-serif font-bold tracking-tight text-white leading-none"> HERI <span class="text-amber-500">TAGE</span></h1>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-amber-400 mt-1">Gifts & Co.</p>
                </div>
            </a>

            <!-- Navigation -->
            <nav class="flex-1 space-y-10">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-amber-500 mb-6 opacity-90">Collections</h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="#" class="flex items-center gap-4 text-emerald-100/80 hover:text-white transition-all group">
                                <span class="w-2 h-2 rounded-full border border-amber-500/50 group-hover:bg-amber-500 group-hover:border-amber-500 transition-all"></span>
                                <span class="font-medium tracking-wide">Luxury Gift Boxes</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-4 text-emerald-100/80 hover:text-white transition-all group">
                                <span class="w-2 h-2 rounded-full border border-amber-500/50 group-hover:bg-amber-500 group-hover:border-amber-500 transition-all"></span>
                                <span class="font-medium tracking-wide">Artisan Tea Sets</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-4 text-emerald-100/80 hover:text-white transition-all group">
                                <span class="w-2 h-2 rounded-full border border-amber-500/50 group-hover:bg-amber-500 group-hover:border-amber-500 transition-all"></span>
                                <span class="font-medium tracking-wide">Wooden Crates</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-amber-500 mb-6 opacity-90">Occasions</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-emerald-100/80 hover:text-white hover:pl-2 transition-all">Wedding Heritage</a></li>
                        <li><a href="#" class="text-emerald-100/80 hover:text-white hover:pl-2 transition-all">Seasonal Harvest</a></li>
                        <li><a href="#" class="text-emerald-100/80 hover:text-white hover:pl-2 transition-all">Festive Specials</a></li>
                    </ul>
                </div>
            </nav>

            <!-- Footer Badge -->
            <div class="pt-8 border-t border-emerald-800/50">
                <div class="flex items-start gap-4 opacity-80 hover:opacity-100 transition">
                    <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white uppercase tracking-wider">Authentic Assurance</p>
                        <p class="text-[10px] text-emerald-200 mt-1">100% Premium Sourced</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>