@extends('layouts.admin-app')

@section('page-title', 'Edit Artikel Budidaya')
@section('page-subtitle', 'Edit informasi budidaya kopi')

@section('content')
<div class="bg-white rounded-2xl shadow-lg">
    <div class="p-8">
        <form action="{{ route('admin.artikel-budidaya.update', $artikelBudidaya) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $artikelBudidaya->judul) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent @error('judul') border-red-500 @enderror">
                    @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Deskripsi Singkat -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Singkat</label>
                    <textarea name="deskripsi_singkat" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ old('deskripsi_singkat', $artikelBudidaya->deskripsi_singkat) }}</textarea>
                </div>

                <!-- Konten -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Konten <span class="text-red-500">*</span></label>
                    <textarea name="konten" rows="10"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent @error('konten') border-red-500 @enderror">{{ old('konten', $artikelBudidaya->konten) }}</textarea>
                    @error('konten') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Gambar Utama -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Utama</label>
                        @if($artikelBudidaya->gambar_utama)
                            <img src="{{ Storage::url($artikelBudidaya->gambar_utama) }}" class="w-32 h-24 object-cover rounded-lg mb-2">
                        @endif
                        <input type="file" name="gambar_utama" accept="image/*"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500">
                        <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">File PDF</label>
                        @if($artikelBudidaya->file_pdf)
                            <a href="{{ Storage::url($artikelBudidaya->file_pdf) }}" target="_blank" class="text-xs text-blue-500 underline mb-2 block">Lihat PDF saat ini</a>
                        @endif
                        <input type="file" name="file_pdf" accept=".pdf"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500">
                        <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah PDF</p>
                    </div>
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tags</label>
                    <div id="tags-container" class="w-full px-4 py-3 border border-gray-300 rounded-xl flex flex-wrap gap-2 min-h-[50px]">
                    </div>
                    <input type="text" id="tags-input"
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500"
                        placeholder="Ketik tag lalu tekan Enter...">
                    <p class="text-xs text-gray-400 mt-1">Tekan Enter atau koma untuk menambah tag</p>
                    <input type="hidden" name="tags" id="tags-hidden" value="[]">
                </div>

                <!-- Galeri Gambar -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Galeri Gambar</label>
                    @if($artikelBudidaya->galeri_gambar)
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($artikelBudidaya->galeri_gambar as $foto)
                                <img src="{{ Storage::url($foto) }}" class="w-24 h-20 object-cover rounded-lg">
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="galeri_gambar[]" accept="image/*" multiple
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500">
                    <p class="text-xs text-gray-400 mt-1">Upload foto baru akan menggantikan galeri yang lama</p>
                </div>
                <!-- Status Publish -->
                <div class="flex items-center space-x-3">
                    <input type="checkbox" name="is_published" value="1" id="is_published" {{ old('is_published', $artikelBudidaya->is_published) ? 'checked' : '' }}
                        class="w-5 h-5 text-green-600 rounded focus:ring-green-500">
                    <label for="is_published" class="text-sm font-bold text-gray-700">Publikasikan</label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.artikel-budidaya.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-xl hover:from-green-600 hover:to-green-700 transition shadow-lg">
                    Update Artikel
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
    
    // Load tags yang sudah ada
    let tags = {!! json_encode($artikelBudidaya->tags ?? []) !!};

    function renderTags() {
        tagsContainer.innerHTML = '';
        tags.forEach((tag, index) => {
            tagsContainer.innerHTML += `
                <span class="flex items-center px-3 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full">
                    ${tag}
                    <button type="button" onclick="removeTag(${index})" class="ml-2 text-green-600 hover:text-red-500">✕</button>
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

    // Render tags awal
    renderTags();
</script>
@endpush