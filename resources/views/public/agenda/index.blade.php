@extends('layouts.public')

@section('title', 'Agenda Kegiatan')

@push('styles')
<style>
    /* Custom scrollbar untuk area agenda list */
    .agenda-scroll-area::-webkit-scrollbar {
        width: 8px;
    }
    
    .agenda-scroll-area::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    
    .agenda-scroll-area::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    
    .agenda-scroll-area::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Smooth transitions untuk filter */
    .filter-item {
        transition: all 0.2s ease-in-out;
    }
    
    .filter-item:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }
</style>
@endpush

@section('content')
    <!-- Hero Section with Blue Decoration -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-20 h-20 sm:w-32 sm:h-32 md:w-48 md:h-48 lg:w-72 lg:h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
            <div class="absolute top-0 right-0 w-20 h-20 sm:w-32 sm:h-32 md:w-48 md:h-48 lg:w-72 lg:h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-4 sm:left-8 md:left-16 lg:left-20 w-20 h-20 sm:w-32 sm:h-32 md:w-48 md:h-48 lg:w-72 lg:h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-4000"></div>
        </div>
        
        <!-- Wave decoration -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-8 sm:h-12 md:h-16 lg:h-20 text-white" preserveAspectRatio="none" viewBox="0 0 1200 120" fill="currentColor">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>
        
        <!-- Content -->
        <div class="relative z-10 py-12 sm:py-16 md:py-20 lg:py-24 xl:py-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-xl sm:max-w-2xl md:max-w-3xl text-center">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-white">
                        Agenda Kegiatan
                    </h1>
                    <p class="mt-4 md:mt-6 text-base sm:text-lg leading-8 text-blue-100">
                        Jadwal kegiatan, rapat, dan acara penting BKPSDM Katingan yang dapat Anda akses dan unduh
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Agenda Content -->
    <div class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto bg-white border border-slate-200 rounded-xl shadow-sm p-4 md:p-6">
                
                <!-- Form Pencarian dan Filter -->
                <form method="GET" action="{{ route('public.agenda') }}" class="mb-6 md:mb-8">
                    <div class="flex flex-col gap-4 items-center justify-center">
                        <!-- Input Pencarian -->
                        <div class="w-full max-w-2xl">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2 text-center">Cari Agenda</label>
                            <div class="relative">
                                <div class="flex flex-col sm:flex-row">
                                    <div class="relative flex-1">
                                        <input type="text" 
                                               id="search"
                                               name="search" 
                                               value="{{ request('search') }}" 
                                               placeholder="Cari agenda, rapat, atau kegiatan…" 
                                               class="w-full rounded-lg sm:rounded-l-lg sm:rounded-r-none border-slate-300 focus:border-blue-500 focus:ring-blue-500 pl-10 pr-2 py-3 text-sm" 
                                               aria-label="Cari agenda">
                                        <svg class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 4.287 12.01l3.226 3.227a.75.75 0 1 0 1.06-1.06l-3.226-3.227A6.75 6.75 0 0 0 10.5 3.75Zm-5.25 6.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <button type="submit" 
                                            class="mt-2 sm:mt-0 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg sm:rounded-r-lg sm:rounded-l-none border border-blue-600 hover:border-blue-700 transition-colors text-sm font-medium">
                                        <span class="sm:hidden">Cari Agenda</span>
                                        <svg class="w-4 h-4 hidden sm:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 4.287 12.01l3.226 3.227a.75.75 0 1 0 1.06-1.06l-3.226-3.227A6.75 6.75 0 0 0 10.5 3.75Zm-5.25 6.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tombol Reset -->
                        @if(request('search'))
                            <div class="w-full flex justify-center">
                                <a href="{{ route('public.agenda') }}" 
                                   class="inline-flex items-center px-4 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0 1 12.548-3.364l1.903 1.903h-3.183a.75.75 0 1 0 0 1.5h4.992a.75.75 0 0 0 .75-.75V4.356a.75.75 0 0 0-1.5 0v3.18l-1.9-1.9A9 9 0 0 0 3.306 9.67a.75.75 0 1 0 1.45.388Zm15.408 3.352a.75.75 0 0 0-.919.53 7.5 7.5 0 0 1-12.548 3.364l-1.902-1.903h3.183a.75.75 0 0 0 0-1.5H2.984a.75.75 0 0 0-.75.75v4.992a.75.75 0 0 0 1.5 0v-3.18l1.9 1.9a9 9 0 0 0 15.059-4.035.75.75 0 0 0-.53-.918Z" clip-rule="evenodd"/>
                                    </svg>
                                    Reset
                                </a>
                            </div>
                        @endif
                    </div>
                </form>

                <!-- Filter Active Indicator -->
                @if(request('search'))
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-blue-800">
                                <span class="font-medium">Pencarian aktif:</span>
                                <span class="font-semibold">"{{ request('search') }}"</span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Agenda Grid -->
                @if($agenda->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8">
                        @foreach($agenda as $item)
                            <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                @if($item->thumbnail)
                                    <div class="relative overflow-hidden bg-slate-100">
                                        <img src="{{ Storage::url($item->thumbnail) }}" 
                                             alt="Thumbnail {{ $item->title }}" 
                                             class="w-full h-44 sm:h-48 md:h-52 object-cover transition-transform duration-500 hover:scale-105"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                             loading="lazy">
                                        <div class="hidden absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 items-center justify-center">
                                            <svg class="w-12 h-12 text-white opacity-60" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    </div>
                                @else
                                    <div class="h-44 sm:h-48 md:h-52 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white opacity-60" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="p-4 md:p-5">
                                    <!-- Tanggal dan Status -->
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center text-blue-600 text-sm font-medium">
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            @if($item->start_date)
                                                {{ $item->start_date->format('d M Y') }}
                                                @if($item->end_date && !$item->start_date->equalTo($item->end_date))
                                                    - {{ $item->end_date->format('d M Y') }}
                                                @endif
                                            @else
                                                {{ $item->created_at->format('d M Y') }}
                                            @endif
                                        </div>
                                        
                                        <!-- Status Badge -->
                                        @if($item->status)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $item->status->color() }}">
                                                {{ $item->status->label() }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <!-- Waktu -->
                                    @if($item->start_time || $item->end_time)
                                        <div class="flex items-center text-gray-600 text-sm mb-3">
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            @if($item->start_time)
                                                {{ $item->start_time }}
                                                @if($item->end_time)
                                                    - {{ $item->end_time }}
                                                @endif
                                                WIB
                                            @elseif($item->end_time)
                                                Selesai: {{ $item->end_time }} WIB
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <!-- Judul -->
                                    <h3 class="text-lg md:text-xl font-bold text-slate-800 mb-3 line-clamp-2 hover:text-blue-600 transition-colors">
                                        <a href="{{ route('public.agenda.show', $item) }}">
                                            {{ $item->title }}
                                        </a>
                                    </h3>
                                    
                                    <!-- Deskripsi -->
                                    <p class="text-slate-600 text-sm md:text-base mb-4 line-clamp-3">
                                        {{ Str::limit(strip_tags($item->description), 120) }}
                                    </p>
                                    
                                    <!-- Link Selengkapnya -->
                                                                                <a href="{{ route('public.agenda.show', $item) }}" 
                                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors group">
                                        Lihat Detail
                                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" 
                                             xmlns="http://www.w3.org/2000/svg" 
                                             fill="none" 
                                             viewBox="0 0 24 24" 
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center">
                        {{ $agenda->withQueryString()->links('pagination.blue-theme') }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada agenda ditemukan</h3>
                        <p class="text-gray-600 mb-6">
                            @if(request('search'))
                                Coba ubah kata kunci pencarian yang Anda gunakan.
                            @else
                                Belum ada agenda yang tersedia saat ini.
                            @endif
                        </p>
                        @if(request('search'))
                            <a href="{{ route('public.agenda') }}" 
                               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0 1 12.548-3.364l1.903 1.903h-3.183a.75.75 0 1 0 0 1.5h4.992a.75.75 0 0 0 .75-.75V4.356a.75.75 0 0 0-1.5 0v3.18l-1.9-1.9A9 9 0 0 0 3.306 9.67a.75.75 0 1 0 1.45.388Zm15.408 3.352a.75.75 0 0 0-.919.53 7.5 7.5 0 0 1-12.548 3.364l-1.902-1.903h3.183a.75.75 0 0 0 0-1.5H2.984a.75.75 0 0 0-.75.75v4.992a.75.75 0 0 0 1.5 0v-3.18l1.9 1.9a9 9 0 0 0 15.059-4.035.75.75 0 0 0-.53-.918Z" clip-rule="evenodd"/>
                                </svg>
                                Lihat Semua Agenda
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Submit form only on Enter key or button click
        const searchInput = document.querySelector('input[name="search"]');
        const searchForm = document.querySelector('form');
        
        if (searchInput && searchForm) {
            // Handle Enter key press
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchForm.submit();
                } else if (e.key === 'Escape') {
                    this.value = '';
                    searchForm.submit();
                }
            });
        }
        
        // Enhanced agenda item hover effects
        const agendaItems = document.querySelectorAll('.filter-item');
        agendaItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endpush
