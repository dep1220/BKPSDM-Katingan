<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Berita') }}
        </h2>
    </x-slot>

    <div>
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 sm:p-6 text-gray-900">
                <!-- Search and Header Section -->
                <div class="mb-6 flex flex-col gap-4">
                    <!-- Header Mobile/Desktop -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                                Daftar Berita
                            </h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 w-fit">
                                {{ $beritas->total() }} Total
                                @if(request('search'))
                                    <span class="hidden sm:inline ml-1 text-blue-600">• Hasil pencarian</span>
                                @endif
                            </span>
                        </div>
                        <!-- Tambah Button - Mobile Full Width -->
                        <div class="w-full sm:w-auto">
                            <a href="{{ route('beritas.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span class="sm:hidden">Tambah Berita Baru</span>
                                <span class="hidden sm:inline">Tambah Berita</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Search Section -->
                    <form method="GET" action="{{ route('beritas.index') }}" class="flex flex-col sm:flex-row gap-3" id="searchForm">
                        <div class="relative flex-1 sm:max-w-md">
                            <input type="text" 
                                   name="search" 
                                   id="searchInput"
                                   value="{{ request('search') }}" 
                                   placeholder="Cari judul berita atau penulis..." 
                                   class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            @if(request('search'))
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" 
                                            onclick="clearSearch()" 
                                            class="text-gray-400 hover:text-gray-600">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                        @if(request('search'))
                            <div class="flex gap-2">
                                <a href="{{ route('beritas.index') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Reset
                                </a>
                            </div>
                        @endif
                    </form>
                    
                    @if(request('search'))
                        <div class="sm:hidden">
                            <p class="text-sm text-blue-600">Hasil pencarian untuk "{{ request('search') }}"</p>
                        </div>
                    @endif
                </div>

                <!-- Mobile Card View -->
                <div class="block sm:hidden space-y-4">
                    @forelse ($beritas as $berita)
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-start space-x-3">
                                @if($berita->thumbnail)
                                    <img class="h-16 w-16 rounded-lg object-cover flex-shrink-0" 
                                         src="{{ asset('storage/' . $berita->thumbnail) }}" 
                                         alt="Thumbnail">
                                @else
                                    <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900 mb-1 line-clamp-2">{{ $berita->title }}</h3>
                                    <p class="text-xs text-gray-500 mb-2 line-clamp-2">{{ Str::limit(strip_tags($berita->content), 80) }}</p>
                                    
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            @if($berita->kategori === \App\Enums\BeritaKategori::PENGUMUMAN)
                                                bg-purple-100 text-purple-800
                                            @elseif($berita->kategori === \App\Enums\BeritaKategori::BERITA_UTAMA)
                                                bg-red-100 text-red-800
                                            @else
                                                bg-blue-100 text-blue-800
                                            @endif">
                                            {{ $berita->kategori->label() }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $berita->status == \App\Enums\BeritaStatus::PUBLISHED ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            <div class="w-1.5 h-1.5 rounded-full mr-1 {{ $berita->status == \App\Enums\BeritaStatus::PUBLISHED ? 'bg-green-400' : 'bg-yellow-400' }}"></div>
                                            {{ $berita->status->label() }}
                                        </span>
                                    </div>
                                    
                                    @if($berita->lampiran_file)
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/' . $berita->lampiran_file) }}" 
                                               target="_blank"
                                               class="inline-flex items-center text-xs text-blue-600 hover:text-blue-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                </svg>
                                                Unduh Lampiran
                                            </a>
                                        </div>
                                    @endif
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center text-xs text-gray-500">
                                            <div class="h-5 w-5 rounded-full bg-gray-300 flex items-center justify-center mr-2">
                                                <span class="text-xs font-medium text-gray-700">{{ substr($berita->user->name, 0, 1) }}</span>
                                            </div>
                                            {{ $berita->user->name }}
                                            <span class="ml-2">{{ $berita->created_at->format('d M Y') }}</span>
                                        </div>
                                        
                                        <div class="flex space-x-3">
                                            <a href="{{ route('beritas.edit', $berita) }}" 
                                               class="text-blue-600 hover:text-blue-900 underline text-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('beritas.destroy', $berita) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 underline text-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <h3 class="text-sm font-medium text-gray-900 mb-1">
                                @if(request('search'))
                                    Tidak ada berita yang cocok
                                @else
                                    Belum ada berita
                                @endif
                            </h3>
                            <p class="text-sm text-gray-500 mb-4">
                                @if(request('search'))
                                    Coba ubah kata kunci pencarian Anda.
                                @else
                                    Mulai dengan membuat berita pertama Anda.
                                @endif
                            </p>
                            @if(!request('search'))
                                <a href="{{ route('beritas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    Buat Berita Pertama
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>

                <!-- Desktop Table View -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berita</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($beritas as $berita)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($berita->thumbnail)
                                                <img class="h-12 w-12 rounded-lg object-cover mr-4" src="{{ asset('storage/' . $berita->thumbnail) }}" alt="Thumbnail">
                                            @else
                                                <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center mr-4">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($berita->title, 40) }}</div>
                                                <div class="text-sm text-gray-500">{{ Str::limit(strip_tags($berita->content), 60) }}</div>
                                                @if($berita->lampiran_file)
                                                    <div class="mt-1">
                                                        <a href="{{ asset('storage/' . $berita->lampiran_file) }}" 
                                                           target="_blank"
                                                           class="inline-flex items-center text-xs text-blue-600 hover:text-blue-800">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                            </svg>
                                                            Unduh Lampiran
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($berita->kategori === \App\Enums\BeritaKategori::PENGUMUMAN)
                                                bg-purple-100 text-purple-800
                                            @elseif($berita->kategori === \App\Enums\BeritaKategori::BERITA_UTAMA)
                                                bg-red-100 text-red-800
                                            @else
                                                bg-blue-100 text-blue-800
                                            @endif">
                                            {{ $berita->kategori->label() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center mr-3">
                                                <span class="text-xs font-medium text-gray-700">{{ substr($berita->user->name, 0, 2) }}</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $berita->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $berita->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $berita->status == \App\Enums\BeritaStatus::PUBLISHED ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            <div class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $berita->status == \App\Enums\BeritaStatus::PUBLISHED ? 'bg-green-400' : 'bg-yellow-400' }}"></div>
                                            {{ $berita->status->label() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <div>{{ $berita->created_at->format('d M Y') }}</div>
                                        <div class="text-xs">{{ $berita->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('beritas.edit', $berita) }}" 
                                               class="text-blue-600 hover:text-blue-900 underline">
                                                Edit
                                            </a>
                                            <form action="{{ route('beritas.destroy', $berita) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                            </svg>
                                            <h3 class="text-sm font-medium text-gray-900 mb-1">
                                                @if(request('search'))
                                                    Tidak ada berita yang cocok
                                                @else
                                                    Belum ada berita
                                                @endif
                                            </h3>
                                            <p class="text-sm text-gray-500 mb-4">
                                                @if(request('search'))
                                                    Coba ubah kata kunci pencarian Anda.
                                                @else
                                                    Mulai dengan membuat berita pertama Anda.
                                                @endif
                                            </p>
                                            @if(!request('search'))
                                                <a href="{{ route('beritas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                                    Buat Berita Pertama
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if ($beritas->hasPages())
                    <div class="mt-6">
                        {{ $beritas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchForm = document.getElementById('searchForm');
            let searchTimeout;

            // Auto-submit form on input with debounce
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    searchForm.submit();
                }, 700); // Wait 700ms after user stops typing
            });

            // Submit on Enter key
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    searchForm.submit();
                }
            });
        });

        // Clear search function
        function clearSearch() {
            window.location.href = "{{ route('beritas.index') }}";
        }
    </script>
</x-app-layout>
