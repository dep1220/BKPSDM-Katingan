<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Agenda') }}
        </h2>
    </x-slot>

    <div>
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
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
                                <svg class="w-5 h-5 mr-2 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Daftar Agenda
                            </h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 w-fit">
                                {{ $agenda->total() }} Total
                                @if(request('search') || request('month') || request('year'))
                                    <span class="hidden sm:inline ml-1 text-blue-600">• Hasil filter</span>
                                @endif
                            </span>
                        </div>
                        <!-- Tambah Button - Mobile Full Width -->
                        <div class="w-full sm:w-auto">
                            <a href="{{ route('admin.agenda.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span class="sm:hidden">Tambah Agenda Baru</span>
                                <span class="hidden sm:inline">Tambah Agenda</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Search and Filter Section -->
                    <form method="GET" action="{{ route('admin.agenda.index') }}" class="flex flex-col gap-3" id="filterForm">
                        <!-- Search Input -->
                        <div class="relative flex-1 sm:max-w-md">
                            <input type="text" 
                                   name="search" 
                                   id="searchInput"
                                   value="{{ request('search') }}" 
                                   placeholder="Cari judul agenda..." 
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
                        
                        <!-- Filter Row -->
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="flex-1 sm:max-w-xs">
                                <select name="month" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                    <option value="">Semua Bulan</option>
                                    @foreach($months as $num => $name)
                                        <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-1 sm:max-w-xs">
                                <select name="year" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                    <option value="">Semua Tahun</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-md transition-colors duration-200 text-sm">
                                    Filter
                                </button>
                                @if(request('search') || request('month') || request('year'))
                                    <a href="{{ route('admin.agenda.index') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    
                    @if(request('search') || request('month') || request('year'))
                        <div class="sm:hidden">
                            <p class="text-sm text-blue-600">
                                @if(request('search'))
                                    Hasil pencarian untuk "{{ request('search') }}"
                                @endif
                                @if(request('month') || request('year'))
                                    @if(request('search')) • @endif
                                    Filter: 
                                    @if(request('month')){{ $months[request('month')] }}@endif
                                    @if(request('year')){{ request('month') ? ' ' : '' }}{{ request('year') }}@endif
                                @endif
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Mobile Card View -->
                <div class="block sm:hidden space-y-4">
                    @forelse ($agenda as $item)
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900 mb-1 line-clamp-2">{{ $item->title }}</h3>
                                    @if($item->description)
                                        <p class="text-xs text-gray-500 mb-2 line-clamp-2">{{ Str::limit(strip_tags($item->description), 80) }}</p>
                                    @endif
                                    
                                    <div class="flex items-center justify-between mb-2">
                                        @if($item->file_path)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                Ada File
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Tanpa File
                                            </span>
                                        @endif
                                        <span class="text-xs text-gray-500">{{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('admin.agenda.show', $item) }}" class="text-xs text-yellow-600 hover:text-yellow-900 font-medium">Lihat</a>
                                            <a href="{{ route('admin.agenda.edit', $item) }}" class="text-xs text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                            @if($item->file_path)
                                                <a href="{{ route('admin.agenda.download', $item) }}" class="text-xs text-green-600 hover:text-green-900 font-medium">Unduh</a>
                                            @endif
                                        </div>
                                        <form action="{{ route('admin.agenda.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda: {{ addslashes($item->title) }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 hover:text-red-900 font-medium">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="text-sm font-medium text-gray-900 mb-1">
                                @if(request('search') || request('month') || request('year'))
                                    Tidak ada agenda yang cocok
                                @else
                                    Belum ada agenda
                                @endif
                            </h3>
                            <p class="text-sm text-gray-500 mb-4">
                                @if(request('search') || request('month') || request('year'))
                                    Coba ubah filter atau kata kunci pencarian Anda.
                                @else
                                    Mulai dengan membuat agenda pertama Anda.
                                @endif
                            </p>
                            @if(!request('search') && !request('month') && !request('year'))
                                <a href="{{ route('admin.agenda.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    Buat Agenda Pertama
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Agenda</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($agenda as $key => $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $agenda->firstItem() + $key }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="h-10 w-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($item->title, 50) }}</div>
                                                @if($item->description)
                                                    <div class="text-sm text-gray-500 mt-1">{{ Str::limit(strip_tags($item->description), 80) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($item->file_path)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                Ada
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Tidak Ada
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('admin.agenda.show', $item) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors">Lihat</a>
                                            <a href="{{ route('admin.agenda.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors">Edit</a>
                                            @if($item->file_path)
                                                <a href="{{ route('admin.agenda.download', $item) }}" class="text-green-600 hover:text-green-900 transition-colors">Unduh</a>
                                            @endif
                                            <form action="{{ route('admin.agenda.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda: {{ addslashes($item->title) }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="text-gray-500">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                @if(request('search') || request('month') || request('year'))
                                                    Tidak ada agenda yang cocok
                                                @else
                                                    Belum Ada Agenda
                                                @endif
                                            </h3>
                                            <p class="mt-1 text-sm text-gray-500">
                                                @if(request('search') || request('month') || request('year'))
                                                    Coba ubah filter atau kata kunci pencarian Anda.
                                                @else
                                                    Mulai dengan menambahkan agenda baru.
                                                @endif
                                            </p>
                                            @if(!request('search') && !request('month') && !request('year'))
                                                <div class="mt-6">
                                                    <a href="{{ route('admin.agenda.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                        </svg>
                                                        Tambah Agenda
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if ($agenda->hasPages())
                    <div class="mt-6">
                        {{ $agenda->withQueryString()->links() }}
                    </div>
                @endif

                <!-- Statistics -->
                @if($agenda->count() > 0)
                    <div class="mt-4 text-sm text-gray-500">
                        Menampilkan {{ $agenda->count() }} dari {{ $agenda->total() }} agenda
                        @if(request('search') || request('month') || request('year'))
                            (hasil filter)
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterForm = document.getElementById('filterForm');
            let searchTimeout;

            // Auto-submit form on input with debounce
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    filterForm.submit();
                }, 700); // Wait 700ms after user stops typing
            });

            // Submit on Enter key
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    filterForm.submit();
                }
            });
        });

        // Clear search function
        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterForm').submit();
        }
    </script>
</x-app-layout>
