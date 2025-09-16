@extends('layouts.public')

@section('title', $berita->title)

@section('meta')
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
@endsection

@section('content')
    {{-- Content Protection Component --}}
    @include('components.content-protection')

    <div class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                {{-- Judul dan Meta Info --}}
                <div class="mb-6 md:mb-8">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight protected-content">{{ $berita->title }}</h1>
                    <div class="flex flex-col sm:flex-row sm:items-center text-sm text-gray-500 protected-content gap-1 sm:gap-0">
                        <span>Dipublikasikan pada {{ $berita->created_at->format('d F Y') }}</span>
                        <span class="hidden sm:inline mx-2">&bull;</span>
                        <span>Oleh: {{ $berita->user->name }}</span>
                    </div>
                </div>

                {{-- Tombol Share & Copy Link --}}
                <div class="mb-6 flex justify-start">
                    <div class="w-fit">
                        <h4 class="font-semibold text-gray-800 mb-3 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                            Bagikan Berita
                        </h4>

                        <div class="flex flex-wrap gap-2">
                            {{-- Tombol Copy Link --}}
                            <button onclick="copyLinkToClipboard()" class="inline-flex items-center justify-center px-3 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md text-xs">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <span class="hidden sm:inline">Salin</span>
                            </button>

                            {{-- Tombol Share WhatsApp --}}
                            <a href="https://wa.me/?text={{ urlencode($berita->title . ' - ' . request()->url()) }}" target="_blank" class="inline-flex items-center justify-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md text-xs">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"></path>
                                </svg>
                                <span class="hidden sm:inline">WA</span>
                            </a>

                            {{-- Tombol Share Facebook --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md text-xs">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
                                </svg>
                                <span class="hidden sm:inline">FB</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Gambar Utama / Preview File --}}
                <div class="mb-6 md:mb-8">
                    @if($berita->thumbnail)
                        <img src="{{ asset('storage/' . $berita->thumbnail) }}" 
                             alt="{{ $berita->title }}" 
                             class="w-full rounded-lg shadow-lg protected-content" 
                             draggable="false">
                    @elseif($berita->kategori === \App\Enums\BeritaKategori::PENGUMUMAN && $berita->lampiran_file)
                        {{-- Preview file untuk pengumuman tanpa thumbnail --}}
                        <div class="w-full bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg shadow-lg p-8 border-2 border-purple-200">
                            <div class="flex flex-col items-center justify-center text-center">
                                <img src="{{ $berita->getFilePreviewUrl() }}" 
                                     alt="Preview {{ $berita->getFileExtension() }} file" 
                                     class="w-32 h-40 object-contain mb-4">
                                <h3 class="text-lg font-semibold text-purple-800 mb-2">
                                    Dokumen {{ strtoupper($berita->getFileExtension()) }}
                                </h3>
                                <p class="text-purple-600 mb-4 text-sm">
                                    Klik tombol di bawah untuk mengunduh atau membuka dokumen
                                </p>
                                <a href="{{ asset('storage/' . $berita->lampiran_file) }}" 
                                   target="_blank"
                                   class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    {{ $berita->getFileIcon() }} Unduh/Buka File
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-lg shadow-lg flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-blue-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V8h2v9zm4 0h-2v-4h2v4z"/>
                                </svg>
                                <p class="text-blue-400 text-sm">Gambar tidak tersedia</p>
                            </div>
                        </div>
                    @endif
                    
                    {{-- Badge Kategori --}}
                    <div class="mt-4 flex justify-start">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($berita->kategori === \App\Enums\BeritaKategori::PENGUMUMAN)
                                bg-purple-100 text-purple-800
                            @elseif($berita->kategori === \App\Enums\BeritaKategori::BERITA_UTAMA)
                                bg-red-100 text-red-800
                            @else
                                bg-blue-100 text-blue-800
                            @endif">
                            {{ $berita->kategori->label() }}
                        </span>
                    </div>
                </div>

                {{-- Konten Artikel --}}
                <div class="prose max-w-none lg:prose-lg text-gray-700 protected-content" id="berita-content">
                    {!! $berita->content !!}
                </div>

                {{-- File Lampiran (jika ada dan ada thumbnail) --}}
                @if($berita->hasDownloadableFile() && $berita->thumbnail)
                    <div class="mt-8 p-6 bg-purple-50 border border-purple-200 rounded-lg">
                        <h3 class="text-lg font-semibold text-purple-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                            </svg>
                            File Lampiran
                        </h3>
                        <div class="flex items-center justify-between bg-white p-4 rounded-lg border border-purple-100">
                            <div class="flex items-center space-x-3">
                                <div class="text-2xl">{{ $berita->getFileIcon() }}</div>
                                <div>
                                    <p class="font-medium text-gray-900">
                                        Dokumen {{ strtoupper($berita->getFileExtension()) }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Klik untuk mengunduh atau membuka di tab baru
                                    </p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $berita->lampiran_file) }}" 
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-all duration-300 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Unduh/Buka
                            </a>
                        </div>
                    </div>
                @endif

                {{-- Tombol Kembali --}}
                <div class="mt-8 md:mt-12 border-t pt-6">
                    <a href="{{ route('public.berita') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300 text-sm md:text-base">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Kumpulan Berita
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Data berita untuk sharing
    const currentUrl = window.location.href;
    const beritaTitle = `{{ addslashes($berita->title) }}`;
    const beritaDescription = `{{ addslashes(Str::limit(html_entity_decode(strip_tags($berita->content)), 100)) }}`;

    // Fungsi copy link yang simpel
    function copyLinkToClipboard() {
        // Metode 1: Clipboard API modern
        if (navigator.clipboard) {
            navigator.clipboard.writeText(currentUrl).then(() => {
                showNotification('✅ Link berhasil disalin!', 'success');
            }).catch(() => {
                // Fallback ke metode lama
                copyWithFallback();
            });
        } else {
            copyWithFallback();
        }
    }

    // Fallback method untuk copy
    function copyWithFallback() {
        const textArea = document.createElement('textarea');
        textArea.value = currentUrl;
        textArea.style.position = 'absolute';
        textArea.style.left = '-9999px';
        document.body.appendChild(textArea);
        textArea.select();
        textArea.setSelectionRange(0, 99999);
        
        try {
            const successful = document.execCommand('copy');
            if (successful) {
                showNotification('✅ Link berhasil disalin!', 'success');
            } else {
                showNotification('❌ Gagal menyalin link', 'error');
            }
        } catch (err) {
            showNotification('❌ Gagal menyalin link', 'error');
        }
        
        document.body.removeChild(textArea);
    }

    // Fungsi share WhatsApp
    function shareWhatsApp() {
        const text = `*${beritaTitle}*\n\n${beritaDescription}\n\nBaca selengkapnya: ${currentUrl}`;
        const waUrl = `https://wa.me/?text=${encodeURIComponent(text)}`;
        
        window.open(waUrl, '_blank');
        showNotification('📱 Membuka WhatsApp...', 'info');
    }

    // Fungsi share Facebook
    function shareFacebook() {
        const fbUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;
        
        window.open(fbUrl, '_blank', 'width=600,height=400');
        showNotification('📘 Membuka Facebook...', 'info');
    }

    // Fungsi share Twitter
    function shareTwitter() {
        const text = `${beritaTitle} - ${beritaDescription}`;
        const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(currentUrl)}`;
        
        window.open(twitterUrl, '_blank', 'width=600,height=400');
        showNotification('🐦 Membuka Twitter...', 'info');
    }

    // Fungsi notifikasi sederhana
    function showNotification(message, type) {
        // Hapus notifikasi yang ada
        const existing = document.querySelector('.toast-notification');
        if (existing) existing.remove();

        // Buat notifikasi baru
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            font-size: 14px;
            font-weight: 500;
            max-width: 300px;
            animation: slideIn 0.3s ease-out;
        `;
        toast.textContent = message;

        // Tambahkan animasi CSS
        if (!document.querySelector('#toast-styles')) {
            const style = document.createElement('style');
            style.id = 'toast-styles';
            style.textContent = `
                @keyframes slideIn {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                @keyframes slideOut {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(100%); opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        }

        document.body.appendChild(toast);

        // Hapus setelah 3 detik
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease-in';
            setTimeout(() => {
                if (toast.parentNode) toast.parentNode.removeChild(toast);
            }, 300);
        }, 3000);
    }

    // Test fungsi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Share buttons ready
        
        // Test click event pada tombol pertama
        setTimeout(() => {
            // All share functions loaded successfully
        }, 1000);
    });
</script>
@endpush
