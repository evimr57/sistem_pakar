@extends('layouts.admin-app')

@section('page-title', '👤 Profile Settings')
@section('page-subtitle', 'Kelola informasi profil Anda')

@section('content')
    <!-- Profile Information Card -->
    <div class="bg-white rounded-2xl shadow-lg mb-6">
        <div class="p-8">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-3 mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Profile Information</h3>
                    <p class="text-sm text-gray-600">Update your account's profile information and email address</p>
                </div>
            </div>

            @if (session('status') === 'profile-updated')
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold">Profile updated successfully!</span>
                </div>
            @endif

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="{{ old('username', $user->username) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        required
                    >
                    @error('username')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input 
                        type="text" 
                        id="nama" 
                        name="nama" 
                        value="{{ old('nama', $user->nama) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        required
                    >
                    @error('nama')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        required
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-sm text-yellow-800">
                                Your email address is unverified.
                                <button form="send-verification" class="underline text-sm text-yellow-600 hover:text-yellow-900">
                                    Click here to re-send the verification email.
                                </button>
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Nomor HP -->
                <div>
                    <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP</label>
                    <input 
                        type="text" 
                        id="no_hp" 
                        name="no_hp" 
                        value="{{ old('no_hp', $user->no_hp) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        placeholder="08123456789"
                    >
                    @error('no_hp')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-xl hover:from-green-600 hover:to-green-700 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Password Card -->
    <div class="bg-white rounded-2xl shadow-lg mb-6">
        <div class="p-8">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-3 mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Update Password</h3>
                    <p class="text-sm text-gray-600">Ensure your account is using a long, random password to stay secure</p>
                </div>
            </div>

            @if (session('status') === 'password-updated')
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold">Password updated successfully!</span>
                </div>
            @endif

            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        autocomplete="current-password"
                    >
                    @error('current_password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        autocomplete="new-password"
                    >
                    @error('password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        autocomplete="new-password"
                    >
                    @error('password_confirmation', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Account Card -->
    <div class="bg-white rounded-2xl shadow-lg border-2 border-red-200">
        <div class="p-8">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-xl p-3 mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Delete Account</h3>
                    <p class="text-sm text-gray-600">Once your account is deleted, all of its resources and data will be permanently deleted</p>
                </div>
            </div>

            <button 
                type="button"
                onclick="if(confirm('Are you sure you want to delete your account? This action cannot be undone.')) { document.getElementById('delete-account-form').submit(); }"
                class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold rounded-xl hover:from-red-600 hover:to-red-700 transition-all shadow-lg hover:shadow-xl"
            >
                Delete Account
            </button>

            <form id="delete-account-form" method="post" action="{{ route('profile.destroy') }}" class="hidden">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>
@endsection