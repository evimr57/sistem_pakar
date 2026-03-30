@extends('layouts.admin-app')

@section('page-title', 'Edit Artikel Budidaya')
@section('page-subtitle', 'Edit informasi budidaya kopi')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --green-deep:  #1a4d2e;
        --green-mid:   #2d7a4f;
        --green-bright:#4ade80;
        --bg-base:     #f0f5f1;
        --bg-card:     #ffffff;
        --text-primary:#0f1f14;
        --text-muted:  #6b7f72;
        --shadow:      0 4px 24px rgba(29,77,46,.08), 0 1px 4px rgba(29,77,46,.05);
        --radius:      20px;
        --input-border:#d1d5db;
        --input-focus: #2d7a4f;
    }
    body, .form-root { font-family: 'Plus Jakarta Sans', sans-serif; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(12px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .anim { animation: fadeUp .5s cubic-bezier(.22,1,.36,1) both; }
    .a1   { animation-delay: .04s; }
    .a2   { animation-delay: .12s; }
    .a3   { animation-delay: .20s; }

    .form-card {
        background: var(--bg-card);
        border-radius: var(--radius);
        border: 1.5px solid rgba(29,77,46,.07);
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .form-body { padding: 2rem; }

    .form-section { margin-bottom: 2rem; }
    .form-section-title {
        display: flex; align-items: center; gap: .5rem;
        font-size: .78rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: .08em; color: var(--text-muted);
        margin-bottom: 1.1rem; padding-bottom: .6rem;
        border-bottom: 1.5px solid rgba(29,77,46,.08);
    }
    .form-section-title-bar { width: 3px; height: 14px; background: linear-gradient(180deg, var(--green-mid), var(--green-bright)); border-radius: 2px; flex-shrink: 0; }

    .form-label { display: block; font-size: .8rem; font-weight: 700; color: var(--text-primary); margin-bottom: .45rem; }
    .form-label .req { color: #ef4444; margin-left: 2px; }
    .form-hint  { font-size: .7rem; color: var(--text-muted); margin-top: .3rem; }
    .form-error { font-size: .7rem; color: #ef4444; margin-top: .3rem; }

    .form-input, .form-textarea, .form-file {
        width: 100%;
        padding: .7rem 1rem;
        border: 1.5px solid var(--input-border);
        border-radius: 12px;
        font-size: .85rem; font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-primary);
        background: #fafafa;
        transition: border-color .18s, box-shadow .18s, background .18s;
        outline: none;
    }
    .form-input:focus, .form-textarea:focus {
        border-color: var(--input-focus); background: #fff;
        box-shadow: 0 0 0 3px rgba(45,122,79,.12);
    }
    .form-input.error { border-color: #ef4444; }
    .form-textarea { resize: vertical; line-height: 1.6; }
    .form-file { padding: .6rem .9rem; cursor: pointer; color: var(--text-muted); }
    .form-file::-webkit-file-upload-button {
        background: #f0fdf4; border: 1px solid #bbf7d0;
        color: var(--green-mid); font-weight: 700; font-size: .76rem;
        padding: .3rem .75rem; border-radius: 7px; cursor: pointer;
        margin-right: .65rem; font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    @media (max-width: 640px) { .grid-2 { grid-template-columns: 1fr; } }

    /* current media previews */
    .media-current {
        display: flex; align-items: center; gap: .65rem;
        padding: .55rem .8rem; background: #f0fdf4;
        border: 1px solid #bbf7d0; border-radius: 10px;
        margin-bottom: .6rem;
    }
    .media-current img { width: 52px; height: 38px; object-fit: cover; border-radius: 7px; flex-shrink: 0; }
    .media-current span { font-size: .73rem; color: var(--text-muted); }
    .media-current a    { font-size: .73rem; color: #2563eb; text-decoration: underline; }

    /* tags */
    .tags-box {
        width: 100%; min-height: 48px;
        padding: .55rem .75rem;
        border: 1.5px solid var(--input-border); border-radius: 12px;
        background: #fafafa;
        display: flex; flex-wrap: wrap; gap: .4rem; align-items: center;
        cursor: text; transition: border-color .18s, box-shadow .18s;
    }
    .tags-box.focused { border-color: var(--input-focus); box-shadow: 0 0 0 3px rgba(45,122,79,.12); background: #fff; }
    .tag-pill {
        display: inline-flex; align-items: center; gap: .3rem;
        padding: .22rem .7rem; background: #dcfce7; color: #166534;
        font-size: .73rem; font-weight: 700; border-radius: 50px;
    }
    .tag-pill button { background:none; border:none; cursor:pointer; color:#4ade80; font-size:.8rem; line-height:1; padding:0; }
    .tag-pill button:hover { color:#ef4444; }

    /* sub-bab */
    .sub-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }
    .sub-header-left h3 { font-size: .85rem; font-weight: 700; color: var(--text-primary); }
    .sub-header-left p  { font-size: .73rem; color: var(--text-muted); margin-top: 2px; }

    .btn-add-sub {
        display: inline-flex; align-items: center; gap: .4rem;
        padding: .55rem 1.1rem;
        background: #f0fdf4; border: 1.5px solid #bbf7d0;
        color: var(--green-mid); font-size: .8rem; font-weight: 700;
        border-radius: 50px; cursor: pointer; transition: all .18s;
    }
    .btn-add-sub:hover { background: #dcfce7; border-color: var(--green-mid); transform: translateY(-1px); }

    .sub-card { background: #fafcfb; border: 1.5px solid rgba(29,77,46,.1); border-radius: 16px; overflow: hidden; margin-bottom: .85rem; transition: box-shadow .2s; }
    .sub-card:hover { box-shadow: 0 4px 16px rgba(29,77,46,.08); }
    .sub-card-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: .85rem 1.1rem;
        background: rgba(45,122,79,.05); border-bottom: 1px solid rgba(29,77,46,.08);
    }
    .sub-card-header span { font-size: .8rem; font-weight: 700; color: var(--green-mid); display: flex; align-items: center; gap: .4rem; }
    .sub-card-header span::before { content:''; display:inline-block; width:6px; height:6px; border-radius:50%; background:var(--green-mid); }
    .btn-del-sub { display:inline-flex; align-items:center; gap:.3rem; font-size:.75rem; font-weight:600; color:#9ca3af; background:none; border:none; cursor:pointer; padding:.2rem .5rem; border-radius:6px; transition:all .15s; }
    .btn-del-sub:hover { color:#ef4444; background:#fee2e2; }
    .sub-card-body { padding: 1.1rem; display: flex; flex-direction: column; gap: .85rem; }
    .sub-label { display:block; font-size:.76rem; font-weight:700; color:var(--text-muted); margin-bottom:.35rem; }
    .sub-label .req { color:#ef4444; }

    /* existing sub image preview */
    .sub-img-preview { width: 72px; height: 50px; object-fit: cover; border-radius: 8px; margin-bottom: .4rem; border: 1.5px solid rgba(29,77,46,.1); display: block; }

    .empty-sub { text-align:center; padding:2.5rem 1rem; background:#f9fafb; border:2px dashed rgba(29,77,46,.15); border-radius:16px; }
    .empty-sub-icon { width:44px; height:44px; margin:0 auto .75rem; opacity:.25; }
    .empty-sub p { font-size:.82rem; color:var(--text-muted); }

    .publish-row { display:flex; align-items:center; gap:.85rem; padding:1rem 1.2rem; background:#f0fdf4; border:1.5px solid #bbf7d0; border-radius:14px; }
    .publish-row input[type=checkbox] { width:18px; height:18px; accent-color:var(--green-mid); cursor:pointer; }
    .publish-row label { font-size:.85rem; font-weight:600; color:var(--green-deep); cursor:pointer; }
    .publish-row p { font-size:.72rem; color:var(--text-muted); margin-top:1px; }

    .form-footer { display:flex; justify-content:flex-end; gap:.75rem; padding:1.4rem 2rem; border-top:1.5px solid rgba(29,77,46,.07); background:#fafcfb; }
    .btn-cancel { display:inline-flex; align-items:center; gap:.4rem; padding:.7rem 1.4rem; background:#fff; border:1.5px solid rgba(29,77,46,.2); color:var(--text-primary); font-size:.85rem; font-weight:600; border-radius:12px; text-decoration:none; transition:all .18s; }
    .btn-cancel:hover { background:#f9fafb; border-color:#9ca3af; }
    .btn-submit { display:inline-flex; align-items:center; gap:.45rem; padding:.7rem 1.5rem; background:linear-gradient(135deg,#2d7a4f,#16a34a); color:#fff; font-size:.85rem; font-weight:700; border-radius:12px; border:none; cursor:pointer; box-shadow:0 4px 14px rgba(22,163,74,.3); transition:all .18s; }
    .btn-submit:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(22,163,74,.4); }
</style>
@endpush

@section('content')
<div class="form-root">
<form action="{{ route('admin.artikel-budidaya.update', $artikelBudidaya) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="form-card anim a1">

    {{-- Form body --}}
    <div class="form-body">

        {{-- ── Informasi Utama ── --}}
        <div class="form-section anim a1">
            <div class="form-section-title">
                <div class="form-section-title-bar"></div>
                Informasi Utama
            </div>

            <div style="margin-bottom:1rem;">
                <label class="form-label">Judul Bab <span class="req">*</span></label>
                <input type="text" name="judul" value="{{ old('judul', $artikelBudidaya->judul) }}"
                    class="form-input {{ $errors->has('judul') ? 'error' : '' }}">
                @error('judul') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Deskripsi Singkat</label>
                <textarea name="deskripsi_singkat" rows="3" class="form-textarea">{{ old('deskripsi_singkat', $artikelBudidaya->deskripsi_singkat) }}</textarea>
            </div>
        </div>

        {{-- ── Media ── --}}
        <div class="form-section anim a2">
            <div class="form-section-title">
                <div class="form-section-title-bar"></div>
                Media
            </div>
            <div class="grid-2">
                <div>
                    <label class="form-label">Gambar Cover</label>
                    @if($artikelBudidaya->gambar_utama)
                        <div class="media-current">
                            <img src="{{ Storage::url($artikelBudidaya->gambar_utama) }}" alt="Cover">
                            <span>Gambar saat ini</span>
                        </div>
                    @endif
                    <input type="file" name="gambar_utama" accept="image/*" class="form-file">
                    <p class="form-hint">Kosongkan jika tidak ingin mengubah. Format: JPG, PNG. Maks 2MB</p>
                </div>
                <div>
                    <label class="form-label">File PDF</label>
                    @if($artikelBudidaya->file_pdf)
                        <div class="media-current">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            <a href="{{ Storage::url($artikelBudidaya->file_pdf) }}" target="_blank">Lihat PDF saat ini</a>
                        </div>
                    @endif
                    <input type="file" name="file_pdf" accept=".pdf" class="form-file">
                    <p class="form-hint">Kosongkan jika tidak ingin mengubah. Format: PDF. Maks 5MB</p>
                </div>
            </div>
        </div>

        {{-- ── Tags ── --}}
        <div class="form-section anim a2">
            <div class="form-section-title">
                <div class="form-section-title-bar"></div>
                Tags
            </div>
            <div id="tags-box" class="tags-box" onclick="document.getElementById('tags-input').focus()"></div>
            <input type="text" id="tags-input" class="form-input" style="margin-top:.5rem;"
                placeholder="Ketik tag lalu tekan Enter atau koma...">
            <p class="form-hint">Tekan Enter atau koma untuk menambahkan tag. Backspace untuk menghapus tag terakhir.</p>
            <input type="hidden" name="tags" id="tags-hidden" value="[]">
        </div>

        {{-- ── Sub-bab ── --}}
        <div class="form-section anim a3">
            <div class="form-section-title">
                <div class="form-section-title-bar"></div>
                Sub-bab
            </div>

            <div class="sub-header">
                <div class="sub-header-left">
                    <h3>Daftar Sub-bab</h3>
                    <p>Edit atau tambah sub-bab artikel</p>
                </div>
                <button type="button" onclick="tambahSub()" class="btn-add-sub">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Tambah Sub-bab
                </button>
            </div>

            <div id="sub-container">
                @foreach($artikelBudidaya->subBab as $i => $sub)
                <div class="sub-card" id="sub-existing-{{ $i }}">
                    <div class="sub-card-header">
                        <span>Sub-bab {{ $i + 1 }}</span>
                        <button type="button" class="btn-del-sub" onclick="hapusSub('sub-existing-{{ $i }}')">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            Hapus
                        </button>
                    </div>
                    <div class="sub-card-body">
                        <div>
                            <label class="sub-label">Judul Sub-bab <span class="req">*</span></label>
                            <input type="text" name="sub_judul[]" value="{{ $sub->judul_sub }}" class="form-input">
                        </div>
                        <div>
                            <label class="sub-label">Konten</label>
                            <textarea name="sub_konten[]" rows="5" class="form-textarea">{{ $sub->konten }}</textarea>
                        </div>
                        <div>
                            <label class="sub-label">Gambar</label>
                            @if($sub->gambar)
                                <img src="{{ Storage::url($sub->gambar) }}" class="sub-img-preview" alt="Sub gambar">
                            @endif
                            <input type="file" name="sub_gambar[{{ $i }}]" accept="image/*" class="form-file">
                            <p class="form-hint">Kosongkan jika tidak ingin mengubah</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div id="empty-sub" class="{{ $artikelBudidaya->subBab->isEmpty() ? '' : 'hidden' }} empty-sub">
                <svg class="empty-sub-icon" fill="none" stroke="#2d7a4f" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p>Belum ada sub-bab. Klik <strong>Tambah Sub-bab</strong> untuk memulai.</p>
            </div>
        </div>

        {{-- ── Publikasi ── --}}
        <div class="anim a3">
            <div class="publish-row">
                <input type="checkbox" name="is_published" value="1" id="is_published"
                    {{ old('is_published', $artikelBudidaya->is_published) ? 'checked' : '' }}>
                <div>
                    <label for="is_published">Publikasikan</label>
                    <p>Artikel akan tampil untuk pengguna jika dicentang</p>
                </div>
            </div>
        </div>

    </div>{{-- /form-body --}}

    {{-- Footer --}}
    <div class="form-footer">
        <a href="{{ route('admin.artikel-budidaya.index') }}" class="btn-cancel">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Batal
        </a>
        <button type="submit" class="btn-submit">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            Update Artikel
        </button>
    </div>

</div>{{-- /form-card --}}
</form>
</div>
@endsection

@push('scripts')
<script>
let subCount = {{ $artikelBudidaya->subBab->count() }};

function tambahSub() {
    document.getElementById('empty-sub').classList.add('hidden');
    const index = subCount++;
    const div = document.createElement('div');
    div.className = 'sub-card';
    div.id = `sub-new-${index}`;
    div.innerHTML = `
        <div class="sub-card-header">
            <span>Sub-bab Baru</span>
            <button type="button" class="btn-del-sub" onclick="hapusSub('sub-new-${index}')">
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                Hapus
            </button>
        </div>
        <div class="sub-card-body">
            <div>
                <label class="sub-label">Judul Sub-bab <span class="req">*</span></label>
                <input type="text" name="sub_judul[]" class="form-input" placeholder="Contoh: Pemilihan Lahan">
            </div>
            <div>
                <label class="sub-label">Konten</label>
                <textarea name="sub_konten[]" rows="5" class="form-textarea" placeholder="Tulis isi sub-bab di sini..."></textarea>
            </div>
            <div>
                <label class="sub-label">Gambar <span style="font-weight:400;color:#9ca3af;">(opsional)</span></label>
                <input type="file" name="sub_gambar[${index}]" accept="image/*" class="form-file">
                <p class="form-hint">Format: JPG, PNG. Maks 2MB</p>
            </div>
        </div>`;
    document.getElementById('sub-container').appendChild(div);
}

function hapusSub(id) {
    const el = document.getElementById(id);
    if (el) el.remove();
    if (!document.querySelectorAll('.sub-card').length)
        document.getElementById('empty-sub').classList.remove('hidden');
}

/* ── Tags ── */
const tagsInput  = document.getElementById('tags-input');
const tagsBox    = document.getElementById('tags-box');
const tagsHidden = document.getElementById('tags-hidden');
let tags = {!! json_encode($artikelBudidaya->tags ?? []) !!};

tagsInput.addEventListener('focus', () => tagsBox.classList.add('focused'));
tagsInput.addEventListener('blur',  () => tagsBox.classList.remove('focused'));

function renderTags() {
    tagsBox.innerHTML = '';
    tags.forEach((tag, i) => {
        const span = document.createElement('span');
        span.className = 'tag-pill';
        span.innerHTML = `${tag}<button type="button" onclick="removeTag(${i})" title="Hapus">&#x2715;</button>`;
        tagsBox.appendChild(span);
    });
    tagsBox.appendChild(tagsInput);
    tagsHidden.value = JSON.stringify(tags);
}

function removeTag(i) { tags.splice(i, 1); renderTags(); }

tagsInput.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ',') {
        e.preventDefault();
        const val = tagsInput.value.trim().replace(/,$/, '');
        if (val && !tags.includes(val)) { tags.push(val); renderTags(); }
        else tagsInput.value = '';
    }
    if (e.key === 'Backspace' && !tagsInput.value && tags.length) {
        tags.pop(); renderTags();
    }
});

renderTags();
</script>
@endpush