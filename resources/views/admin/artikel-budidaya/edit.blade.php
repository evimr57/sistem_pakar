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
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Bab <span class="text-red-500">*</span></label>
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

                <!-- Gambar Utama & PDF -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Cover</label>
                        @if($artikelBudidaya->gambar_utama)
                            <img src="{{ Storage::url($artikelBudidaya->gambar_utama) }}" class="w-32 h-24 object-cover rounded-lg mb-2">
                        @endif
                        <input type="file" name="gambar_utama" accept="image/*"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500">
                        <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">File PDF</label>
                        @if($artikelBudidaya->file_pdf)
                            <a href="{{ Storage::url($artikelBudidaya->file_pdf) }}" target="_blank" class="text-xs text-blue-500 underline mb-2 block">Lihat PDF saat ini</a>
                        @endif
                        <input type="file" name="file_pdf" accept=".pdf"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500">
                        <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah</p>
                    </div>
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tags</label>
                    <div id="tags-container" class="w-full px-4 py-3 border border-gray-300 rounded-xl flex flex-wrap gap-2 min-h-[50px]"></div>
                    <input type="text" id="tags-input"
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500"
                        placeholder="Ketik tag lalu tekan Enter...">
                    <input type="hidden" name="tags" id="tags-hidden" value="[]">
                </div>

                <!-- Sub-bab -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Sub-bab</label>
                            <p class="text-xs text-gray-400 mt-1">Edit atau tambah sub-bab</p>
                        </div>
                        <button type="button" onclick="tambahSub()"
                            class="flex items-center gap-2 px-4 py-2 bg-green-500 text-white text-sm font-bold rounded-xl hover:bg-green-600 transition">
                            + Tambah Sub-bab
                        </button>
                    </div>

                    <div id="sub-container" class="space-y-4">
                        @foreach($artikelBudidaya->subBab as $i => $sub)
                        <div class="sub-item bg-gray-50 border border-gray-200 rounded-xl p-5 space-y-4" id="sub-existing-{{ $i }}">
                            <div class="flex items-center justify-between">
                                <h4 class="font-bold text-gray-700 text-sm">Sub-bab {{ $i + 1 }}</h4>
                                <button type="button" onclick="hapusSubExisting('sub-existing-{{ $i }}')" class="text-red-400 hover:text-red-600 text-sm font-semibold">Hapus</button>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1">Judul Sub-bab <span class="text-red-500">*</span></label>
                                <input type="text" name="sub_judul[]" value="{{ $sub->judul_sub }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1">Konten</label>
                                <textarea name="sub_konten[]" rows="5"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500">{{ $sub->konten }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1">Gambar</label>
                                @if($sub->gambar)
                                    <img src="{{ Storage::url($sub->gambar) }}" class="w-24 h-16 object-cover rounded-lg mb-2">
                                @endif
                                <input type="file" name="sub_gambar[{{ $i }}]" accept="image/*"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">
                                <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($artikelBudidaya->subBab->isEmpty())
                    <div id="empty-sub" class="text-center py-8 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-400 text-sm">Belum ada sub-bab. Klik tombol di atas untuk menambahkan.</p>
                    </div>
                    @else
                    <div id="empty-sub" class="hidden text-center py-8 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-400 text-sm">Belum ada sub-bab. Klik tombol di atas untuk menambahkan.</p>
                    </div>
                    @endif
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
    let subCount = {{ $artikelBudidaya->subBab->count() }};

    function tambahSub() {
        const container = document.getElementById('sub-container');
        const empty = document.getElementById('empty-sub');
        empty.classList.add('hidden');

        const index = subCount++;
        const div = document.createElement('div');
        div.className = 'sub-item bg-gray-50 border border-gray-200 rounded-xl p-5 space-y-4';
        div.id = `sub-new-${index}`;
        div.innerHTML = `
            <div class="flex items-center justify-between">
                <h4 class="font-bold text-gray-700 text-sm">Sub-bab Baru</h4>
                <button type="button" onclick="hapusSubExisting('sub-new-${index}')" class="text-red-400 hover:text-red-600 text-sm font-semibold">Hapus</button>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1">Judul Sub-bab <span class="text-red-500">*</span></label>
                <input type="text" name="sub_judul[]"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500"
                    placeholder="Contoh: Pemilihan Lahan">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1">Konten</label>
                <textarea name="sub_konten[]" rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500"
                    placeholder="Tulis isi sub-bab di sini..."></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1">Gambar (opsional)</label>
                <input type="file" name="sub_gambar[${index}]" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">
            </div>
        `;
        container.appendChild(div);
    }

    function hapusSubExisting(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
        if (document.querySelectorAll('.sub-item').length === 0) {
            document.getElementById('empty-sub').classList.remove('hidden');
        }
    }

    // Tags
    const tagsInput = document.getElementById('tags-input');
    const tagsContainer = document.getElementById('tags-container');
    const tagsHidden = document.getElementById('tags-hidden');
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

    renderTags();
</script>
@endpush