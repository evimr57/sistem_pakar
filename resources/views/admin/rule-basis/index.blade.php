@extends('layouts.admin-app')

@section('page-title', 'Manajemen Rule Basis')
@section('page-subtitle', 'Kelola aturan diagnosa sistem pakar')

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
    body, .index-root { font-family: 'Plus Jakarta Sans', sans-serif; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(12px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .anim { animation: fadeUp .5s cubic-bezier(.22,1,.36,1) both; }
    .a1 { animation-delay:.04s; }
    .a2 { animation-delay:.12s; }
    .a3 { animation-delay:.20s; }

    /* ── alert ── */
    .alert-success {
        display:flex; align-items:center; gap:.75rem;
        padding:.9rem 1.2rem; margin-bottom:1.25rem;
        background:#f0fdf4; border:1.5px solid #bbf7d0;
        border-radius:14px; font-size:.85rem; font-weight:600; color:#166534;
    }

    /* ── main card ── */
    .index-card {
        background:var(--bg-card);
        border-radius:var(--radius);
        border:1.5px solid rgba(29,77,46,.07);
        box-shadow:var(--shadow);
        overflow:hidden;
    }

    /* ── toolbar ── */
    .toolbar {
        display:flex; align-items:center; justify-content:space-between;
        padding:1.4rem 1.75rem;
        border-bottom:1.5px solid rgba(29,77,46,.07);
        flex-wrap:wrap; gap:.75rem;
    }
    .toolbar-title-bar { display:inline-block; width:3px; height:16px; background:linear-gradient(180deg,var(--green-mid),var(--green-bright)); border-radius:2px; vertical-align:middle; margin-right:.4rem; }
    .toolbar-title { font-size:1rem; font-weight:700; color:var(--text-primary); letter-spacing:-.01em; }
    .btn-add {
        display:inline-flex; align-items:center; gap:.45rem;
        padding:.6rem 1.25rem;
        background:linear-gradient(135deg,#2d7a4f,#16a34a);
        color:#fff; font-size:.82rem; font-weight:700;
        border-radius:50px; text-decoration:none;
        box-shadow:0 4px 14px rgba(22,163,74,.25); transition:all .2s;
    }
    .btn-add:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(22,163,74,.35); }

    /* ── filter bar ── */
    .filter-bar {
        padding:1.1rem 1.75rem;
        background:#fafcfb;
        border-bottom:1.5px solid rgba(29,77,46,.07);
        display:flex; gap:1rem; flex-wrap:wrap; align-items:flex-end;
    }
    .filter-group { display:flex; flex-direction:column; gap:.35rem; flex:1; min-width:160px; }
    .filter-label { font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:var(--text-muted); }
    .filter-select, .filter-input {
        padding:.6rem .9rem;
        border:1.5px solid var(--input-border); border-radius:10px;
        font-size:.82rem; font-family:'Plus Jakarta Sans',sans-serif;
        color:var(--text-primary); background:#fff; outline:none;
        transition:border-color .15s, box-shadow .15s;
    }
    .filter-select:focus, .filter-input:focus {
        border-color:var(--input-focus);
        box-shadow:0 0 0 3px rgba(45,122,79,.1);
    }
    .filter-actions { display:flex; gap:.5rem; align-items:flex-end; }
    .btn-filter {
        display:inline-flex; align-items:center; gap:.35rem;
        padding:.6rem 1.1rem;
        background:#f0fdf4; border:1.5px solid #bbf7d0;
        color:var(--green-mid); font-size:.8rem; font-weight:700;
        border-radius:10px; cursor:pointer; transition:all .15s;
    }
    .btn-filter:hover { background:#dcfce7; border-color:var(--green-mid); }
    .btn-reset {
        display:inline-flex; align-items:center; gap:.35rem;
        padding:.6rem 1rem;
        background:#f9fafb; border:1.5px solid #e5e7eb;
        color:var(--text-muted); font-size:.8rem; font-weight:600;
        border-radius:10px; text-decoration:none; transition:all .15s;
    }
    .btn-reset:hover { background:#f3f4f6; }

    /* ── table ── */
    .table-wrap { overflow-x:auto; }
    table { width:100%; border-collapse:collapse; }
    thead tr { border-bottom:1.5px solid rgba(29,77,46,.08); }
    thead th {
        padding:.75rem 1.1rem;
        text-align:left; font-size:.67rem; font-weight:700;
        text-transform:uppercase; letter-spacing:.08em;
        color:var(--text-muted); background:#fafcfb; white-space:nowrap;
    }
    thead th.center { text-align:center; }

    tbody tr { border-bottom:1px solid rgba(29,77,46,.05); transition:background .15s; }
    tbody tr:last-child { border-bottom:none; }
    tbody tr:hover { background:#fafcfb; }
    td { padding:.85rem 1.1rem; vertical-align:middle; }

    .td-no { font-size:.78rem; color:var(--text-muted); font-weight:500; }

    /* id badge */
    .id-pill {
        display:inline-block; padding:.18rem .6rem;
        background:#f0fdf4; border:1px solid #bbf7d0;
        color:var(--green-mid); font-size:.68rem; font-weight:700;
        border-radius:6px; font-family:'DM Mono',monospace; letter-spacing:.02em;
        margin-bottom:.3rem;
    }
    .cell-name { font-size:.82rem; font-weight:600; color:var(--text-primary); }
    .cell-sub  { font-size:.75rem; color:var(--text-muted); }

    /* numeric badge */
    .num-badge {
        display:inline-block; padding:.25rem .65rem;
        background:#f9fafb; border:1.5px solid #e5e7eb;
        color:var(--text-primary); font-size:.8rem; font-weight:700;
        border-radius:8px; font-family:'DM Mono',monospace;
        min-width:52px; text-align:center;
    }

    /* cf badge color by value */
    .cf-high   { background:#f0fdf4; border-color:#bbf7d0; color:#166534; }
    .cf-mid    { background:#fefce8; border-color:#fde68a; color:#a16207; }
    .cf-low    { background:#f9fafb; border-color:#e5e7eb; color:#6b7280; }

    .td-keterangan { font-size:.78rem; color:var(--text-muted); max-width:180px; }

    /* action buttons */
    .actions { display:flex; align-items:center; justify-content:center; gap:.4rem; }
    .btn-edit, .btn-del {
        display:inline-flex; align-items:center; gap:.3rem;
        padding:.38rem .85rem; border-radius:8px;
        font-size:.75rem; font-weight:700;
        text-decoration:none; border:1.5px solid transparent;
        cursor:pointer; transition:all .15s; white-space:nowrap;
        font-family:'Plus Jakarta Sans',sans-serif;
    }
    .btn-edit { background:#f0fdf4; color:#2d7a4f; border-color:#bbf7d0; }
    .btn-edit:hover { background:#dcfce7; border-color:#2d7a4f; }
    .btn-del  { background:#fff5f5; color:#dc2626; border-color:#fecaca; }
    .btn-del:hover  { background:#fee2e2; border-color:#dc2626; }

    /* empty state */
    .empty-state { padding:4rem 2rem; text-align:center; }
    .empty-icon  { width:48px; height:48px; margin:0 auto 1rem; opacity:.22; }
    .empty-state h4 { font-size:.95rem; font-weight:700; color:var(--text-primary); margin-bottom:.35rem; }
    .empty-state p  { font-size:.82rem; color:var(--text-muted); }

    /* pagination */
    .pagination-wrap {
        padding:1.1rem 1.75rem;
        border-top:1.5px solid rgba(29,77,46,.07);
    }
</style>
@endpush

@section('content')
<div class="index-root">

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert-success anim a1">
            <svg width="16" height="16" fill="none" stroke="#16a34a" viewBox="0 0 24 24" stroke-width="2.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="index-card anim a2">

        {{-- Toolbar --}}
        <div class="toolbar">
            <div class="toolbar-title">
                <span class="toolbar-title-bar"></span>
                Daftar Rule Basis
            </div>
            <a href="{{ route('admin.rule-basis.create') }}" class="btn-add">
                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Rule
            </a>
        </div>

        {{-- Filter --}}
        <div class="filter-bar anim a2">
            <form method="GET" action="{{ route('admin.rule-basis.index') }}" style="display:contents;">
                <div class="filter-group">
                    <label class="filter-label">Filter Penyakit</label>
                    <select name="penyakit" class="filter-select">
                        <option value="">Semua Penyakit</option>
                        @foreach($penyakits as $penyakit)
                            <option value="{{ $penyakit->id_penyakit }}" {{ request('penyakit') == $penyakit->id_penyakit ? 'selected' : '' }}>
                                {{ $penyakit->id_penyakit }} — {{ $penyakit->nama_penyakit }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Filter Gejala</label>
                    <select name="gejala" class="filter-select">
                        <option value="">Semua Gejala</option>
                        @foreach($gejalas as $gejala)
                            <option value="{{ $gejala->id_gejala }}" {{ request('gejala') == $gejala->id_gejala ? 'selected' : '' }}>
                                {{ $gejala->id_gejala }} — {{ $gejala->nama_gejala }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn-filter">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                        Filter
                    </button>
                    @if(request('penyakit') || request('gejala'))
                        <a href="{{ route('admin.rule-basis.index') }}" class="btn-reset">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="table-wrap anim a3">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Penyakit</th>
                        <th>Gejala</th>
                        <th class="center">MB</th>
                        <th class="center">MD</th>
                        <th class="center">CF</th>
                        <th>Keterangan</th>
                        <th class="center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rules as $index => $rule)
                        <tr>
                            <td class="td-no">{{ $rules->firstItem() + $index }}</td>

                            <td>
                                <div class="id-pill">{{ $rule->id_penyakit }}</div>
                                <div class="cell-name">{{ $rule->penyakit->nama_penyakit ?? '-' }}</div>
                            </td>

                            <td>
                                <div class="id-pill">{{ $rule->id_gejala }}</div>
                                <div class="cell-sub">{{ $rule->gejala->nama_gejala ?? '-' }}</div>
                            </td>

                            <td style="text-align:center;">
                                <span class="num-badge">{{ number_format($rule->mb, 2) }}</span>
                            </td>
                            <td style="text-align:center;">
                                <span class="num-badge">{{ number_format($rule->md, 2) }}</span>
                            </td>
                            <td style="text-align:center;">
                                @php $cf = $rule->cf_pakar; @endphp
                                <span class="num-badge {{ $cf >= 0.7 ? 'cf-high' : ($cf >= 0.4 ? 'cf-mid' : 'cf-low') }}">
                                    {{ number_format($cf, 2) }}
                                </span>
                            </td>

                            <td class="td-keterangan">{{ Str::limit($rule->keterangan ?? '-', 50) }}</td>

                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.rule-basis.edit', $rule->id_rule) }}" class="btn-edit">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.rule-basis.destroy', $rule->id_rule) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus rule ini?')" style="display:contents;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-del">
                                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <svg class="empty-icon" fill="none" stroke="#2d7a4f" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                    <h4>Belum ada rule basis</h4>
                                    <p>Klik <strong>Tambah Rule</strong> untuk menambahkan aturan diagnosa.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($rules->hasPages())
            <div class="pagination-wrap">
                {{ $rules->links() }}
            </div>
        @endif

    </div>
</div>
@endsection