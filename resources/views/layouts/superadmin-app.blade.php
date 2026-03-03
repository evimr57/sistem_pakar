<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: true }" x-cloak>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Super Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #0f1f0f; }
        ::-webkit-scrollbar-thumb { background: #16a34a; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #15803d; }

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

        .sidebar-bg {
            background: linear-gradient(160deg, #0f2010 0%, #0a1a0b 50%, #0d1e0e 100%);
        }

        .crown-glow {
            filter: drop-shadow(0 0 6px rgba(251, 191, 36, 0.6));
        }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="sidebar-transition sidebar-bg text-white fixed h-full z-30 flex flex-col shadow-2xl"
        >
            <!-- Logo -->
            <div class="p-6 border-b border-green-900/40">
                <div class="flex items-center justify-between">
                    <div x-show="sidebarOpen" class="flex items-center space-x-3">
                        <div class="logo-float">
                            <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white crown-glow" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M2 19l2-8 4 4 4-8 4 8 4-4 2 8H2z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold bg-gradient-to-r from-yellow-400 to-amber-200 bg-clip-text text-transparent">Coffee Expert</h1>
                            <p class="text-xs text-purple-300/70">Super Admin Panel</p>
                        </div>
                    </div>
                    <!-- Collapsed logo (when sidebar is closed) -->
                    <div x-show="!sidebarOpen" class="mx-auto logo-float">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white crown-glow" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M2 19l2-8 4 4 4-8 4 8 4-4 2 8H2z"/>
                            </svg>
                        </div>
                    </div>
                    <button x-show="sidebarOpen" @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg hover:bg-green-800/30 transition-colors">
                        <svg class="w-5 h-5 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <button x-show="!sidebarOpen" @click="sidebarOpen = !sidebarOpen" class="absolute bottom-0 left-0 right-0 mx-auto w-full flex justify-center py-2 hover:bg-green-800/20 transition-colors">
                        <svg class="w-5 h-5 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

                <!-- Dashboard -->
                <a href="{{ route('super-admin.dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-xl hover:bg-green-800/30 {{ request()->routeIs('super-admin.dashboard') ? 'bg-green-800/40 ring-1 ring-green-500/30' : '' }} group">
                    <div class="flex items-center flex-1">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-500/20 group-hover:bg-blue-500/30 transition-colors">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <span x-show="sidebarOpen" class="ml-3 font-semibold text-gray-200">Dashboard</span>
                    </div>
                </a>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-green-900/40">
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
                            <!-- Super Admin Badge -->
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-amber-500 text-white shadow badge-pulse">
                                ★ SUPER ADMIN
                            </span>
                            <!-- Profile -->
                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-3 py-2 rounded-xl bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 transition-all">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ substr(Auth::user()->nama, 0, 1) }}
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-bold text-gray-800">{{ Auth::user()->nama }}</p>
                                    <p class="text-xs text-green-600 font-semibold uppercase">Super Admin</p>
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