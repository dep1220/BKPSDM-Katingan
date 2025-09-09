@extends('layouts.public')

@section('title', 'Galeri Kegiatan - BKPSDM Katingan')

@push('styles')
<style>
    /* Gallery specific styles */
    .gallery-item {
        transition: all 0.3s ease-in-out;
    }
    
    .gallery-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 0.75rem;
    }
    
    @media (min-width: 480px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
    }
    
    @media (min-width: 640px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }
    }
    
    @media (min-width: 768px) {
        .gallery-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
    }
    
    @media (min-width: 1024px) {
        .gallery-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }
    }
    
    @media (min-width: 1280px) {
        .gallery-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }
    
    /* Ensure equal height for gallery items */
    .gallery-item img {
        height: 10rem;
        object-fit: cover;
        width: 100%;
    }
    
    @media (min-width: 480px) {
        .gallery-item img {
            height: 11rem;
        }
    }
    
    @media (min-width: 640px) {
        .gallery-item img {
            height: 12rem;
        }
    }
    
    @media (min-width: 768px) {
        .gallery-item img {
            height: 13rem;
        }
    }
    
    @media (min-width: 1024px) {
        .gallery-item img {
            height: 14rem;
        }
    }
</style>
@endpush

@section('content')
    <!-- Hero Section with Blue Decoration -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
            <div class="absolute top-0 right-0 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-10 sm:left-20 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-4000"></div>
        </div>
        
        <!-- Wave decoration -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-20 text-white" preserveAspectRatio="none" viewBox="0 0 1200 120" fill="currentColor">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>
        
        <!-- Content -->
        <div class="relative py-24 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                    Galeri Kegiatan
                </h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed">
                    Dokumentasi visual dari berbagai program dan kegiatan yang telah kami laksanakan.
                </p>
            </div>
        </div>
    </div>

    {{-- Konten Utama (Grid Gambar + Modal) --}}
    <div class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ gOpen:false, gSrc:'', gTitle:'' }" @keydown.escape.window="gOpen=false">

            <div class="gallery-grid">
                @forelse($galeris as $item)
                {{-- Item Galeri --}}
                <button type="button"
                        class="gallery-item group block rounded-lg overflow-hidden shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        @click="gOpen=true; gSrc='{{ $item->image ? asset('storage/' . $item->image) : 'https://placehold.co/1200x800/e2e8f0/adb5bd?text=Galeri' }}'; gTitle=@js($item->title ?? 'Gambar Galeri')">
                    <div class="relative">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://placehold.co/600x400/e2e8f0/adb5bd?text=Galeri' }}" 
                             alt="{{ $item->title }}" 
                             class="w-full object-cover transition-transform duration-300 group-hover:scale-105">
                        {{-- Overlay saat hover --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                            <div class="p-4 w-full">
                                <p class="text-white text-sm font-semibold line-clamp-2">{{ $item->title ?? 'Lihat Gambar' }}</p>
                            </div>
                        </div>
                        {{-- Icon untuk menunjukkan bisa diklik --}}
                        <div class="absolute top-4 right-4 w-8 h-8 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-gray-700">
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </button>
                @empty
                <div class="col-span-full text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Galeri Belum Tersedia</h3>
                        <p class="text-gray-600 leading-relaxed mb-8">
                            Dokumentasi kegiatan sedang dalam proses upload. Silakan kunjungi halaman ini kembali dalam waktu dekat.
                        </p>
                        <a href="{{ route('public.index') }}" 
                           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition-colors shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            {{-- Link Paginasi --}}
            <div class="mt-12 flex justify-center">
                <nav class="pagination-wrapper" role="navigation" aria-label="Pagination Navigation">
                    {{ $galeris->links('pagination.blue-theme') }}
                </nav>
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
        </div>
    </div>
@endsection
