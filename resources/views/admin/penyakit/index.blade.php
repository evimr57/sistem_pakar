@extends('layouts.admin-app')

@section('page-title', 'Manajemen Penyakit')
@section('page-subtitle', 'Kelola data penyakit tanaman kopi')

@section('content')
    @if (session('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg flex items-center" role="alert">
            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg flex items-center" role="alert">
            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span class="font-semibold">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg">
        <!-- Header Section - Normal (No Sticky) -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-xl p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Daftar Penyakit & Hama Tanaman Kopi</h3>
                </div>
                <a href="{{ route('admin.penyakit.create') }}" class="flex items-center px-5 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold rounded-xl hover:from-red-600 hover:to-red-700 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Data
                </a>
            </div>
        </div>

        <!-- Table Section with Horizontal Scroll Only -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Kode</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Gambar</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Nama Penyakit</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Nama Latin</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Kategori</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Deskripsi Singkat</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Deskripsi Lengkap</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Pengendalian Pencegahan</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Pengendalian Kimia</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Pengendalian Organik</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Pengendalian Budidaya</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Tingkat Bahaya</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($penyakits as $index => $penyakit)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <!-- No -->
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                {{ $penyakits->firstItem() + $index }}
                            </td>

                            <!-- Kode Penyakit -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-800 text-white">
                                    {{ $penyakit->id_penyakit }}
                                </span>
                            </td>

                            <!-- Gambar Preview -->
                            <td class="px-4 py-4">
                                @if($penyakit->gambar_url)
                                    <img 
                                        src="{{ $penyakit->gambar_url }}" 
                                        alt="{{ $penyakit->nama_penyakit }}" 
                                        class="w-16 h-16 object-cover rounded-lg shadow-sm cursor-pointer hover:scale-110 transition-transform"
                                        onclick="openModal('{{ $penyakit->gambar_url }}', '{{ $penyakit->nama_penyakit }}')"
                                    >
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </td>

                            <!-- Nama Penyakit -->
                            <td class="px-4 py-4">
                                <div class="text-sm font-bold text-gray-900 min-w-[150px]">{{ $penyakit->nama_penyakit }}</div>
                            </td>

                            <!-- Nama Latin -->
                            <td class="px-4 py-4">
                                <div class="text-sm text-gray-600 italic min-w-[120px]">{{ $penyakit->nama_latin ?? '-' }}</div>
                            </td>

                            <!-- Kategori -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($penyakit->kategori === 'Penyakit')
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800">
                                        Penyakit
                                    </span>
                                @elseif($penyakit->kategori === 'Hama')
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-orange-100 text-orange-800">
                                        Hama
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-800">
                                        {{ $penyakit->kategori ?? '-' }}
                                    </span>
                                @endif
                            </td>

                            <!-- Deskripsi Singkat -->
                            <td class="px-4 py-4">
                                <div class="text-sm text-gray-600 max-w-xs">{{ Str::limit($penyakit->deskripsi_singkat ?? '-', 80) }}</div>
                            </td>

                            <!-- Deskripsi Lengkap -->
                            <td class="px-4 py-4">
                                <div class="text-sm text-gray-600 max-w-xs">{{ Str::limit($penyakit->deskripsi_lengkap ?? '-', 80) }}</div>
                            </td>

                            <!-- Pengendalian Pencegahan -->
                            <td class="px-4 py-4">
                                <div class="text-sm text-gray-600 max-w-xs">{{ Str::limit($penyakit->pengendalian_pencegahan ?? '-', 60) }}</div>
                            </td>

                            <!-- Pengendalian Kimia -->
                            <td class="px-4 py-4">
                                <div class="text-sm text-gray-600 max-w-xs">{{ Str::limit($penyakit->pengendalian_kimia ?? '-', 60) }}</div>
                            </td>

                            <!-- Pengendalian Organik -->
                            <td class="px-4 py-4">
                                <div class="text-sm text-gray-600 max-w-xs">{{ Str::limit($penyakit->pengendalian_organik ?? '-', 60) }}</div>
                            </td>

                            <!-- Pengendalian Budidaya -->
                            <td class="px-4 py-4">
                                <div class="text-sm text-gray-600 max-w-xs">{{ Str::limit($penyakit->pengendalian_budidaya ?? '-', 60) }}</div>
                            </td>

                            <!-- Tingkat Bahaya -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($penyakit->tingkat_bahaya === 'Sangat Tinggi')
                                    <span class="px-2 py-1 text-xs font-bold rounded-full bg-red-600 text-white">{{ $penyakit->tingkat_bahaya }}</span>
                                @elseif($penyakit->tingkat_bahaya === 'Tinggi')
                                    <span class="px-2 py-1 text-xs font-bold rounded-full bg-orange-500 text-white">{{ $penyakit->tingkat_bahaya }}</span>
                                @elseif($penyakit->tingkat_bahaya === 'Sedang')
                                    <span class="px-2 py-1 text-xs font-bold rounded-full bg-yellow-500 text-white">{{ $penyakit->tingkat_bahaya }}</span>
                                @elseif($penyakit->tingkat_bahaya === 'Rendah')
                                    <span class="px-2 py-1 text-xs font-bold rounded-full bg-green-500 text-white">{{ $penyakit->tingkat_bahaya }}</span>
                                @else
                                    <span class="text-sm text-gray-500">{{ $penyakit->tingkat_bahaya ?? '-' }}</span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.penyakit.edit', $penyakit) }}" class="inline-flex items-center px-3 py-2 bg-blue-500 text-white text-xs font-semibold rounded-lg hover:bg-blue-600 transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.penyakit.destroy', $penyakit) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-500 text-white text-xs font-semibold rounded-lg hover:bg-red-600 transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-xl font-semibold mb-2">Belum ada data</p>
                                    <p class="text-sm">Klik tombol "Tambah Data" untuk menambahkan penyakit atau hama</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $penyakits->links() }}
        </div>
    </div>

    <!-- Image Modal Lightbox -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center p-4" onclick="closeModal()">
        <div class="relative max-w-5xl max-h-full" onclick="event.stopPropagation()">
            <!-- Close Button -->
            <button 
                onclick="closeModal()" 
                class="absolute -top-12 right-0 text-white hover:text-gray-300 transition"
            >
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Image -->
            <img 
                id="modalImage" 
                src="" 
                alt="" 
                class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl"
            >
            
            <!-- Image Title -->
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4 rounded-b-lg">
                <p id="modalTitle" class="text-white text-lg font-semibold"></p>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        function openModal(imageUrl, title) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scroll
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Restore scroll
        }

        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endsection