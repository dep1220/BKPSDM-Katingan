<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Gambar Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Form action ke route update dengan method PUT --}}
                    <form method="POST" action="{{ route('galeri.update', $galeri) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" :value="__('Judul Gambar (Opsional)')" />
                            {{-- Isi value dengan data lama --}}
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $galeri->title)" autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Inisialisasi preview dengan gambar yang sudah ada --}}
                        <div class="mt-4" x-data="{ imagePreview: '{{ $galeri->image ? asset('storage/' . $galeri->image) : '' }}', originalImage: '{{ $galeri->image ? asset('storage/' . $galeri->image) : '' }}' }">
                            <x-input-label for="image" :value="__('Ganti File Gambar (Opsional)')" />
                            <p class="text-sm text-gray-600 mt-1 mb-2">
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Gambar baru akan dikompres otomatis untuk menghemat storage
                                </span>
                                <br>
                                Format yang didukung: JPEG, PNG, GIF, WebP (Maksimal 2MB)
                            </p>
                            
                            <!-- Preview Image dengan tombol X -->
                            <div x-show="imagePreview" class="mt-2 relative">
                                <span class="block w-96 h-96 rounded-md overflow-hidden bg-gray-100 border relative">
                                    <img :src="imagePreview" alt="Preview" class="w-full h-full object-cover">
                                    <!-- Tombol X untuk membatalkan -->
                                    <button type="button" 
                                            @click="
                                                imagePreview = originalImage;
                                                document.getElementById('image').value = '';
                                            "
                                            class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center transition-colors shadow-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </span>
                                <p class="text-xs text-gray-500 mt-1">
                                    @if($galeri->image)
                                        Klik tombol ❌ untuk kembali ke gambar asli
                                    @else
                                        Klik tombol ❌ untuk membatalkan pilihan gambar
                                    @endif
                                </p>
                            </div>
                            
                            <input id="image" type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mt-2"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                @change="
                                    const file = $event.target.files[0];
                                    if (file) {
                                        const maxSize = 2 * 1024 * 1024; // 2MB dalam bytes
                                        if (file.size > maxSize) {
                                            alert('Ukuran file terlalu besar! Maksimal 2MB.\nUkuran file Anda: ' + (file.size / 1024 / 1024).toFixed(2) + 'MB');
                                            $event.target.value = '';
                                            imagePreview = originalImage;
                                            return;
                                        }
                                        imagePreview = URL.createObjectURL(file);
                                    }
                                " />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('galeri.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Update Gambar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>