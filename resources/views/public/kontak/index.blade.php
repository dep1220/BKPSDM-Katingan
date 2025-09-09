@extends('layouts.public')

@section('title', 'Hubungi Kami')

@section('content')
    <!-- Hero Section with Blue Decoration -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div
                class="absolute top-0 left-0 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse">
            </div>
            <div
                class="absolute top-0 right-0 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-8 left-10 sm:left-20 w-32 h-32 sm:w-48 sm:h-48 lg:w-72 lg:h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-4000">
            </div>
        </div>

        <!-- Wave decoration -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-12 sm:h-16 md:h-20 text-white" preserveAspectRatio="none" viewBox="0 0 1200 120"
                fill="currentColor">
                <path
                    d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                    opacity=".25"></path>
                <path
                    d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                    opacity=".5"></path>
                <path
                    d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z">
                </path>
            </svg>
        </div>

        <!-- Content -->
        <div class="relative py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-3 sm:mb-4 md:mb-6">
                    Hubungi Kami
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed">
                    Kami siap membantu. Kirimkan pertanyaan, masukan, atau permintaan informasi Anda.
                </p>
            </div>
        </div>
    </div>

    <div class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 items-start">
                <!-- Info Panel -->
                <div class="md:col-span-1 lg:col-span-1 order-2 md:order-1 lg:order-1">
                    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-4 md:p-6 lg:sticky lg:top-6">
                        <h2 class="text-lg font-semibold text-slate-800 mb-4">Informasi Kontak</h2>
                        @php
                            $email = config('app.contact_email') ?: config('mail.from.address');
                            $phone = config('app.phone') ?? null;
                            $address = config('app.address') ?? null;
                        @endphp
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <span
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                            d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-sm text-slate-500">Alamat</div>
                                    <div class="text-slate-700 font-medium leading-relaxed">
                                        {{ $address ?: 'Jalan M.T. Haryono' }}<br>
                                        {{ !$address ? 'Komplek Perkantoran Kereng Humbang' : '' }}<br>
                                        {{ !$address ? 'Kota Kasongan, Kabupaten Katingan' : '' }}<br>
                                        {{ !$address ? 'Provinsi Kalimantan Tengah' : '' }}
                                    </div>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5">
                                        <path
                                            d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                                        <path
                                            d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-sm text-slate-500">Email</div>
                                    @if ($email)
                                        <a href="mailto:{{ $email }}"
                                            class="text-slate-700 font-medium hover:text-blue-600">{{ $email }}</a>
                                    @else
                                        <div class="text-slate-700 font-medium">—</div>
                                    @endif
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5">
                                        <path
                                            d="M2.25 4.5A2.25 2.25 0 0 1 4.5 2.25h2.205a1.5 1.5 0 0 1 1.447 1.08l.845 2.817a1.5 1.5 0 0 1-.586 1.683l-1.398.999a.75.75 0 0 0-.223.98 12.05 12.05 0 0 0 5.558 5.558.75.75 0 0 0 .98-.223l.999-1.398a1.5 1.5 0 0 1 1.683-.586l2.817.845a1.5 1.5 0 0 1 1.08 1.447V19.5A2.25 2.25 0 0 1 19.5 21.75h-3.75C8.414 21.75 2.25 15.586 2.25 8.25V4.5Z" />
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-sm text-slate-500">Telepon</div>
                                    @if ($phone)
                                        <a href="tel:{{ $phone }}"
                                            class="text-slate-700 font-medium hover:text-blue-600">{{ $phone }}</a>
                                    @else
                                        <div class="text-slate-700 font-medium">-</div>
                                    @endif
                                </div>
                            </li>
                        </ul>

                        <div class="mt-6">
                            <h3 class="text-sm font-semibold text-slate-700">Jam Kerja</h3>
                            <ul class="mt-2 text-sm text-slate-600 space-y-1">
                                <li>Senin–Jumat: 08.00 – 16.00</li>
                                <li>Sabtu–Minggu: Tutup</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Form Panel -->
                <div class="md:col-span-2 order-1 md:order-2 lg:order-2">
                    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-4 md:p-6 lg:p-8"
                        x-data="{ submitting: false }" x-init="submitting = false">
                        @if (session('success'))
                            <div
                                class="mb-6 flex items-start gap-3 rounded-lg border border-green-200 bg-green-50 p-4 text-green-800">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5 mt-0.5">
                                    <path fill-rule="evenodd"
                                        d="M2.25 12a9.75 9.75 0 1 1 19.5 0 9.75 9.75 0 0 1-19.5 0Zm14.03-2.28a.75.75 0 0 0-1.06-1.06l-4.72 4.72-1.72-1.72a.75.75 0 1 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.06 0l5.25-5.25Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="flex-1">{{ session('success') }}</div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div
                                class="mb-6 flex items-start gap-3 rounded-lg border border-red-200 bg-red-50 p-4 text-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5 mt-0.5">
                                    <path fill-rule="evenodd"
                                        d="M2.25 12c0 5.385 4.365 9.75 9.75 9.75s9.75-4.365 9.75-9.75S17.385 2.25 12 2.25 2.25 6.615 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="flex-1">
                                    <p class="font-medium">Terdapat kesalahan dalam pengisian form:</p>
                                    <ul class="mt-2 list-disc list-inside text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('public.kontak.store') }}" method="POST" @submit="submitting = true"
                            x-data="{ formSubmitted: false }"
                            @submit.prevent="
                                if (!formSubmitted) {
                                    submitting = true;
                                    formSubmitted = true;
                                    $el.submit();
                                }
                              ">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-slate-700">Nama
                                        Lengkap</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        required
                                        class="mt-1 w-full rounded-lg {{ $errors->has('name') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-slate-300 focus:border-blue-500 focus:ring-blue-500' }}"
                                        placeholder="Masukkan nama Anda"
                                        aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                                        aria-describedby="name-error">
                                    @error('name')
                                        <p id="name-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-slate-700">Alamat
                                        Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        required
                                        class="mt-1 w-full rounded-lg {{ $errors->has('email') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-slate-300 focus:border-blue-500 focus:ring-blue-500' }}"
                                        placeholder="nama@contoh.go.id"
                                        aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                                        aria-describedby="email-error">
                                    @error('email')
                                        <p id="email-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4 md:mt-6">
                                <label for="subject" class="block text-sm font-medium text-slate-700">Subjek</label>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                    required
                                    class="mt-1 w-full rounded-lg {{ $errors->has('subject') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-slate-300 focus:border-blue-500 focus:ring-blue-500' }}"
                                    placeholder="Ringkasan pesan"
                                    aria-invalid="{{ $errors->has('subject') ? 'true' : 'false' }}"
                                    aria-describedby="subject-error">
                                @error('subject')
                                    <p id="subject-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mt-4 md:mt-6">
                                <label for="message" class="block text-sm font-medium text-slate-700">Pesan</label>
                                <textarea id="message" name="message" rows="6" required
                                    class="mt-1 w-full rounded-lg {{ $errors->has('message') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-slate-300 focus:border-blue-500 focus:ring-blue-500' }}"
                                    placeholder="Tulis pesan Anda dengan jelas">{{ old('message') }}</textarea>
                                @error('message')
                                    <p id="message-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- CAPTCHA Section -->
                            <div class="mt-4 md:mt-6">
                                <label for="captcha" class="block text-sm font-medium text-slate-700">Verifikasi
                                    Keamanan</label>
                                <div class="mt-2 bg-slate-50 border border-slate-300 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div id="captcha-display"
                                                class="relative bg-gradient-to-br from-blue-50 via-white to-blue-50 border-2 border-slate-300 rounded-lg px-6 py-3 font-mono text-xl font-bold tracking-widest text-slate-700 select-none min-w-[140px] text-center shadow-inner overflow-hidden cursor-pointer hover:shadow-md transition-all duration-200 captcha-blur">
                                                <!-- Background pattern -->
                                                <div class="absolute inset-0 opacity-20">
                                                    <div class="absolute top-1 left-2 w-1 h-1 bg-blue-300 rounded-full">
                                                    </div>
                                                    <div class="absolute top-3 right-3 w-1 h-1 bg-slate-400 rounded-full">
                                                    </div>
                                                    <div class="absolute bottom-2 left-4 w-1 h-1 bg-blue-400 rounded-full">
                                                    </div>
                                                    <div
                                                        class="absolute bottom-1 right-2 w-1 h-1 bg-slate-300 rounded-full">
                                                    </div>
                                                    <div
                                                        class="absolute top-2 left-1/2 w-0.5 h-0.5 bg-blue-200 rounded-full">
                                                    </div>
                                                </div>
                                                <!-- Diagonal lines for noise -->
                                                <div class="absolute inset-0 opacity-10">
                                                    <div
                                                        class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-slate-400 to-transparent transform rotate-12">
                                                    </div>
                                                    <div
                                                        class="absolute top-1/2 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-blue-400 to-transparent transform -rotate-6">
                                                    </div>
                                                    <div
                                                        class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-slate-300 to-transparent transform rotate-3">
                                                    </div>
                                                </div>
                                                <span id="captcha-text"
                                                    class="relative z-10 text-shadow-sm filter drop-shadow-sm"></span>
                                            </div>
                                            <button type="button" onclick="generateCaptcha()"
                                                class="inline-flex items-center gap-1 px-3 py-2 text-sm bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                                Refresh
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <input type="text" id="captcha" name="captcha"
                                            value="{{ old('captcha') }}" required
                                            class="w-full rounded-lg {{ $errors->has('captcha') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-slate-300 focus:border-blue-500 focus:ring-blue-500' }}"
                                            placeholder="Masukkan kode di atas" maxlength="6" autocomplete="off">
                                        @error('captcha')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <p class="mt-2 text-xs text-slate-500">Masukkan 6 karakter yang ditampilkan di atas
                                        untuk verifikasi keamanan.</p>
                                </div>
                                <input type="hidden" id="captcha_token" name="captcha_token" value="">
                            </div>

                            <div class="mt-6 md:mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <p class="text-xs text-slate-500">Dengan mengirimkan pesan, Anda setuju untuk dihubungi
                                    kembali.</p>
                                <button type="submit" :disabled="submitting"
                                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 md:px-5 py-2.5 md:py-3 text-white font-semibold shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-60 disabled:cursor-not-allowed">
                                    <svg x-show="submitting" xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                    </svg>
                                    <span>Kirim Pesan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="mt-12">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Lokasi Kantor</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Kunjungi kantor kami di lokasi berikut untuk mendapatkan pelayanan langsung
                    </p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <div class="w-full h-64 md:h-80">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3987.6869664445026!2d113.41752807496678!3d-1.8728723981100412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwNTInMjIuMyJTIDExM8KwMjUnMTIuNCJF!5e0!3m2!1sid!2sid!4v1757338469673!5m2!1sid!2sid"
                            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Peta lokasi BKPSDM Katingan"></iframe>
                    </div>
                    <div class="p-6 bg-gray-50">
                        <a href="https://www.google.com/maps/search/?api=1&query=-1.872861,113.420111" target="_blank"
                            rel="noopener"
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full font-semibold transition-colors shadow-lg hover:shadow-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="m11.54 22.351.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        /* Custom CAPTCHA blur effects */
        .captcha-blur #captcha-text {
            text-shadow:
                0 0 2px rgba(0, 0, 0, 0.3),
                1px 1px 1px rgba(0, 0, 0, 0.2),
                -1px -1px 1px rgba(255, 255, 255, 0.8);
            filter:
                blur(0.3px) contrast(1.2) brightness(0.95);
            letter-spacing: 0.15em;
            transform: skew(-2deg);
        }

        .captcha-blur::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                linear-gradient(45deg, transparent 40%, rgba(255, 255, 255, 0.1) 50%, transparent 60%),
                linear-gradient(-45deg, transparent 40%, rgba(0, 0, 0, 0.05) 50%, transparent 60%);
            pointer-events: none;
            z-index: 5;
        }

        .captcha-blur:hover #captcha-text {
            filter:
                blur(0.2px) contrast(1.3) brightness(1);
            transition: all 0.2s ease;
        }

        /* Animated background noise */
        .captcha-blur .noise-line {
            position: absolute;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.1), transparent);
            animation: drift 3s linear infinite;
        }

        @keyframes drift {
            0% {
                transform: translateX(-100%) rotate(2deg);
            }

            100% {
                transform: translateX(200%) rotate(-2deg);
            }
        }
    </style>
    <script>
        // CAPTCHA functionality
        let currentCaptcha = '';

        function generateCaptcha() {
            // Generate random 6-character alphanumeric string
            const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // Exclude confusing characters
            let captcha = '';
            for (let i = 0; i < 6; i++) {
                captcha += chars.charAt(Math.floor(Math.random() * chars.length));
            }

            currentCaptcha = captcha;

            // Apply visual distortion to each character
            const captchaText = document.getElementById('captcha-text');
            captchaText.innerHTML = '';

            captcha.split('').forEach((char, index) => {
                const span = document.createElement('span');
                span.textContent = char;

                // Add random visual distortions
                const randomRotate = (Math.random() - 0.5) * 15; // -7.5 to 7.5 degrees
                const randomScale = 0.9 + Math.random() * 0.2; // 0.9 to 1.1
                const randomSkew = (Math.random() - 0.5) * 10; // -5 to 5 degrees
                const randomVertical = (Math.random() - 0.5) * 4; // -2 to 2px

                span.style.display = 'inline-block';
                span.style.transform = `
                rotate(${randomRotate}deg) 
                scale(${randomScale}) 
                skew(${randomSkew}deg) 
                translateY(${randomVertical}px)
            `;
                span.style.filter = `blur(${0.2 + Math.random() * 0.3}px)`;
                span.style.opacity = 0.85 + Math.random() * 0.15;

                captchaText.appendChild(span);
            });

            document.getElementById('captcha_token').value = btoa(captcha); // Base64 encode for simple validation

            // Clear previous input
            document.getElementById('captcha').value = '';

            console.log('New CAPTCHA generated:', captcha);
        }

        // Validate CAPTCHA before form submission (removed alerts - using server validation instead)
        document.querySelector('form').addEventListener('submit', function(e) {
            const userInput = document.getElementById('captcha').value.toUpperCase();
            const captchaToken = document.getElementById('captcha_token').value;

            // Just ensure CAPTCHA token exists, let server handle validation
            if (!captchaToken) {
                generateCaptcha(); // Generate new CAPTCHA if missing
            }
        });

        // Generate initial CAPTCHA when page loads
        document.addEventListener('DOMContentLoaded', function() {
            generateCaptcha();

            // Auto-uppercase CAPTCHA input
            document.getElementById('captcha').addEventListener('input', function(e) {
                e.target.value = e.target.value.toUpperCase();
            });
        });

        // Regenerate CAPTCHA if user clicks on display
        document.getElementById('captcha-display').addEventListener('click', function() {
            generateCaptcha();
        });
    </script>
@endpush
