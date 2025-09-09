{{-- Mobile Sidebar Overlay --}}
<div x-show="isSidebarOpen" 
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden"
     @click="isSidebarOpen = false">
</div>

{{-- Desktop Sidebar --}}
<aside class="z-20 hidden w-64 overflow-y-auto bg-white/80 backdrop-blur-lg border-r border-slate-200 md:block flex-shrink-0 shadow-lg">
    <div class="py-4 text-gray-500">
        <a class="flex items-center justify-center mb-6" href="{{ route('dashboard') }}">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('img/logo.png') }}" alt="Logo BKPSDM" class="h-10">
                <div class="flex flex-col">
                    <span class="font-bold text-base text-gray-800">BKPSDM</span>
                    <span class="text-xs text-gray-500">Admin Panel</span>
                </div>
            </div>
        </a>
        
        <nav class="mt-6">
            {{-- Dashboard (Semua Role) --}}
            <div class="px-6 py-2">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 border-l-4 border-blue-500' : 'text-gray-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Dashboard</span>
                </x-nav-link>
            </div>

            {{-- Menu untuk Super Admin, Admin, & Penulis --}}
            @role('super-admin|admin|penulis')
                <div class="px-6 py-2">
                    <x-nav-link :href="route('beritas.index')" :active="request()->routeIs('beritas.*')" class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-orange-50 hover:text-orange-700 {{ request()->routeIs('beritas.*') ? 'bg-orange-100 text-orange-700 border-l-4 border-orange-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span>Manajemen Berita</span>
                    </x-nav-link>
                </div>
            @endrole
            
            {{-- Menu untuk Super Admin & Admin --}}
            @role('super-admin|admin')
                <div class="px-6 py-2">
                    <x-nav-link :href="route('galeri.index')" :active="request()->routeIs('galeri.*')" class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('galeri.*') ? 'bg-green-100 text-green-700 border-l-4 border-green-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Manajemen Galeri</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('unduhan.index')" :active="request()->routeIs('unduhan.*')" class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('unduhan.*') ? 'bg-blue-100 text-blue-700 border-l-4 border-blue-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        <span>Manajemen Unduhan</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('admin.agenda.index')" :active="request()->routeIs('admin.agenda.*')" class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-yellow-50 hover:text-yellow-700 {{ request()->routeIs('admin.agenda.*') ? 'bg-yellow-100 text-yellow-700 border-l-4 border-yellow-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Manajemen Agenda</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('admin.visi-misi.index')" :active="request()->routeIs('admin.visi-misi.*')" class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-pink-50 hover:text-pink-700 {{ request()->routeIs('admin.visi-misi.*') ? 'bg-pink-100 text-pink-700 border-l-4 border-pink-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        <span>Visi & Misi</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('kontak.index')" :active="request()->routeIs('kontak.*')" class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-purple-50 hover:text-purple-700 {{ request()->routeIs('kontak.*') ? 'bg-purple-100 text-purple-700 border-l-4 border-purple-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>Pesan Kontak</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('hero.index')" :active="request()->routeIs('hero.*')" class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-indigo-50 hover:text-indigo-700 {{ request()->routeIs('hero.*') ? 'bg-indigo-100 text-indigo-700 border-l-4 border-indigo-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                        <span>Manajemen Hero</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('pejabat.index')" :active="request()->routeIs('pejabat.*')" class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-cyan-50 hover:text-cyan-700 {{ request()->routeIs('pejabat.*') ? 'bg-cyan-100 text-cyan-700 border-l-4 border-cyan-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span>Struktur Organisasi</span>
                    </x-nav-link>
                </div>
            @endrole
            
            {{-- Menu HANYA untuk Super Admin --}}
            @role('super-admin')
                <div class="mt-6 px-6">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Administrator</div>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-teal-50 hover:text-teal-700 {{ request()->routeIs('users.*') ? 'bg-teal-100 text-teal-700 border-l-4 border-teal-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197M15 21a6 6 0 006-6v-1a6 6 0 00-9-5.197"></path></svg>
                        <span>Manajemen Pengguna</span>
                    </x-nav-link>
                </div>
            @endrole

            {{-- Quick Links --}}
            <div class="mt-6 px-6">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Quick Links</div>
            </div>
            <div class="px-6 py-2">
                <a href="{{ route('public.index') }}" target="_blank" class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-gray-50 hover:text-gray-700 text-gray-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    <span>Lihat Website</span>
                </a>
            </div>
        </nav>
    </div>
</aside>

{{-- Mobile Sidebar --}}
<aside x-show="isSidebarOpen"
       x-transition:enter="transition ease-in-out duration-300"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in-out duration-300"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto bg-white/95 backdrop-blur-lg border-r border-slate-200 md:hidden flex-shrink-0 shadow-xl">
    <div class="py-4 text-gray-500">
        {{-- Mobile Header with Close Button --}}
        <div class="flex items-center justify-between mb-6 px-6">
            <a class="flex items-center space-x-3" href="{{ route('dashboard') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo BKPSDM" class="h-8">
                <div class="flex flex-col">
                    <span class="font-bold text-sm text-gray-800">BKPSDM</span>
                    <span class="text-xs text-gray-500">Admin Panel</span>
                </div>
            </a>
            <button @click="isSidebarOpen = false" 
                    class="p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <nav class="mt-6">
            {{-- Dashboard (Semua Role) --}}
            <div class="px-6 py-2">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                           @click="isSidebarOpen = false"
                           class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 border-l-4 border-blue-500' : 'text-gray-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Dashboard</span>
                </x-nav-link>
            </div>

            {{-- Menu untuk Super Admin, Admin, & Penulis --}}
            @role('super-admin|admin|penulis')
                <div class="px-6 py-2">
                    <x-nav-link :href="route('beritas.index')" :active="request()->routeIs('beritas.*')" 
                               @click="isSidebarOpen = false"
                               class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-orange-50 hover:text-orange-700 {{ request()->routeIs('beritas.*') ? 'bg-orange-100 text-orange-700 border-l-4 border-orange-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span>Manajemen Berita</span>
                    </x-nav-link>
                </div>
            @endrole
            
            {{-- Menu untuk Super Admin & Admin --}}
            @role('super-admin|admin')
                <div class="px-6 py-2">
                    <x-nav-link :href="route('galeri.index')" :active="request()->routeIs('galeri.*')" 
                               @click="isSidebarOpen = false"
                               class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('galeri.*') ? 'bg-green-100 text-green-700 border-l-4 border-green-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Manajemen Galeri</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('unduhan.index')" :active="request()->routeIs('unduhan.*')" 
                               @click="isSidebarOpen = false"
                               class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('unduhan.*') ? 'bg-blue-100 text-blue-700 border-l-4 border-blue-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        <span>Manajemen Unduhan</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('admin.agenda.index')" :active="request()->routeIs('admin.agenda.*')" 
                               @click="isSidebarOpen = false"
                               class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-yellow-50 hover:text-yellow-700 {{ request()->routeIs('admin.agenda.*') ? 'bg-yellow-100 text-yellow-700 border-l-4 border-yellow-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Manajemen Agenda</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('admin.visi-misi.index')" :active="request()->routeIs('admin.visi-misi.*')" 
                               @click="isSidebarOpen = false"
                               class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-pink-50 hover:text-pink-700 {{ request()->routeIs('admin.visi-misi.*') ? 'bg-pink-100 text-pink-700 border-l-4 border-pink-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        <span>Visi & Misi</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('kontak.index')" :active="request()->routeIs('kontak.*')" 
                               @click="isSidebarOpen = false"
                               class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-purple-50 hover:text-purple-700 {{ request()->routeIs('kontak.*') ? 'bg-purple-100 text-purple-700 border-l-4 border-purple-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>Pesan Kontak</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('hero.index')" :active="request()->routeIs('hero.*')" 
                               @click="isSidebarOpen = false"
                               class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-indigo-50 hover:text-indigo-700 {{ request()->routeIs('hero.*') ? 'bg-indigo-100 text-indigo-700 border-l-4 border-indigo-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                        <span>Manajemen Hero</span>
                    </x-nav-link>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('pejabat.index')" :active="request()->routeIs('pejabat.*')" 
                               @click="isSidebarOpen = false"
                               class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-cyan-50 hover:text-cyan-700 {{ request()->routeIs('pejabat.*') ? 'bg-cyan-100 text-cyan-700 border-l-4 border-cyan-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span>Struktur Organisasi</span>
                    </x-nav-link>
                </div>
            @endrole
            
            {{-- Menu HANYA untuk Super Admin --}}
            @role('super-admin')
                <div class="mt-6 px-6">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Administrator</div>
                </div>
                <div class="px-6 py-2">
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" 
                               @click="isSidebarOpen = false"
                               class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-teal-50 hover:text-teal-700 {{ request()->routeIs('users.*') ? 'bg-teal-100 text-teal-700 border-l-4 border-teal-500' : 'text-gray-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197M15 21a6 6 0 006-6v-1a6 6 0 00-9-5.197"></path></svg>
                        <span>Manajemen Pengguna</span>
                    </x-nav-link>
                </div>
            @endrole

            {{-- Quick Links --}}
            <div class="mt-6 px-6">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Quick Links</div>
            </div>
            <div class="px-6 py-2">
                <a href="{{ route('public.index') }}" target="_blank" 
                   @click="isSidebarOpen = false"
                   class="group inline-flex items-center w-full text-sm font-semibold px-4 py-3 rounded-lg transition-all duration-200 hover:bg-gray-50 hover:text-gray-700 text-gray-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    <span>Lihat Website</span>
                </a>
            </div>
        </nav>
    </div>
</aside>
