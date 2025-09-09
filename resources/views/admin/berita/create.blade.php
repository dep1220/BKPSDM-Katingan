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
                    <form method="POST" action="{{ route('beritas.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Judul --}}
                        <div>
                            <x-input-label for="title" :value="__('Judul')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Gambar Thumbnail --}}
                        <div class="mt-4" x-data="{ thumbnailPreview: '' }">
                            <x-input-label for="thumbnail">
                                {{ __('Gambar Thumbnail') }}
                                <span class="text-red-500 ml-1">*</span>
                            </x-input-label>
                            <p class="text-sm text-gray-600 mt-1 mb-2">
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Gambar akan dikompres otomatis untuk performa website yang lebih baik
                                </span>
                                <br>
                                <span class="text-red-600 font-medium">Wajib diisi:</span> Format yang didukung: JPEG, PNG, GIF, WebP (Maksimal 10MB)
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
                                @change="thumbnailPreview = URL.createObjectURL($event.target.files[0])"
                                required />
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
        console.log('Script dimuat');
        
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM siap');
            
            // Cek apakah TinyMCE tersedia
            if (typeof tinymce === 'undefined') {
                console.error('TinyMCE tidak dimuat');
                return;
            }
            
            console.log('TinyMCE tersedia, inisialisasi...');
            
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
                        console.log('TinyMCE berhasil diinisialisasi untuk:', editor.id);
                    });
                    
                    editor.on('change', function() {
                        editor.save();
                    });
                },
                
                // Konfigurasi upload gambar (disederhanakan dulu)
                images_upload_url: '{{ route("admin.upload-image") }}',
                images_upload_credentials: true,
                images_upload_handler: function (blobInfo, success, failure, progress) {
                    console.log('Upload dimulai...');
                    
                    var xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', '{{ route("admin.upload-image") }}');
                    
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            try {
                                var json = JSON.parse(xhr.responseText);
                                console.log('Upload berhasil:', json);
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
