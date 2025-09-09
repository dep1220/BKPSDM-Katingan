@extends('layouts.public')

@section('title', 'Profil - Visi & Misi | BKPSDM Katingan')

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
                    Visi & Misi
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed">
                    Komitmen dan arah strategis BKPSDM Kabupaten Katingan dalam memberikan pelayanan terbaik
                </p>
            </div>
        </div>
    </div>

    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($visiMisi)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Visi Section -->
                    <div class="order-1">
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                            {{-- Header --}}
                            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white">Visi</h3>
                                </div>
                            </div>
                            
                            {{-- Content --}}
                            <div class="p-8">
                                <div class="relative">
                                    <div class="absolute -top-2 -left-2 text-6xl text-blue-200 font-serif opacity-50">"</div>
                                    <blockquote class="text-gray-700 leading-relaxed text-lg pl-8 pt-4 italic font-medium">
                                        {{ $visiMisi->visi }}
                                    </blockquote>
                                    <div class="absolute -bottom-4 -right-2 text-6xl text-blue-200 font-serif rotate-180 opacity-50">"</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Misi Section -->
                    <div class="order-2">
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                            {{-- Header --}}
                            <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-8 py-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                                            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-1.381z" clip-rule="evenodd" />
                                            <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.487l-.115.04c-.567.2-1.156.349-1.764.44z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white">Misi</h3>
                                </div>
                            </div>
                            
                            {{-- Content --}}
                            <div class="p-8">
                                <div class="space-y-6">
                                    @foreach($visiMisi->misi as $index => $misi)
                                        <div class="flex items-start group">
                                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 text-white rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-all duration-200 shadow-lg">
                                                <span class="text-sm font-bold">{{ $index + 1 }}</span>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed text-base flex-1 pt-2">
                                                {{ $misi }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Status Information --}}
                @if($visiMisi && $visiMisi->is_active)
                    <div class="mt-12 text-center">
                        <div class="inline-flex items-center px-6 py-3 bg-green-50 border border-green-200 text-green-800 rounded-full text-sm font-medium shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                            Visi Misi Aktif
                        </div>
                        <p class="text-gray-500 text-sm mt-3">Terakhir diperbarui: {{ $visiMisi->updated_at->format('d F Y') }}</p>
                    </div>
                @endif
            @else
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi & Misi Belum Tersedia</h3>
                        <p class="text-gray-600 leading-relaxed mb-8">
                            Visi dan misi organisasi sedang dalam proses penyusunan atau belum diaktifkan. 
                            Silakan kunjungi halaman ini kembali dalam waktu dekat.
                        </p>
                        <a href="{{ route('public.index') }}" 
                           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition-colors shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
