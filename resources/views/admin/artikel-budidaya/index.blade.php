@extends('layouts.admin-app')

@section('page-title', 'Artikel Budidaya')
@section('page-subtitle', 'Kelola informasi budidaya kopi')

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
    }
    body, .index-root { font-family: 'Plus Jakarta Sans', sans-serif; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(12px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .anim { animation: fadeUp .5s cubic-bezier(.22,1,.36,1) both; }
    .a1   { animation-delay: .04s; }
    .a2   { animation-delay: .12s; }

    /* ── alert ── */
    .alert-success {
        display: flex; align-items: center; gap: .75rem;
        padding: .9rem 1.2rem; margin-bottom: 1.25rem;
        background: #f0fdf4; border: 1.5px solid #bbf7d0;
        border-radius: 14px; font-size: .85rem; font-weight: 600; color: #166534;
    }
    .alert-success svg { flex-shrink: 0; }

    /* ── main card ── */
    .index-card {
        background: var(--bg-card);
        border-radius: var(--radius);
        border: 1.5px solid rgba(29,77,46,.07);
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    /* ── toolbar ── */
    .toolbar {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1.4rem 1.75rem;
        border-bottom: 1.5px solid rgba(29,77,46,.07);
        flex-wrap: wrap; gap: .75rem;
    }
    .toolbar-title {
        font-size: 1rem; font-weight: 700;
        color: var(--text-primary); letter-spacing: -.01em;
    }
    .toolbar-title span {
        display: inline-flex; align-items: center; gap: .4rem;
    }
    .toolbar-title-bar {
        display: inline-block; width: 3px; height: 16px;
        background: linear-gradient(180deg, var(--green-mid), var(--green-bright));
        border-radius: 2px; vertical-align: middle; margin-right: .3rem;
    }
    .btn-add {
        display: inline-flex; align-items: center; gap: .45rem;
        padding: .6rem 1.25rem;
        background: linear-gradient(135deg, #2d7a4f, #16a34a);
        color: #fff; font-size: .82rem; font-weight: 700;
        border-radius: 50px; text-decoration: none;
        box-shadow: 0 4px 14px rgba(22,163,74,.25);
        transition: all .2s;
    }
    .btn-add:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(22,163,74,.35); }

    /* ── table ── */
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    thead tr { border-bottom: 1.5px solid rgba(29,77,46,.08); }
    thead th {
        padding: .75rem 1.25rem;
        text-align: left; font-size: .68rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .08em;
        color: var(--text-muted); white-space: nowrap;
        background: #fafcfb;
    }
    thead th.center { text-align: center; }

    tbody tr { border-bottom: 1px solid rgba(29,77,46,.05); transition: background .15s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #fafcfb; }
    td { padding: .9rem 1.25rem; vertical-align: middle; }

    .td-no { font-size: .78rem; color: var(--text-muted); font-weight: 500; width: 48px; }

    .article-title { font-size: .85rem; font-weight: 700; color: var(--text-primary); }
    .article-desc  { font-size: .75rem; color: var(--text-muted); margin-top: .2rem; line-height: 1.4; }

    /* status badge */
    .badge {
        display: inline-flex; align-items: center; gap: .3rem;
        padding: .25rem .75rem; border-radius: 50px;
        font-size: .7rem; font-weight: 700; white-space: nowrap;
    }
    .badge-published { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .badge-draft     { background: #f9fafb; color: #6b7280; border: 1px solid #e5e7eb; }
    .badge-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .badge-published .badge-dot { background: #16a34a; }
    .badge-draft     .badge-dot { background: #9ca3af; }

    .td-author { font-size: .8rem; color: var(--text-primary); font-weight: 500; }
    .td-date   { font-size: .78rem; color: var(--text-muted); white-space: nowrap; }

    /* action buttons */
    .actions { display: flex; align-items: center; justify-content: center; gap: .45rem; }
    .btn-edit, .btn-del {
        display: inline-flex; align-items: center; gap: .3rem;
        padding: .38rem .85rem; border-radius: 8px;
        font-size: .75rem; font-weight: 700;
        text-decoration: none; border: 1.5px solid transparent;
        cursor: pointer; transition: all .15s; white-space: nowrap;
    }
    .btn-edit {
        background: #f0fdf4; color: #2d7a4f; border-color: #bbf7d0;
    }
    .btn-edit:hover { background: #dcfce7; border-color: #2d7a4f; }
    .btn-del {
        background: #fff5f5; color: #dc2626; border-color: #fecaca;
    }
    .btn-del:hover { background: #fee2e2; }

    /* empty state */
    .empty-state {
        padding: 4rem 2rem; text-align: center;
    }
    .empty-icon { width: 52px; height: 52px; margin: 0 auto 1rem; opacity: .25; }
    .empty-state h4 { font-size: .95rem; font-weight: 700; color: var(--text-primary); margin-bottom: .35rem; }
    .empty-state p  { font-size: .82rem; color: var(--text-muted); }

    /* pagination */
    .pagination-wrap { padding: 1.1rem 1.75rem; border-top: 1.5px solid rgba(29,77,46,.07); }
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
                Daftar Artikel Budidaya
            </div>
            <a href="{{ route('admin.artikel-budidaya.create') }}" class="btn-add">
                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Artikel
            </a>
        </div>

        {{-- Table --}}
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th class="center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artikels as $index => $artikel)
                        <tr>
                            <td class="td-no">{{ $artikels->firstItem() + $index }}</td>
                            <td>
                                <div class="article-title">{{ $artikel->judul }}</div>
                                @if($artikel->deskripsi_singkat)
                                    <div class="article-desc">{{ Str::limit($artikel->deskripsi_singkat, 65) }}</div>
                                @endif
                            </td>
                            <td>
                                @if($artikel->is_published)
                                    <span class="badge badge-published">
                                        <span class="badge-dot"></span> Published
                                    </span>
                                @else
                                    <span class="badge badge-draft">
                                        <span class="badge-dot"></span> Draft
                                    </span>
                                @endif
                            </td>
                            <td class="td-author">{{ $artikel->author->nama ?? 'Admin' }}</td>
                            <td class="td-date">{{ $artikel->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.artikel-budidaya.edit', $artikel) }}" class="btn-edit">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.artikel-budidaya.destroy', $artikel) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus artikel ini?')" style="display:contents;">
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
                            <td colspan="6">
                                <div class="empty-state">
                                    <svg class="empty-icon" fill="none" stroke="#2d7a4f" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <h4>Belum ada artikel budidaya</h4>
                                    <p>Klik <strong>Tambah Artikel</strong> untuk membuat artikel pertama.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($artikels->hasPages())
            <div class="pagination-wrap">
                {{ $artikels->links() }}
            </div>
        @endif

    </div>
</div>
@endsection 