@extends('layouts.public')

@section('title', $agenda->title)

@push('styles')
<style>
    /* Content typography styling */
    .agenda-content h1,
    .agenda-content h2,
    .agenda-content h3,
    .agenda-content h4,
    .agenda-content h5,
    .agenda-content h6 {
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    
    .agenda-content h1 { font-size: 1.875rem; }
    .agenda-content h2 { font-size: 1.5rem; }
    .agenda-content h3 { font-size: 1.25rem; }
    
    .agenda-content p {
        margin-bottom: 1rem;
        line-height: 1.75;
    }
    
    .agenda-content ul,
    .agenda-content ol {
        margin-bottom: 1rem;
        padding-left: 1.5rem;
    }
    
    .agenda-content li {
        margin-bottom: 0.5rem;
    }
    
    .agenda-content blockquote {
        border-left: 4px solid #3b82f6;
        background: #eff6ff;
        padding: 1rem;
        margin: 1rem 0;
        border-radius: 0 0.5rem 0.5rem 0;
    }
    
    .agenda-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .agenda-content th,
    .agenda-content td {
        padding: 0.75rem;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .agenda-content th {
        background-color: #f8fafc;
        font-weight: 600;
    }
    
    /* Back button animation */
    .back-button {
        transition: all 0.2s ease-in-out;
    }
    
    .back-button:hover {
        transform: translateX(-3px);
    }
    
    /* Download button glow effect */
    .download-button {
        position: relative;
        overflow: hidden;
    }
    
    .download-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .download-button:hover::before {
        left: 100%;
    }
</style>
@endpush

@section('content')
    <!-- Breadcrumb & Back Navigation -->
    <div class="bg-gray-50 border-b border-gray-200 py-4 md:py-6">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Back Button -->
                <a href="{{ route('public.agenda') }}" 
                   class="back-button inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="hidden sm:inline">Kembali ke Agenda</span>
                    <span class="sm:hidden">Kembali</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-8 md:py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Article Header -->
                <div class="bg-white rounded-xl md:rounded-2xl border border-gray-200 shadow-sm p-4 md:p-8 mb-6 md:mb-8">
                    <!-- Agenda Meta Information -->
                    <div class="flex flex-wrap items-center gap-3 md:gap-4 mb-4 md:mb-6">
                        @php
                            $isAgenda = str_contains(strtolower($agenda->title), 'agenda');
                            $isRapat = str_contains(strtolower($agenda->title), 'rapat');
                            $isKegiatan = str_contains(strtolower($agenda->title), 'kegiatan');
                            $isJadwal = str_contains(strtolower($agenda->title), 'jadwal');
                            $isAcara = str_contains(strtolower($agenda->title), 'acara');
                            
                            $badgeColor = 'bg-blue-100 text-blue-800';
                            $badgeText = 'Agenda';
                            $iconColor = 'text-blue-600';
                            
                            if ($isRapat) {
                                $badgeColor = 'bg-green-100 text-green-800';
                                $badgeText = 'Rapat';
                                $iconColor = 'text-green-600';
                            } elseif ($isKegiatan) {
                                $badgeColor = 'bg-purple-100 text-purple-800';
                                $badgeText = 'Kegiatan';
                                $iconColor = 'text-purple-600';
                            } elseif ($isJadwal) {
                                $badgeColor = 'bg-orange-100 text-orange-800';
                                $badgeText = 'Jadwal';
                                $iconColor = 'text-orange-600';
                            } elseif ($isAcara) {
                                $badgeColor = 'bg-pink-100 text-pink-800';
                                $badgeText = 'Acara';
                                $iconColor = 'text-pink-600';
                            }
                        @endphp
                        
                        <span class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-full text-xs sm:text-sm font-medium {{ $badgeColor }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"/>
                                <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd"/>
                            </svg>
                            {{ $badgeText }}
                        </span>
                        
                        <div class="flex items-center gap-2 text-gray-600 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd"/>
                            </svg>
                            Dipublikasi pada {{ $agenda->created_at->format('d F Y') }}
                        </div>
                        
                        @if($agenda->updated_at != $agenda->created_at)
                            <div class="flex items-center gap-2 text-gray-600 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0 1 12.548-3.364l1.903 1.903h-3.183a.75.75 0 1 0 0 1.5h4.992a.75.75 0 0 0 .75-.75V4.356a.75.75 0 0 0-1.5 0v3.18l-1.9-1.9A9 9 0 0 0 3.306 9.67a.75.75 0 1 0 1.45.388Zm15.408 3.352a.75.75 0 0 0-.919.53 7.5 7.5 0 0 1-12.548 3.364l-1.902-1.903h3.183a.75.75 0 0 0 0-1.5H2.984a.75.75 0 0 0-.75.75v4.992a.75.75 0 0 0 1.5 0v-3.18l1.9 1.9a9 9 0 0 0 15.059-4.035.75.75 0 0 0-.53-.918Z" clip-rule="evenodd"/>
                                </svg>
                                Diperbarui {{ $agenda->updated_at->format('d F Y') }}
                            </div>
                        @endif
                    </div>

                    <!-- Jadwal Agenda -->
                    @if($agenda->start_date || $agenda->start_time || $agenda->status)
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4 md:p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"/>
                                    <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd"/>
                                </svg>
                                Jadwal Agenda
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Tanggal -->
                                @if($agenda->start_date)
                                    <div class="flex items-center gap-3 bg-white rounded-lg p-3 border border-gray-200">
                                        <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500 font-medium">Tanggal</div>
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $agenda->start_date->format('d F Y') }}
                                                @if($agenda->end_date && !$agenda->start_date->equalTo($agenda->end_date))
                                                    <br><span class="text-gray-600">s.d {{ $agenda->end_date->format('d F Y') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Waktu -->
                                @if($agenda->start_time || $agenda->end_time)
                                    <div class="flex items-center gap-3 bg-white rounded-lg p-3 border border-gray-200">
                                        <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500 font-medium">Waktu</div>
                                            <div class="text-sm font-semibold text-gray-900">
                                                @if($agenda->start_time)
                                                    {{ $agenda->start_time }}
                                                    @if($agenda->end_time)
                                                        - {{ $agenda->end_time }}
                                                    @endif
                                                    WIB
                                                @elseif($agenda->end_time)
                                                    Selesai: {{ $agenda->end_time }} WIB
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Status -->
                                @if($agenda->status)
                                    <div class="flex items-center gap-3 bg-white rounded-lg p-3 border border-gray-200">
                                        <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500 font-medium">Status</div>
                                            <div class="text-sm">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $agenda->status->color() }}">
                                                    {{ $agenda->status->label() }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $agenda->title }}
                    </h1>

                    <!-- Download Button (if file exists) -->
                    @if($agenda->file_path)
                        <div class="flex flex-wrap gap-4 pt-6 border-t border-gray-200">
                            <a href="{{ asset('storage/' . $agenda->file_path) }}" 
                               target="_blank"
                               class="download-button inline-flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd"/>
                                </svg>
                                Unduh Dokumen Agenda
                                <span class="text-xs opacity-80">
                                    ({{ strtoupper(pathinfo($agenda->file_path, PATHINFO_EXTENSION)) }})
                                </span>
                            </a>
                            
                            <!-- File Size Info (if we can calculate it) -->
                            @php
                                $filePath = public_path('storage/' . $agenda->file_path);
                                $fileSize = file_exists($filePath) ? filesize($filePath) : null;
                                $fileSizeFormatted = $fileSize ? number_format($fileSize / 1024, 1) . ' KB' : null;
                                if ($fileSize && $fileSize > 1024 * 1024) {
                                    $fileSizeFormatted = number_format($fileSize / (1024 * 1024), 1) . ' MB';
                                }
                            @endphp
                            
                            @if($fileSizeFormatted)
                                <div class="flex items-center gap-2 text-sm text-gray-600 py-3">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd"/>
                                    </svg>
                                    Ukuran file: {{ $fileSizeFormatted }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Content Body (if there's additional description/content) -->
                @if($agenda->description)
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <div class="w-1 h-8 bg-blue-600 rounded-full"></div>
                            Deskripsi Agenda
                        </h2>
                        
                        <div class="agenda-content prose prose-lg max-w-none text-gray-700">
                            {!! nl2br(e($agenda->description)) !!}
                        </div>
                    </div>
                @endif

                <!-- Related Actions -->
                <div class="mt-12 bg-gray-50 rounded-2xl border border-gray-200 p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Tindakan Lanjutan</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('public.agenda') }}" 
                           class="inline-flex items-center gap-3 p-4 bg-white border border-gray-200 rounded-xl hover:border-blue-300 hover:shadow-md transition-all duration-300">
                            <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center {{ $iconColor }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"/>
                                    <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">Lihat Agenda Lainnya</div>
                                <div class="text-sm text-gray-600">Jelajahi agenda dan kegiatan lainnya</div>
                            </div>
                        </a>
                        
                        <a href="{{ route('public.unduhan') }}" 
                           class="inline-flex items-center gap-3 p-4 bg-white border border-gray-200 rounded-xl hover:border-blue-300 hover:shadow-md transition-all duration-300">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">Dokumen Lainnya</div>
                                <div class="text-sm text-gray-600">Unduh dokumen dan berkas resmi</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced download button interaction
        const downloadButton = document.querySelector('.download-button');
        if (downloadButton) {
            downloadButton.addEventListener('click', function() {
                // Add a subtle animation feedback
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 100);
            });
        }
        
        // Enhanced back button interaction
        const backButton = document.querySelector('.back-button');
        if (backButton) {
            backButton.addEventListener('mouseenter', function() {
                this.querySelector('svg').style.transform = 'translateX(-2px)';
            });
            
            backButton.addEventListener('mouseleave', function() {
                this.querySelector('svg').style.transform = 'translateX(0)';
            });
        }
    });
</script>
@endpush
