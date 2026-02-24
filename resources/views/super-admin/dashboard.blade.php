<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                ☕ {{ __('Super Admin Dashboard') }}
            </h2>
            <span class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-bold rounded-full shadow-lg">
                SUPER ADMIN
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Card with Gradient -->
            <div class="bg-gradient-to-r from-green-600 via-green-700 to-green-800 overflow-hidden shadow-xl sm:rounded-2xl transform hover:scale-[1.01] transition duration-300">
                <div class="p-8 text-white relative overflow-hidden">
                    <!-- Decorative circles -->
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute -right-5 -bottom-5 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center mb-4">
                            <div class="bg-white bg-opacity-20 rounded-full p-3 mr-4">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold">Selamat Datang Kembali! 👋</h3>
                                <p class="text-green-100 text-lg mt-1">{{ Auth::user()->nama }}</p>
                            </div>
                        </div>
                        <p class="text-green-50 text-base">Sistem Pakar Diagnosa Tanaman Kopi</p>
                        <div class="mt-4 flex items-center space-x-4">
                            <div class="flex items-center bg-white bg-opacity-20 rounded-full px-4 py-2">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">{{ now()->translatedFormat('l, d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards with Hover Effects -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Users Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl transform hover:scale-105 transition duration-300 hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Users</p>
                                <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ \App\Models\User::count() }}</h3>
                                <p class="text-xs text-gray-500 mt-2">Semua pengguna terdaftar</p>
                            </div>
                            <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl p-4 shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center text-green-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-xs font-semibold">Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Super Admins Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl transform hover:scale-105 transition duration-300 hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Super Admins</p>
                                <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ \App\Models\User::where('role', 'super_admin')->count() }}</h3>
                                <p class="text-xs text-gray-500 mt-2">Administrator tertinggi</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-400 to-red-600 rounded-2xl p-4 shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center text-red-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-xs font-semibold">Full Access</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Regular Admins Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl transform hover:scale-105 transition duration-300 hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Admins</p>
                                <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ \App\Models\User::where('role', 'admin')->count() }}</h3>
                                <p class="text-xs text-gray-500 mt-2">Administrator biasa</p>
                            </div>
                            <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-2xl p-4 shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center text-green-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-xs font-semibold">Verified</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Regular Users Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl transform hover:scale-105 transition duration-300 hover:shadow-2xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Regular Users</p>
                                <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ \App\Models\User::where('role', 'user')->count() }}</h3>
                                <p class="text-xs text-gray-500 mt-2">Pengguna biasa</p>
                            </div>
                            <div class="bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl p-4 shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center text-purple-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                </svg>
                                <span class="text-xs font-semibold">Community</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions with Modern Design -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-3 mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Quick Actions</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Manage Users -->
                        <a href="{{ route('super-admin.users.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <div class="flex items-center">
                                <div class="bg-blue-500 text-white rounded-xl p-4 mr-4 group-hover:bg-blue-600 transition-colors">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-800 text-lg">Manage Users</p>
                                    <p class="text-sm text-gray-600 mt-1">Kelola semua pengguna</p>
                                </div>
                                <svg class="w-5 h-5 text-blue-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>

                        <!-- Add New User -->
                        <a href="{{ route('super-admin.users.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <div class="flex items-center">
                                <div class="bg-green-500 text-white rounded-xl p-4 mr-4 group-hover:bg-green-600 transition-colors">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-800 text-lg">Add New User</p>
                                    <p class="text-sm text-gray-600 mt-1">Tambah pengguna baru</p>
                                </div>
                                <svg class="w-5 h-5 text-green-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>

                        <!-- Settings -->
                        <a href="{{ route('profile.edit') }}" class="group relative overflow-hidden bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <div class="flex items-center">
                                <div class="bg-purple-500 text-white rounded-xl p-4 mr-4 group-hover:bg-purple-600 transition-colors">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-800 text-lg">Settings</p>
                                    <p class="text-sm text-gray-600 mt-1">Edit profil Anda</p>
                                </div>
                                <svg class="w-5 h-5 text-purple-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Users Table -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-3 mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">Recent Users</h3>
                        </div>
                        <a href="{{ route('super-admin.users.index') }}" class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-semibold rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all shadow-lg hover:shadow-xl">
                            View All
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Username</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Registered</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse(\App\Models\User::latest()->take(5)->get() as $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                                {{ strtoupper(substr($user->username, 0, 1)) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900">{{ $user->username }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-medium">{{ $user->nama }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->role === 'super_admin')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gradient-to-r from-red-500 to-red-600 text-white shadow-md">
                                                ⭐ Super Admin
                                            </span>
                                        @elseif($user->role === 'admin')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md">
                                                👤 Admin
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gradient-to-r from-gray-400 to-gray-500 text-white shadow-md">
                                                👥 User
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $user->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center">
                                        <div class="text-gray-400">
                                            <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                            </svg>
                                            <p class="text-lg font-semibold">Belum ada data user</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>