<x-guest-layout>
    <div class="flex flex-wrap w-full h-screen">
        <!-- Kolom Kiri (Gambar Latar) -->
        <div class="w-full md:w-1/2 h-64 md:h-full flex flex-col bg-cover bg-center" style="background-image: url('img/bkpsdm_kasongan.jpg');">
            {{-- Anda bisa mengganti URL di atas dengan gambar kantor BKPSDM Katingan yang berkualitas tinggi --}}
            <div class="flex flex-col justify-between h-full p-8 bg-black bg-opacity-25">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-3">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-12 h-auto">
                        <span class="text-white font-bold text-xl">BKPSDM KATINGAN</span>
                    </a>
                </div>
                <div>
                    <h1 class="text-white font-bold text-4xl leading-tight mb-2">Panel Administrasi</h1>
                    <p class="text-gray-200">Sistem Manajemen Konten Website.</p>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan (Form Login) -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center bg-white p-8">
            <div class="w-full max-w-md">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Selamat Datang Kembali</h2>
                    <p class="text-gray-500 mt-2">Silakan masuk ke akun Anda.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Alamat Email')" class="font-semibold" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="contoh@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-6">
                        <x-input-label for="password" :value="__('Password')" class="font-semibold" />
                        <div class="relative">
                            <x-text-input id="password" class="block mt-1 w-full input-with-icon" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                            <button type="button" id="togglePassword" class="password-toggle-btn">
                                <!-- Eye Icon (Hidden) -->
                                <svg id="eyeIcon" class="icon-transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <!-- Eye Slash Icon (Visible) -->
                                <svg id="eyeSlashIcon" class="icon-transition hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464M14.12 14.12l1.414 1.414M14.12 14.12L9.878 9.878m4.242 4.242L8.464 21.536"></path>
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Lupa Password -->
                    <div class="flex items-center justify-between mt-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="mt-8">
                        <x-primary-button class="w-full justify-center py-3">
                            {{ __('Log In') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            togglePassword.addEventListener('click', function() {
                // Toggle password visibility
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                
                // Toggle icons
                eyeIcon.classList.toggle('hidden', !isPassword);
                eyeSlashIcon.classList.toggle('hidden', isPassword);
            });
        });
    </script>
</x-guest-layout>
