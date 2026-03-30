@extends('layouts.admin-app')

@section('page-title', 'Tambah Artikel Hama & Penyakit')
@section('page-subtitle', 'Tambah informasi hama dan penyakit kopi baru')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
<div style="background:white; border-radius:1.25rem; box-shadow:0 1px 4px rgba(0,0,0,0.07); border:1px solid #f0fdf4; overflow:hidden;">

    {{-- Header --}}
    <div style="padding:1.25rem 1.5rem; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; gap:0.75rem;">
        <div style="width:2.5rem; height:2.5rem; background:#dcfce7; border-radius:0.75rem; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <svg style="width:1.25rem; height:1.25rem; color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
        </div>
        <div>
            <div style="font-size:0.9rem; font-weight:700; color:#111827;">Tambah Artikel Baru</div>
            <div style="font-size:0.75rem; color:#9ca3af;">Isi formulir di bawah untuk menambahkan artikel hama & penyakit kopi</div>
        </div>
    </div>

    <div style="padding:2rem;">
        <form action="{{ route('admin.artikel-hama-penyakit.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display:flex; flex-direction:column; gap:1.5rem;">

                {{-- Judul & Jenis --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
                    <div>
                        <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">
                            Judul <span style="color:#dc2626;">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                            class="@error('judul') border-red-300 bg-red-50 @enderror"
                            style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; box-sizing:border-box;"
                            placeholder="Masukkan judul artikel...">
                        @error('judul')
                            <p style="color:#dc2626; font-size:0.75rem; margin-top:0.375rem; display:flex; align-items:center; gap:0.25rem;">
                                <svg style="width:0.875rem; height:0.875rem;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">
                            Jenis <span style="color:#dc2626;">*</span>
                        </label>
                        <div style="position:relative;">
                            <select name="jenis"
                                style="width:100%; padding:0.75rem 2.5rem 0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; background:white; appearance:none; outline:none; box-sizing:border-box;">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="Hama" {{ old('jenis') === 'Hama' ? 'selected' : '' }}>Hama</option>
                                <option value="Penyakit" {{ old('jenis') === 'Penyakit' ? 'selected' : '' }}>Penyakit</option>
                            </select>
                            <svg style="position:absolute; right:0.875rem; top:50%; transform:translateY(-50%); width:1rem; height:1rem; color:#9ca3af; pointer-events:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                        @error('jenis')
                            <p style="color:#dc2626; font-size:0.75rem; margin-top:0.375rem;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi Singkat --}}
                <div>
                    <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Deskripsi Singkat</label>
                    <textarea name="deskripsi_singkat" rows="3"
                        style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:none; box-sizing:border-box;"
                        placeholder="Ringkasan singkat artikel...">{{ old('deskripsi_singkat') }}</textarea>
                </div>

                {{-- Konten --}}
                <div>
                    <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">
                        Konten <span style="color:#dc2626;">*</span>
                    </label>
                    <textarea name="konten" rows="8"
                        class="@error('konten') border-red-300 bg-red-50 @enderror"
                        style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:vertical; box-sizing:border-box;"
                        placeholder="Tulis konten artikel secara lengkap...">{{ old('konten') }}</textarea>
                    @error('konten')
                        <p style="color:#dc2626; font-size:0.75rem; margin-top:0.375rem;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Informasi Teknis --}}
                <div style="border:1px solid #e5e7eb; border-radius:1rem; overflow:hidden;">
                    <div style="padding:0.875rem 1.25rem; background:#f9fafb; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; gap:0.5rem;">
                        <svg style="width:1rem; height:1rem; color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span style="font-size:0.875rem; font-weight:600; color:#374151;">Informasi Teknis</span>
                    </div>
                    <div style="padding:1.25rem; display:flex; flex-direction:column; gap:1.25rem;">
                        <div>
                            <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Gejala Visual</label>
                            <textarea name="gejala_visual" rows="3"
                                style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:none; box-sizing:border-box;"
                                placeholder="Deskripsikan gejala yang terlihat pada tanaman...">{{ old('gejala_visual') }}</textarea>
                        </div>
                        <div>
                            <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Cara Identifikasi</label>
                            <textarea name="cara_identifikasi" rows="3"
                                style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:none; box-sizing:border-box;"
                                placeholder="Cara mengidentifikasi hama/penyakit ini...">{{ old('cara_identifikasi') }}</textarea>
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
                            <div>
                                <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Pencegahan</label>
                                <textarea name="pencegahan" rows="4"
                                    style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:none; box-sizing:border-box;"
                                    placeholder="Langkah-langkah pencegahan...">{{ old('pencegahan') }}</textarea>
                            </div>
                            <div>
                                <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Pengendalian</label>
                                <textarea name="pengendalian" rows="4"
                                    style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:none; box-sizing:border-box;"
                                    placeholder="Cara pengendalian...">{{ old('pengendalian') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Gambar & PDF --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
                    <div>
                        <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Gambar Utama</label>
                        <input type="file" name="gambar_utama" accept="image/*"
                            style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#6b7280; box-sizing:border-box;">
                        <p style="font-size:0.7rem; color:#9ca3af; margin-top:0.375rem;">Format: JPG, PNG. Maks 2MB</p>
                    </div>
                    <div>
                        <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">File PDF</label>
                        <input type="file" name="file_pdf" accept=".pdf"
                            style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#6b7280; box-sizing:border-box;">
                        <p style="font-size:0.7rem; color:#9ca3af; margin-top:0.375rem;">Format: PDF. Maks 5MB</p>
                    </div>
                </div>

                {{-- Tags --}}
                <div>
                    <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Tags</label>
                    <div id="tags-container"
                        style="width:100%; padding:0.625rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; display:flex; flex-wrap:wrap; gap:0.5rem; min-height:3rem; background:#fafafa; cursor:text; box-sizing:border-box;"
                        onclick="document.getElementById('tags-input').focus()">
                    </div>
                    <input type="text" id="tags-input"
                        style="width:100%; margin-top:0.5rem; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; box-sizing:border-box;"
                        placeholder="Ketik tag lalu tekan Enter atau koma...">
                    <p style="font-size:0.7rem; color:#9ca3af; margin-top:0.375rem;">Tekan Enter atau koma untuk menambah tag</p>
                    <input type="hidden" name="tags" id="tags-hidden" value="[]">
                </div>

                {{-- Galeri Gambar --}}
                <div>
                    <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Galeri Gambar</label>
                    <input type="file" name="galeri_gambar[]" accept="image/*" multiple
                        style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#6b7280; box-sizing:border-box;">
                    <p style="font-size:0.7rem; color:#9ca3af; margin-top:0.375rem;">Bisa pilih beberapa foto sekaligus. Format: JPG, PNG. Maks 2MB per foto</p>
                </div>

                {{-- Status Publish --}}
                <div style="display:flex; align-items:center; gap:0.75rem; padding:1rem; border:1px solid #e5e7eb; border-radius:0.75rem; background:#f9fafb;">
                    <div style="position:relative; display:inline-flex; align-items:center; cursor:pointer;" onclick="togglePublish('is_published', 'track_is_published', 'knob_is_published')">
                        <input type="checkbox" name="is_published" value="1" id="is_published"
                            {{ old('is_published') ? 'checked' : '' }}
                            style="position:absolute; opacity:0; width:0; height:0;">
                        <div id="track_is_published"
                            style="width:2.5rem; height:1.375rem; border-radius:9999px; transition:background 0.2s; background:{{ old('is_published') ? '#16a34a' : '#d1d5db' }}; position:relative; flex-shrink:0;">
                            <div id="knob_is_published"
                                style="position:absolute; top:0.1875rem; width:1rem; height:1rem; background:white; border-radius:9999px; box-shadow:0 1px 3px rgba(0,0,0,0.2); transition:left 0.2s; left:{{ old('is_published') ? '1.25rem' : '0.1875rem' }};"></div>
                        </div>
                    </div>
                    <div>
                        <label for="is_published" style="font-size:0.875rem; font-weight:600; color:#374151; cursor:pointer;" onclick="togglePublish('is_published', 'track_is_published', 'knob_is_published')">Publikasikan Sekarang</label>
                        <p style="font-size:0.75rem; color:#9ca3af;">Artikel akan langsung tampil di halaman publik</p>
                    </div>
                </div>

            </div>

            {{-- Action Buttons --}}
            <div style="display:flex; align-items:center; justify-content:space-between; margin-top:2rem; padding-top:1.5rem; border-top:1px solid #f3f4f6;">
                <a href="{{ route('admin.artikel-hama-penyakit.index') }}"
                    style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.625rem 1.25rem; border:1px solid #e5e7eb; color:#6b7280; font-size:0.875rem; font-weight:600; border-radius:0.75rem; text-decoration:none; background:white;">
                    <svg style="width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Batal
                </a>
                <button type="submit"
                    style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.625rem 1.5rem; background:#16a34a; color:white; font-size:0.875rem; font-weight:700; border-radius:0.75rem; border:none; cursor:pointer;">
                    <svg style="width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
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
                <span style="display:inline-flex; align-items:center; gap:0.375rem; padding:0.25rem 0.625rem; background:#dcfce7; color:#15803d; font-size:0.75rem; font-weight:600; border-radius:0.5rem; border:1px solid #bbf7d0;">
                    ${tag}
                    <button type="button" onclick="removeTag(${index})"
                        style="color:#86efac; background:none; border:none; cursor:pointer; line-height:1; font-size:0.875rem;">&times;</button>
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
            if (val) { tags.push(val); tagsInput.value = ''; renderTags(); }
        }
    });

    function togglePublish(cbId, trackId, knobId) {
        const cb = document.getElementById(cbId);
        const track = document.getElementById(trackId);
        const knob = document.getElementById(knobId);
        cb.checked = !cb.checked;
        if (cb.checked) {
            track.style.background = '#16a34a';
            knob.style.left = '1.25rem';
        } else {
            track.style.background = '#d1d5db';
            knob.style.left = '0.1875rem';
        }
    }
</script>
@endpush