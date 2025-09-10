<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Visi & Misi') }}
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
                <!-- Header Section -->
                <div class="mb-6 flex flex-col gap-4">
                    <!-- Header Mobile/Desktop -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-pink-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                Daftar Visi & Misi
                            </h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 w-fit">
                                {{ $visiMisi->total() }} Total
                            </span>
                        </div>
                        <!-- Tambah Button - Mobile Full Width -->
                        <div class="w-full sm:w-auto">
                            <a href="{{ route('admin.visi-misi.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span class="sm:hidden">Tambah Visi & Misi Baru</span>
                                <span class="hidden sm:inline">Tambah Visi & Misi</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile Card View -->
                <div class="block sm:hidden space-y-4">
                    @forelse ($visiMisi as $item)
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-lg bg-purple-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900 mb-1 line-clamp-2">{{ Str::limit($item->visi, 80) }}</h3>
                                    <p class="text-xs text-gray-500 mb-2">{{ count($item->misi) }} misi</p>
                                    
                                    <div class="flex items-center justify-between mb-2">
                                        @if($item->is_active)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <div class="w-1.5 h-1.5 rounded-full mr-1 bg-green-400"></div>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <div class="w-1.5 h-1.5 rounded-full mr-1 bg-gray-400"></div>
                                                Tidak Aktif
                                            </span>
                                        @endif
                                        <span class="text-xs text-gray-500">{{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('admin.visi-misi.show', $item) }}" class="text-xs text-yellow-600 hover:text-yellow-900 font-medium">Lihat</a>
                                            <a href="{{ route('admin.visi-misi.edit', $item) }}" class="text-xs text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                            @if($item->is_active)
                                                <form action="{{ route('admin.visi-misi.deactivate', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-xs text-orange-600 hover:text-orange-900 font-medium" onclick="return confirm('Nonaktifkan visi misi ini?')">
                                                        Nonaktifkan
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.visi-misi.activate', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-xs text-green-600 hover:text-green-900 font-medium" onclick="return confirm('Aktifkan visi misi ini? Visi misi yang sedang aktif akan dinonaktifkan.')">
                                                        Aktifkan
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <form action="{{ route('admin.visi-misi.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus visi misi ini?')">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                            <h3 class="text-sm font-medium text-gray-900 mb-1">Belum Ada Visi & Misi</h3>
                            <p class="text-sm text-gray-500 mb-4">Mulai dengan membuat visi & misi pertama Anda.</p>
                            <a href="{{ route('admin.visi-misi.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Buat Visi & Misi Pertama
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Desktop Table View -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visi & Misi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($visiMisi as $key => $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $visiMisi->firstItem() + $key }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="h-10 w-10 rounded-lg bg-pink-100 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-pink-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="text-sm font-medium text-gray-900 mb-1">{{ Str::limit($item->visi, 60) }}</div>
                                                <div class="text-sm text-gray-500">
                                                    <span class="inline-flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                        {{ count($item->misi) }} misi
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($item->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <div class="w-1.5 h-1.5 rounded-full mr-1.5 bg-green-400"></div>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <div class="w-1.5 h-1.5 rounded-full mr-1.5 bg-gray-400"></div>
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>{{ $item->created_at->format('d M Y') }}</div>
                                        <div class="text-xs">{{ $item->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('admin.visi-misi.show', $item) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors">Lihat</a>
                                            <a href="{{ route('admin.visi-misi.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors">Edit</a>
                                            @if($item->is_active)
                                                <form action="{{ route('admin.visi-misi.deactivate', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-orange-600 hover:text-orange-900 transition-colors" onclick="return confirm('Nonaktifkan visi misi ini?')">
                                                        Nonaktifkan
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.visi-misi.activate', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:text-green-900 transition-colors" onclick="return confirm('Aktifkan visi misi ini? Visi misi yang sedang aktif akan dinonaktifkan.')">
                                                        Aktifkan
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.visi-misi.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus visi misi ini?')">
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
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum Ada Visi & Misi</h3>
                                            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan visi & misi baru.</p>
                                            <div class="mt-6">
                                                <a href="{{ route('admin.visi-misi.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    Tambah Visi & Misi
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if ($visiMisi->hasPages())
                    <div class="mt-6">
                        {{ $visiMisi->links() }}
                    </div>
                @endif

                <!-- Statistics -->
                @if($visiMisi->count() > 0)
                    <div class="mt-4 text-sm text-gray-500">
                        Menampilkan {{ $visiMisi->count() }} dari {{ $visiMisi->total() }} visi & misi
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
