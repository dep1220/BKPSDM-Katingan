<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Slide Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('hero.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Judul Utama (Opsional)')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Subtitle -->
                        <div class="mt-4">
                            <x-input-label for="subtitle" :value="__('Sub-Judul / Deskripsi (Opsional)')" />
                            <textarea id="subtitle" name="subtitle" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('subtitle') }}</textarea>
                            <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                        </div>

                        <!-- Background Image -->
                        <div class="mt-4" x-data="{ imagePreview: '' }">
                            <x-input-label for="background_image" :value="__('Gambar Latar (Wajib)')" />
                             <div x-show="imagePreview" class="mt-2">
                                <span class="block w-full h-48 rounded-md overflow-hidden bg-gray-100 border">
                                    <img :src="imagePreview" class="w-full h-full object-cover">
                                </span>
                            </div>
                            <input id="background_image" type="file" name="background_image" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mt-2" @change="imagePreview = URL.createObjectURL($event.target.files[0])" />
                            <x-input-error :messages="$errors->get('background_image')" class="mt-2" />
                        </div>
                        
                        <!-- Button Text -->
                        <div class="mt-4">
                            <x-input-label for="button_text" :value="__('Teks Tombol (Opsional)')" />
                            <x-text-input id="button_text" class="block mt-1 w-full" type="text" name="button_text" :value="old('button_text')" />
                            <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                        </div>

                        <!-- Button Link -->
                        <div class="mt-4">
                            <x-input-label for="button_link" :value="__('Link Tombol (Opsional)')" />
                            <x-text-input id="button_link" class="block mt-1 w-full" type="url" name="button_link" placeholder="https://..." :value="old('button_link')" />
                            <x-input-error :messages="$errors->get('button_link')" class="mt-2" />
                        </div>
                        
                        <!-- Order -->
                        <div class="mt-4">
                            <x-input-label for="order" :value="__('Urutan Tampil')" />
                            <x-text-input id="order" class="block mt-1 w-full" type="number" name="order" :value="old('order', 0)" required />
                            <x-input-error :messages="$errors->get('order')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('hero.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan Slide') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
