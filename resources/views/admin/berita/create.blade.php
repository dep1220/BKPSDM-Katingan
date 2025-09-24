<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Berita Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('beritas.store') }}" enctype="multipart/form-data" 
                          x-data="{ 
                              kategori: '{{ old('kategori', 'berita_harian') }}', 
                              thumbnailPreview: '' 
                          }">
                        @csrf

                        {{-- Judul --}}
                        <div>
                            <x-input-label for="title" :value="__('Judul')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Kategori --}}
                        <div class="mt-4">
                            <x-input-label for="kategori">
                                {{ __('Kategori') }}
                                <span class="text-red-500 ml-1">*</span>
                            </x-input-label>
                            <select id="kategori" name="kategori" x-model="kategori"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required
                                @change="kategori = $event.target.value">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach(\App\Enums\BeritaKategori::options() as $value => $label)
                                    <option value="{{ $value }}" {{ old('kategori') === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />

                            {{-- File Lampiran untuk Pengumuman --}}
                            <div x-show="kategori === 'pengumuman'" class="mt-4" x-transition>
                                <x-input-label for="lampiran_file">
                                    {{ __('File Lampiran') }}
                                    <span class="text-gray-500 text-sm">(Opsional)</span>
                                </x-input-label>
                                <p class="text-sm text-gray-600 mt-1 mb-2">
                                    Format yang didukung: PDF, DOC, DOCX (Maksimal 5MB)
                                </p>
                                <input id="lampiran_file" type="file" name="lampiran_file"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 mt-2"
                                    accept=".pdf,.doc,.docx"
                                    @change="
                                        const file = $event.target.files[0];
                                        if (file && file.size > 5 * 1024 * 1024) {
                                            alert('Ukuran file terlalu besar! Maksimal 5MB.');
                                            $event.target.value = '';
                                        }
                                    " />
                                <x-input-error :messages="$errors->get('lampiran_file')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Gambar Thumbnail --}}
                        <div class="mt-4">
                            <x-input-label for="thumbnail">
                                {{ __('Gambar Thumbnail') }}
                                <span x-show="kategori !== 'pengumuman'" class="text-red-500 ml-1">*</span>
                                <span x-show="kategori === 'pengumuman'" class="text-gray-500 ml-1">(Opsional)</span>
                            </x-input-label>
                            <p class="text-sm text-gray-600 mt-1 mb-2">
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Gambar akan dikompres otomatis untuk performa website yang lebih baik
                                </span>
                                <br>
                                <span x-show="kategori !== 'pengumuman'" class="text-red-600 font-medium">Wajib diisi:</span>
                                <span x-show="kategori === 'pengumuman'" class="text-blue-600 font-medium">Untuk pengumuman:</span>
                                <span x-show="kategori !== 'pengumuman'">Format yang didukung: JPEG, PNG, GIF, WebP (Maksimal 2MB)</span>
                                <span x-show="kategori === 'pengumuman'">Jika tidak ada thumbnail, akan menampilkan preview file. Format: JPEG, PNG, GIF, WebP (Maksimal 2MB)</span>
                            </p>

                            {{-- Div untuk menampilkan preview --}}
                            <div x-show="thumbnailPreview" class="mt-2">
                                <span class="block w-32 h-32 rounded-md overflow-hidden bg-gray-100">
                                    <img :src="thumbnailPreview" alt="Preview Thumbnail" class="w-full h-full object-cover">
                                </span>
                            </div>

                            <input id="thumbnail" type="file" name="thumbnail"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mt-2"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                @change="
                                    const file = $event.target.files[0];
                                    if (file) {
                                        if (file.size > 2 * 1024 * 1024) {
                                            alert('Ukuran file terlalu besar! Maksimal 2MB.');
                                            $event.target.value = '';
                                            thumbnailPreview = '';
                                            return;
                                        }
                                        thumbnailPreview = URL.createObjectURL(file);
                                    }
                                "
                                :required="kategori !== 'pengumuman'" />
                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                        </div>

                        {{-- Konten --}}
                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Konten')" />
                            <textarea id="content" name="content"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                rows="10">{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        {{-- Status --}}
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach (App\Enums\BeritaStatus::cases() as $status)
                                    <option value="{{ $status->value }}" @selected(old('status', 'draft') == $status->value)>
                                        {{ $status->label() }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('beritas.index') }}"
                                class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan Berita') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah TinyMCE tersedia
            if (typeof tinymce === 'undefined') {
                console.error('TinyMCE tidak dimuat');
                return;
            }
            
            tinymce.init({
                selector: '#content',
                height: 400,
                menubar: true,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'image | removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                branding: false,
                promotion: false,
                license_key: 'gpl',
                
                setup: function(editor) {
                    editor.on('init', function() {
                        // TinyMCE initialized successfully
                    });
                    
                    editor.on('change', function() {
                        editor.save();
                    });
                },
                
                // Konfigurasi upload gambar (disederhanakan dulu)
                images_upload_url: '{{ route("admin.upload-image") }}',
                images_upload_credentials: true,
                images_upload_handler: function (blobInfo, success, failure, progress) {
                    var xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', '{{ route("admin.upload-image") }}');
                    
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            try {
                                var json = JSON.parse(xhr.responseText);
                                success(json.location);
                            } catch (e) {
                                console.error('Parse error:', e);
                                failure('Invalid response');
                            }
                        } else {
                            console.error('HTTP Error:', xhr.status);
                            failure('HTTP Error: ' + xhr.status);
                        }
                    };
                    
                    xhr.onerror = function () {
                        console.error('Network error');
                        failure('Network error');
                    };
                    
                    var formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    xhr.send(formData);
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
