<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta name="description" content="@yield('meta_description', 'BKPSDM Kabupaten Katingan - Berita, Galeri, dan Informasi Terkini')"> --}}

    @yield('meta')

    <title>@yield('title', 'BKPSDM Kabupaten Katingan')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper JS for Slider -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Additional styles from child views -->
    @stack('styles')

    <style>
        .swiper-button-next,
        .swiper-button-prev {
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 9999px;
            width: 44px;
            height: 44px;
            transition: background-color 0.3s ease;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Animation delays for decorative elements */
        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px;
        }

        .swiper-pagination-bullet-active {
            background-color: #ffffff;
            transform: scale(1.2);
        }

        /* Enhanced navbar hover effects */
        .navbar-item {
            position: relative;
            overflow: hidden;
        }

        .navbar-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transition: left 0.5s;
        }

        .navbar-item:hover::before {
            left: 100%;
        }

        /* Active navigation states */
        .nav-active {
            color: #2563eb !important;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 197, 253, 0.1));
            border-radius: 8px;
        }

        .nav-active .nav-underline {
            transform: scaleX(1);
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
        }

        .nav-underline {
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: #3b82f6;
            transform: scaleX(0);
            transition: transform 0.3s ease;
            border-radius: 2px;
        }

        .mobile-nav-active {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 197, 253, 0.1)) !important;
            border-left: 4px solid #3b82f6 !important;
            color: #2563eb !important;
        }

        .mobile-nav-active svg {
            color: #3b82f6 !important;
        }

        .dropdown-active {
            background: rgba(59, 130, 246, 0.1) !important;
            color: #2563eb !important;
        }

        .dropdown-active svg {
            color: #3b82f6 !important;
        }

        /* Smooth shadow animation for dropdown */
        .dropdown-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.3s ease;
        }

        .dropdown-shadow:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Logo hover effect */
        .logo-container {
            transition: transform 0.3s ease;
        }

        .logo-container:hover {
            transform: scale(1.05);
        }

        /* Ensure header doesn't overlap content */
        header {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Mobile layout adjustments */
        @media (max-width: 767px) {
            .mobile-center-logo {
                justify-content: flex-start;
                /* Logo di kiri pada mobile */
                width: auto;
            }

            .logo-container {
                margin: 0;
                /* Reset margin */
            }

            /* Hide desktop navigation on mobile */
            nav {
                display: none !important;
            }

            /* Ensure mobile layout uses flex properly */
            .mobile-header-flex {
                width: 100%;
            }
        }

        /* Desktop layout adjustments */
        @media (min-width: 768px) {
            .mobile-center-logo {
                justify-content: flex-start;
                width: auto;
                padding: 0;
            }

            /* Ensure navigation aligns with content */
            nav {
                margin-right: 0;
            }
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-50 text-gray-800">
    <div x-data="{ open: false }" class="min-h-screen flex flex-col">
        <!-- Header & Navigation -->
        <header class="bg-white/90 backdrop-blur-lg shadow-sm sticky top-0 z-50 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-3 md:py-4 mobile-header-flex">
                    <!-- Logo - Left (Both Mobile & Desktop) -->
                    <div class="flex justify-start mobile-center-logo">
                        <a href="{{ route('public.index') }}"
                            class="flex items-center space-x-2 md:space-x-3 logo-container">
                            <img class="h-8 md:h-10 w-auto" src="{{ asset('img/logo.png') }}" alt="BKPSDM Katingan">
                            <div class="flex flex-col sm:flex"> <!-- Show logo text on mobile too -->
                                <span class="font-bold text-sm md:text-base text-gray-800 leading-tight">BKPSDM</span>
                                <span class="text-xs text-gray-500 leading-tight">Kabupaten Katingan</span>
                            </div>
                        </a>
                    </div>

                    <!-- Mobile Menu Button - Separate from logo -->
                    <div class="md:hidden">
                        <button @click="open = !open"
                            class="relative p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                            <svg class="h-6 w-6 transform transition-transform duration-200"
                                :class="open ? 'rotate-90' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x-show="!open"
                                    d="M4 6h16M4 12h16m-7 6h7" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x-show="open"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Desktop Navigation - Right Aligned -->
                    <nav class="hidden md:flex items-center">
                        <div class="flex items-center space-x-3 lg:space-x-5">
                            <a href="{{ route('public.index') }}"
                                class="navbar-item relative font-medium transition-all duration-300 group px-3 py-2 rounded-lg {{ request()->routeIs('public.index') ? 'nav-active text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Beranda
                                <span
                                    class="nav-underline {{ request()->routeIs('public.index') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                            </a>

                            <!-- Dropdown Profil -->
                            <div x-data="{ openProfil: false }" class="relative">
                                <button @click="openProfil = !openProfil" @keydown.escape="openProfil=false"
                                    class="navbar-item relative font-medium transition-all duration-300 inline-flex items-center gap-1 group px-3 py-2 rounded-lg {{ request()->routeIs('public.pejabat') || request()->routeIs('public.visi-misi') ? 'nav-active text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                    Profil
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 transform group-hover:rotate-180 transition-transform duration-300"
                                        :class="openProfil ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.168l3.71-2.938a.75.75 0 1 1 .94 1.172l-4.2 3.325a.75.75 0 0 1-.94 0l-4.2-3.325a.75.75 0 0 1-.08-1.172Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span
                                        class="nav-underline {{ request()->routeIs('public.pejabat') || request()->routeIs('public.visi-misi') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                                </button>
                                <div x-show="openProfil" @click.away="openProfil=false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                    class="dropdown-shadow absolute right-0 mt-3 w-56 rounded-xl bg-white shadow-xl ring-1 ring-black/5 overflow-hidden z-50 border border-gray-100">
                                    <div class="py-2">
                                        <a href="{{ route('public.pejabat') }}"
                                            class="group flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('public.pejabat') ? 'dropdown-active' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('public.pejabat') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Struktur Organisasi
                                        </a>
                                        <a href="{{ route('public.visi-misi') }}"
                                            class="group flex items-center px-4 py-3 text-sm transition-all duration-200 {{ request()->routeIs('public.visi-misi') ? 'dropdown-active' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('public.visi-misi') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Visi & Misi
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('public.berita') }}"
                                class="navbar-item relative font-medium transition-all duration-300 group px-3 py-2 rounded-lg {{ request()->routeIs('public.berita*') ? 'nav-active text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Berita
                                <span
                                    class="nav-underline {{ request()->routeIs('public.berita*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                            </a>

                            <a href="{{ route('public.galeri') }}"
                                class="navbar-item relative font-medium transition-all duration-300 group px-3 py-2 rounded-lg {{ request()->routeIs('public.galeri*') ? 'nav-active text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Galeri
                                <span
                                    class="nav-underline {{ request()->routeIs('public.galeri*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                            </a>

                            <a href="{{ route('public.agenda') }}"
                                class="navbar-item relative font-medium transition-all duration-300 group px-3 py-2 rounded-lg {{ request()->routeIs('public.agenda*') ? 'nav-active text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Agenda
                                <span
                                    class="nav-underline {{ request()->routeIs('public.agenda*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                            </a>

                            <a href="{{ route('public.unduhan') }}"
                                class="navbar-item relative font-medium transition-all duration-300 group px-3 py-2 rounded-lg {{ request()->routeIs('public.unduhan*') ? 'nav-active text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Unduhan
                                <span
                                    class="nav-underline {{ request()->routeIs('public.unduhan*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                            </a>

                            <a href="{{ route('public.kontak') }}"
                                class="navbar-item relative font-medium transition-all duration-300 group px-3 py-2 rounded-lg {{ request()->routeIs('public.kontak*') ? 'nav-active text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                                Kontak
                                <span
                                    class="nav-underline {{ request()->routeIs('public.kontak*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Mobile Navigation -->
            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="md:hidden bg-white/95 backdrop-blur-lg border-t border-slate-200 shadow-lg relative z-40">
                <a href="{{ route('public.index') }}"
                    class="group flex items-center px-4 py-4 border-l-4 transition-all duration-200 {{ request()->routeIs('public.index') ? 'mobile-nav-active text-blue-700 bg-blue-50 border-blue-600' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700 border-transparent hover:border-blue-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('public.index') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Beranda
                </a>
                <div class="border-t border-gray-100"></div>
                <div class="px-4 pt-3 pb-1 text-xs uppercase tracking-wider text-gray-400 font-semibold bg-gray-50">
                    Profil</div>
                <a href="{{ route('public.pejabat') }}"
                    class="group flex items-center px-4 py-4 border-l-4 transition-all duration-200 {{ request()->routeIs('public.pejabat*') ? 'mobile-nav-active text-blue-700 bg-blue-50 border-blue-600' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700 border-transparent hover:border-blue-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('public.pejabat*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Struktur Organisasi
                </a>
                <a href="{{ route('public.visi-misi') }}"
                    class="group flex items-center px-4 py-4 border-l-4 transition-all duration-200 {{ request()->routeIs('public.visi-misi*') ? 'mobile-nav-active text-blue-700 bg-blue-50 border-blue-600' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700 border-transparent hover:border-blue-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('public.visi-misi*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Visi & Misi
                </a>
                <div class="border-t border-gray-100"></div>
                <a href="{{ route('public.berita') }}"
                    class="group flex items-center px-4 py-4 border-l-4 transition-all duration-200 {{ request()->routeIs('public.berita*') ? 'mobile-nav-active text-blue-700 bg-blue-50 border-blue-600' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700 border-transparent hover:border-blue-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('public.berita*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Berita
                </a>
                <a href="{{ route('public.galeri') }}"
                    class="group flex items-center px-4 py-4 border-l-4 transition-all duration-200 {{ request()->routeIs('public.galeri*') ? 'mobile-nav-active text-blue-700 bg-blue-50 border-blue-600' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700 border-transparent hover:border-blue-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('public.galeri*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Galeri
                </a>
                <a href="{{ route('public.agenda') }}"
                    class="group flex items-center px-4 py-4 border-l-4 transition-all duration-200 {{ request()->routeIs('public.agenda*') ? 'mobile-nav-active text-blue-700 bg-blue-50 border-blue-600' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700 border-transparent hover:border-blue-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('public.agenda*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Agenda
                </a>
                <a href="{{ route('public.unduhan') }}"
                    class="group flex items-center px-4 py-4 border-l-4 transition-all duration-200 {{ request()->routeIs('public.unduhan*') ? 'mobile-nav-active text-blue-700 bg-blue-50 border-blue-600' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700 border-transparent hover:border-blue-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('public.unduhan*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Unduhan
                </a>
                <a href="{{ route('public.kontak') }}"
                    class="group flex items-center px-4 py-4 border-l-4 transition-all duration-200 {{ request()->routeIs('public.kontak*') ? 'mobile-nav-active text-blue-700 bg-blue-50 border-blue-600' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700 border-transparent hover:border-blue-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('public.kontak*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Kontak
                </a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow relative">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="relative bg-gradient-to-br from-blue-800 via-blue-900 to-indigo-900 text-white overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute inset-0">
                <div
                    class="absolute top-0 left-0 w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10">
                </div>
                <div
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-cyan-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10">
                </div>
            </div>

            <!-- Wave decoration top -->
            <div class="absolute top-0 left-0 right-0">
                <svg class="w-full h-20 text-blue-800 transform rotate-180" preserveAspectRatio="none"
                    viewBox="0 0 1200 120" fill="currentColor">
                    <path
                        d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                        opacity=".25"></path>
                    <path
                        d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                        opacity=".5"></path>
                    <path
                        d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z">
                    </path>
                </svg>
            </div>

            <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
                <!-- Main Footer Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
                    <!-- Company Info -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center mb-6">
                            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-3 mr-4">
                                <img class="w-8 h-8" src="{{ asset('img/logo.png') }}" alt="Logo BKPSDM">
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-white">BKPSDM</h3>
                                <p class="text-blue-200 text-sm">Kabupaten Katingan</p>
                            </div>
                        </div>
                        <p class="text-blue-100 text-sm leading-relaxed max-w-md mb-6">
                            Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Katingan berkomitmen untuk
                            memberikan pelayanan terbaik dalam manajemen kepegawaian dan pengembangan aparatur sipil
                            negara.
                        </p>

                        <!-- Social Media Links -->
                        <div>
                            <h4 class="font-semibold text-white mb-3">Ikuti Kami</h4>
                            <div class="flex space-x-4">
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/humasbkpp.kabupatenkatingan/"
                                    target="_blank" rel="noopener noreferrer"
                                    class="group bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-3 hover:bg-opacity-20 transition-all duration-300">
                                    <svg class="w-5 h-5 text-blue-200 group-hover:text-white transition-colors"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </a>
                                <!-- Instagram -->
                                <a href="https://www.instagram.com/bkpsdmkatingan/?hl=id"
                                    target="_blank" rel="noopener noreferrer"
                                    class="group bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-3 hover:bg-opacity-20 transition-all duration-300">
                                    <svg class="w-5 h-5 text-blue-200 group-hover:text-white transition-colors"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="font-bold text-lg mb-6 text-white">Tautan Cepat</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('public.berita') }}"
                                    class="group flex items-center text-blue-200 hover:text-white transition-colors duration-300">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Berita Terbaru
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('public.galeri') }}"
                                    class="group flex items-center text-blue-200 hover:text-white transition-colors duration-300">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Galeri Kegiatan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('public.agenda') }}"
                                    class="group flex items-center text-blue-200 hover:text-white transition-colors duration-300">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Agenda Kegiatan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('public.pejabat') }}"
                                    class="group flex items-center text-blue-200 hover:text-white transition-colors duration-300">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Struktur Organisasi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('public.unduhan') }}"
                                    class="group flex items-center text-blue-200 hover:text-white transition-colors duration-300">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Pusat Unduhan
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h3 class="font-bold text-lg mb-6 text-white">Hubungi Kami</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-2 mr-3 mt-1">
                                    <svg class="w-4 h-4 text-blue-200" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-blue-100 text-sm leading-relaxed">
                                        Jalan M.T. Haryono
                                        Komplek Perkantoran Kereng Humbang
                                        Kota Kasongan, Kabupaten Katingan
                                        Provinsi Kalimantan Tengah
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-2 mr-3">
                                    <svg class="w-4 h-4 text-blue-200" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                                    </svg>
                                </div>
                                <a href="mailto:info@bkpsdm-katingan.go.id"
                                    class="text-blue-100 text-sm hover:text-white transition-colors">
                                    info@bkpsdm-katingan.go.id
                                </a>
                            </div>

                            <div class="flex items-center">
                                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-2 mr-3">
                                    <svg class="w-4 h-4 text-blue-200" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                                    </svg>
                                </div>
                                <span class="text-blue-100 text-sm">
                                    (0536) 123-4567
                                </span>
                            </div>

                            <!-- Login Admin Button -->
                            <div class="mt-6 pt-4 border-t border-blue-700 border-opacity-30">
                                <a href="{{ route('login') }}"
                                    class="inline-flex items-center px-4 py-2 bg-white bg-opacity-10 backdrop-blur-sm border border-white border-opacity-20 rounded-lg text-blue-100 hover:bg-opacity-20 hover:text-white transition-all duration-300 group">
                                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                    Login
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section -->
                <div class="border-t border-blue-700 border-opacity-50 py-2">
                    <div class="flex justify-center items-center">
                        <div class="text-center">
                            <p class="text-blue-200 text-sm">
                                &copy; {{ date('Y') }} BKPSDM Kabupaten Katingan. Seluruh Hak Cipta Dilindungi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Additional scripts from child views -->
    @stack('scripts')
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/684bcd42b25605190dae132f/1itk1jj4d';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>
