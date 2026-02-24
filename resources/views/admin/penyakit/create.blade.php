@extends('layouts.admin-app')

@section('page-title', '➕ Tambah Penyakit')
@section('page-subtitle', 'Tambah data penyakit tanaman kopi baru')

@section('content')
    @if ($errors->any())
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
            <div class="flex items-start">
                <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.penyakit.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-2xl shadow-lg">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Form Tambah Penyakit Baru</h3>
                </div>
            </div>

            <!-- Form Body -->
            <div class="p-8 space-y-6">
                
                <!-- ID Penyakit -->
                <div>
                    <label for="id_penyakit" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kode Penyakit <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="id_penyakit" 
                        id="id_penyakit" 
                        value="{{ old('id_penyakit') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition @error('id_penyakit') border-red-500 @enderror"
                        placeholder="Contoh: HP001 atau P001"
                        required
                        maxlength="10"
                    >
                    <p class="mt-1 text-sm text-gray-500">Format: HP001 (Hama) atau P001 (Penyakit). Maksimal 10 karakter.</p>
                    @error('id_penyakit')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Penyakit -->
                <div>
                    <label for="nama_penyakit" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Penyakit <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_penyakit" 
                        id="nama_penyakit" 
                        value="{{ old('nama_penyakit') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition @error('nama_penyakit') border-red-500 @enderror"
                        placeholder="Contoh: Penggerek Buah Kopi"
                        required
                    >
                    @error('nama_penyakit')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Latin -->
                <div>
                    <label for="nama_latin" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Latin
                    </label>
                    <input 
                        type="text" 
                        name="nama_latin" 
                        id="nama_latin" 
                        value="{{ old('nama_latin') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        placeholder="Contoh: Hypothenemus hampei"
                    >
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="kategori" 
                        id="kategori" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        required
                    >
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Hama" {{ old('kategori') == 'Hama' ? 'selected' : '' }}>🐛 Hama</option>
                        <option value="Penyakit" {{ old('kategori') == 'Penyakit' ? 'selected' : '' }}>🦠 Penyakit</option>
                    </select>
                    @error('kategori')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi Singkat -->
                <div>
                    <label for="deskripsi_singkat" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Singkat
                    </label>
                    <textarea 
                        name="deskripsi_singkat" 
                        id="deskripsi_singkat" 
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        placeholder="Ringkasan singkat tentang penyakit/hama ini..."
                    >{{ old('deskripsi_singkat') }}</textarea>
                </div>

                <!-- Deskripsi Lengkap -->
                <div>
                    <label for="deskripsi_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Lengkap
                    </label>
                    <textarea 
                        name="deskripsi_lengkap" 
                        id="deskripsi_lengkap" 
                        rows="5"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        placeholder="Penjelasan detail tentang penyakit/hama, gejala, dampak, dll..."
                    >{{ old('deskripsi_lengkap') }}</textarea>
                </div>

                <!-- Pengendalian Pencegahan -->
                <div>
                    <label for="pengendalian_pencegahan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pengendalian Pencegahan
                    </label>
                    <textarea 
                        name="pengendalian_pencegahan" 
                        id="pengendalian_pencegahan" 
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        placeholder="Cara pencegahan sebelum terjadi serangan..."
                    >{{ old('pengendalian_pencegahan') }}</textarea>
                </div>

                <!-- Pengendalian Kimia -->
                <div>
                    <label for="pengendalian_kimia" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pengendalian Kimia
                    </label>
                    <textarea 
                        name="pengendalian_kimia" 
                        id="pengendalian_kimia" 
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        placeholder="Pestisida atau bahan kimia yang dapat digunakan..."
                    >{{ old('pengendalian_kimia') }}</textarea>
                </div>

                <!-- Pengendalian Organik -->
                <div>
                    <label for="pengendalian_organik" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pengendalian Organik
                    </label>
                    <textarea 
                        name="pengendalian_organik" 
                        id="pengendalian_organik" 
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        placeholder="Cara pengendalian dengan bahan organik/alami..."
                    >{{ old('pengendalian_organik') }}</textarea>
                </div>

                <!-- Pengendalian Budidaya -->
                <div>
                    <label for="pengendalian_budidaya" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pengendalian Budidaya
                    </label>
                    <textarea 
                        name="pengendalian_budidaya" 
                        id="pengendalian_budidaya" 
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        placeholder="Teknik budidaya untuk mengendalikan hama/penyakit..."
                    >{{ old('pengendalian_budidaya') }}</textarea>
                </div>

                <!-- Tingkat Bahaya -->
                <div>
                    <label for="tingkat_bahaya" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tingkat Bahaya
                    </label>
                    <select 
                        name="tingkat_bahaya" 
                        id="tingkat_bahaya" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                    >
                        <option value="">-- Pilih Tingkat Bahaya --</option>
                        <option value="Rendah" {{ old('tingkat_bahaya') == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="Sedang" {{ old('tingkat_bahaya') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Tinggi" {{ old('tingkat_bahaya') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                        <option value="Sangat Tinggi" {{ old('tingkat_bahaya') == 'Sangat Tinggi' ? 'selected' : '' }}>Sangat Tinggi</option>
                    </select>
                </div>

                <!-- Upload Gambar -->
                <div>
                    <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">
                        Upload Gambar
                    </label>
                    <input 
                        type="file" 
                        name="gambar" 
                        id="gambar" 
                        accept="image/*"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                        onchange="previewImage(event)"
                    >
                    <p class="mt-2 text-sm text-gray-500">Format: JPG, PNG, WebP. Maksimal 2MB</p>
                    
                    <!-- Preview Gambar -->
                    <div id="imagePreview" class="mt-3 hidden">
                        <p class="text-sm text-gray-600 mb-2">Preview gambar:</p>
                        <img id="preview" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg shadow-sm">
                    </div>
                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex justify-between items-center rounded-b-2xl">
                <a href="{{ route('admin.penyakit.index') }}" class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-400 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-xl hover:from-green-600 hover:to-green-700 transition-all shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Simpan Data
                </button>
            </div>
        </div>
    </form>

    <!-- JavaScript for Image Preview -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection