<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Daftar User</h3>
                        <a href="{{ route('super-admin.users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Tambah User
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">No HP</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 border-b">{{ $user->id }}</td>
                                        <td class="px-6 py-4 border-b">{{ $user->username }}</td>
                                        <td class="px-6 py-4 border-b">{{ $user->nama }}</td>
                                        <td class="px-6 py-4 border-b">{{ $user->email }}</td>
                                        <td class="px-6 py-4 border-b">{{ $user->no_hp ?? '-' }}</td>
                                        <td class="px-6 py-4 border-b">
                                            @if($user->role === 'super_admin')
                                                <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Super Admin</span>
                                            @elseif($user->role === 'admin')
                                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Admin</span>
                                            @else
                                                <span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded-full">User</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 border-b">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('super-admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                                
                                                @if($user->id !== auth()->id())
                                                    <form action="{{ route('super-admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 border-b text-center text-gray-500">
                                            Belum ada data user.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>