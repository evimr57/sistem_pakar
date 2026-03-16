@extends('layouts.admin-app')

@section('page-title', 'Edit Artikel Hama & Penyakit')
@section('page-subtitle', 'Edit informasi hama dan penyakit kopi')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100">

    {{-- Form Header --}}
    <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
            <i class="bi bi-pencil-square text-red-500 text-lg"></i>
        </div>
        <div>
            <h3 class="font-bold text-gray-800 text-base leading-tight">Edit Artikel</h3>
            <p class="text-xs text-gray-400 mt-0.5">Perbarui informasi hama dan penyakit kopi</p>
        </div>
    </div>

    <div class="p-8">
        <form action="{{ route('admin.artikel-hama-penyakit.update', $artikelHamaPenyakit) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-7">

                {{-- Judul & Jenis --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                            Judul <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul', $artikelHamaPenyakit->judul) }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:ring-2 focus:ring-red-400 focus:border-transparent transition @error('judul') border-red-400 bg-red-50 @enderror"
                            placeholder="Judul artikel...">
                        @error('judul')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                            Jenis <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="jenis" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 focus:ring-2 focus:ring-red-400 focus:border-transparent appearance-none transition bg-white">
                                <option value="Hama" {{ old('jenis', $artikelHamaPenyakit->jenis) === 'Hama' ? 'selected' : '' }}>Hama</option>
                                <option value="Penyakit" {{ old('jenis', $artikelHamaPenyakit->jenis) === 'Penyakit' ? 'selected' : '' }}>Penyakit</option>
                            </select>
                            <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi Singkat --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Deskripsi Singkat</label>
                    <textarea name="deskripsi_singkat" rows="3"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:ring-2 focus:ring-red-400 focus:border-transparent transition resize-none"
                        placeholder="Ringkasan singkat artikel...">{{ old('deskripsi_singkat', $artikelHamaPenyakit->deskripsi_singkat) }}</textarea>
                </div>

                {{-- Konten --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                        Konten <span class="text-red-500">*</span>
                    </label>
                    <textarea name="konten" rows="8"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:ring-2 focus:ring-red-400 focus:border-transparent transition resize-y @error('konten') border-red-400 bg-red-50 @enderror"
                        placeholder="Tulis konten artikel...">{{ old('konten', $artikelHamaPenyakit->konten) }}</textarea>
                    @error('konten')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Informasi Teknis --}}
                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
                        <i class="bi bi-clipboard2-pulse text-gray-500 text-base"></i>
                        <h4 class="font-semibold text-gray-700 text-sm">Informasi Teknis</h4>
                    </div>
                    <div class="p-6 space-y-5">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                                <i class="bi bi-eye text-gray-400 mr-1"></i>Gejala Visual
                            </label>
                            <textarea name="gejala_visual" rows="3"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:ring-2 focus:ring-red-400 focus:border-transparent transition resize-none"
                                placeholder="Deskripsikan gejala yang terlihat...">{{ old('gejala_visual', $artikelHamaPenyakit->gejala_visual) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                                <i class="bi bi-search text-gray-400 mr-1"></i>Cara Identifikasi
                            </label>
                            <textarea name="cara_identifikasi" rows="3"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:ring-2 focus:ring-red-400 focus:border-transparent transition resize-none"
                                placeholder="Cara mengidentifikasi...">{{ old('cara_identifikasi', $artikelHamaPenyakit->cara_identifikasi) }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                                    <i class="bi bi-shield-check text-gray-400 mr-1"></i>Pencegahan
                                </label>
                                <textarea name="pencegahan" rows="4"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:ring-2 focus:ring-red-400 focus:border-transparent transition resize-none"
                                    placeholder="Langkah pencegahan...">{{ old('pencegahan', $artikelHamaPenyakit->pencegahan) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                                    <i class="bi bi-tools text-gray-400 mr-1"></i>Pengendalian
                                </label>
                                <textarea name="pengendalian" rows="4"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:ring-2 focus:ring-red-400 focus:border-transparent transition resize-none"
                                    placeholder="Cara pengendalian...">{{ old('pengendalian', $artikelHamaPenyakit->pengendalian) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Gambar & PDF --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                            <i class="bi bi-image text-gray-400 mr-1"></i>Gambar Utama
                        </label>
                        @if($artikelHamaPenyakit->gambar_utama)
                            <div class="mb-3 relative inline-block">
                                <img src="{{ Storage::url($artikelHamaPenyakit->gambar_utama) }}"
                                    class="w-32 h-24 object-cover rounded-xl border border-gray-200 shadow-sm">
                                <span class="absolute -top-1.5 -right-1.5 bg-green-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">Aktif</span>
                            </div>
                        @endif
                        <input type="file" name="gambar_utama" accept="image/*"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-600 hover:file:bg-red-100 transition">
                        <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-1">
                            <i class="bi bi-info-circle"></i> Kosongkan jika tidak ingin mengubah
                        </p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                            <i class="bi bi-file-earmark-pdf text-gray-400 mr-1"></i>File PDF
                        </label>
                        @if($artikelHamaPenyakit->file_pdf)
                            <a href="{{ Storage::url($artikelHamaPenyakit->file_pdf) }}" target="_blank"
                                class="inline-flex items-center gap-1.5 text-xs text-red-500 font-medium hover:text-red-700 mb-3 border border-red-100 bg-red-50 px-3 py-1.5 rounded-lg transition">
                                <i class="bi bi-file-earmark-pdf-fill"></i> Lihat PDF saat ini
                                <i class="bi bi-box-arrow-up-right text-[10px]"></i>
                            </a>
                        @endif
                        <input type="file" name="file_pdf" accept=".pdf"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-600 hover:file:bg-red-100 transition">
                        <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-1">
                            <i class="bi bi-info-circle"></i> Kosongkan jika tidak ingin mengubah
                        </p>
                    </div>
                </div>

                {{-- Tags --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                        <i class="bi bi-tags text-gray-400 mr-1"></i>Tags
                    </label>
                    <div id="tags-container"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl flex flex-wrap gap-2 min-h-[50px] bg-gray-50/50 cursor-text"
                        onclick="document.getElementById('tags-input').focus()">
                    </div>
                    <input type="text" id="tags-input"
                        class="w-full mt-2 px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                        placeholder="Ketik tag lalu tekan Enter atau koma...">
                    <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-1">
                        <i class="bi bi-keyboard"></i> Tekan Enter atau koma untuk menambah tag
                    </p>
                    <input type="hidden" name="tags" id="tags-hidden" value="[]">
                </div>

                {{-- Galeri Gambar --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                        <i class="bi bi-images text-gray-400 mr-1"></i>Galeri Gambar
                    </label>
                    @if($artikelHamaPenyakit->galeri_gambar)
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($artikelHamaPenyakit->galeri_gambar as $foto)
                                <img src="{{ Storage::url($foto) }}"
                                    class="w-24 h-20 object-cover rounded-xl border border-gray-200 shadow-sm">
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="galeri_gambar[]" accept="image/*" multiple
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-600 hover:file:bg-red-100 transition">
                    <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-1">
                        <i class="bi bi-exclamation-triangle"></i> Upload foto baru akan menggantikan galeri yang lama
                    </p>
                </div>

                {{-- Status Publish --}}
                <div class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 bg-gray-50/60">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" id="is_published"
                            {{ old('is_published', $artikelHamaPenyakit->is_published) ? 'checked' : '' }}
                            class="sr-only peer">
                        <div class="w-10 h-5 bg-gray-200 rounded-full peer peer-checked:bg-red-500 peer-focus:ring-2 peer-focus:ring-red-300 transition-all after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5"></div>
                    </label>
                    <div>
                        <label for="is_published" class="text-sm font-semibold text-gray-700 cursor-pointer">Publikasikan Artikel</label>
                        <p class="text-xs text-gray-400">Artikel akan langsung tampil di halaman publik</p>
                    </div>
                </div>

            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.artikel-hama-penyakit.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-50 hover:border-gray-300 transition">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-bold rounded-xl hover:from-red-600 hover:to-red-700 transition shadow-md shadow-red-100 active:scale-95">
                    <i class="bi bi-check2-circle"></i> Update Artikel
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
    let tags = {!! json_encode($artikelHamaPenyakit->tags ?? []) !!};

    function renderTags() {
        tagsContainer.innerHTML = '';
        tags.forEach((tag, index) => {
            tagsContainer.innerHTML += `
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-50 text-red-700 text-xs font-semibold rounded-lg border border-red-100">
                    <i class="bi bi-tag-fill text-red-400 text-[10px]"></i>
                    ${tag}
                    <button type="button" onclick="removeTag(${index})"
                        class="ml-0.5 text-red-300 hover:text-red-600 transition leading-none">
                        <i class="bi bi-x-lg text-[10px]"></i>
                    </button>
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