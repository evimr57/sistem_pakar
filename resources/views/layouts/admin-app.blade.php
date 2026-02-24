<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: true }" x-cloak>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #5FA357;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4a8345;
        }

        /* Sidebar Transition */
        .sidebar-transition {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Logo Float Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        .logo-float {
            animation: float 3s ease-in-out infinite;
        }

        /* Menu Item Active Indicator */
        .menu-item {
            position: relative;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(to bottom, #5FA357, #C1FA70);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .menu-item:hover::before,
        .menu-item.active::before {
            transform: translateX(0);
        }

        /* Page Fade In Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-content {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Badge Pulse */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .badge-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
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
            <!-- Logo Section -->
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
                            <p class="text-xs text-gray-400">Admin Panel</p>
                        </div>
                    </div>
                    <button
                        @click="sidebarOpen = !sidebarOpen"
                        class="p-2 rounded-lg hover:bg-gray-700 transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                   class="menu-item flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'active bg-gray-700' : '' }} group">
                    <div class="flex items-center flex-1">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-500/20 group-hover:bg-blue-500/30 transition-colors">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <span x-show="sidebarOpen" class="ml-3 font-semibold">Dashboard</span>
                    </div>
                </a>

                <!-- Penyakit Management -->
                <a href="{{ route('admin.penyakit.index') }}"
                   class="menu-item flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.penyakit.*') ? 'active bg-gray-700' : '' }} group">
                    <div class="flex items-center flex-1">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500/20 group-hover:bg-red-500/30 transition-colors">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <span x-show="sidebarOpen" class="ml-3 font-semibold">Penyakit</span>
                    </div>
                </a>

                <!-- Gejala Management -->
                <a href="{{ route('admin.gejala.index') }}"
                   class="menu-item flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.gejala.*') ? 'active bg-gray-700' : '' }} group">
                    <div class="flex items-center flex-1">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-green-500/20 group-hover:bg-green-500/30 transition-colors">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <span x-show="sidebarOpen" class="ml-3 font-semibold">Gejala</span>
                    </div>
                </a>

                <!-- Artikel Management -->
                <a href="{{ route('admin.artikel.index') }}"
                   class="menu-item flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.artikel.*') ? 'active bg-gray-700' : '' }} group">
                    <div class="flex items-center flex-1">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-yellow-500/20 group-hover:bg-yellow-500/30 transition-colors">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <span x-show="sidebarOpen" class="ml-3 font-semibold">Artikel</span>
                    </div>
                </a>

            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="menu-item w-full flex items-center px-4 py-3 rounded-xl hover:bg-red-600/20 group">
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

            <!-- Top Header - Fixed at top -->
            <header class="bg-white border-b border-gray-200 fixed top-0 right-0 z-20 shadow-sm" :class="sidebarOpen ? 'left-64' : 'left-20'" style="transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                <div class="px-8 py-4">
                    <div class="flex items-center justify-between">
                        <!-- Page Title -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">
                                @yield('page-title', 'Dashboard')
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">
                                @yield('page-subtitle', 'Sistem Pakar Diagnosa Penyakit Tanaman Kopi')
                            </p>
                        </div>

                        <!-- User Info -->
                        <div class="flex items-center space-x-4">
                            <!-- Notifications -->
                            <button class="relative p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full badge-pulse"></span>
                            </button>

                            <!-- User Profile - Clickable -->
                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-3 py-2 rounded-xl bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 transition-all">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ substr(Auth::user()->nama, 0, 1) }}
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-bold text-gray-800">{{ Auth::user()->nama }}</p>
                                    <p class="text-xs text-green-600 font-semibold uppercase">Admin</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content - Scrollable with top padding for fixed header -->
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