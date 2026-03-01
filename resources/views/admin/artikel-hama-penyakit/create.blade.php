@extends('layouts.admin-app')

@section('page-title', 'Tambah Artikel Hama & Penyakit')
@section('page-subtitle', 'Tambah informasi hama dan penyakit kopi baru')

@section('content')
<div class="bg-white rounded-2xl shadow-lg">
    <div class="p-8">
        <form action="{{ route('admin.artikel-hama-penyakit.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <!-- Judul & Jenis -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent @error('judul') border-red-500 @enderror"
                            placeholder="Masukkan judul artikel...">
                        @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jenis <span class="text-red-500">*</span></label>
                        <select name="jenis" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent @error('jenis') border-red-500 @enderror">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Hama" {{ old('jenis') === 'Hama' ? 'selected' : '' }}>Hama</option>
                            <option value="Penyakit" {{ old('jenis') === 'Penyakit' ? 'selected' : '' }}>Penyakit</option>
                        </select>
                        @error('jenis') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Deskripsi Singkat -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Singkat</label>
                    <textarea name="deskripsi_singkat" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        placeholder="Ringkasan singkat...">{{ old('deskripsi_singkat') }}</textarea>
                </div>

                <!-- Konten -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Konten <span class="text-red-500">*</span></label>
                    <textarea name="konten" rows="8"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent @error('konten') border-red-500 @enderror"
                        placeholder="Tulis konten artikel...">{{ old('konten') }}</textarea>
                    @error('konten') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Info Spesifik Hama Penyakit -->
                <div class="border border-gray-200 rounded-xl p-6 bg-gray-50">
                    <h4 class="font-bold text-gray-700 mb-4">📋 Informasi Teknis</h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Gejala Visual</label>
                            <textarea name="gejala_visual" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 bg-white"
                                placeholder="Deskripsikan gejala yang terlihat...">{{ old('gejala_visual') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Cara Identifikasi</label>
                            <textarea name="cara_identifikasi" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 bg-white"
                                placeholder="Cara mengidentifikasi...">{{ old('cara_identifikasi') }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Pencegahan</label>
                                <textarea name="pencegahan" rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 bg-white"
                                    placeholder="Langkah pencegahan...">{{ old('pencegahan') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Pengendalian</label>
                                <textarea name="pengendalian" rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 bg-white"
                                    placeholder="Cara pengendalian...">{{ old('pengendalian') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gambar & PDF -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Utama</label>
                        <input type="file" name="gambar_utama" accept="image/*"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG. Maks 2MB</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">File PDF</label>
                        <input type="file" name="file_pdf" accept=".pdf"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500">
                        <p class="text-xs text-gray-400 mt-1">Format: PDF. Maks 5MB</p>
                    </div>
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tags</label>
                    <div id="tags-container" class="w-full px-4 py-3 border border-gray-300 rounded-xl flex flex-wrap gap-2 min-h-[50px]"></div>
                    <input type="text" id="tags-input"
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500"
                        placeholder="Ketik tag lalu tekan Enter...">
                    <p class="text-xs text-gray-400 mt-1">Tekan Enter atau koma untuk menambah tag</p>
                    <input type="hidden" name="tags" id="tags-hidden" value="[]">
                </div>

                <!-- Galeri Gambar -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Galeri Gambar</label>
                    <input type="file" name="galeri_gambar[]" accept="image/*" multiple
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500">
                    <p class="text-xs text-gray-400 mt-1">Bisa pilih beberapa foto sekaligus. Format: JPG, PNG. Maks 2MB per foto</p>
                </div>

                <!-- Status Publish -->
                <div class="flex items-center space-x-3">
                    <input type="checkbox" name="is_published" value="1" id="is_published" {{ old('is_published') ? 'checked' : '' }}
                        class="w-5 h-5 text-red-600 rounded focus:ring-red-500">
                    <label for="is_published" class="text-sm font-bold text-gray-700">Publikasikan sekarang</label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.artikel-hama-penyakit.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold rounded-xl hover:from-red-600 hover:to-red-700 transition shadow-lg">
                    Simpan Artikel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const tagsInput = document.getElementById('tags-input');
    const tagsContainer = document.getElementById('tags-container');
    const tagsHidden = document.getElementById('tags-hidden');
    let tags = [];

    function renderTags() {
        tagsContainer.innerHTML = '';
        tags.forEach((tag, index) => {
            tagsContainer.innerHTML += `
                <span class="flex items-center px-3 py-1 bg-red-100 text-red-800 text-xs font-bold rounded-full">
                    ${tag}
                    <button type="button" onclick="removeTag(${index})" class="ml-2 text-red-600 hover:text-red-900">✕</button>
                </span>`;
        });
        tagsHidden.value = JSON.stringify(tags);
    }

    function removeTag(index) {
        tags.splice(index, 1);
        renderTags();
    }

    tagsInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            const val = tagsInput.value.trim();
            if (val) {
                tags.push(val);
                tagsInput.value = '';
                renderTags();
            }
        }
    });
</script>
@endpush