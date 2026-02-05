<footer style="background-color: #0e1110ff; background-image: linear-gradient(rgba(8, 10, 10, 0.9), rgba(8, 10, 10, 0.95)), url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 30c0-10 10-20 20-20s10 10 10 20-10 20-20 20-20-10-20-20z' fill='%2310B981' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E&quot;);" class="text-white pt-16 pb-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <!-- Brand -->
            <div class="col-span-1 md:col-span-1">
                <a href="{{ route('home') }}" class="text-2xl font-serif font-bold text-white tracking-wide block mb-6">
                    {{ get_setting('site_name', config('app.name')) }}
                </a>
                <p class="text-emerald-100/80 text-sm leading-relaxed mb-6">
                    Curating moments of joy with our premium gift collections. Wrapped with love, delivered with care.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-emerald-200 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ecececff" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
                    </a>
                    <a href="#" class="text-emerald-200 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ecececff" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
                    </a>
                </div>
            </div>

            <!-- Shop -->
            <div>
                <h3 class="text-amber-500 font-serif font-semibold mb-4 tracking-wide">SHOP</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('products.index') }}" class="text-emerald-100/80 hover:text-white transition-colors text-sm">All Products</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-emerald-100/80 hover:text-white transition-colors text-sm">New Arrivals</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-emerald-100/80 hover:text-white transition-colors text-sm">Best Sellers</a></li>
                    <li><a href="{{ route('contact') }}" class="text-emerald-100/80 hover:text-white transition-colors text-sm">Corporate Gifts</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="text-amber-500 font-serif font-semibold mb-4 tracking-wide">SUPPORT</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('about') }}" class="text-emerald-100/80 hover:text-white transition-colors text-sm">FAQ</a></li>
                    <li><a href="{{ route('about') }}" class="text-emerald-100/80 hover:text-white transition-colors text-sm">Shipping & Returns</a></li>
                    <li><a href="{{ route('contact') }}" class="text-emerald-100/80 hover:text-white transition-colors text-sm">Contact Us</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-emerald-100/80 hover:text-white transition-colors text-sm">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-amber-500 font-serif font-semibold mb-4 tracking-wide">NEWSLETTER</h3>
                <p class="text-emerald-100/80 text-sm mb-4">Subscribe to receive updates, access to exclusive deals, and more.</p>
                <form class="flex flex-col space-y-2">
                    <input type="email" placeholder="Enter your email" class="bg-emerald-900/50 border border-emerald-700 text-white px-4 py-2 rounded focus:outline-none focus:ring-1 focus:ring-amber-500 text-sm placeholder-emerald-500/50">
                    <button type="submit" class="bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-600 transition-colors uppercase text-xs font-bold tracking-wider shadow-lg shadow-amber-500/20">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="border-t border-emerald-800/50 pt-8 text-center text-emerald-100/60 text-sm">
            &copy; {{ date('Y') }} {{ get_setting('site_name', config('app.name')) }}. All rights reserved.
        </div>
    </div>
</footer>
