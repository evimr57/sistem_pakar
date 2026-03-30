@extends('layouts.admin-app')

@section('page-title', 'Edit Penyakit')
@section('page-subtitle', 'Edit data penyakit tanaman kopi')

@section('content')

@if($errors->any())
    <div style="margin-bottom:1.5rem; background:#fef2f2; border:1px solid #fecaca; color:#dc2626; padding:1rem 1.25rem; border-radius:0.75rem; display:flex; align-items:flex-start; gap:0.75rem;">
        <svg style="width:1.25rem; height:1.25rem; flex-shrink:0; margin-top:0.1rem;" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
            <p style="font-weight:600; font-size:0.875rem; margin-bottom:0.375rem;">Terdapat kesalahan:</p>
            <ul style="font-size:0.8rem; padding-left:1rem; display:flex; flex-direction:column; gap:0.2rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<form action="{{ route('admin.penyakit.update', $penyakit) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div style="background:white; border-radius:1.25rem; box-shadow:0 1px 4px rgba(0,0,0,0.07); border:1px solid #f0fdf4; overflow:hidden;">

        {{-- Header --}}
        <div style="padding:1.25rem 1.5rem; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; gap:0.75rem;">
            <div style="width:2.5rem; height:2.5rem; background:#dcfce7; border-radius:0.75rem; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <svg style="width:1.25rem; height:1.25rem; color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <div style="font-size:0.9rem; font-weight:700; color:#111827;">Form Edit Penyakit</div>
                <div style="font-size:0.75rem; color:#9ca3af;">Perbarui data penyakit atau hama tanaman kopi</div>
            </div>
        </div>

        {{-- Form Body --}}
        <div style="padding:2rem; display:flex; flex-direction:column; gap:1.5rem;">

            {{-- Kode Penyakit (readonly) --}}
            <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Kode Penyakit</label>
                <input type="text" name="id_penyakit" id="id_penyakit" value="{{ $penyakit->id_penyakit }}"
                    style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#6b7280; background:#f9fafb; font-family:monospace; box-sizing:border-box; cursor:not-allowed;"
                    readonly disabled>
                <p style="font-size:0.75rem; color:#9ca3af; margin-top:0.375rem;">Kode penyakit tidak dapat diubah setelah dibuat.</p>
            </div>

            {{-- Nama Penyakit --}}
            <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">
                    Nama Penyakit <span style="color:#dc2626;">*</span>
                </label>
                <input type="text" name="nama_penyakit" id="nama_penyakit"
                    value="{{ old('nama_penyakit', $penyakit->nama_penyakit) }}"
                    style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; box-sizing:border-box;"
                    placeholder="Contoh: Penggerek Buah Kopi" required>
                @error('nama_penyakit')
                    <p style="color:#dc2626; font-size:0.75rem; margin-top:0.375rem;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Latin --}}
            <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Nama Latin</label>
                <input type="text" name="nama_latin" id="nama_latin"
                    value="{{ old('nama_latin', $penyakit->nama_latin) }}"
                    style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; box-sizing:border-box; font-style:italic;"
                    placeholder="Contoh: Hypothenemus hampei">
            </div>

            {{-- Kategori & Tingkat Bahaya (2 kolom) --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
                <div>
                    <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">
                        Kategori <span style="color:#dc2626;">*</span>
                    </label>
                    <div style="position:relative;">
                        <select name="kategori" id="kategori" required
                            style="width:100%; padding:0.75rem 2.5rem 0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; background:white; appearance:none; outline:none; box-sizing:border-box;">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Hama" {{ old('kategori', $penyakit->kategori) == 'Hama' ? 'selected' : '' }}>Hama</option>
                            <option value="Penyakit" {{ old('kategori', $penyakit->kategori) == 'Penyakit' ? 'selected' : '' }}>Penyakit</option>
                        </select>
                        <svg style="position:absolute; right:0.875rem; top:50%; transform:translateY(-50%); width:1rem; height:1rem; color:#9ca3af; pointer-events:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    @error('kategori')
                        <p style="color:#dc2626; font-size:0.75rem; margin-top:0.375rem;">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Tingkat Bahaya</label>
                    <div style="position:relative;">
                        <select name="tingkat_bahaya" id="tingkat_bahaya"
                            style="width:100%; padding:0.75rem 2.5rem 0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; background:white; appearance:none; outline:none; box-sizing:border-box;">
                            <option value="">-- Pilih Tingkat Bahaya --</option>
                            <option value="Rendah" {{ old('tingkat_bahaya', $penyakit->tingkat_bahaya) == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                            <option value="Sedang" {{ old('tingkat_bahaya', $penyakit->tingkat_bahaya) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Tinggi" {{ old('tingkat_bahaya', $penyakit->tingkat_bahaya) == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                            <option value="Sangat Tinggi" {{ old('tingkat_bahaya', $penyakit->tingkat_bahaya) == 'Sangat Tinggi' ? 'selected' : '' }}>Sangat Tinggi</option>
                        </select>
                        <svg style="position:absolute; right:0.875rem; top:50%; transform:translateY(-50%); width:1rem; height:1rem; color:#9ca3af; pointer-events:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Deskripsi Singkat --}}
            <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Deskripsi Singkat</label>
                <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="3"
                    style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:none; box-sizing:border-box;"
                    placeholder="Ringkasan singkat tentang penyakit/hama ini...">{{ old('deskripsi_singkat', $penyakit->deskripsi_singkat) }}</textarea>
            </div>

            {{-- Deskripsi Lengkap --}}
            <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Deskripsi Lengkap</label>
                <textarea name="deskripsi_lengkap" id="deskripsi_lengkap" rows="5"
                    style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:vertical; box-sizing:border-box;"
                    placeholder="Penjelasan detail tentang penyakit/hama, gejala, dampak, dll...">{{ old('deskripsi_lengkap', $penyakit->deskripsi_lengkap) }}</textarea>
            </div>

            {{-- Pengendalian (group dalam card) --}}
            <div style="border:1px solid #e5e7eb; border-radius:1rem; overflow:hidden;">
                <div style="padding:0.875rem 1.25rem; background:#f9fafb; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; gap:0.5rem;">
                    <svg style="width:1rem; height:1rem; color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span style="font-size:0.875rem; font-weight:600; color:#374151;">Metode Pengendalian</span>
                </div>
                <div style="padding:1.25rem; display:flex; flex-direction:column; gap:1.25rem;">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
                        <div>
                            <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Pencegahan</label>
                            <textarea name="pengendalian_pencegahan" rows="4"
                                style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:none; box-sizing:border-box;"
                                placeholder="Cara pencegahan sebelum terjadi serangan...">{{ old('pengendalian_pencegahan', $penyakit->pengendalian_pencegahan) }}</textarea>
                        </div>
                        <div>
                            <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Kimia</label>
                            <textarea name="pengendalian_kimia" rows="4"
                                style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:none; box-sizing:border-box;"
                                placeholder="Pestisida atau bahan kimia yang dapat digunakan...">{{ old('pengendalian_kimia', $penyakit->pengendalian_kimia) }}</textarea>
                        </div>
                        <div>
                            <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Organik</label>
                            <textarea name="pengendalian_organik" rows="4"
                                style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:none; box-sizing:border-box;"
                                placeholder="Cara pengendalian dengan bahan organik/alami...">{{ old('pengendalian_organik', $penyakit->pengendalian_organik) }}</textarea>
                        </div>
                        <div>
                            <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Budidaya</label>
                            <textarea name="pengendalian_budidaya" rows="4"
                                style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; resize:none; box-sizing:border-box;"
                                placeholder="Teknik budidaya untuk mengendalikan hama/penyakit...">{{ old('pengendalian_budidaya', $penyakit->pengendalian_budidaya) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Upload Gambar --}}
            <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Upload Gambar</label>
                <input type="file" name="gambar" id="gambar" accept="image/*"
                    style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#6b7280; box-sizing:border-box;"
                    onchange="previewImage(event)">
                <p style="font-size:0.7rem; color:#9ca3af; margin-top:0.375rem;">Format: JPG, PNG, WebP. Maksimal 2MB</p>

                {{-- Preview gambar baru --}}
                <div id="imagePreview" style="display:none; margin-top:0.75rem;">
                    <p style="font-size:0.75rem; color:#6b7280; margin-bottom:0.375rem;">Preview gambar baru:</p>
                    <img id="preview" src="" alt="Preview"
                        style="width:6rem; height:6rem; object-fit:cover; border-radius:0.75rem; border:1px solid #e5e7eb;">
                </div>

                {{-- Gambar lama --}}
                @if($penyakit->gambar_url)
                    <div style="margin-top:0.75rem;">
                        <p style="font-size:0.75rem; color:#6b7280; margin-bottom:0.375rem;">Gambar saat ini:</p>
                        <img src="{{ $penyakit->gambar_url }}" alt="Current"
                            style="width:6rem; height:6rem; object-fit:cover; border-radius:0.75rem; border:1px solid #e5e7eb;">
                        <p style="font-size:0.7rem; color:#9ca3af; margin-top:0.375rem;">Upload gambar baru untuk mengganti</p>
                    </div>
                @endif
            </div>

        </div>

        {{-- Footer --}}
        <div style="padding:1rem 1.5rem; background:#f9fafb; border-top:1px solid #f3f4f6; display:flex; align-items:center; justify-content:space-between;">
            <a href="{{ route('admin.penyakit.index') }}"
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
                Update Data
            </button>
        </div>

    </div>
</form>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection