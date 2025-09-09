<x-guest-layout>
    <div class="flex flex-wrap w-full h-screen">
        <!-- Kolom Kiri (Gambar Latar) -->
        <div class="w-full md:w-1/2 h-64 md:h-full flex flex-col bg-cover bg-center" style="background-image: url('img/bkpsdm_kasongan.jpg');">
            <div class="flex flex-col justify-between h-full p-8 bg-black bg-opacity-25">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-3">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-12 h-auto">
                        <span class="text-white font-bold text-xl">BKPSDM KATINGAN</span>
                    </a>
                </div>
                <div>
                    <h1 class="text-white font-bold text-4xl leading-tight mb-2">Lupa Password?</h1>
                    <p class="text-gray-200">Kami akan membantu Anda mengatur ulang password.</p>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan (Form) -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center bg-white p-8">
            <div class="w-full max-w-md">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Reset Password</h2>
                    <p class="text-gray-500 mt-2">
                        Tidak masalah. Cukup beritahu kami alamat email Anda dan kami akan mengirimkan link untuk mengatur ulang password.
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Alamat Email')" class="font-semibold" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan email Anda" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-8">
                        <x-primary-button class="w-full justify-center py-3">
                            {{ __('Kirim Link Reset Password') }}
                        </x-primary-button>
                    </div>

                    <div class="text-center mt-6">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            &larr; Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
