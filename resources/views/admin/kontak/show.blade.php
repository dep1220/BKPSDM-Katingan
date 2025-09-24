<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">

                    <div class="flex justify-between items-start mb-6 pb-4 border-b">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gray-200 rounded-full w-12 h-12 flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-lg text-gray-800">{{ $kontak->name }}</p>
                                <p class="text-sm text-gray-500">{{ $kontak->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">{{ $kontak->created_at->diffForHumans() }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $kontak->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $kontak->subject }}</h3>
                    </div>

                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {{-- Menggunakan nl2br() untuk mengubah baris baru (\n) menjadi tag <br> agar enter terbaca --}}
                        {{-- Fungsi e() untuk escape HTML injection demi keamanan --}}
                        <p>
                            {!! nl2br(e($kontak->message)) !!}
                        </p>
                    </div>

                    <div class="mt-8 pt-6 border-t">
                        <a href="{{ route('kontak.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali ke Daftar Pesan
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
