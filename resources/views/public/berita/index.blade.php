@extends('layouts.public')

@section('title', 'Arsip Berita - BKPSDM Katingan')

@push('styles')
<style>
    /* Mencegah seleksi teks pada konten berita */
    .berita-content {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-touch-callout: none;
        -webkit-tap-highlight-color: transparent;
    }
    
    .berita-content img {
        -webkit-user-drag: none;
        -khtml-user-drag: none;
        -moz-user-drag: none;
        -o-user-drag: none;
        user-drag: none;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section with Blue Decoration -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-24 h-24 sm:w-40 sm:h-40 md:w-56 md:h-56 lg:w-72 lg:h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
            <div class="absolute top-0 right-0 w-24 h-24 sm:w-40 sm:h-40 md:w-56 md:h-56 lg:w-72 lg:h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-5 sm:left-10 md:left-20 w-24 h-24 sm:w-40 sm:h-40 md:w-56 md:h-56 lg:w-72 lg:h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-4000"></div>
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
        <div class="relative py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-white mb-3 sm:mb-4 md:mb-6">
                    Kumpulan Berita
                </h1>
                <p class="text-lg sm:text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed">
                    Kumpulan informasi dan kegiatan terbaru dari BKPSDM Katingan.
                </p>
            </div>
        </div>
    </div>

    {{-- Form Pencarian --}}
    <div class="py-8 md:py-10 bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <form method="GET" action="{{ route('public.berita') }}" class="flex flex-col sm:flex-row gap-2">
                    <div class="relative flex-1">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Cari berita berdasarkan judul atau konten…" 
                               class="w-full rounded-lg sm:rounded-l-lg sm:rounded-r-none border-gray-300 focus:border-blue-500 focus:ring-blue-500 pl-10 pr-4 py-3 text-sm" 
                               aria-label="Cari berita">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 4.287 12.01l3.226 3.227a.75.75 0 1 0 1.06-1.06l-3.226-3.227A6.75 6.75 0 0 0 10.5 3.75Zm-5.25 6.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg sm:rounded-r-lg sm:rounded-l-none border border-blue-600 hover:border-blue-700 transition-colors text-sm font-medium">
                        <span class="sm:hidden">Cari Berita</span>
                        <svg class="w-5 h-5 hidden sm:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 4.287 12.01l3.226 3.227a.75.75 0 1 0 1.06-1.06l-3.226-3.227A6.75 6.75 0 0 0 10.5 3.75Zm-5.25 6.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </form>
                
                @if(request('search'))
                    <div class="mt-4 text-center">
                        <p class="text-gray-600">
                            Hasil pencarian untuk: <span class="font-semibold text-gray-900">"{{ request('search') }}"</span>
                            <span class="text-sm text-gray-500">({{ $beritas->total() }} berita ditemukan)</span>
                        </p>
                        <a href="{{ route('public.berita') }}" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 text-sm mt-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"/>
                            </svg>
                            Lihat Semua Berita
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Konten Utama (Grid Berita) --}}
    <div class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($beritas->count() > 0)
                {{-- Grid Berita --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($beritas as $berita)
                        <article class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                            {{-- Gambar Berita --}}
                            <div class="relative overflow-hidden">
                                @if($berita->thumbnail)
                                    <img src="{{ asset('storage/' . $berita->thumbnail) }}" 
                                         alt="{{ $berita->title }}" 
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                @elseif($berita->kategori === \App\Enums\BeritaKategori::PENGUMUMAN && $berita->lampiran_file)
                                    {{-- Preview file untuk pengumuman tanpa thumbnail --}}
                                    <div class="w-full h-48 bg-gradient-to-br from-purple-50 to-purple-100 flex flex-col items-center justify-center relative">
                                        <img src="{{ $berita->getFilePreviewUrl() }}" 
                                             alt="Preview {{ $berita->getFileExtension() }} file" 
                                             class="w-24 h-32 object-contain">
                                        <div class="absolute bottom-2 left-2 right-2">
                                            <p class="text-xs text-purple-600 text-center font-medium">
                                                File {{ strtoupper($berita->getFileExtension()) }} - Klik untuk unduh
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-blue-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V8h2v9zm4 0h-2v-4h2v4z"/>
                                        </svg>
                                    </div>
                                @endif

                                {{-- Badge Kategori --}}
                                <div class="absolute top-4 left-4 flex gap-2">
                                    @if($berita->kategori === \App\Enums\BeritaKategori::PENGUMUMAN)
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-500 text-white">
                                            Pengumuman
                                        </span>
                                    @elseif($berita->kategori === \App\Enums\BeritaKategori::BERITA_UTAMA)
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-red-500 text-white">
                                            Berita Utama
                                        </span>
                                    @else
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-500 text-white">
                                            Berita Harian
                                        </span>
                                    @endif
                                </div>

                                {{-- Overlay dengan tombol baca/unduh --}}
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                    @if($berita->kategori === \App\Enums\BeritaKategori::PENGUMUMAN && $berita->lampiran_file && !$berita->thumbnail)
                                        {{-- Tombol download untuk pengumuman dengan file --}}
                                        <div class="flex flex-col gap-2 opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300">
                                            <a href="{{ route('public.berita.show', $berita->id) }}" 
                                               class="text-white font-semibold px-4 py-2 bg-blue-600 rounded-full text-center text-sm">
                                                Baca Detail
                                            </a>
                                            <a href="{{ asset('storage/' . $berita->lampiran_file) }}" 
                                               target="_blank"
                                               class="text-white font-semibold px-4 py-2 bg-purple-600 rounded-full text-center text-sm">
                                                {{ $berita->getFileIcon() }} Unduh File
                                            </a>
                                        </div>
                                    @else
                                        <a href="{{ route('public.berita.show', $berita->id) }}">
                                            <span class="text-white font-semibold px-6 py-2 bg-blue-600 rounded-full opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300">
                                                Baca Artikel
                                            </span>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            {{-- Konten Berita --}}
                            <div class="p-6">
                                {{-- Meta Info --}}
                                <div class="flex items-center gap-3 text-sm text-gray-500 mb-3">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                        <time datetime="{{ $berita->created_at->format('Y-m-d') }}">
                                            {{ $berita->created_at->format('d M Y') }}
                                        </time>
                                    </div>
                                </div> 

                                {{-- Judul --}}
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">
                                    <a href="{{ route('public.berita.show', $berita->id) }}" class="hover:underline">
                                        {{ $berita->title }}
                                    </a>
                                </h3>

                                {{-- Konten Preview --}}
                                <p class="text-gray-600 leading-relaxed mb-4 line-clamp-3">
                                    {{ Str::limit(html_entity_decode(strip_tags($berita->content)), 120) }}
                                </p>

                                {{-- Action Buttons --}}
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <a href="{{ route('public.berita.show', $berita->id) }}" 
                                       class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold text-sm group/link">
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                                        </svg>
                                    </a>
                                    
                                    {{-- Share Button --}}
                                    <button onclick="shareBerita('{{ $berita->title }}', '{{ route('public.berita.show', $berita->slug) }}')" 
                                            class="p-2 text-gray-400 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-200"
                                            title="Bagikan berita">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="flex justify-center">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 px-6 py-4">
                        {{ $beritas->links('pagination::tailwind') }}
                    </div>
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V8h2v9zm4 0h-2v-4h2v4z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">
                            @if(request('search'))
                                Tidak Ada Hasil Pencarian
                            @else
                                Belum Ada Berita
                            @endif
                        </h3>
                        <p class="text-gray-600 mb-8">
                            @if(request('search'))
                                Coba gunakan kata kunci yang berbeda atau periksa ejaan Anda.
                            @else
                                Berita dan informasi terbaru akan segera hadir di sini.
                            @endif
                        </p>
                        @if(request('search'))
                            <a href="{{ route('public.berita') }}" 
                               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition-colors shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                </svg>
                                Lihat Semua Berita
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Handling pencarian dengan Enter key
    document.addEventListener('DOMContentLoaded', function() {
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
    });

    // Fungsi untuk share berita ke WhatsApp dari halaman index
    function shareBerita(title, url) {
        const text = `*${title}*\n\nBerita terbaru dari BKPSDM Katingan\n\nBaca selengkapnya: ${url}`;
        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text)}`;
        window.open(whatsappUrl, '_blank', 'width=600,height=600');
        showMiniNotification('📤 Membuka WhatsApp...', 'info');
    }

    // Fungsi untuk copy link berita dari halaman index
    function copyBeritaLink(url) {
        navigator.clipboard.writeText(url).then(function() {
            showMiniNotification('✅ Link berhasil disalin!', 'success');
        }).catch(function() {
            // Fallback untuk browser lama
            const textArea = document.createElement('textarea');
            textArea.value = url;
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                showMiniNotification('✅ Link berhasil disalin!', 'success');
            } catch (err) {
                showMiniNotification('❌ Gagal menyalin link', 'error');
            }
            document.body.removeChild(textArea);
        });
    }

    // Fungsi untuk menampilkan notifikasi mini
    function showMiniNotification(message, type) {
        // Hapus notifikasi yang sudah ada
        const existingNotification = document.querySelector('.mini-notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        // Tentukan warna berdasarkan type
        let bgColor = '#3b82f6'; // blue
        if (type === 'success') {
            bgColor = '#10b981'; // green
        } else if (type === 'error') {
            bgColor = '#ef4444'; // red
        }

        // Buat elemen notifikasi
        const notification = document.createElement('div');
        notification.className = 'mini-notification';
        notification.innerHTML = `
            <div style="position: fixed; bottom: 20px; right: 20px; background-color: ${bgColor}; color: white; padding: 12px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 99999; font-family: 'Inter', Arial, sans-serif; font-size: 14px; font-weight: 500; animation: slideUp 0.3s ease-out; max-width: 300px;">
                ${message}
            </div>
        `;

        // Tambahkan animasi CSS jika belum ada
        if (!document.querySelector('style[data-mini-notification]')) {
            const style = document.createElement('style');
            style.setAttribute('data-mini-notification', '');
            style.textContent = `
                @keyframes slideUp {
                    from {
                        transform: translateY(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateY(0);
                        opacity: 1;
                    }
                }
                @keyframes slideDown {
                    from {
                        transform: translateY(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateY(100%);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }

        document.body.appendChild(notification);

        // Hapus notifikasi setelah 3 detik
        setTimeout(function() {
            if (notification.parentNode) {
                notification.firstElementChild.style.animation = 'slideDown 0.3s ease-in forwards';
                setTimeout(function() {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }
        }, 3000);
    }
</script>
@endpush
