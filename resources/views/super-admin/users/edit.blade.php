<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('super-admin.users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Username -->
                        <div>
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('username')" />
                        </div>

                        <!-- Nama -->
                        <div>
                            <x-input-label for="nama" :value="__('Nama Lengkap')" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $user->nama)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <!-- Password (Optional) -->
                        <div>
                            <x-input-label for="password" :value="__('Password Baru (kosongkan jika tidak ingin mengubah)')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" />
                        </div>

                        <!-- No HP -->
                        <div>
                            <x-input-label for="no_hp" :value="__('Nomor HP')" />
                            <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $user->no_hp)" />
                            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                        </div>

                        <!-- Role -->
                        <div>
                            <x-input-label for="role" :value="__('Role')" />
                            <select id="role" name="role" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('role')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                            <a href="{{ route('super-admin.users.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
