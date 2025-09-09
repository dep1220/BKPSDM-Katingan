@extends('layouts.public')

@section('title', 'Pusat Unduhan')

@push('styles')
<style>
    /* Custom scrollbar untuk area file list */
    .file-scroll-area::-webkit-scrollbar {
        width: 8px;
    }
    
    .file-scroll-area::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    
    .file-scroll-area::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    
    .file-scroll-area::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Smooth transitions untuk filter */
    .filter-item {
        transition: all 0.2s ease-in-out;
    }
    
    .filter-item:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }
</style>
@endpush

@section('content')
    <!-- Hero Section with Blue Decoration -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
            <div class="absolute top-0 right-0 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-4000"></div>
        </div>
        
        <!-- Wave decoration -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-12 sm:h-16 md:h-20 text-white" preserveAspectRatio="none" viewBox="0 0 1200 120" fill="currentColor">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>
        
        <!-- Content -->
        <div class="relative py-16 sm:py-20 md:py-24 lg:py-28 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 md:mb-6">
                    Pusat Unduhan
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed">
                    Akses dokumen, formulir, dan file penting untuk kebutuhan administrasi kepegawaian.
                </p>
            </div>
        </div>
    </div>

    <div class="py-12 sm:py-14 md:py-16 lg:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-white border border-slate-200 rounded-xl shadow-sm p-4 md:p-6 lg:p-8">
                
                <!-- Form Pencarian dan Filter -->
                <form method="GET" action="{{ route('public.unduhan') }}" class="mb-6 md:mb-8">
                    <div class="flex flex-col md:flex-row gap-3 md:gap-4 md:items-center md:justify-between">
                        <!-- Input Pencarian -->
                        <div class="relative w-full md:max-w-sm">
                            <div class="flex">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}" 
                                       placeholder="Cari dokumen…" 
                                       class="w-full rounded-l-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 pl-10 pr-2 py-2 md:py-2.5" 
                                       aria-label="Cari dokumen">
                                <button type="submit" 
                                        class="px-4 py-2 md:py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-r-lg border border-l-0 border-blue-600 hover:border-blue-700 transition-colors">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 4.287 12.01l3.226 3.227a.75.75 0 1 0 1.06-1.06l-3.226-3.227A6.75 6.75 0 0 0 10.5 3.75Zm-5.25 6.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 4.287 12.01l3.226 3.227a.75.75 0 1 0 1.06-1.06l-3.226-3.227A6.75 6.75 0 0 0 10.5 3.75Zm-5.25 6.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        
                        <!-- Filter Tipe -->
                        <div class="flex items-center gap-2 md:gap-3">
                            <label for="filter-type" class="text-sm text-slate-600 whitespace-nowrap">Tipe:</label>
                            <select name="type" 
                                    id="filter-type" 
                                    class="rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 py-2 md:py-2.5"
                                    onchange="this.form.submit()">
                                <option value="all" {{ request('type') === 'all' || !request('type') ? 'selected' : '' }}>Semua</option>
                                <option value="pdf" {{ request('type') === 'pdf' ? 'selected' : '' }}>PDF</option>
                                <option value="docs" {{ request('type') === 'docs' ? 'selected' : '' }}>Dokumen (DOC, DOCX)</option>
                                <option value="sheets" {{ request('type') === 'sheets' ? 'selected' : '' }}>Spreadsheet (XLS, XLSX)</option>
                                <option value="slides" {{ request('type') === 'slides' ? 'selected' : '' }}>Presentasi (PPT, PPTX)</option>
                                <option value="archives" {{ request('type') === 'archives' ? 'selected' : '' }}>Arsip (ZIP, RAR)</option>
                                <option value="others" {{ request('type') === 'others' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        
                        <!-- Tombol Cari -->
                        <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 4.287 12.01l3.226 3.227a.75.75 0 1 0 1.06-1.06l-3.226-3.227A6.75 6.75 0 0 0 10.5 3.75Zm-5.25 6.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Z" clip-rule="evenodd"/>
                            </svg>
                            Cari
                        </button>
                    </div>
                    
                    <!-- Reset Filter -->
                    @if(request('search') || request('type'))
                        <div class="mt-3 text-center">
                            <a href="{{ route('public.unduhan') }}" class="inline-flex items-center gap-1 text-slate-600 hover:text-blue-600 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0 1 12.548-3.364l1.903 1.903h-3.183a.75.75 0 1 0 0 1.5h4.992a.75.75 0 0 0 .75-.75V4.356a.75.75 0 0 0-1.5 0v3.18l-1.9-1.9A9 9 0 0 0 3.306 9.67a.75.75 0 1 0 1.45.388Zm15.408 3.352a.75.75 0 0 0-1.45-.388A7.5 7.5 0 0 1 6.165 16.46l-1.903-1.903h3.183a.75.75 0 0 0 0-1.5H2.453a.75.75 0 0 0-.75.75v4.992a.75.75 0 0 0 1.5 0v-3.18l1.9 1.9a9 9 0 0 0 15.059-4.035.75.75 0 0 0-.049-.773Z" clip-rule="evenodd"/>
                                </svg>
                                Reset Filter
                            </a>
                        </div>
                    @endif
                </form>

                <!-- Info Hasil -->
                @if(request('search') || request('type'))
                    <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-700">
                            Menampilkan hasil untuk: 
                            @if(request('search'))
                                <span class="font-semibold">"{{ request('search') }}"</span>
                            @endif
                            @if(request('type') && request('type') !== 'all')
                                @if(request('search')) | @endif
                                <span class="font-semibold">Tipe: {{ ucfirst(request('type')) }}</span>
                            @endif
                            ({{ $unduhans->count() }} file ditemukan)
                        </p>
                    </div>
                @endif

                <!-- List File dengan Scroll -->
                <div class="border border-slate-200 rounded-lg">
                    <div class="max-h-96 overflow-y-auto file-scroll-area">
                        <ul class="divide-y divide-slate-200">
                            @forelse($unduhans as $item)
                                @php
                                    $path = $item->file_path ?? '';
                                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                    $url = $path ? asset('storage/' . $path) : '#';
                                    $badgeClass = match ($ext) {
                                        'pdf' => 'bg-red-50 text-red-600',
                                        'doc', 'docx' => 'bg-blue-50 text-blue-600',
                                        'xls', 'xlsx', 'csv' => 'bg-green-50 text-green-600',
                                        'ppt', 'pptx' => 'bg-orange-50 text-orange-600',
                                        'zip', 'rar', '7z' => 'bg-slate-100 text-slate-600',
                                        default => 'bg-slate-100 text-slate-600',
                                    };
                                @endphp
                                <li class="p-4 hover:bg-slate-50 transition-colors filter-item">
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                        <!-- Icon dan Info File -->
                                        <div class="flex items-start sm:items-center gap-3 flex-1 min-w-0">
                                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-lg {{ $badgeClass }} flex-shrink-0">
                                                @switch($ext)
                                                    @case('pdf')
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                            <path d="M6.75 3A2.25 2.25 0 0 0 4.5 5.25v13.5A2.25 2.25 0 0 0 6.75 21h10.5A2.25 2.25 0 0 0 19.5 18.75V8.244a2.25 2.25 0 0 0-.659-1.591l-3.494-3.494A2.25 2.25 0 0 0 13.756 2.5H6.75ZM8.25 12a.75.75 0 0 1 .75-.75h1.5A2.25 2.25 0 0 1 12.75 13.5v.75a2.25 2.25 0 0 1-2.25 2.25H9a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 0 .75-.75v-.75a.75.75 0 0 0-.75-.75H9a.75.75 0 0 1-.75-.75Zm6.75 0a.75.75 0 0 0-.75-.75H13.5a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75H13.5a.75.75 0 0 0 0 1.5h.75A2.25 2.25 0 0 0 16.5 14.25V13.5A2.25 2.25 0 0 0 14.25 11.25ZM8.25 9A.75.75 0 0 0 9 9.75h6a.75.75 0 0 0 0-1.5H9Z"/>
                                                        </svg>
                                                        @break
                                                    @case('doc') @case('docx')
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                            <path d="M7.5 3.75A1.75 1.75 0 0 0 5.75 5.5v13A1.75 1.75 0 0 0 7.5 20.25h9A1.75 1.75 0 0 0 18.25 18.5v-13A1.75 1.75 0 0 0 16.5 3.75h-9Zm.75 4.5a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM8.25 12a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Zm.75 3.75a.75.75 0 0 0 0 1.5H15a.75.75 0 0 0 0-1.5H9Z"/>
                                                        </svg>
                                                        @break
                                                    @case('xls') @case('xlsx') @case('csv')
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                            <path d="M4.5 6A2.25 2.25 0 0 1 6.75 3.75h10.5A2.25 2.25 0 0 1 19.5 6v12a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 18V6ZM7.5 7.5a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5h-9Zm0 3a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5h-9Zm0 3a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5h-9Z"/>
                                                        </svg>
                                                        @break
                                                    @case('ppt') @case('pptx')
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                            <path d="M12 3.75a8.25 8.25 0 1 0 8.25 8.25h-8.25V3.75Z"/>
                                                            <path d="M12.75 2.25v8.25h8.25A8.25 8.25 0 0 0 12.75 2.25Z"/>
                                                        </svg>
                                                        @break
                                                    @default
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                            <path d="M6.75 3A2.25 2.25 0 0 0 4.5 5.25v13.5A2.25 2.25 0 0 0 6.75 21h10.5A2.25 2.25 0 0 0 19.5 18.75V8.244a2.25 2.25 0 0 0-.659-1.591l-3.494-3.494A2.25 2.25 0 0 0 13.756 2.5H6.75Z"/>
                                                        </svg>
                                                @endswitch
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="font-medium text-slate-800 truncate">{{ $item->title }}</div>
                                                <div class="flex items-center gap-2 text-xs text-slate-500 mt-1">
                                                    <span>{{ $item->created_at?->format('d F Y') }}</span>
                                                    @if($ext)
                                                        <span>•</span>
                                                        <span class="uppercase">{{ $ext }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Tombol Aksi -->
                                        <div class="flex items-center gap-2 flex-shrink-0">
                                            <a href="{{ $url }}" 
                                               target="_blank" 
                                               class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 font-semibold text-sm px-3 py-1.5 rounded-lg hover:bg-blue-50 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd"/>
                                                </svg>
                                                Lihat
                                            </a>
                                            <a href="{{ $url }}" 
                                               download 
                                               class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-3 py-1.5 rounded-lg transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                    <path d="M12 3.75a.75.75 0 0 1 .75.75v8.19l2.47-2.47a.75.75 0 1 1 1.06 1.06l-3.75 3.75a.75.75 0 0 1-1.06 0l-3.75-3.75a.75.75 0 1 1 1.06-1.06l2.47 2.47V4.5A.75.75 0 0 1 12 3.75ZM3.75 18A2.25 2.25 0 0 1 6 15.75h12A2.25 2.25 0 0 1 20.25 18v.75a.75.75 0 0 1-1.5 0V18A.75.75 0 0 0 18 17.25H6A.75.75 0 0 0 5.25 18v.75a.75.75 0 0 1-1.5 0V18Z"/>
                                                </svg>
                                                Unduh
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="p-8 text-center text-gray-500">
                                    @if(request('search') || request('type'))
                                        <div class="text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p>Tidak ada file yang cocok dengan pencarian Anda.</p>
                                            <a href="{{ route('public.unduhan') }}" class="text-blue-600 hover:text-blue-700 text-sm mt-2 inline-block">Reset filter</a>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p>Belum ada file untuk diunduh.</p>
                                        </div>
                                    @endif
                                </li>
                            @endforelse
                        </ul>
                    </div>
                    
                    <!-- Info Scroll -->
                    @if($unduhans->count() > 5)
                        <div class="p-3 bg-slate-50 border-t border-slate-200 text-center">
                            <p class="text-xs text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 inline mr-1">
                                    <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v16.19l2.47-2.47a.75.75 0 1 1 1.06 1.06l-3.75 3.75a.75.75 0 0 1-1.06 0l-3.75-3.75a.75.75 0 1 1 1.06-1.06l2.47 2.47V3a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd"/>
                                </svg>
                                Scroll untuk melihat lebih banyak file ({{ $unduhans->count() }} total)
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Submit form only on Enter key or button click
        const searchInput = document.querySelector('input[name="search"]');
        const searchForm = document.querySelector('form');
        
        if (searchInput && searchForm) {
            // Handle Enter key press
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchForm.submit();
                } else if (e.key === 'Escape') {
                    this.value = '';
                    searchForm.submit();
                }
            });
        }
        
        // Enhanced file type indicators
        const fileItems = document.querySelectorAll('.filter-item');
        fileItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Smooth scroll behavior for file list
        const scrollArea = document.querySelector('.file-scroll-area');
        if (scrollArea) {
            scrollArea.style.scrollBehavior = 'smooth';
        }
    });
</script>
@endpush
