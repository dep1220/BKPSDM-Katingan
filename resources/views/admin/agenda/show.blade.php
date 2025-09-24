<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Agenda') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <!-- Header Actions -->
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-semibold text-gray-900">Detail Agenda</h3>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.agenda.edit', $agenda) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg text-orange-600 bg-orange-50 border border-orange-200 hover:bg-orange-100 transition duration-150 ease-in-out">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                @if($agenda->file_path)
                                    <a href="{{ route('admin.agenda.download', $agenda) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg text-green-600 bg-green-50 border border-green-200 hover:bg-green-100 transition duration-150 ease-in-out">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Unduh File
                                    </a>
                                @endif
                                <button type="button" onclick="openDeleteModal()" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg text-red-600 bg-red-50 border border-red-200 hover:bg-red-100 transition duration-150 ease-in-out">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </div>

                    </div>
                    
                    <div class="p-6">
                        <!-- Kategori Badge -->
                        <div class="mb-4">
                            @php
                                $isAgenda = str_contains(strtolower($agenda->title), 'agenda');
                                $isRapat = str_contains(strtolower($agenda->title), 'rapat');
                                $isKegiatan = str_contains(strtolower($agenda->title), 'kegiatan');
                                $isJadwal = str_contains(strtolower($agenda->title), 'jadwal');
                                $isAcara = str_contains(strtolower($agenda->title), 'acara');
                                $isSosialisasi = str_contains(strtolower($agenda->title), 'sosialisasi');
                                
                                $badgeClass = 'bg-blue-100 text-blue-800 border-blue-200';
                                $badgeText = 'Agenda';
                                
                                if ($isRapat) {
                                    $badgeClass = 'bg-green-100 text-green-800 border-green-200';
                                    $badgeText = 'Rapat';
                                } elseif ($isKegiatan) {
                                    $badgeClass = 'bg-purple-100 text-purple-800 border-purple-200';
                                    $badgeText = 'Kegiatan';
                                } elseif ($isJadwal) {
                                    $badgeClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                    $badgeText = 'Jadwal';
                                } elseif ($isAcara) {
                                    $badgeClass = 'bg-indigo-100 text-indigo-800 border-indigo-200';
                                    $badgeText = 'Acara';
                                } elseif ($isSosialisasi) {
                                    $badgeClass = 'bg-pink-100 text-pink-800 border-pink-200';
                                    $badgeText = 'Sosialisasi';
                                }
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium border {{ $badgeClass }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $badgeText }}
                            </span>
                        </div>

                        <!-- Judul -->
                        <div class="mb-8">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $agenda->title }}</h1>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Kegiatan</h2>
                            <div class="text-gray-700 bg-gray-50 p-4 rounded-lg border">
                                {!! nl2br(e($agenda->description)) !!}
                            </div>
                        </div>

                        <!-- Jadwal -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Jadwal</h2>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Tanggal -->
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div>
                                            <div class="font-medium text-gray-900">Tanggal</div>
                                            <div class="text-sm text-gray-600">
                                                @if($agenda->start_date)
                                                    {{ $agenda->start_date->format('d F Y') }}
                                                    @if($agenda->end_date && $agenda->end_date != $agenda->start_date)
                                                        - {{ $agenda->end_date->format('d F Y') }}
                                                    @endif
                                                @else
                                                    <span class="text-gray-500">Belum diset</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Waktu -->
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            <div class="font-medium text-gray-900">Waktu</div>
                                            <div class="text-sm text-gray-600">
                                                @if($agenda->start_time)
                                                    {{ $agenda->start_time }}
                                                    @if($agenda->end_time)
                                                        - {{ $agenda->end_time }}
                                                    @endif
                                                    WIB
                                                @else
                                                    <span class="text-gray-500">Belum diset</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Status -->
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="font-medium text-gray-900">Status</span>
                                        </div>
                                        <div>
                                            @if($agenda->status)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $agenda->status->color() }}">
                                                    {{ $agenda->status->label() }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                    Belum diset
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- File Agenda -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">File Agenda</h2>
                            @if($agenda->file_path)
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-4">
                                            @php
                                                $extension = strtolower(pathinfo($agenda->file_path, PATHINFO_EXTENSION));
                                            @endphp
                                            @if($extension === 'pdf')
                                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            @elseif(in_array($extension, ['doc', 'docx']))
                                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-medium text-gray-900">{{ basename($agenda->file_path) }}</div>
                                            @php
                                                $filePath = public_path('storage/' . $agenda->file_path);
                                                $fileSize = file_exists($filePath) ? filesize($filePath) : null;
                                                $fileSizeFormatted = $fileSize ? number_format($fileSize / 1024, 1) . ' KB' : null;
                                                if ($fileSize && $fileSize > 1024 * 1024) {
                                                    $fileSizeFormatted = number_format($fileSize / (1024 * 1024), 1) . ' MB';
                                                }
                                                $extensionDisplay = strtoupper(pathinfo($agenda->file_path, PATHINFO_EXTENSION));
                                            @endphp
                                            <div class="text-sm text-gray-500">
                                                {{ $extensionDisplay }}
                                                @if($fileSizeFormatted)
                                                    • {{ $fileSizeFormatted }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 ml-4">
                                            <a href="{{ route('admin.agenda.download', $agenda) }}" 
                                               class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                Unduh
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-yellow-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        <span class="text-yellow-800">Belum ada file yang diupload untuk agenda ini.</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Navigasi -->
                        <div class="flex space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.agenda.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-gray-700 transition duration-150 ease-in-out">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Info Agenda -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-blue-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Agenda
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Dibuat:</span>
                                <span class="text-gray-900">{{ $agenda->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Waktu:</span>
                                <span class="text-gray-900">{{ $agenda->created_at->format('H:i') }}</span>
                            </div>
                            @if($agenda->updated_at != $agenda->created_at)
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="font-medium text-gray-600">Terakhir Diperbarui:</span>
                                    <span class="text-gray-900">{{ $agenda->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Tanggal Agenda:</span>
                                <span class="text-gray-900 text-sm">
                                    @if($agenda->start_date)
                                        {{ $agenda->start_date->format('d/m/Y') }}
                                        @if($agenda->end_date && $agenda->end_date != $agenda->start_date)
                                            - {{ $agenda->end_date->format('d/m/Y') }}
                                        @endif
                                    @else
                                        <span class="text-gray-500">Belum diset</span>
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Jam Agenda:</span>
                                <span class="text-gray-900 text-sm">
                                    @if($agenda->start_time)
                                        {{ $agenda->start_time }}
                                        @if($agenda->end_time)
                                            - {{ $agenda->end_time }}
                                        @endif
                                        WIB
                                    @else
                                        <span class="text-gray-500">Belum diset</span>
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Status Agenda:</span>
                                <span>
                                    @if($agenda->status)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $agenda->status->color() }}">
                                            {{ $agenda->status->label() }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Belum diset
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="font-medium text-gray-600">Status File:</span>
                                <span>
                                    @if($agenda->file_path)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Ada File
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Tidak Ada
                                        </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mt-4">Hapus Agenda</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus agenda ini? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                        <p class="font-semibold text-gray-900">{{ $agenda->title }}</p>
                    </div>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="deleteCancel" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-auto mr-2 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-150 ease-in-out">
                        Batal
                    </button>
                    <button id="deleteConfirm" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-auto hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 transition duration-150 ease-in-out">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        document.getElementById('deleteCancel').addEventListener('click', function() {
            document.getElementById('deleteModal').classList.add('hidden');
        });

        document.getElementById('deleteConfirm').addEventListener('click', function() {
            const deleteForm = document.createElement('form');
            deleteForm.method = 'POST';
            deleteForm.action = '{{ route("admin.agenda.destroy", $agenda) }}';
            deleteForm.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(deleteForm);
            deleteForm.submit();
        });

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('deleteModal').classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
