<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('beritas.update', $berita) }}" enctype="multipart/form-data"
                          x-data="{ 
                              kategori: '{{ old('kategori', $berita->kategori->value) }}', 
                              thumbnailPreview: '{{ $berita->thumbnail ? asset('storage/' . $berita->thumbnail) : '' }}' 
                          }">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" :value="__('Judul')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $berita->title)"
                                required autofocus />
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
                                    <option value="{{ $value }}" {{ old('kategori', $berita->kategori->value) === $value ? 'selected' : '' }}>
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
                                    @if($berita->lampiran_file)
                                        <br><span class="text-blue-600 font-medium">File saat ini akan tetap digunakan jika tidak ada file baru yang diupload</span>
                                    @endif
                                </p>
                                
                                @if($berita->lampiran_file)
                                    <div class="mt-2 mb-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">File Lampiran Saat Ini:</label>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ asset('storage/' . $berita->lampiran_file) }}" 
                                               target="_blank"
                                               class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                </svg>
                                                Unduh File Saat Ini
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                
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
                            <span class="text-gray-500 text-sm">* Opsional - Upload hanya jika ingin mengganti gambar</span>
                            <p class="text-sm text-gray-600 mt-1 mb-2">
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Gambar baru akan dikompres otomatis untuk performa website yang lebih baik
                                </span>
                                <br>
                                <span x-show="kategori === 'pengumuman'" class="text-blue-600 font-medium">Untuk pengumuman:</span>
                                <span x-show="kategori === 'pengumuman'">Jika tidak ada thumbnail, akan menampilkan preview file.</span>
                                Format yang didukung: JPEG, PNG, GIF, WebP (Maksimal 2MB)
                                @if($berita->thumbnail)
                                    <br><span class="text-blue-600 font-medium">Gambar saat ini akan tetap digunakan jika tidak ada gambar baru yang diupload</span>
                                @endif
                            </p>
                            @if($berita->thumbnail)
                                <div class="mt-2 mb-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini:</label>
                                    <div class="w-32 h-32 rounded-md overflow-hidden bg-gray-100 border-2 border-gray-300">
                                        <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="Current Thumbnail" class="w-full h-full object-cover">
                                    </div>
                                </div>
                            @endif
                            <div x-show="thumbnailPreview && thumbnailPreview !== '{{ $berita->thumbnail ? asset('storage/' . $berita->thumbnail) : '' }}'" class="mt-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Preview Gambar Baru:</label>
                                <span class="block w-32 h-32 rounded-md overflow-hidden bg-gray-100 border-2 border-blue-300">
                                    <img :src="thumbnailPreview" alt="Preview Thumbnail" class="w-full h-full object-cover">
                                </span>
                            </div>
                            <input id="thumbnail" type="file" name="thumbnail"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mt-2"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                @change="thumbnailPreview = URL.createObjectURL($event.target.files[0])" />
                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Konten')" />
                            <textarea id="content" name="content"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                rows="10">{{ old('content', $berita->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach (App\Enums\BeritaStatus::cases() as $status)
                                    <option value="{{ $status->value }}" @selected(old('status', $berita->status) == $status)>
                                        {{ $status->label() }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('beritas.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Update Berita') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
    <script>
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
            // Konfigurasi upload gambar
            images_upload_url: '{{ route("admin.upload-image") }}',
            images_upload_handler: function (blobInfo, success, failure, progress) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ route("admin.upload-image") }}');
                
                // Add CSRF token
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                
                xhr.upload.onprogress = function (e) {
                    if (progress && e.lengthComputable) {
                        progress(e.loaded / e.total * 100);
                    }
                };
                
                xhr.onload = function () {
                    var json;
                    
                    if (xhr.status === 403) {
                        failure('HTTP Error: ' + xhr.status, { remove: true });
                        return;
                    }
                    
                    if (xhr.status < 200 || xhr.status >= 300) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    
                    try {
                        json = JSON.parse(xhr.responseText);
                        
                        if (!json || typeof json.location != "string") {
                            failure('Invalid JSON: ' + xhr.responseText);
                            return;
                        }
                        
                        success(json.location);
                    } catch (e) {
                        failure('Failed to parse response: ' + e.message);
                    }
                };
                
                xhr.onerror = function () {
                    failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                };
                
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                
                xhr.send(formData);
            },
            // File picker untuk memilih gambar dari komputer
            file_picker_types: 'image',
            file_picker_callback: function (callback, value, meta) {
                if (meta.filetype === 'image') {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    
                    input.onchange = function () {
                        var file = this.files[0];
                        
                        if (file) {
                            var formData = new FormData();
                            formData.append('file', file);
                            
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '{{ route("admin.upload-image") }}', true);
                            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                            
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    try {
                                        var response = JSON.parse(xhr.responseText);
                                        if (response.location) {
                                            callback(response.location, {
                                                title: file.name,
                                                alt: file.name
                                            });
                                        } else {
                                            alert('Upload failed: No location returned');
                                        }
                                    } catch (e) {
                                        alert('Upload failed: Invalid response');
                                        console.error('Parse error:', e);
                                    }
                                } else {
                                    alert('Upload failed: HTTP ' + xhr.status);
                                }
                            };
                            
                            xhr.onerror = function() {
                                alert('Upload failed: Network error');
                            };
                            
                            xhr.send(formData);
                        }
                    };
                    
                    input.click();
                }
            },
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
