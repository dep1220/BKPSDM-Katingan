@extends('layouts.public')

@section('title', 'Struktur Pejabat - BKPSDM Katingan')

@section('content')
    <!-- Hero Section with Blue Decoration -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
            <div class="absolute top-0 right-0 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-10 sm:left-20 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-4000"></div>
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
        <div class="relative py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-3 sm:mb-4 md:mb-6">
                    Struktur Organisasi
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed">
                    Tim Profesional BKPSDM Kabupaten Katingan yang berdedikasi melayani masyarakat
                </p>
            </div>
        </div>
    </div>

    {{-- Konten Utama (Struktur Hierarkis) --}}
    <div class="py-10 sm:py-12 md:py-16 lg:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- 1. Pimpinan (Kepala Badan) --}}
            @if($pimpinan)
            <div class="flex justify-center mb-10 sm:mb-12 md:mb-16">
                <div class="w-64 sm:w-72">
                    {{-- Kartu dengan design seperti ID Card --}}
                    <div class="bg-white rounded-lg shadow-lg border-t-4 border-blue-600 overflow-hidden">
                        {{-- Header dengan border biru bergaris putus-putus --}}
                        <div class="relative p-3 md:p-4 bg-gray-50">
                            <div class="absolute top-2 left-2 md:left-4 right-2 md:right-4 border-t-2 border-dashed border-blue-400"></div>
                        </div>
                        
                        {{-- Foto --}}
                        <div class="px-6 pt-4">
                            <div class="w-28 h-36 mx-auto rounded-lg overflow-hidden border-2 border-gray-200">
                                <img src="{{ $pimpinan->photo ? asset('storage/' . $pimpinan->photo) : 'https://placehold.co/600x400/e2e8f0/adb5bd?text=Foto' }}" 
                                     alt="{{ $pimpinan->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                        </div>
                        
                        {{-- Info Text --}}
                        <div class="p-6 text-center">
                            <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $pimpinan->name }}</h3>
                            <p class="text-xs text-gray-600 font-medium mb-2">{{ $pimpinan->jabatan }}</p>
                            @if($pimpinan->nip)
                            <p class="text-sm text-gray-500">NIP. {{ $pimpinan->nip }}</p>
                            @endif
                        </div>
                        
                        {{-- Footer dengan border biru --}}
                        <div class="h-2 bg-blue-600"></div>
                    </div>
                </div>
            </div>
            @endif

            {{-- 2. Sekretaris Badan --}}
            @php
                $sekretarisBadan = $staffPejabats->filter(function($pejabatList, $jabatan) {
                    return str_contains(strtolower($jabatan), 'sekretaris');
                })->flatten();
            @endphp
            
            @if($sekretarisBadan->isNotEmpty())
            <div class="flex justify-center mb-16">
                @foreach($sekretarisBadan as $sekretaris)
                <div class="w-64 sm:w-72 mr-4">
                    {{-- Kartu dengan design seperti ID Card --}}
                    <div class="bg-white rounded-lg shadow-lg border-t-4 border-blue-600 overflow-hidden">
                        {{-- Header dengan border biru bergaris putus-putus --}}
                        <div class="relative p-4 bg-gray-50">
                            <div class="absolute top-2 left-4 right-4 border-t-2 border-dashed border-blue-400"></div>
                        </div>
                        
                        {{-- Foto --}}
                        <div class="px-6 pt-4">
                            <div class="w-28 h-36 mx-auto rounded-lg overflow-hidden border-2 border-gray-200">
                                <img src="{{ $sekretaris->photo ? asset('storage/' . $sekretaris->photo) : 'https://placehold.co/600x400/e2e8f0/adb5bd?text=Foto' }}" 
                                     alt="{{ $sekretaris->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                        </div>
                        
                        {{-- Info Text --}}
                        <div class="p-6 text-center">
                            <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $sekretaris->name }}</h3>
                            <p class="text-xs text-gray-600 font-medium mb-2">{{ $sekretaris->jabatan }}</p>
                            @if($sekretaris->nip)
                            <p class="text-sm text-gray-500">NIP. {{ $sekretaris->nip }}</p>
                            @endif
                        </div>
                        
                        {{-- Footer dengan border biru --}}
                        <div class="h-2 bg-blue-600"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- 3. Kepala Sub Bagian --}}
            @php
                $kepalaSubBagian = $staffPejabats->filter(function($pejabatList, $jabatan) {
                    return str_contains(strtolower($jabatan), 'kepala sub bagian');
                });
            @endphp

            @if($kepalaSubBagian->isNotEmpty())
            <div class="flex flex-wrap justify-center gap-6 mb-16">
                @foreach($kepalaSubBagian as $jabatan => $pejabatGroup)
                    @foreach($pejabatGroup as $pejabat)
                        <div class="w-64 sm:w-72">
                            {{-- Kartu dengan design seperti ID Card --}}
                            <div class="bg-white rounded-lg shadow-lg border-t-4 border-blue-600 overflow-hidden">
                                {{-- Header dengan border biru bergaris putus-putus --}}
                                <div class="relative p-4 bg-gray-50">
                                    <div class="absolute top-2 left-4 right-4 border-t-2 border-dashed border-blue-400"></div>
                                </div>
                                
                                {{-- Foto --}}
                                <div class="px-6 pt-4">
                                    <div class="w-28 h-36 mx-auto rounded-lg overflow-hidden border-2 border-gray-200">
                                        <img src="{{ $pejabat->photo ? asset('storage/' . $pejabat->photo) : 'https://placehold.co/600x400/e2e8f0/adb5bd?text=Foto' }}" 
                                             alt="{{ $pejabat->name }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                </div>
                                
                                {{-- Info Text --}}
                                <div class="p-6 text-center">
                                    <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $pejabat->name }}</h3>
                                    <p class="text-xs text-gray-600 font-medium mb-2">{{ $pejabat->jabatan }}</p>
                                    @if($pejabat->nip)
                                    <p class="text-sm text-gray-500">NIP. {{ $pejabat->nip }}</p>
                                    @endif
                                </div>
                                
                                {{-- Footer dengan border biru --}}
                                <div class="h-2 bg-blue-600"></div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            @endif

            {{-- 4. Kepala Bidang (sisanya) --}}
            @php
                $kepalaBidang = $staffPejabats->filter(function($pejabatList, $jabatan) {
                    return str_contains(strtolower($jabatan), 'kepala bidang') && 
                           !str_contains(strtolower($jabatan), 'sekretaris') && 
                           !str_contains(strtolower($jabatan), 'kepala sub bagian');
                });
            @endphp

            <div class="flex flex-wrap justify-center gap-6">
                @foreach($kepalaBidang as $jabatan => $pejabatGroup)
                    @foreach($pejabatGroup as $pejabat)
                        <div class="w-64 sm:w-72">
                            {{-- Kartu dengan design seperti ID Card --}}
                            <div class="bg-white rounded-lg shadow-lg border-t-4 border-blue-600 overflow-hidden">
                                {{-- Header dengan border biru bergaris putus-putus --}}
                                <div class="relative p-4 bg-gray-50">
                                    <div class="absolute top-2 left-4 right-4 border-t-2 border-dashed border-blue-400"></div>
                                </div>
                                
                                {{-- Foto --}}
                                <div class="px-6 pt-4">
                                    <div class="w-28 h-36 mx-auto rounded-lg overflow-hidden border-2 border-gray-200">
                                        <img src="{{ $pejabat->photo ? asset('storage/' . $pejabat->photo) : 'https://placehold.co/600x400/e2e8f0/adb5bd?text=Foto' }}" 
                                             alt="{{ $pejabat->name }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                </div>
                                
                                {{-- Info Text --}}
                                <div class="p-6 text-center">
                                    <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $pejabat->name }}</h3>
                                    <p class="text-xs text-gray-600 font-medium mb-2">{{ $pejabat->jabatan }}</p>
                                    @if($pejabat->nip)
                                    <p class="text-sm text-gray-500">NIP. {{ $pejabat->nip }}</p>
                                    @endif
                                </div>
                                
                                {{-- Footer dengan border biru --}}
                                <div class="h-2 bg-blue-600"></div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
                
                @if($kepalaBidang->isEmpty() && $kepalaSubBagian->isEmpty() && $sekretarisBadan->isEmpty() && $pimpinan === null)
                    <div class="text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <p class="text-gray-500 text-lg">Belum ada data pejabat yang dimasukkan.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection