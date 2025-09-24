<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Judul diubah --}}
            {{ __('Edit File Unduhan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Action form dan method diubah untuk proses update --}}
                    <form method="POST" action="{{ route('unduhan.update', $unduhan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH') {{-- Menggunakan method PATCH untuk update --}}

                        {{-- Judul File --}}
                        <div>
                            <x-input-label for="title" :value="__('Judul File (Wajib)')" />
                            {{-- value diisi dengan data lama dari $unduhan --}}
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $unduhan->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi (Opsional)')" />
                            {{-- textarea diisi dengan data lama dari $unduhan --}}
                            <textarea id="description" name="description" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Masukkan deskripsi file...">{{ old('description', $unduhan->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        {{-- Bagian Input File yang Dimodifikasi --}}
                        <div class="mt-4" x-data="{ file: null }">
                            {{-- Label diubah --}}
                            <x-input-label for="file" :value="__('Ganti File (Opsional)')" />

                            {{-- Menampilkan file yang saat ini terpasang --}}
                            <div class="mt-2 mb-4 p-3 bg-gray-50 border rounded-md">
                                <p class="text-sm font-medium text-gray-700">File Saat Ini:</p>
                                <a href="{{ asset('storage/' . $unduhan->file_path) }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-blue-600 hover:underline">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    {{-- Ganti 'original_filename' dengan nama kolom yang sesuai di database Anda --}}
                                    <span>{{ $unduhan->original_filename ?? 'Lihat File' }}</span>
                                </a>
                            </div>

                            <p class="text-sm text-gray-600 mt-1 mb-2">
                                Pilih file baru jika Anda ingin mengganti file yang lama.
                                <br>
                                Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT (Maksimal 5MB)
                            </p>

                            {{-- Input file asli yang disembunyikan (required dihapus) --}}
                            <input
                                id="file" type="file" name="file" {{-- required dihapus --}}
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,text/plain"
                                class="hidden"
                                x-ref="fileInput"
                                @change="file = $event.target.files[0]"
                            />

                            {{-- Komponen UI Kustom --}}
                            <div class="mt-2 flex items-center space-x-4">
                                <label for="file" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Pilih File Baru
                                </label>
                                <div x-show="file" class="flex items-center space-x-2" x-transition>
                                    <span class="text-sm font-medium text-gray-700" x-text="file?.name"></span>
                                    <button type="button" @click="file = null; $refs.fileInput.value = null;" class="inline-flex items-center justify-center w-6 h-6 rounded-full text-red-500 bg-red-100 hover:bg-red-200 hover:text-red-700 focus:outline-none" title="Hapus pilihan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                                <p x-show="!file" class="text-sm text-gray-500">Belum ada file baru dipilih.</p>
                            </div>

                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('unduhan.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{-- Teks tombol diubah --}}
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
