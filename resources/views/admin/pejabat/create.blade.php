<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tambah Pejabat Baru') }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('pejabat.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                    </div>
                    
                    {{-- NIP --}}
                    <div class="mt-4">
                        <x-input-label for="nip" :value="__('NIP (Nomor Induk Pegawai)')" />
                        <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip" :value="old('nip')" placeholder="Contoh: 196501010199103001" />
                        <p class="text-sm text-gray-500 mt-1">*NIP tidak boleh kosong</p>
                    </div>
                    
                    {{-- JABATAN (DROPDOWN) --}}
                    <div class="mt-4">
                        <x-input-label for="jabatan" :value="__('Jabatan')" />
                        <select id="jabatan" name="jabatan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            @foreach ($jabatans as $jabatan)
                                <option value="{{ $jabatan->value }}">{{ $jabatan->value }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- FOTO (KOTAK & WAJIB) --}}
                    <div class="mt-4" x-data="{ photoPreview: '' }">
                        <x-input-label for="photo" :value="__('Foto (Wajib)')" />
                        <div x-show="photoPreview" class="mt-2">
                            <span class="block w-48 h-48 rounded-md overflow-hidden bg-gray-100 border">
                                <img :src="photoPreview" class="w-full h-full object-cover">
                            </span>
                        </div>
                        <input id="photo" type="file" name="photo" required class="block w-full text-sm mt-2" @change="photoPreview = URL.createObjectURL($event.target.files[0])" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="order" :value="__('Urutan Tampil')" />
                        <x-text-input id="order" class="block mt-1 w-full" type="number" name="order" :value="old('order', 0)" required />
                    </div>
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('pejabat.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                        <x-primary-button>{{ __('Simpan Pejabat') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
