@extends('layouts.public')

@section('title', 'Selamat Datang di BKPSDM Katingan')

@section('content')
    <!-- Hero Slider -->
    <section aria-label="Slider Beranda" class="relative">
        <div class="swiper-container h-[45vh] sm:h-[55vh] md:h-[65vh] lg:h-[75vh] xl:h-[80vh] w-full">
            <div class="swiper-wrapper">
                @forelse($heroSlides as $slide)
                    <div class="swiper-slide relative">
                        <img
                            src="{{ $slide->background_image ? asset('storage/' . $slide->background_image) : 'https://placehold.co/1600x900/e2e8f0/94a3b8?text=BKPSDM+Katingan' }}"
                            alt="{{ $slide->title ?? 'Slide BKPSDM Katingan' }}"
                            class="w-full h-full object-cover"
                            loading="eager"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute inset-0 flex items-end">
                            <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-6 sm:pb-8 md:pb-10 lg:pb-12 text-white">
                                @if(!empty($slide->title))
                                    <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-extrabold tracking-tight leading-tight drop-shadow mb-2 sm:mb-3 md:mb-4">
                                        {{ $slide->title }}
                                    </h1>
                                @endif
                                @if(!empty($slide->subtitle))
                                    <p class="text-sm sm:text-base md:text-lg lg:text-xl/relaxed max-w-2xl md:max-w-3xl lg:max-w-4xl text-white/90">
                                        {{ $slide->subtitle }}
                                    </p>
                                @endif
                                @if($slide->button_text && $slide->button_link)
                                    <div class="mt-3 sm:mt-4 md:mt-5 lg:mt-6">
                                        <a href="{{ $slide->button_link }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 sm:py-2.5 sm:px-5 md:py-3 md:px-6 lg:py-3.5 lg:px-7 rounded-lg shadow-lg shadow-black/10 transition-colors duration-200 text-sm sm:text-base md:text-lg">
                                            {{ $slide->button_text }}
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 sm:w-5 sm:h-5"><path fill-rule="evenodd" d="M4.5 12a.75.75 0 0 1 .75-.75h12.19l-4.72-4.72a.75.75 0 1 1 1.06-1.06l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H5.25A.75.75 0 0 1 4.5 12Z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide relative bg-gray-700 flex items-center justify-center text-white">
                        <p class="text-center px-4">Silakan tambahkan slide di panel admin.</p>
                    </div>
                @endforelse
            </div>
            <div class="swiper-pagination" aria-label="Navigasi slide"></div>
            <div class="swiper-button-next" aria-label="Slide berikut"></div>
            <div class="swiper-button-prev" aria-label="Slide sebelumnya"></div>
        </div>
        <script>
            const heroSwiper = new Swiper('.swiper-container', {
                loop: true,
                autoplay: { delay: 5000, disableOnInteraction: false },
                pagination: { el: '.swiper-pagination', clickable: true },
                navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                effect: 'fade',
                fadeEffect: { crossFade: true },
                keyboard: { enabled: true },
            });
        </script>
    </section>

    <!-- Layanan Cepat -->
    <section class="py-8 sm:py-10 md:py-12 lg:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-6 sm:mb-8 md:mb-10 lg:mb-12">
                <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4">Layanan Cepat</h2>
                <p class="text-gray-600 max-w-xl md:max-w-2xl lg:max-w-3xl mx-auto text-sm sm:text-base md:text-lg">Akses cepat ke informasi dan layanan yang tersedia di BKPSDM Katingan</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6 max-w-4xl mx-auto" role="navigation" aria-label="Layanan cepat">
                <a href="{{ route('public.berita') }}" class="group bg-white rounded-xl md:rounded-2xl border border-gray-200 hover:border-blue-300 p-4 md:p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-3 md:space-y-4">
                        <div class="inline-flex h-12 w-12 md:h-16 md:w-16 items-center justify-center rounded-xl md:rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill-rule="evenodd" d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 0 0 3 3h15a3 3 0 0 1-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125ZM12 9.75a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H12Zm-.75-2.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5H12a.75.75 0 0 1-.75-.75ZM6 12.75a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5H6Zm-.75 3.75a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5H6a.75.75 0 0 1-.75-.75ZM6 6.75a.75.75 0 0 0-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75v-3A.75.75 0 0 0 9 6.75H6Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm md:text-base lg:text-lg text-gray-900 group-hover:text-blue-600 transition-colors">Berita</h3>
                            <p class="text-xs md:text-sm text-gray-500 mt-1">Informasi terbaru</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('public.pejabat') }}" class="group bg-white rounded-xl md:rounded-2xl border border-gray-200 hover:border-blue-300 p-4 md:p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-3 md:space-y-4">
                        <div class="inline-flex h-12 w-12 md:h-16 md:w-16 items-center justify-center rounded-xl md:rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm md:text-base lg:text-lg text-gray-900 group-hover:text-blue-600 transition-colors">Pejabat</h3>
                            <p class="text-xs md:text-sm text-gray-500 mt-1">Struktur organisasi</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('public.galeri') }}" class="group bg-white rounded-xl md:rounded-2xl border border-gray-200 hover:border-blue-300 p-4 md:p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-3 md:space-y-4">
                        <div class="inline-flex h-12 w-12 md:h-16 md:w-16 items-center justify-center rounded-xl md:rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm md:text-base lg:text-lg text-gray-900 group-hover:text-blue-600 transition-colors">Galeri</h3>
                            <p class="text-xs md:text-sm text-gray-500 mt-1">Dokumentasi kegiatan</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('public.unduhan') }}" class="group bg-white rounded-xl md:rounded-2xl border border-gray-200 hover:border-blue-300 p-4 md:p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-3 md:space-y-4">
                        <div class="inline-flex h-12 w-12 md:h-16 md:w-16 items-center justify-center rounded-xl md:rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm md:text-base lg:text-lg text-gray-900 group-hover:text-blue-600 transition-colors">Unduhan</h3>
                            <p class="text-xs md:text-sm text-gray-500 mt-1">Dokumen & agenda</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Berita & Sidebar -->
    <section class="py-12 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
                <div class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-6 md:mb-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Berita Terbaru</h2>
                        <a href="{{ route('public.berita') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold text-sm">
                            Lihat Semua
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M4.5 12a.75.75 0 0 1 .75-.75h12.19l-4.72-4.72a.75.75 0 1 1 1.06-1.06l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H5.25A.75.75 0 0 1 4.5 12Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                    <div class="space-y-8 md:space-y-10">
                        @php
                            $featured = $latestBerita->first();
                            $others = $latestBerita->slice(1, 2); // Ambil berita ke-2 dan ke-3 saja
                        @endphp

                        @if($featured)
                            <!-- Berita Unggulan -->
                            <article class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300">
                                <div class="flex flex-col lg:flex-row">
                                    <div class="lg:w-1/2">
                                        <a href="{{ route('public.berita.show', $featured) }}" class="block group">
                                            <img src="{{ $featured->thumbnail ? asset('storage/' . $featured->thumbnail) : 'https://placehold.co/800x500/e2e8f0/adb5bd?text=Berita' }}" 
                                                 alt="{{ $featured->title }}" 
                                                 class="w-full h-56 sm:h-64 md:h-72 lg:h-full object-cover group-hover:scale-105 transition-transform duration-300" 
                                                 loading="lazy">
                                        </a>
                                    </div>
                                    <div class="p-6 md:p-8 lg:w-1/2 flex flex-col justify-between">
                                        <div>
                                            <div class="flex items-center gap-3 text-sm text-gray-500 mb-4">
                                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">Terbaru</span>
                                                <span>{{ $featured->created_at->format('d F Y') }}</span>
                                            </div>
                                            <h3 class="font-bold text-xl md:text-2xl leading-tight text-gray-900 mb-4">
                                                <a href="{{ route('public.berita.show', $featured) }}" class="hover:text-blue-600 transition-colors">
                                                    {{ Str::limit($featured->title, 100) }}
                                                </a>
                                            </h3>
                                            <p class="text-gray-600 line-clamp-3 mb-4 md:mb-6 text-sm md:text-base">{{ Str::limit(strip_tags($featured->content), 220) }}</p>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-600">
                                                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <span class="text-sm text-gray-600">{{ $featured->user?->name ?? 'Admin' }}</span>
                                            </div>
                                            <a href="{{ route('public.berita.show', $featured) }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 md:py-3 md:px-6 rounded-lg transition-colors text-sm md:text-base">
                                                Baca Selengkapnya
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                    <path fill-rule="evenodd" d="M4.5 12a.75.75 0 0 1 .75-.75h12.19l-4.72-4.72a.75.75 0 1 1 1.06-1.06l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H5.25A.75.75 0 0 1 4.5 12Z" clip-rule="evenodd"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endif

                        @if($others->isNotEmpty())
                            <!-- Berita Lainnya (2 berita) -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                                @foreach($others as $berita)
                                    <article class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col">
                                        <a href="{{ route('public.berita.show', $berita) }}" class="block group">
                                            <img src="{{ $berita->thumbnail ? asset('storage/' . $berita->thumbnail) : 'https://placehold.co/600x400/e2e8f0/adb5bd?text=Berita' }}" 
                                                 alt="{{ $berita->title }}" 
                                                 class="w-full h-40 sm:h-48 object-cover group-hover:scale-105 transition-transform duration-300" 
                                                 loading="lazy">
                                        </a>
                                        <div class="p-4 md:p-6 flex-1 flex flex-col">
                                            <div class="flex items-center text-xs text-gray-500 mb-3">
                                                <span>{{ $berita->created_at->format('d F Y') }}</span>
                                                <span class="mx-2">•</span>
                                                <span>{{ $berita->user?->name ?? 'Admin' }}</span>
                                            </div>
                                            <h3 class="font-bold text-base md:text-lg line-clamp-2 mb-3">
                                                <a href="{{ route('public.berita.show', $berita) }}" class="hover:text-blue-600 transition-colors">
                                                    {{ Str::limit($berita->title, 90) }}
                                                </a>
                                            </h3>
                                            <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-1">{{ Str::limit(strip_tags($berita->content), 140) }}</p>
                                            <a href="{{ route('public.berita.show', $berita) }}" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 font-semibold text-sm">
                                                Baca selengkapnya
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                    <path fill-rule="evenodd" d="M4.5 12a.75.75 0 0 1 .75-.75h12.19l-4.72-4.72a.75.75 0 1 1 1.06-1.06l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H5.25A.75.75 0 0 1 4.5 12Z" clip-rule="evenodd"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @endif

                        @if(!$featured)
                            <div class="text-center py-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                                <p class="text-gray-500">Belum ada berita yang dipublikasikan.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Agenda Terbaru -->
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Agenda Terbaru</h3>
                            <a href="{{ route('public.agenda') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                Lihat Semua
                            </a>
                        </div>
                        <div class="space-y-4">
                            @forelse($latestAgenda as $agenda)
                                <div class="flex items-start gap-4 p-4 rounded-lg border border-gray-100 hover:border-blue-200 hover:bg-blue-50/50 transition-all">
                                    <div class="flex-shrink-0 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                            <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"/>
                                            <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <a href="{{ route('public.agenda.show', $agenda) }}" class="block font-medium text-gray-900 hover:text-blue-600 transition-colors">
                                            {{ Str::limit($agenda->title, 50) }}
                                        </a>
                                        <p class="text-xs text-gray-500 mt-1">{{ $agenda->created_at->format('d M Y') }}</p>
                                        @if($agenda->description)
                                            <p class="text-xs text-gray-600 mt-1 line-clamp-2">{{ Str::limit($agenda->description, 80) }}</p>
                                        @endif
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('public.agenda.show', $agenda) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 hover:bg-blue-100 text-gray-600 hover:text-blue-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M4.5 12a.75.75 0 0 1 .75-.75h8.25V5.25a.75.75 0 0 1 1.28-.53l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 0 1-1.28-.53V9H5.25A.75.75 0 0 1 4.5 12Z" clip-rule="evenodd"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-gray-500 text-sm">Belum ada agenda terbaru.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Unduhan Terbaru -->
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Unduhan Terbaru</h3>
                            <a href="{{ route('public.unduhan') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                Lihat Semua
                            </a>
                        </div>
                        <div class="space-y-4">
                            @forelse($latestUnduhan as $item)
                                @php
                                    $path = $item->file_path ?? '';
                                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                @endphp
                                <div class="flex items-start gap-4 p-4 rounded-lg border border-gray-100 hover:border-blue-200 hover:bg-blue-50/50 transition-all">
                                    <div class="flex-shrink-0 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-gray-100 text-gray-600">
                                        @switch($ext)
                                            @case('pdf')
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-red-600">
                                                    <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd"/>
                                                    <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z"/>
                                                </svg>
                                                @break
                                            @case('doc')
                                            @case('docx')
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-blue-600">
                                                    <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd"/>
                                                </svg>
                                                @break
                                            @default
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd"/>
                                                </svg>
                                        @endswitch
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <a href="{{ $path ? asset('storage/' . $path) : '#' }}" target="_blank" class="block font-medium text-gray-900 hover:text-blue-600 transition-colors">
                                            {{ Str::limit($item->title, 50) }}
                                        </a>
                                        <p class="text-xs text-gray-500 mt-1">{{ $item->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="{{ $path ? asset('storage/' . $path) : '#' }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 hover:bg-blue-100 text-gray-600 hover:text-blue-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-gray-500 text-sm">Belum ada dokumen untuk diunduh.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Pejabat -->
    <section class="py-12 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Struktur Organisasi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base">Tim kami yang berdedikasi untuk melayani masyarakat Katingan dengan integritas dan profesionalisme</p>
            </div>

            <div class="space-y-12">
                {{-- 1. Kepala Dinas --}}
                @if($pimpinan)
                <div class="flex justify-center mb-12 md:mb-16">
                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5">
                        {{-- Kartu dengan design seperti ID Card --}}
                        <div class="bg-white rounded-lg shadow-lg border-t-4 border-blue-600 overflow-hidden">
                            {{-- Header dengan border biru bergaris putus-putus --}}
                            <div class="relative p-3 md:p-4 bg-gray-50">
                                <div class="absolute top-2 left-4 right-4 border-t-2 border-dashed border-blue-400"></div>
                            </div>
                            
                            {{-- Foto --}}
                            <div class="px-4 md:px-6 pt-4">
                                <div class="w-24 h-32 sm:w-28 sm:h-36 md:w-32 md:h-40 mx-auto rounded-lg overflow-hidden border-2 border-gray-200">
                                    <img src="{{ $pimpinan->photo ? asset('storage/' . $pimpinan->photo) : 'https://placehold.co/600x400/e2e8f0/adb5bd?text=Foto' }}" 
                                         alt="{{ $pimpinan->name }}" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                            
                            {{-- Info Text --}}
                            <div class="p-4 md:p-6 text-center">
                                <h3 class="font-bold text-base md:text-lg text-gray-900 mb-1">{{ $pimpinan->name }}</h3>
                                <p class="text-gray-600 font-medium mb-2 text-sm md:text-base">{{ $pimpinan->jabatan }}</p>
                                @if($pimpinan->nip)
                                <p class="text-xs md:text-sm text-gray-500">NIP. {{ $pimpinan->nip }}</p>
                                @endif
                            </div>
                            
                            {{-- Footer dengan border biru --}}
                            <div class="h-2 bg-blue-600"></div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- 2. Sekretaris --}}
                @php
                    $sekretaris = isset($groupedPejabats) ? collect($groupedPejabats)->filter(function($pejabatList, $jabatan) {
                        return $jabatan === 'Sekretaris';
                    }) : collect();
                @endphp
                
                {{-- @if($sekretaris->isNotEmpty())
                <div class="flex justify-center mb-16">
                    @foreach($sekretaris as $jabatan => $pejabatGroup)
                        @foreach($pejabatGroup as $sekretaris_pejabat)
                            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5"> --}}
                                {{-- Kartu dengan design seperti ID Card --}}
                                {{-- <div class="bg-white rounded-lg shadow-lg border-t-4 border-blue-600 overflow-hidden">
                                    <div class="relative p-3 md:p-4 bg-gray-50">
                                        <div class="absolute top-2 left-4 right-4 border-t-2 border-dashed border-blue-400"></div>
                                    </div>
                                     --}}
                                    {{-- Foto --}}
                                    {{-- <div class="px-4 md:px-6 pt-4">
                                        <div class="w-24 h-32 sm:w-28 sm:h-36 md:w-32 md:h-40 mx-auto rounded-lg overflow-hidden border-2 border-gray-200">
                                            <img src="{{ $sekretaris_pejabat->photo ? asset('storage/' . $sekretaris_pejabat->photo) : 'https://placehold.co/600x400/e2e8f0/adb5bd?text=Foto' }}" 
                                                 alt="{{ $sekretaris_pejabat->name }}" 
                                                 class="w-full h-full object-cover">
                                        </div>
                                    </div> --}}
                                    
                                    {{-- Info Text --}}
                                    {{-- <div class="p-4 md:p-6 text-center">
                                        <h3 class="font-bold text-base md:text-lg text-gray-900 mb-1">{{ $sekretaris_pejabat->name }}</h3>
                                        <p class="text-gray-600 font-medium mb-2 text-sm md:text-base">{{ $sekretaris_pejabat->jabatan }}</p>
                                        @if($sekretaris_pejabat->nip)
                                        <p class="text-xs md:text-sm text-gray-500">NIP. {{ $sekretaris_pejabat->nip }}</p>
                                        @endif
                                    </div>
                                    <div class="h-2 bg-blue-600"></div>
                                </div> --}}
                            {{-- </div>
                        @endforeach
                    @endforeach
                </div>
                @endif --}}

                {{-- Pesan jika tidak ada data --}}
                @if(!$pimpinan && (!isset($groupedPejabats) || $sekretaris->isEmpty()))
                    <div class="text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <p class="text-gray-500">Belum ada data pejabat untuk ditampilkan.</p>
                        <p class="text-sm text-gray-400 mt-2">Pastikan data pejabat menggunakan jabatan yang sesuai: Kepala Dinas, Sekretaris, atau Kepala Bidang.</p>
                    </div>
                @endif
            </div>
            
            <div class="text-center mt-16">
                <a href="{{ route('public.pejabat') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    Lihat Struktur Lengkap
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M4.5 12a.75.75 0 0 1 .75-.75h12.19l-4.72-4.72a.75.75 0 1 1 1.06-1.06l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H5.25A.75.75 0 0 1 4.5 12Z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Galeri -->
    <section class="py-12 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ gOpen:false, gSrc:'', gTitle:'' }" @keydown.escape.window="gOpen=false">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Galeri Kegiatan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base">Dokumentasi visual dari berbagai kegiatan dan program yang telah kami laksanakan</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                @forelse($latestGaleri as $item)
                    <button type="button" class="group relative rounded-2xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1"
                            @click="gOpen=true; gSrc='{{ $item->image ? asset('storage/' . $item->image) : 'https://placehold.co/1200x800/e2e8f0/adb5bd?text=Galeri' }}'; gTitle=@js($item->title ?? 'Gambar Galeri')">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://placehold.co/600x400/e2e8f0/adb5bd?text=Galeri' }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-44 sm:h-48 md:h-56 object-cover group-hover:scale-110 transition-transform duration-300" 
                             loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-3 md:p-4">
                                <h3 class="text-white font-semibold text-xs sm:text-sm line-clamp-2">{{ Str::limit($item->title, 60) }}</h3>
                            </div>
                        </div>
                        <div class="absolute top-3 md:top-4 right-3 md:right-4 w-6 h-6 md:w-8 md:h-8 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 md:w-4 md:h-4 text-gray-700">
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </button>
                @empty
                    <div class="col-span-2 md:col-span-3 lg:col-span-4 text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-500">Belum ada gambar di galeri.</p>
                    </div>
                @endforelse
            </div>

            <!-- Modal Preview Gambar -->
            <div x-show="gOpen" x-transition class="fixed inset-0 z-50 bg-black/70 flex items-center justify-center p-4" role="dialog" aria-modal="true" @click.self="gOpen=false">
                <div class="relative max-w-5xl w-full">
                    <button type="button" @click="gOpen=false" class="absolute -top-3 -right-3 bg-white text-gray-700 hover:text-gray-900 rounded-full p-2 shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white" aria-label="Tutup gambar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M6.225 4.811a.75.75 0 0 1 1.06 0L12 9.526l4.715-4.715a.75.75 0 1 1 1.06 1.06L13.06 10.586l4.715 4.715a.75.75 0 1 1-1.06 1.06L12 11.646l-4.715 4.715a.75.75 0 1 1-1.06-1.06l4.714-4.715-4.714-4.715a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/></svg>
                    </button>
                    <div class="bg-white rounded-xl overflow-hidden">
                        <img :src="gSrc" :alt="gTitle || 'Gambar Galeri'" class="w-full h-auto object-contain max-h-[80vh] bg-black">
                        <div class="p-4">
                            <h3 class="text-gray-800 font-semibold" x-text="gTitle"></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-12 md:mt-16">
                <a href="{{ route('public.galeri') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 md:py-4 md:px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    Lihat Semua Galeri
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 md:w-5 md:h-5">
                        <path fill-rule="evenodd" d="M4.5 12a.75.75 0 0 1 .75-.75h12.19l-4.72-4.72a.75.75 0 1 1 1.06-1.06l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H5.25A.75.75 0 0 1 4.5 12Z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Kontak -->
    <section class="py-12 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 rounded-2xl md:rounded-3xl text-white p-6 md:p-8 lg:p-12 shadow-2xl">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-6 md:gap-8">
                    <div class="text-center lg:text-left">
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4">Butuh bantuan atau informasi lebih lanjut?</h3>
                        <p class="text-blue-100 text-base md:text-lg mb-6 lg:mb-0 max-w-2xl">Tim kami siap membantu Anda dengan pelayanan terbaik. Jangan ragu untuk menghubungi kami kapan saja.</p>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('public.kontak') }}" class="inline-flex items-center gap-2 md:gap-3 bg-white text-blue-700 hover:bg-blue-50 font-bold px-6 py-3 md:px-8 md:py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 md:w-6 md:h-6">
                                <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm md:text-base">Hubungi Kami Sekarang</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection