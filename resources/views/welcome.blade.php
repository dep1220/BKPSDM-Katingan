<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Tailwind CSS</title>

    {{-- Ini baris penting untuk memanggil file CSS yang sudah diproses oleh Vite --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-white">

    <div class="h-screen flex flex-col justify-center items-center">
        
        <svg class="h-16 w-16 mb-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>

        <h1 class="text-4xl font-bold mb-2">
            Tailwind CSS Berhasil Jalan! 👍
        </h1>

        <p class="text-lg text-gray-400">
            Jika tulisan ini besar dan berada di tengah dengan background gelap, artinya semua sudah siap.
        </p>

        <div class="mt-8 p-6 border border-gray-700 rounded-lg bg-gray-800">
            <p class="text-left font-mono">
                <span class="text-yellow-400">Path file:</span> <span class="text-green-400">resources/views/welcome.blade.php</span><br>
                <span class="text-yellow-400">Status Vite:</span> <span class="text-green-400">npm run dev</span>
            </p>
        </div>

    </div>

</body>
</html>