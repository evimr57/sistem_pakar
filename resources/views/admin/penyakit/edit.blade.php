@extends('layouts.admin-app')

@section('page-title', 'Edit Penyakit')
@section('page-subtitle', 'Edit data penyakit tanaman kopi')

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

    <form action="{{ route('admin.penyakit.update', $penyakit) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow-lg">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Form Edit Penyakit</h3>
                </div>
            </div>

            <!-- Form Body -->
            <div class="p-8 space-y-6">
                
                <!-- ID Penyakit (Read-only) -->
                <div>
                    <label for="id_penyakit" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kode Penyakit
                    </label>
                    <input 
                        type="text" 
                        name="id_penyakit" 
                        id="id_penyakit" 
                        value="{{ $penyakit->id_penyakit }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100 cursor-not-allowed"
                        readonly
                        disabled
                    >
                    <p class="mt-1 text-sm text-gray-500">Kode penyakit tidak dapat diubah setelah dibuat.</p>
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
                        value="{{ old('nama_penyakit', $penyakit->nama_penyakit) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('nama_penyakit') border-red-500 @enderror"
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
                        value="{{ old('nama_latin', $penyakit->nama_latin) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        required
                    >
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Hama" {{ old('kategori', $penyakit->kategori) == 'Hama' ? 'selected' : '' }}>Hama</option>
                        <option value="Penyakit" {{ old('kategori', $penyakit->kategori) == 'Penyakit' ? 'selected' : '' }}>Penyakit</option>
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Ringkasan singkat tentang penyakit/hama ini..."
                    >{{ old('deskripsi_singkat', $penyakit->deskripsi_singkat) }}</textarea>
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Penjelasan detail tentang penyakit/hama, gejala, dampak, dll..."
                    >{{ old('deskripsi_lengkap', $penyakit->deskripsi_lengkap) }}</textarea>
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Cara pencegahan sebelum terjadi serangan..."
                    >{{ old('pengendalian_pencegahan', $penyakit->pengendalian_pencegahan) }}</textarea>
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Pestisida atau bahan kimia yang dapat digunakan..."
                    >{{ old('pengendalian_kimia', $penyakit->pengendalian_kimia) }}</textarea>
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Cara pengendalian dengan bahan organik/alami..."
                    >{{ old('pengendalian_organik', $penyakit->pengendalian_organik) }}</textarea>
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Teknik budidaya untuk mengendalikan hama/penyakit..."
                    >{{ old('pengendalian_budidaya', $penyakit->pengendalian_budidaya) }}</textarea>
                </div>

                <!-- Tingkat Bahaya -->
                <div>
                    <label for="tingkat_bahaya" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tingkat Bahaya
                    </label>
                    <select 
                        name="tingkat_bahaya" 
                        id="tingkat_bahaya" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    >
                        <option value="">-- Pilih Tingkat Bahaya --</option>
                        <option value="Rendah" {{ old('tingkat_bahaya', $penyakit->tingkat_bahaya) == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="Sedang" {{ old('tingkat_bahaya', $penyakit->tingkat_bahaya) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Tinggi" {{ old('tingkat_bahaya', $penyakit->tingkat_bahaya) == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                        <option value="Sangat Tinggi" {{ old('tingkat_bahaya', $penyakit->tingkat_bahaya) == 'Sangat Tinggi' ? 'selected' : '' }}>Sangat Tinggi</option>
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        onchange="previewImage(event)"
                    >
                    <p class="mt-2 text-sm text-gray-500">Format: JPG, PNG, WebP. Maksimal 2MB</p>
                    
                    <!-- Preview Gambar Baru -->
                    <div id="imagePreview" class="mt-3 hidden">
                        <p class="text-sm text-gray-600 mb-2">Preview gambar baru:</p>
                        <img id="preview" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg shadow-sm">
                    </div>
                    
                    <!-- Preview Gambar Lama -->
                    @if($penyakit->gambar_url)
                        <div class="mt-3">
                            <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                            <img src="{{ $penyakit->gambar_url }}" alt="Current" class="w-32 h-32 object-cover rounded-lg shadow-sm">
                            <p class="text-xs text-gray-500 mt-2">Upload gambar baru untuk mengganti</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex justify-between items-center rounded-b-2xl">
                <a href="{{ route('admin.penyakit.index') }}" class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-400 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Update Data
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