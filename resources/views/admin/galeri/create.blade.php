<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Gambar Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('galeri.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Judul Gambar (Opsional)')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4" x-data="{ imagePreview: '' }">
                            <x-input-label for="image" :value="__('File Gambar (Wajib)')" />
                            <p class="text-sm text-gray-600 mt-1 mb-2">
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Gambar akan dikompres otomatis untuk menghemat storage
                                </span>
                                <br>
                                Format yang didukung: JPEG, PNG, GIF, WebP (Maksimal 10MB)
                            </p>
                            <div x-show="imagePreview" class="mt-2">
                                <span class="block w-96 h-96 rounded-md overflow-hidden bg-gray-100 border">
                                    <img :src="imagePreview" alt="Preview" class="w-full h-full object-cover">
                                </span>
                            </div>
                            <input id="image" type="file" name="image" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mt-2"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                @change="imagePreview = URL.createObjectURL($event.target.files[0])" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('galeri.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan Gambar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>