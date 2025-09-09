<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Agenda') }}
            </h2>
            <nav class="text-sm text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-gray-700">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="{{ route('admin.agenda.index') }}" class="hover:text-gray-700">Agenda</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Edit Agenda</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Form Edit Agenda</h3>
                            
                            <form action="{{ route('admin.agenda.update', $agenda) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-6">
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Judul Agenda <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('title') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $agenda->title) }}" 
                                           placeholder="Masukkan judul agenda..."
                                           required>
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-sm text-gray-500">
                                        Gunakan kata kunci seperti "Agenda", "Rapat", "Kegiatan", "Jadwal", atau "Acara" untuk kategori otomatis.
                                    </p>
                                </div>

                                <div class="mb-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Deskripsi Kegiatan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('description') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}" 
                                              id="description" 
                                              name="description" 
                                              rows="5" 
                                              placeholder="Masukkan deskripsi agenda (minimal 10 karakter)..."
                                              required>{{ old('description', $agenda->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-sm text-gray-500">
                                        Deskripsi kegiatan wajib diisi dan akan ditampilkan di halaman detail agenda.
                                    </p>
                                </div>

                                <!-- Current File Info -->
                                @if($agenda->file_path)
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">File Saat Ini</label>
                                        <div class="bg-blue-50 border border-blue-200 rounded-md p-4 flex items-center justify-between">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <div>
                                                    <div class="font-medium text-gray-900">{{ basename($agenda->file_path) }}</div>
                                                    @php
                                                        $filePath = public_path('storage/' . $agenda->file_path);
                                                        $fileSize = file_exists($filePath) ? filesize($filePath) : null;
                                                        $fileSizeFormatted = $fileSize ? number_format($fileSize / 1024, 1) . ' KB' : null;
                                                        if ($fileSize && $fileSize > 1024 * 1024) {
                                                            $fileSizeFormatted = number_format($fileSize / (1024 * 1024), 1) . ' MB';
                                                        }
                                                    @endphp
                                                    @if($fileSizeFormatted)
                                                        <div class="text-sm text-gray-500">Ukuran: {{ $fileSizeFormatted }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.agenda.download', $agenda) }}" 
                                                   class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                                   title="Unduh File">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </a>
                                                <a href="{{ asset('storage/' . $agenda->file_path) }}" 
                                                   target="_blank" 
                                                   class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                   title="Lihat File">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-6">
                                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                        @if($agenda->file_path)
                                            Ganti File Agenda 
                                            <span class="text-sm text-gray-500 font-normal">(opsional)</span>
                                        @else
                                            File Agenda 
                                            <span class="text-sm text-gray-500 font-normal">(opsional)</span>
                                        @endif
                                    </label>
                                    <input type="file" 
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 {{ $errors->has('file') ? 'border-red-300' : '' }}" 
                                           id="file" 
                                           name="file"
                                           accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                                    @error('file')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-sm text-gray-500">
                                        @if($agenda->file_path)
                                            Kosongkan jika tidak ingin mengubah file yang ada. 
                                        @endif
                                        Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Maksimal 10MB. File bersifat opsional.
                                    </p>
                                </div>

                                <div class="flex space-x-3">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        Update Agenda
                                    </button>
                                    <a href="{{ route('admin.agenda.show', $agenda) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat Detail
                                    </a>
                                    <a href="{{ route('admin.agenda.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                        Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Info Agenda -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-blue-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Informasi Agenda
                            </h3>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-600">Dibuat:</span>
                                    <span class="text-gray-900">{{ $agenda->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                @if($agenda->updated_at != $agenda->created_at)
                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-600">Diperbarui:</span>
                                        <span class="text-gray-900">{{ $agenda->updated_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-600">Status File:</span>
                                    <span>
                                        @if($agenda->file_path)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Ada File
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Tidak Ada
                                            </span>
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-600">Kategori:</span>
                                    <span>
                                        @php
                                            $isAgenda = str_contains(strtolower($agenda->title), 'agenda');
                                            $isRapat = str_contains(strtolower($agenda->title), 'rapat');
                                            $isKegiatan = str_contains(strtolower($agenda->title), 'kegiatan');
                                            $isJadwal = str_contains(strtolower($agenda->title), 'jadwal');
                                            $isAcara = str_contains(strtolower($agenda->title), 'acara');
                                            
                                            $badgeClass = 'bg-blue-100 text-blue-800';
                                            $badgeText = 'Agenda';
                                            
                                            if ($isRapat) {
                                                $badgeClass = 'bg-green-100 text-green-800';
                                                $badgeText = 'Rapat';
                                            } elseif ($isKegiatan) {
                                                $badgeClass = 'bg-purple-100 text-purple-800';
                                                $badgeText = 'Kegiatan';
                                            } elseif ($isJadwal) {
                                                $badgeClass = 'bg-yellow-100 text-yellow-800';
                                                $badgeText = 'Jadwal';
                                            } elseif ($isAcara) {
                                                $badgeClass = 'bg-indigo-100 text-indigo-800';
                                                $badgeText = 'Acara';
                                            }
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                            {{ $badgeText }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preview -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Preview
                            </h3>
                            
                            <div id="preview-content">
                                <h4 class="font-bold text-gray-900" id="preview-title">{{ $agenda->title }}</h4>
                                <p class="text-sm text-gray-700 mt-2" id="preview-description">
                                    {{ $agenda->description ?: 'Tidak ada deskripsi' }}
                                </p>
                                <div id="preview-file" class="text-sm text-gray-600 mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    @if($agenda->file_path)
                                        {{ basename($agenda->file_path) }}
                                    @else
                                        Belum ada file dipilih
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Live preview
            const titleInput = document.getElementById('title');
            const descriptionInput = document.getElementById('description');
            const fileInput = document.getElementById('file');
            
            const previewTitle = document.getElementById('preview-title');
            const previewDescription = document.getElementById('preview-description');
            const previewFile = document.getElementById('preview-file');

            // Title preview
            titleInput.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    previewTitle.textContent = this.value;
                } else {
                    previewTitle.textContent = '{{ $agenda->title }}';
                }
            });

            // Description preview
            descriptionInput.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    previewDescription.textContent = this.value.substring(0, 100) + (this.value.length > 100 ? '...' : '');
                } else {
                    previewDescription.textContent = '{{ $agenda->description ?: "Tidak ada deskripsi" }}';
                }
            });

            // File preview
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    const fileName = file.name;
                    const fileSize = (file.size / 1024 / 1024).toFixed(2); // MB
                    
                    previewFile.innerHTML = `
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        ${fileName} (${fileSize} MB) - File Baru
                    `;
                    previewFile.classList.remove('text-gray-600');
                    previewFile.classList.add('text-green-600');
                } else {
                    previewFile.innerHTML = `
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        @if($agenda->file_path)
                            {{ basename($agenda->file_path) }}
                        @else
                            Belum ada file dipilih
                        @endif
                    `;
                    previewFile.classList.remove('text-green-600');
                    previewFile.classList.add('text-gray-600');
                }
            });

            // File size validation
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    const maxSize = 10 * 1024 * 1024; // 10MB in bytes
                    
                    if (file.size > maxSize) {
                        alert('Ukuran file terlalu besar! Maksimal 10MB.');
                        this.value = '';
                        previewFile.innerHTML = `
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            @if($agenda->file_path)
                                {{ basename($agenda->file_path) }}
                            @else
                                Belum ada file dipilih
                            @endif
                        `;
                        previewFile.classList.remove('text-green-600');
                        previewFile.classList.add('text-gray-600');
                    }
                }
            });
        });
    </script>
