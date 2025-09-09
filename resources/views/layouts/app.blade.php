<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ isSidebarOpen: false }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script> --}}
        
        {{-- Chart.js for Dashboard Charts --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <style>
            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }
            ::-webkit-scrollbar-track {
                background: #f1f5f9;
            }
            ::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 3px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
            
            /* Smooth transitions */
            * {
                transition: all 0.2s ease-in-out;
            }
            
            /* Mobile sidebar smooth transitions */
            @media (max-width: 768px) {
                body.sidebar-open {
                    overflow: hidden;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <div class="flex h-screen overflow-hidden">
            {{-- Sidebar --}}
            @include('layouts.sidebar')

            <div class="flex flex-col flex-1 w-full">
                {{-- Top Navigation --}}
                @include('layouts.navigation')

                {{-- Main Content Area --}}
                <main class="h-full overflow-y-auto">
                    <div class="container px-4 sm:px-6 mx-auto grid py-4 sm:py-6">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        <!-- Scripts from child views -->
        @stack('scripts')
    </body>
</html>
