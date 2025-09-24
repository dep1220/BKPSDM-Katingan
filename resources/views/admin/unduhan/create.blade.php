<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Unggah File Baru') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('unduhan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input-label for="title" :value="__('Judul File (Wajib)')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi (Opsional)')" />
                            <textarea id="description" name="description" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Masukkan deskripsi file...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mt-4" x-data="{ file: null }">
                            <x-input-label for="file" :value="__('Pilih File (Wajib)')" />
                            <p class="text-sm text-gray-600 mt-1 mb-2">
        <span class="inline-flex items-center gap-1">
            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-5L9 2H4z" clip-rule="evenodd"></path>
            </svg>
            Hanya file dokumen yang diperbolehkan
        </span>
                                <br>
                                Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT (Maksimal 5MB)
                            </p>

                            {{-- Input file asli yang disembunyikan --}}
                            <input
                                id="file" type="file" name="file" required
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,text/plain"
                                class="hidden"
                                x-ref="fileInput"
                                @change="file = $event.target.files[0]"
                            />

                            {{-- Komponen UI Kustom --}}
                            <div class="mt-2 flex items-center space-x-4">
                                {{-- Tombol "Pilih File" baru menggunakan label --}}
                                <label for="file" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Pilih File
                                </label>

                                {{-- Tampilan setelah file dipilih --}}
                                <div x-show="file" class="flex items-center space-x-2" x-transition>
                                    {{-- Nama file --}}
                                    <span class="text-sm font-medium text-gray-700" x-text="file?.name"></span>

                                    {{-- Tombol Hapus/Batal yang sekarang jadi dekat --}}
                                    <button
                                        type="button"
                                        @click="file = null; $refs.fileInput.value = null;"
                                        class="inline-flex items-center justify-center w-6 h-6 rounded-full text-red-500 bg-red-100 hover:bg-red-200 hover:text-red-700 focus:outline-none"
                                        title="Hapus pilihan"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>

                                {{-- Teks placeholder saat belum ada file --}}
                                <p x-show="!file" class="text-sm text-gray-500">Belum ada file yang dipilih.</p>
                            </div>

                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('unduhan.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan File') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