</x-app-layout>
            <!-- Info Agenda -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-info-circle me-1"></i>
                    Informasi Agenda
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td width="40%" class="fw-bold">Dibuat:</td>
                            <td>{{ $agenda->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @if($agenda->updated_at != $agenda->created_at)
                            <tr>
                                <td class="fw-bold">Diperbarui:</td>
                                <td>{{ $agenda->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="fw-bold">Status File:</td>
                            <td>
                                @if($agenda->file_path)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i>Ada File
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-times me-1"></i>Tidak Ada
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Kategori:</td>
                            <td>
                                @php
                                    $isAgenda = str_contains(strtolower($agenda->title), 'agenda');
                                    $isRapat = str_contains(strtolower($agenda->title), 'rapat');
                                    $isKegiatan = str_contains(strtolower($agenda->title), 'kegiatan');
                                    $isJadwal = str_contains(strtolower($agenda->title), 'jadwal');
                                    $isAcara = str_contains(strtolower($agenda->title), 'acara');
                                    
                                    $badgeClass = 'bg-primary';
                                    $badgeText = 'Agenda';
                                    
                                    if ($isRapat) {
                                        $badgeClass = 'bg-success';
                                        $badgeText = 'Rapat';
                                    } elseif ($isKegiatan) {
                                        $badgeClass = 'bg-purple';
                                        $badgeText = 'Kegiatan';
                                    } elseif ($isJadwal) {
                                        $badgeClass = 'bg-warning';
                                        $badgeText = 'Jadwal';
                                    } elseif ($isAcara) {
                                        $badgeClass = 'bg-info';
                                        $badgeText = 'Acara';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $badgeText }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Preview -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <i class="fas fa-eye me-1"></i>
                    Preview Perubahan
                </div>
                <div class="card-body">
                    <div id="preview-content">
                        <h6 class="fw-bold" id="preview-title">{{ $agenda->title }}</h6>
                        <p class="small" id="preview-description">
                            {{ $agenda->description ?: 'Tidak ada deskripsi' }}
                        </p>
                        <div id="preview-file" class="small">
                            @if($agenda->file_path)
                                <i class="fas fa-file me-1 text-success"></i>{{ basename($agenda->file_path) }}
                            @else
                                <i class="fas fa-file me-1 text-muted"></i>Belum ada file dipilih
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-purple {
        background-color: #6f42c1 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Live preview
        const titleInput = document.getElementById('title');
        const descriptionInput = document.getElementById('description');
        const fileInput = document.getElementById('file');
        
        const previewTitle = document.getElementById('preview-title');
        const previewDescription = document.getElementById('preview-description');
        const previewFile = document.getElementById('preview-file');

        // Store original values
        const originalFileText = previewFile.innerHTML;

        // Title preview
        titleInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                previewTitle.textContent = this.value;
            } else {
                previewTitle.textContent = '{{ $agenda->title }}';
            }
        });

        // Description preview
        descriptionInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                previewDescription.textContent = this.value.substring(0, 100) + (this.value.length > 100 ? '...' : '');
            } else {
                previewDescription.textContent = '{{ $agenda->description ?: "Tidak ada deskripsi" }}';
            }
        });

        // File preview
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2); // MB
                
                previewFile.innerHTML = `<i class="fas fa-file me-1 text-success"></i>${fileName} (${fileSize} MB) <small class="text-success">[File Baru]</small>`;
            } else {
                previewFile.innerHTML = originalFileText;
            }
        });

        // File size validation
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];
                const maxSize = 10 * 1024 * 1024; // 10MB in bytes
                
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar! Maksimal 10MB.');
                    this.value = '';
                    previewFile.innerHTML = originalFileText;
                }
            }
        });
    });
</script>
@endpush