<div class="hidden lg:block bg-white text-stone-600 text-xs py-2.5 font-medium border-b border-stone-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-2">
        <div class="flex items-center gap-6">
            <a href="tel:{{ get_setting('contact_phone', '01312617206') }}" class="flex items-center gap-2 hover:text-emerald-700 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                <span>{{ get_setting('contact_phone', '01312617206') }}</span>
            </a>
            <a href="mailto:{{ get_setting('contact_email', 'mytea@gmail.com') }}" class="hidden sm:flex items-center gap-2 hover:text-emerald-700 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <span>{{ get_setting('contact_email', 'mytea@gmail.com') }}</span>
            </a>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('contact') }}" class="hover:text-emerald-700 transition-colors">Contact Support</a>
            <span class="text-stone-300">|</span>
            <!-- <span class="text-emerald-600 font-semibold">Free Shipping on Orders Over $100</span> -->
        </div>
    </div>
</div>
