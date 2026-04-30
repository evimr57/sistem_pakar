<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ sidebarOpen: true, mobileOpen: false }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('page-title', 'Dashboard')</title>
    <link rel="icon" href="{{ asset('asset/images/v2_nobg.png') }}?v=2" type="image/png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #5FA357; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #4a8345; }

        .sidebar-transition {
            transition: width 0.3s cubic-bezier(0.4,0,0.2,1),
                        margin-left 0.3s cubic-bezier(0.4,0,0.2,1),
                        left 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .sidebar-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 25;
        }

        @keyframes float {
            0%,100% { transform: translateY(0px); }
            50%      { transform: translateY(-5px); }
        }
        .logo-float { animation: float 3s ease-in-out infinite; }

        @keyframes fadeInUp {
            from { opacity:0; transform:translateY(20px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .page-content { animation: fadeInUp .5s ease-out; }

        @keyframes pulse {
            0%,100% { opacity:1; }
            50%     { opacity:.5; }
        }
        .badge-pulse { animation: pulse 2s cubic-bezier(.4,0,.6,1) infinite; }
        @media (max-width: 1023px) {
            .sidebar-desktop { display: none !important; }
            .main-content { margin-left: 0 !important; }
            .header-bar { left: 0 !important; }
        }

    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
<div class="min-h-screen flex">

    {{-- ── Mobile overlay ── --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="sidebar-overlay lg:hidden"
         @click="mobileOpen = false">
    </div>

    {{-- ── Sidebar Desktop (collapse/expand) ── --}}
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
           class="sidebar-transition bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900
                  text-white fixed h-full z-30 flex-col shadow-2xl sidebar-desktop" style="display:flex;">

        <!-- Logo -->
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <div x-show="sidebarOpen" class="flex items-center space-x-3">
                    <div class="logo-float">
                        <div class="w-10 h-10 rounded-xl overflow-hidden shadow-lg flex-shrink-0">
                            <img src="{{ asset('asset/images/ori_nobg.png') }}" class="w-full h-full object-cover" alt="Logo">
                        </div>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-green-400 to-green-200 bg-clip-text text-transparent">Cek Kopi</h1>
                        <p class="text-xs text-gray-400">Admin</p>
                    </div>
                </div>
                <div x-show="!sidebarOpen" class="mx-auto logo-float">
                    <div class="w-10 h-10 rounded-xl overflow-hidden shadow-lg">
                        <img src="{{ asset('asset/images/ori_nobg.png') }}" class="w-full h-full object-cover" alt="Logo">
                    </div>
                </div>
                <button @click="sidebarOpen = !sidebarOpen"
                        class="p-2 rounded-lg hover:bg-gray-700 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Nav Desktop -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }} group">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-500/20 group-hover:bg-blue-500/30 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span x-show="sidebarOpen" class="ml-3 font-semibold">Dashboard</span>
            </a>

            <a href="{{ route('admin.penyakit.index') }}"
               class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.penyakit.*') ? 'bg-gray-700' : '' }} group">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500/20 group-hover:bg-red-500/30 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <span x-show="sidebarOpen" class="ml-3 font-semibold">Penyakit</span>
            </a>

            <a href="{{ route('admin.gejala.index') }}"
               class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.gejala.*') ? 'bg-gray-700' : '' }} group">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-green-500/20 group-hover:bg-green-500/30 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <span x-show="sidebarOpen" class="ml-3 font-semibold">Gejala</span>
            </a>

            <a href="{{ route('admin.rule-basis.index') }}"
               class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.rule-basis.*') ? 'bg-gray-700' : '' }} group">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg transition-colors flex-shrink-0" style="background:rgba(139,92,246,.2);">
                    <svg class="w-5 h-5" style="color:#a78bfa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <span x-show="sidebarOpen" class="ml-3 font-semibold">Rule Basis</span>
            </a>

            <!-- Artikel dropdown -->
            <div x-data="{ open: {{ request()->routeIs('admin.artikel-budidaya.*') || request()->routeIs('admin.artikel-hama-penyakit.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="w-full flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.artikel-budidaya.*') || request()->routeIs('admin.artikel-hama-penyakit.*') ? 'bg-gray-700' : '' }} group">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-yellow-500/20 group-hover:bg-yellow-500/30 transition-colors flex-shrink-0">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <span x-show="sidebarOpen" class="ml-3 font-semibold flex-1 text-left">Artikel</span>
                    <svg x-show="sidebarOpen" :class="open ? 'rotate-180' : ''"
                         class="w-4 h-4 text-gray-400 transition-transform duration-200"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open && sidebarOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="mt-1 ml-6 pl-4 border-l-2 border-gray-600 space-y-1">
                    <a href="{{ route('admin.artikel-budidaya.index') }}"
                       class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.artikel-budidaya.*') ? 'bg-gray-700 text-white' : 'text-gray-400' }} transition-colors">
                        <span class="text-sm font-medium hover:text-white">Budidaya</span>
                    </a>
                    <a href="{{ route('admin.artikel-hama-penyakit.index') }}"
                       class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.artikel-hama-penyakit.*') ? 'bg-gray-700 text-white' : 'text-gray-400' }} transition-colors">
                        <span class="text-sm font-medium hover:text-white">Hama &amp; Penyakit</span>
                    </a>
                </div>
            </div>

        </nav>

        <!-- Logout Desktop -->
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 rounded-xl hover:bg-red-600/20 group">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500/20 group-hover:bg-red-500/30 transition-colors flex-shrink-0">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span x-show="sidebarOpen" class="ml-3 font-semibold text-red-400">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Sidebar Mobile Drawer ── --}}
    <aside x-show="mobileOpen"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           class="bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white
                  fixed h-full z-30 flex flex-col shadow-2xl w-72 lg:hidden">

        <!-- Logo Mobile -->
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="logo-float">
                        <div class="w-10 h-10 rounded-xl overflow-hidden shadow-lg flex-shrink-0">
                            <img src="{{ asset('asset/images/ori_nobg.png') }}" class="w-full h-full object-cover" alt="Logo">
                        </div>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-green-400 to-green-200 bg-clip-text text-transparent">Cek Kopi</h1>
                        <p class="text-xs text-gray-400">Admin</p>
                    </div>
                </div>
                <button @click="mobileOpen = false" class="p-2 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Nav Mobile -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

            <a href="{{ route('admin.dashboard') }}" @click="mobileOpen=false"
               class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }} group">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-500/20 group-hover:bg-blue-500/30 transition-colors">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="ml-3 font-semibold">Dashboard</span>
            </a>

            <a href="{{ route('admin.penyakit.index') }}" @click="mobileOpen=false"
               class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.penyakit.*') ? 'bg-gray-700' : '' }} group">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500/20 group-hover:bg-red-500/30 transition-colors">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <span class="ml-3 font-semibold">Penyakit</span>
            </a>

            <a href="{{ route('admin.gejala.index') }}" @click="mobileOpen=false"
               class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.gejala.*') ? 'bg-gray-700' : '' }} group">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-green-500/20 group-hover:bg-green-500/30 transition-colors">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <span class="ml-3 font-semibold">Gejala</span>
            </a>

            <a href="{{ route('admin.rule-basis.index') }}" @click="mobileOpen=false"
               class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.rule-basis.*') ? 'bg-gray-700' : '' }} group">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg transition-colors" style="background:rgba(139,92,246,.2);">
                    <svg class="w-5 h-5" style="color:#a78bfa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <span class="ml-3 font-semibold">Rule Basis</span>
            </a>

            <!-- Artikel dropdown mobile -->
            <div x-data="{ open: {{ request()->routeIs('admin.artikel-budidaya.*') || request()->routeIs('admin.artikel-hama-penyakit.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="w-full flex items-center px-4 py-3 rounded-xl hover:bg-gray-700 {{ request()->routeIs('admin.artikel-budidaya.*') || request()->routeIs('admin.artikel-hama-penyakit.*') ? 'bg-gray-700' : '' }} group">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-yellow-500/20 group-hover:bg-yellow-500/30 transition-colors">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <span class="ml-3 font-semibold flex-1 text-left">Artikel</span>
                    <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="mt-1 ml-6 pl-4 border-l-2 border-gray-600 space-y-1">
                    <a href="{{ route('admin.artikel-budidaya.index') }}" @click="mobileOpen=false"
                       class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.artikel-budidaya.*') ? 'bg-gray-700 text-white' : 'text-gray-400' }} transition-colors">
                        <span class="text-sm font-medium hover:text-white">Budidaya</span>
                    </a>
                    <a href="{{ route('admin.artikel-hama-penyakit.index') }}" @click="mobileOpen=false"
                       class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.artikel-hama-penyakit.*') ? 'bg-gray-700 text-white' : 'text-gray-400' }} transition-colors">
                        <span class="text-sm font-medium hover:text-white">Hama &amp; Penyakit</span>
                    </a>
                </div>
            </div>

        </nav>

        <!-- Logout Mobile -->
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 rounded-xl hover:bg-red-600/20 group">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500/20 group-hover:bg-red-500/30 transition-colors">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span class="ml-3 font-semibold text-red-400">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main Content ── --}}
    <div
         class="flex-1 sidebar-transition main-content" style="margin-left:16rem;">

        <!-- Header -->
        <header class="bg-white border-b border-gray-200 fixed top-0 right-0 z-20 shadow-sm header-bar" style="left:16rem;"
                style="transition: left 0.3s cubic-bezier(0.4,0,0.2,1);">
            <div class="px-4 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <!-- Hamburger mobile -->
                        <button @click="mobileOpen = true"
                                class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <h2 class="text-xl lg:text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center space-x-2 lg:space-x-3 px-2 lg:px-3 py-2 rounded-xl bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 transition-all">
                            <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white font-bold shadow-lg text-sm">
                                {{ substr(Auth::user()->nama, 0, 1) }}
                            </div>
                            <div class="text-left hidden sm:block">
                                <p class="text-sm font-bold text-gray-800">{{ Auth::user()->nama }}</p>
                                <p class="text-xs text-green-600 font-semibold uppercase">Admin</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main style="padding-top: 73px;">
            <div class="p-4 lg:p-8 page-content">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="px-4 lg:px-8 py-6 bg-white border-t border-gray-200">
            <div class="text-center text-sm text-gray-600">
                &copy; {{ date('Y') }} Cek Kopi by Evi. All rights reserved.
            </div>
        </footer>
    </div>

</div>
@stack('scripts')
</body>
</html>