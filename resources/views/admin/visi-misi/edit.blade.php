<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Visi & Misi') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Formulir Edit Visi & Misi</h3>
                    <a href="{{ route('admin.visi-misi.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>

                <form action="{{ route('admin.visi-misi.update', $visiMisi) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Visi -->
                    <div>
                        <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">Visi <span class="text-red-500">*</span></label>
                        <textarea
                            id="visi"
                            name="visi"
                            rows="4"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Masukkan visi organisasi..."
                            required
                        >{{ old('visi', $visiMisi->visi) }}</textarea>
                        @error('visi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Minimal 20 karakter. Deskripsikan visi organisasi dengan jelas dan inspiratif.</p>
                    </div>

                    <!-- Misi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Misi <span class="text-red-500">*</span></label>
                        <div id="misi-container">
                            @php
                                $misiArray = old('misi', $visiMisi->misi);
                            @endphp
                            @foreach($misiArray as $index => $misi)
                                <div class="misi-item mb-4 p-4 border border-gray-200 rounded-lg">
                                    <div class="flex justify-between items-start mb-2">
                                        <label class="text-sm font-medium text-gray-600">Misi {{ $index + 1 }}</label>
                                        @if($index > 0)
                                            <button type="button" class="remove-misi text-red-600 hover:text-red-800" title="Hapus misi">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                    <textarea
                                        name="misi[]"
                                        rows="3"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        placeholder="Masukkan poin misi..."
                                        required
                                    >{{ $misi }}</textarea>
                                </div>
                            @endforeach
                        </div>
                        
                        @error('misi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('misi.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        <button type="button" id="add-misi" class="mt-2 inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Misi
                        </button>
                        
                        <p class="mt-2 text-sm text-gray-500">Minimal harus ada 1 misi. Setiap misi minimal 10 karakter.</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.visi-misi.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Visi & Misi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let misiCount = document.querySelectorAll('.misi-item').length;
            
            // Add new misi
            document.getElementById('add-misi').addEventListener('click', function() {
                misiCount++;
                const container = document.getElementById('misi-container');
                const newMisiDiv = document.createElement('div');
                newMisiDiv.className = 'misi-item mb-4 p-4 border border-gray-200 rounded-lg';
                newMisiDiv.innerHTML = `
                    <div class="flex justify-between items-start mb-2">
                        <label class="text-sm font-medium text-gray-600">Misi ${misiCount}</label>
                        <button type="button" class="remove-misi text-red-600 hover:text-red-800" title="Hapus misi">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                    <textarea
                        name="misi[]"
                        rows="3"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Masukkan poin misi..."
                        required
                    ></textarea>
                `;
                container.appendChild(newMisiDiv);
                updateMisiLabels();
            });
            
            // Remove misi
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-misi')) {
                    const misiItems = document.querySelectorAll('.misi-item');
                    if (misiItems.length > 1) {
                        e.target.closest('.misi-item').remove();
                        updateMisiLabels();
                    }
                }
            });
            
            // Update misi labels
            function updateMisiLabels() {
                const misiItems = document.querySelectorAll('.misi-item');
                misiItems.forEach((item, index) => {
                    const label = item.querySelector('label');
                    label.textContent = `Misi ${index + 1}`;
                });
            }
        });
    </script>
</x-app-layout>
