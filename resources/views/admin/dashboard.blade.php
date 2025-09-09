<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:p-6">
        {{-- Welcome Message --}}
        <div class="mb-6 sm:mb-8">
            <h3 class="text-xl sm:text-2xl font-semibold text-gray-700">Selamat Datang Kembali, {{ Auth::user()->name }}!</h3>
            <p class="text-sm sm:text-base text-gray-500 mt-1">Berikut adalah ringkasan aktivitas di website BKPSDM Katingan.</p>
        </div>

        {{-- Stat Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 sm:gap-6 mb-6 sm:mb-8">
            <!-- Card: Total Berita -->
            <div class="flex items-center p-4 sm:p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="p-2 sm:p-3 mr-3 sm:mr-4 text-orange-500 bg-orange-100 rounded-full">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="mb-1 text-xs sm:text-sm font-medium text-gray-600 truncate">Total Berita</p>
                    <p class="text-xl sm:text-2xl font-semibold text-gray-700">{{ $beritaCount }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ $monthlyBeritaCount }} dalam 30 hari</p>
                </div>
            </div>
            <!-- Card: Total Galeri -->
            <div class="flex items-center p-4 sm:p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="p-2 sm:p-3 mr-3 sm:mr-4 text-green-500 bg-green-100 rounded-full">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="mb-1 text-xs sm:text-sm font-medium text-gray-600 truncate">Total Galeri</p>
                    <p class="text-xl sm:text-2xl font-semibold text-gray-700">{{ $galeriCount }}</p>
                    <p class="text-xs text-gray-500">Total gambar</p>
                </div>
            </div>
            <!-- Card: Total Agenda -->
            <div class="flex items-center p-4 sm:p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="p-2 sm:p-3 mr-3 sm:mr-4 text-teal-500 bg-teal-100 rounded-full">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="mb-1 text-xs sm:text-sm font-medium text-gray-600 truncate">Total Agenda</p>
                    <p class="text-xl sm:text-2xl font-semibold text-gray-700">{{ $agendaCount }}</p>
                    <p class="text-xs text-gray-500">Rapat & kegiatan</p>
                </div>
            </div>
            <!-- Card: Total Unduhan -->
            <div class="flex items-center p-4 sm:p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="p-2 sm:p-3 mr-3 sm:mr-4 text-blue-500 bg-blue-100 rounded-full">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="mb-1 text-xs sm:text-sm font-medium text-gray-600 truncate">Total Unduhan</p>
                    <p class="text-xl sm:text-2xl font-semibold text-gray-700">{{ $unduhanCount }}</p>
                    <p class="text-xs text-gray-500">Total dokumen</p>
                </div>
            </div>
            <!-- Card: Total Pengguna -->
            <div class="flex items-center p-4 sm:p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="p-2 sm:p-3 mr-3 sm:mr-4 text-purple-500 bg-purple-100 rounded-full">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197M15 21a6 6 0 006-6v-1a6 6 0 00-9-5.197"></path></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="mb-1 text-xs sm:text-sm font-medium text-gray-600 truncate">Total Pengguna</p>
                    <p class="text-xl sm:text-2xl font-semibold text-gray-700">{{ $userCount }}</p>
                    <p class="text-xs text-gray-500">Terdaftar</p>
                </div>
            </div>
        </div>

        {{-- Daftar Berita & Riwayat Aktivitas --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
            <!-- Berita Terbaru -->
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-200">
                    <h4 class="text-sm sm:text-base font-semibold text-gray-700 flex items-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span class="hidden sm:inline">Berita Terbaru</span>
                        <span class="sm:hidden">Berita</span>
                    </h4>
                    <a href="{{ route('beritas.index') }}" class="text-xs sm:text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
                </div>
                <div class="space-y-3">
                    @forelse ($latestBerita as $berita)
                        <div class="p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <div class="flex justify-between items-start">
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-800 text-xs sm:text-sm truncate">{{ Str::limit($berita->title, 35) }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <span class="hidden sm:inline">oleh {{ $berita->user->name }} • </span>
                                        {{ $berita->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <a href="{{ route('beritas.edit', $berita) }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium ml-3 flex-shrink-0">Edit</a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-500">
                            <svg class="w-8 h-8 sm:w-12 sm:h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <p class="text-xs sm:text-sm">Belum ada berita.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Riwayat Aktivitas -->
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-200">
                    <h4 class="text-sm sm:text-base font-semibold text-gray-700 flex items-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="hidden sm:inline">Riwayat Aktivitas ({{ $totalActivitiesCount }})</span>
                        <span class="sm:hidden">Aktivitas ({{ $totalActivitiesCount }})</span>
                    </h4>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">1 Bulan</span>
                </div>
                <div class="mb-3 p-2 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-xs text-blue-700">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="hidden sm:inline">Riwayat aktivitas otomatis terhapus setelah 1 bulan</span>
                        <span class="sm:hidden">Otomatis terhapus setelah 1 bulan</span>
                    </p>
                </div>
                <div class="space-y-3 max-h-60 sm:max-h-80 overflow-y-auto">
                    @forelse ($recentActivities as $activity)
                        <div class="flex items-start space-x-3 p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center justify-center w-6 h-6 sm:w-8 sm:h-8 rounded-full {{ $activity->action_badge }}">
                                    {!! $activity->action_icon !!}
                                </span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-gray-900 truncate">{{ $activity->description }}</p>
                                <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-500">
                            <svg class="w-8 h-8 sm:w-12 sm:h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-xs sm:text-sm">Belum ada aktivitas yang tercatat.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="mt-8 grid gap-4 md:grid-cols-3 lg:grid-cols-4">
            @role('super-admin|admin|penulis')
                <a href="{{ route('beritas.create') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="font-medium">Buat Berita</span>
                </a>
            @endrole

            @role('super-admin|admin')
                <a href="{{ route('galeri.create') }}" class="flex items-center p-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-medium">Tambah Galeri</span>
                </a>

                <a href="{{ route('admin.agenda.create') }}" class="flex items-center p-4 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-xl hover:from-teal-600 hover:to-teal-700 transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-medium">Buat Agenda</span>
                </a>

                <a href="{{ route('unduhan.create') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                    </svg>
                    <span class="font-medium">Upload Dokumen</span>
                </a>

                <a href="{{ route('kontak.index') }}" class="flex items-center p-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-medium">Pesan Masuk</span>
                </a>
            @endrole
        </div>
    </div>
</x-app-layout>
