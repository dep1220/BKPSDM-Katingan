<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Pejabat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Error Summary --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Ada {{ $errors->count() }} kesalahan dalam pengisian form:
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('pejabat.update', $pejabat) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama Lengkap --}}
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" 
                            class="block mt-1 w-full {{ $errors->has('name') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '' }}" 
                            type="text" 
                            name="name" 
                            :value="old('name', $pejabat->name)" 
                            required 
                            autofocus
                            placeholder="Masukkan nama lengkap pejabat"
                            aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                            aria-describedby="name-error" />
                        @error('name')
                            <p id="name-error" class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- NIP --}}
                    <div class="mt-4">
                        <x-input-label for="nip" :value="__('NIP (Nomor Induk Pegawai)')" />
                        <x-text-input id="nip" 
                            class="block mt-1 w-full {{ $errors->has('nip') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '' }}" 
                            type="text" 
                            name="nip" 
                            :value="old('nip', $pejabat->nip)" 
                            placeholder="Contoh: 196501010199103001"
                            pattern="[0-9]*"
                            inputmode="numeric"
                            maxlength="18"
                            aria-invalid="{{ $errors->has('nip') ? 'true' : 'false' }}"
                            aria-describedby="nip-error"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                        <p class="text-sm text-gray-500 mt-1">*NIP hanya boleh berisi angka (maksimal 18 digit)</p>
                        @error('nip')
                            <p id="nip-error" class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Jabatan --}}
                    <div class="mt-4">
                        <x-input-label for="jabatan" :value="__('Jabatan')" />
                        <select id="jabatan" 
                            name="jabatan" 
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm {{ $errors->has('jabatan') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '' }}" 
                            required
                            aria-invalid="{{ $errors->has('jabatan') ? 'true' : 'false' }}"
                            aria-describedby="jabatan-error">
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach ($jabatans as $jabatanOption)
                                <option value="{{ $jabatanOption->value }}" @selected(old('jabatan', $pejabat->jabatan) == $jabatanOption->value)>
                                    {{ $jabatanOption->value }}
                                </option>
                            @endforeach
                        </select>
                        @error('jabatan')
                            <p id="jabatan-error" class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Foto --}}
                    <div class="mt-4" x-data="{ 
                        photoPreview: '{{ $pejabat->photo ? asset('storage/' . $pejabat->photo) : '' }}',
                        hasOriginalPhoto: {{ $pejabat->photo ? 'true' : 'false' }},
                        showPreview() {
                            return this.photoPreview !== '';
                        }
                    }">
                        <x-input-label for="photo" :value="__('Ganti Foto (Opsional)')" />
                        
                        {{-- Current Photo Display --}}
                        @if($pejabat->photo)
                            <div class="mt-2 mb-2">
                                <p class="text-sm text-gray-600 mb-1">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $pejabat->photo) }}" 
                                     alt="Foto {{ $pejabat->name }}" 
                                     class="w-24 h-24 object-cover rounded-lg border-2 border-gray-200">
                            </div>
                        @endif
                        
                        {{-- New Photo Preview --}}
                        <div x-show="showPreview() && photoPreview !== '{{ $pejabat->photo ? asset('storage/' . $pejabat->photo) : '' }}'" class="mt-2">
                            <p class="text-sm text-green-600 mb-1">Preview foto baru:</p>
                            <div class="relative inline-block">
                                <span class="block w-48 h-48 rounded-md overflow-hidden bg-gray-100 border-2 border-dashed border-gray-300">
                                    <img :src="photoPreview" class="w-full h-full object-cover" alt="Preview foto baru">
                                </span>
                                <button type="button" 
                                    @click="photoPreview = '{{ $pejabat->photo ? asset('storage/' . $pejabat->photo) : '' }}'; document.getElementById('photo').value = ''"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                    ×
                                </button>
                            </div>
                        </div>
                        
                        <input id="photo" 
                            type="file" 
                            name="photo" 
                            accept="image/*"
                            class="block w-full text-sm mt-2 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 {{ $errors->has('photo') ? 'border-red-500' : '' }}" 
                            @change="photoPreview = URL.createObjectURL($event.target.files[0])"
                            aria-invalid="{{ $errors->has('photo') ? 'true' : 'false' }}"
                            aria-describedby="photo-error" />
                        <p class="text-sm text-gray-500 mt-1">Format yang didukung: JPG, PNG, GIF (Maksimal 2MB). Kosongkan jika tidak ingin mengubah foto.</p>
                        @error('photo')
                            <p id="photo-error" class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Urutan Tampil --}}
                    <div class="mt-4">
                        <x-input-label for="order" :value="__('Urutan Tampil')" />
                        <x-text-input id="order" 
                            class="block mt-1 w-full {{ $errors->has('order') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '' }}" 
                            type="number" 
                            name="order" 
                            :value="old('order', $pejabat->order)" 
                            required 
                            min="0"
                            placeholder="0 untuk urutan pertama"
                            aria-invalid="{{ $errors->has('order') ? 'true' : 'false' }}"
                            aria-describedby="order-error" />
                        <p class="text-sm text-gray-500 mt-1">Semakin kecil angka, semakin tinggi urutannya</p>
                        @error('order')
                            <p id="order-error" class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end mt-6 pt-4 border-t border-gray-200">
                        <a href="{{ route('pejabat.index') }}" 
                            class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                            Batal
                        </a>
                        <x-primary-button >
                            {{ __('Update Pejabat') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
