<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Agenda') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Form Tambah Agenda</h3>

                            <form action="{{ route('admin.agenda.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-6">
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Judul Agenda <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                           class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('title') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}"
                                           id="title"
                                           name="title"
                                           value="{{ old('title') }}"
                                           placeholder="Masukkan judul agenda..."
                                           required>
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-sm text-gray-500">
                                        Masukkan judul agenda yang jelas dan informatif.
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
                                              required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-sm text-gray-500">
                                        Deskripsi kegiatan wajib diisi dan akan ditampilkan di halaman detail agenda.
                                    </p>
                                </div>

                                <!-- Tanggal dan Waktu -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            Tanggal Mulai <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date"
                                               class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('start_date') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}"
                                               id="start_date"
                                               name="start_date"
                                               value="{{ old('start_date') }}"
                                               required>
                                        @error('start_date')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            Tanggal Selesai
                                        </label>
                                        <input type="date"
                                               class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('end_date') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}"
                                               id="end_date"
                                               name="end_date"
                                               value="{{ old('end_date') }}">
                                        @error('end_date')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-1 text-sm text-gray-500">
                                            Kosongkan jika agenda hanya berlangsung satu hari.
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">
                                            Jam Mulai
                                        </label>
                                        <input type="time"
                                               class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('start_time') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}"
                                               id="start_time"
                                               name="start_time"
                                               value="{{ old('start_time') }}">
                                        @error('start_time')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">
                                            Jam Selesai
                                        </label>
                                        <input type="time"
                                               class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('end_time') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}"
                                               id="end_time"
                                               name="end_time"
                                               value="{{ old('end_time') }}">
                                        @error('end_time')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                        Status Agenda <span class="text-red-500">*</span>
                                    </label>

                                    <!-- Peringatan Status Otomatis -->
                                    <div class="mb-3 p-3 bg-blue-50 border border-blue-200 rounded-md">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-blue-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div class="text-sm">
                                                <p class="font-medium text-blue-800">Status Agenda Otomatis</p>
                                                <p class="text-blue-700 mt-1">
                                                    Setelah agenda disimpan, status akan diperbarui otomatis berdasarkan waktu: <br>
                                                    <span class="font-medium">• Akan Datang:</span> Jika waktu mulai belum tiba <br>
                                                    <span class="font-medium">• Sedang Berlangsung:</span> Jika agenda sedang berlangsung <br>
                                                    <span class="font-medium">• Selesai:</span> Jika agenda sudah berakhir <br>
                                                    Anda hanya perlu mengubah status secara manual untuk <span class="font-medium text-red-600">pembatalan</span>.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <select class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('status') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}"
                                            id="status"
                                            name="status"
                                            required>
                                        <option value="">Pilih Status</option>
                                        @foreach(\App\Enums\AgendaStatus::options() as $value => $label)
                                            <option value="{{ $value }}" {{ old('status') === $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-sm text-gray-500">
                                        Status akan diperbarui otomatis berdasarkan tanggal dan waktu agenda yang Anda tentukan.
                                    </p>
                                </div>

                                <div class="mb-6">
                                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                        File Agenda
                                        <span class="text-sm text-gray-500 font-normal">(opsional)</span>
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
                                        Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Maksimal 5MB. File bersifat opsional.
                                    </p>
                                </div>

                                <div class="flex space-x-3">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        Simpan Agenda
                                    </button>
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
                    <!-- Panduan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-blue-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                Panduan Penggunaan
                            </h3>

                            <h4 class="font-semibold text-gray-900 mb-2">Contoh Judul Agenda:</h4>
                            <ul class="text-sm text-gray-600 space-y-1 mb-4">
                                <li>• Rapat Koordinasi Bulanan</li>
                                <li>• Pelatihan Pengembangan SDM</li>
                                <li>• Evaluasi Kinerja Tahunan</li>
                                <li>• Sosialisasi Kebijakan Baru</li>
                                <li>• Pertemuan Stakeholder</li>
                            </ul>

                            <h4 class="font-semibold text-gray-900 mb-2">Format File:</h4>
                            <div class="grid grid-cols-3 gap-2 text-xs">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">PDF</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">DOC</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">DOCX</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">XLS</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">XLSX</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">PPT</span>
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
                                <h4 class="font-bold text-gray-500" id="preview-title">Judul agenda akan muncul di sini...</h4>
                                <p class="text-sm text-gray-500 mt-2" id="preview-description">Deskripsi agenda akan muncul di sini...</p>

                                <div class="mt-3 space-y-2">
                                    <div id="preview-dates" class="text-sm text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span id="preview-date-text">Belum ada tanggal dipilih</span>
                                    </div>

                                    <div id="preview-times" class="text-sm text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span id="preview-time-text">Belum ada waktu dipilih</span>
                                    </div>

                                    <div id="preview-status" class="text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span id="preview-status-text" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Belum ada status dipilih
                                        </span>
                                    </div>
                                </div>

                                <div id="preview-file" class="text-sm text-gray-500 mt-3 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Belum ada file dipilih
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
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const startTimeInput = document.getElementById('start_time');
            const endTimeInput = document.getElementById('end_time');
            const statusInput = document.getElementById('status');

            const previewTitle = document.getElementById('preview-title');
            const previewDescription = document.getElementById('preview-description');
            const previewFile = document.getElementById('preview-file');
            const previewDateText = document.getElementById('preview-date-text');
            const previewTimeText = document.getElementById('preview-time-text');
            const previewStatusText = document.getElementById('preview-status-text');

            // Status color mapping
            const statusColors = {
                'upcoming': 'bg-blue-100 text-blue-800',
                'ongoing': 'bg-green-100 text-green-800',
                'completed': 'bg-gray-100 text-gray-800',
                'cancelled': 'bg-red-100 text-red-800'
            };

            const statusLabels = {
                'upcoming': 'Akan Datang',
                'ongoing': 'Sedang Berlangsung',
                'completed': 'Selesai',
                'cancelled': 'Dibatalkan'
            };

            // Title preview
            titleInput.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    previewTitle.textContent = this.value;
                    previewTitle.classList.remove('text-gray-500');
                    previewTitle.classList.add('text-gray-900');
                } else {
                    previewTitle.textContent = 'Judul agenda akan muncul di sini...';
                    previewTitle.classList.remove('text-gray-900');
                    previewTitle.classList.add('text-gray-500');
                }
            });

            // Description preview
            descriptionInput.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    previewDescription.textContent = this.value.substring(0, 100) + (this.value.length > 100 ? '...' : '');
                    previewDescription.classList.remove('text-gray-500');
                    previewDescription.classList.add('text-gray-700');
                } else {
                    previewDescription.textContent = 'Deskripsi agenda akan muncul di sini...';
                    previewDescription.classList.remove('text-gray-700');
                    previewDescription.classList.add('text-gray-500');
                }
            });

            // Date preview
            function updateDatePreview() {
                const startDate = startDateInput.value;
                const endDate = endDateInput.value;

                if (startDate) {
                    let dateText = formatDate(startDate);
                    if (endDate && endDate !== startDate) {
                        dateText += ' - ' + formatDate(endDate);
                    }
                    previewDateText.textContent = dateText;
                    previewDateText.parentElement.classList.remove('text-gray-500');
                    previewDateText.parentElement.classList.add('text-gray-700');
                } else {
                    previewDateText.textContent = 'Belum ada tanggal dipilih';
                    previewDateText.parentElement.classList.remove('text-gray-700');
                    previewDateText.parentElement.classList.add('text-gray-500');
                }
            }

            // Time preview
            function updateTimePreview() {
                const startTime = startTimeInput.value;
                const endTime = endTimeInput.value;

                if (startTime || endTime) {
                    let timeText = '';
                    if (startTime) {
                        timeText = startTime;
                        if (endTime) {
                            timeText += ' - ' + endTime;
                        }
                        timeText += ' WIB';
                    } else if (endTime) {
                        timeText = 'Selesai: ' + endTime + ' WIB';
                    }
                    previewTimeText.textContent = timeText;
                    previewTimeText.parentElement.classList.remove('text-gray-500');
                    previewTimeText.parentElement.classList.add('text-gray-700');
                } else {
                    previewTimeText.textContent = 'Belum ada waktu dipilih';
                    previewTimeText.parentElement.classList.remove('text-gray-700');
                    previewTimeText.parentElement.classList.add('text-gray-500');
                }
            }

            // Status preview
            statusInput.addEventListener('change', function() {
                if (this.value) {
                    const label = statusLabels[this.value] || this.value;
                    const colorClass = statusColors[this.value] || 'bg-gray-100 text-gray-800';

                    previewStatusText.textContent = label;
                    previewStatusText.className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${colorClass}`;
                } else {
                    previewStatusText.textContent = 'Belum ada status dipilih';
                    previewStatusText.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800';
                }
            });

            // Date change listeners
            startDateInput.addEventListener('change', updateDatePreview);
            endDateInput.addEventListener('change', updateDatePreview);

            // Time change listeners
            startTimeInput.addEventListener('change', updateTimePreview);
            endTimeInput.addEventListener('change', updateTimePreview);

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
                        ${fileName} (${fileSize} MB)
                    `;
                    previewFile.classList.remove('text-gray-500');
                    previewFile.classList.add('text-green-600');
                } else {
                    previewFile.innerHTML = `
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Belum ada file dipilih
                    `;
                    previewFile.classList.remove('text-green-600');
                    previewFile.classList.add('text-gray-500');
                }
            });

            // File size validation
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    const maxSize = 5 * 1024 * 1024; // 10MB in bytes

                    if (file.size > maxSize) {
                        alert('Ukuran file terlalu besar! Maksimal 5MB.');
                        this.value = '';
                        previewFile.innerHTML = `
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Belum ada file dipilih
                        `;
                        previewFile.classList.remove('text-green-600');
                        previewFile.classList.add('text-gray-500');
                    }
                }
            });

            // Date validation
            endDateInput.addEventListener('change', function() {
                const startDate = startDateInput.value;
                const endDate = this.value;

                if (startDate && endDate && endDate < startDate) {
                    alert('Tanggal selesai tidak boleh lebih awal dari tanggal mulai!');
                    this.value = '';
                    updateDatePreview();
                }
            });

            // Time validation
            endTimeInput.addEventListener('change', function() {
                const startDate = startDateInput.value;
                const endDate = endDateInput.value;
                const startTime = startTimeInput.value;
                const endTime = this.value;

                // Only validate time if it's the same day
                if (startTime && endTime && (!endDate || endDate === startDate)) {
                    if (endTime <= startTime) {
                        alert('Jam selesai harus lebih besar dari jam mulai!');
                        this.value = '';
                        updateTimePreview();
                    }
                }
            });

            // Helper function to format date
            function formatDate(dateString) {
                const date = new Date(dateString);
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    timeZone: 'Asia/Jakarta'
                };
                return date.toLocaleDateString('id-ID', options);
            }
        });
    </script>
</x-app-layout>
