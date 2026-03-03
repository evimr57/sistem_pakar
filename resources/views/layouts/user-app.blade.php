<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: true }" x-cloak>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Coffee Expert</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #5FA357; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #4a8345; }

        .sidebar-transition {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        .logo-float { animation: float 3s ease-in-out infinite; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .page-content { animation: fadeInUp 0.5s ease-out; }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .badge-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="sidebar-transition bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white fixed h-full z-30 flex flex-col shadow-2xl"
        >
            <!-- Logo -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <div x-show="sidebarOpen" class="flex items-center space-x-3">
                        <div class="logo-float">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold bg-gradient-to-r from-green-400 to-green-200 bg-clip-text text-transparent">Coffee Expert</h1>
                            <p class="text-xs text-gray-400">Sistem Pakar Kopi</p>
                        </div>
                    </div>
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

                <!-- Dashboard -->
                <a href="{{ route('user.dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('user.dashboard') ? 'bg-gray-700' : '' }} group">
                    <div class="flex items-center flex-1">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-500/20 group-hover:bg-blue-500/30 transition-colors">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <span x-show="sidebarOpen" class="ml-3 font-semibold">Dashboard</span>
                    </div>
                </a>

                <!-- Diagnosa -->
                <div x-data="{ diagnosaOpen: {{ request()->routeIs('user.diagnosa.*') ? 'true' : 'false' }} }">
                    <button @click="diagnosaOpen = !diagnosaOpen"
                        class="w-full flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('user.diagnosa.*') ? 'bg-gray-700' : '' }} group">
                        <div class="flex items-center flex-1">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-green-500/20 group-hover:bg-green-500/30 transition-colors">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <span x-show="sidebarOpen" class="ml-3 font-semibold">Diagnosa</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="diagnosaOpen ? 'rotate-180' : ''" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="diagnosaOpen && sidebarOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="mt-1 ml-6 pl-4 border-l-2 border-gray-600 space-y-1">
                        <a href="{{ route('user.diagnosa.index') }}"
                            class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('user.diagnosa.index') ? 'bg-gray-700 text-white' : 'text-gray-400' }} group transition-colors">
                            <span class="text-sm font-medium group-hover:text-white">Mulai Diagnosa</span>
                        </a>
                        <a href="{{ route('user.diagnosa.riwayat') }}"
                            class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('user.diagnosa.riwayat') ? 'bg-gray-700 text-white' : 'text-gray-400' }} group transition-colors">
                            <span class="text-sm font-medium group-hover:text-white">Riwayat Diagnosa</span>
                        </a>
                    </div>
                </div>

                <!-- Artikel -->
                <div x-data="{ artikelOpen: {{ request()->routeIs('user.artikel.*') ? 'true' : 'false' }} }">
                    <button @click="artikelOpen = !artikelOpen"
                        class="w-full flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('user.artikel.*') ? 'bg-gray-700' : '' }} group">
                        <div class="flex items-center flex-1">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-yellow-500/20 group-hover:bg-yellow-500/30 transition-colors">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <span x-show="sidebarOpen" class="ml-3 font-semibold">Artikel</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="artikelOpen ? 'rotate-180' : ''" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="artikelOpen && sidebarOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="mt-1 ml-6 pl-4 border-l-2 border-gray-600 space-y-1">
                        <a href="{{ route('user.artikel.budidaya') }}"
                            class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('user.artikel.budidaya*') ? 'bg-gray-700 text-white' : 'text-gray-400' }} group transition-colors">
                            <span class="text-sm font-medium group-hover:text-white">Budidaya</span>
                        </a>
                        <a href="{{ route('user.artikel.hama-penyakit') }}"
                            class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('user.artikel.hama-penyakit*') ? 'bg-gray-700 text-white' : 'text-gray-400' }} group transition-colors">
                            <span class="text-sm font-medium group-hover:text-white">Hama & Penyakit</span>
                        </a>
                    </div>
                </div>

            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 rounded-xl hover:bg-red-600/20 group">
                        <div class="flex items-center flex-1">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500/20 group-hover:bg-red-500/30 transition-colors">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                            <span x-show="sidebarOpen" class="ml-3 font-semibold text-red-400">Logout</span>
                        </div>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="flex-1 sidebar-transition">

            <!-- Header -->
            <header class="bg-white border-b border-gray-200 fixed top-0 right-0 z-20 shadow-sm" :class="sidebarOpen ? 'left-64' : 'left-20'" style="transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                <div class="px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                            <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle', 'Sistem Pakar Diagnosa Penyakit Tanaman Kopi')</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Profile -->
                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-3 py-2 rounded-xl bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 transition-all">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ substr(Auth::user()->nama, 0, 1) }}
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-bold text-gray-800">{{ Auth::user()->nama }}</p>
                                    <p class="text-xs text-green-600 font-semibold uppercase">User</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="pt-28">
                <div class="p-8 page-content">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="px-8 py-6 bg-white border-t border-gray-200">
                <div class="text-center text-sm text-gray-600">
                    &copy; {{ date('Y') }} Coffee Expert System. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>
</html>