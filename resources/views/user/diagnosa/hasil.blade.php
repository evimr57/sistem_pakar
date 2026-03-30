@extends('layouts.user-app')

@section('page-title', 'Hasil Diagnosa')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
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
    body, .hasil-root { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-base); }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(14px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .a1 { animation: fadeUp .5s cubic-bezier(.22,1,.36,1) .04s both; }
    .a2 { animation: fadeUp .5s cubic-bezier(.22,1,.36,1) .12s both; }
    .a3 { animation: fadeUp .5s cubic-bezier(.22,1,.36,1) .20s both; }
    .a4 { animation: fadeUp .5s cubic-bezier(.22,1,.36,1) .28s both; }

    /* ─── Page header ─── */
    .page-hdr {
        display:flex; align-items:center; justify-content:space-between;
        margin-bottom:1.5rem; flex-wrap:wrap; gap:.75rem;
    }
    .page-hdr-title { font-size:1.5rem; font-weight:800; color:var(--text-primary); letter-spacing:-.03em; }
    .btn-dl {
        display:inline-flex; align-items:center; gap:.5rem;
        padding:.55rem 1.2rem;
        background:rgba(255,255,255,.15); border:1.5px solid rgba(255,255,255,.35);
        color:#fff; font-size:.8rem; font-weight:700;
        border-radius:50px; text-decoration:none;
        transition:all .2s;
    }
    .btn-dl:hover { background:rgba(255,255,255,.25); border-color:rgba(255,255,255,.6); transform:translateY(-1px); }

    /* ─── Disease banner ─── */
    .banner {
        background: linear-gradient(130deg, #1a4d2e 0%, #2d7a4f 58%, #38a169 100%);
        border-radius: var(--radius); padding:1.75rem 2rem;
        color:#fff; position:relative; overflow:hidden;
        margin-bottom:1.25rem;
        box-shadow:0 8px 32px rgba(26,77,46,.28);
    }
    .banner::before {
        content:''; position:absolute; inset:0;
        background-image:
            linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
        background-size:28px 28px; pointer-events:none;
    }
    .banner::after {
        content:''; position:absolute; top:-80px; right:-60px;
        width:240px; height:240px; border-radius:50%;
        background:radial-gradient(circle, rgba(74,222,128,.18) 0%, transparent 70%);
        pointer-events:none;
    }
    .banner-in { position:relative; z-index:1; }

    .banner-toprow { display:flex; align-items:flex-start; justify-content:space-between; gap:1rem; flex-wrap:wrap; margin-bottom:.9rem; }
    .pill {
        display:inline-flex; align-items:center; gap:.35rem;
        padding:.28rem .85rem; border-radius:50px;
        font-size:.68rem; font-weight:700; letter-spacing:.06em; text-transform:uppercase;
    }
    .pill-detected   { background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25); color:#fff; }
    .pill-danger-st  { background:#dc2626; color:#fff; }
    .pill-danger-t   { background:#f97316; color:#fff; }
    .pill-danger-s   { background:#fde047; color:#713f12; }
    .pill-danger-r   { background:#bbf7d0; color:#14532d; }

    .disease-name  { font-size:1.6rem; font-weight:800; letter-spacing:-.03em; line-height:1.2; }
    .disease-latin { font-style:italic; font-size:.8rem; color:rgba(255,255,255,.6); margin-top:.25rem; }
    .date-meta     { text-align:right; font-size:.72rem; color:rgba(255,255,255,.5); font-family:'DM Mono',monospace; flex-shrink:0; }
    .date-meta small { display:block; font-size:.62rem; color:rgba(255,255,255,.3); margin-top:.35rem; }

    .cf-box { background:rgba(0,0,0,.18); border-radius:14px; padding:.95rem 1.2rem; margin-top:.75rem; }
    .cf-row { display:flex; align-items:center; justify-content:space-between; margin-bottom:.55rem; }
    .cf-lbl { font-size:.76rem; font-weight:600; color:rgba(255,255,255,.8); }
    .cf-val { font-size:2rem; font-weight:800; letter-spacing:-.04em; }
    .cf-track { background:rgba(0,0,0,.25); border-radius:999px; height:10px; }
    .cf-fill  { background:#fff; border-radius:999px; height:10px; }
    .cf-ticks { display:flex; justify-content:space-between; font-size:.63rem; color:rgba(255,255,255,.4); margin-top:.3rem; }

    /* ─── Two-column layout ─── */
    /* Wireframe: left = narrow (label column), right = wide (content) */
    .main-grid {
        display:grid;
        grid-template-columns: 220px 1fr;
        gap:1.25rem;
        align-items:start;
    }
    @media (max-width:900px) { .main-grid { grid-template-columns:1fr; } }

    /* ─── Card ─── */
    .card {
        background:var(--bg-card); border-radius:var(--radius);
        border:1.5px solid rgba(29,77,46,.07);
        box-shadow:var(--shadow); overflow:hidden;
        transition:transform .2s, box-shadow .2s;
    }
    .card:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(29,77,46,.12); }
    .card-hdr {
        display:flex; align-items:center; gap:.6rem;
        padding:.9rem 1.2rem;
        border-bottom:1px solid rgba(29,77,46,.07);
    }
    .card-hdr-icon {
        width:30px; height:30px; border-radius:8px; flex-shrink:0;
        display:flex; align-items:center; justify-content:center;
    }
    .card-hdr-title { font-size:.85rem; font-weight:700; color:var(--text-primary); letter-spacing:-.01em; }
    .card-body { padding:1.1rem 1.2rem; }

    /* ─── Info table rows ─── */
    .info-row { display:flex; justify-content:space-between; align-items:center; padding:.55rem 0; border-bottom:1px solid rgba(29,77,46,.06); font-size:.78rem; }
    .info-row:last-child { border-bottom:none; }
    .info-k { color:var(--text-muted); font-weight:500; }
    .info-v { font-weight:700; color:var(--text-primary); }
    .info-v.green { color:#16a34a; }
    .info-v.blue  { color:#2563eb; }

    /* ─── Gejala ─── */
    .gejala-item {
        display:flex; align-items:flex-start; gap:.45rem;
        padding:.45rem .6rem; background:#f0fdf4;
        border-radius:8px; font-size:.76rem; color:#166534;
        font-weight:500; margin-bottom:.38rem;
    }
    .gejala-item svg { flex-shrink:0; margin-top:1px; }

    /* ─── Desc ─── */
    .desc-box { background:#f9fafb; border-radius:12px; padding:.9rem 1rem; font-size:.8rem; color:#4b5563; line-height:1.65; }

    /* ─── Pengendalian ─── */
    .ctrl-grid { display:grid; grid-template-columns:1fr 1fr; gap:.65rem; }
    @media (max-width:600px) { .ctrl-grid { grid-template-columns:1fr; } }
    .ctrl-card { border-radius:13px; padding:.9rem; font-size:.76rem; line-height:1.6; border:1.5px solid transparent; }
    .ctrl-lbl { display:flex; align-items:center; gap:.4rem; font-size:.73rem; font-weight:700; margin-bottom:.45rem; }
    .ctrl-lbl-icon { width:24px; height:24px; border-radius:6px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }

    .ctrl-pencegahan { background:#eff6ff; border-color:#dbeafe; color:#1e40af; }
    .ctrl-pencegahan .ctrl-lbl { color:#1e40af; } .ctrl-pencegahan .ctrl-lbl-icon { background:#dbeafe; }
    .ctrl-kimia      { background:#fff7ed; border-color:#fed7aa; color:#c2410c; }
    .ctrl-kimia .ctrl-lbl      { color:#c2410c; } .ctrl-kimia .ctrl-lbl-icon      { background:#fed7aa; }
    .ctrl-organik    { background:#f0fdf4; border-color:#bbf7d0; color:#15803d; }
    .ctrl-organik .ctrl-lbl    { color:#15803d; } .ctrl-organik .ctrl-lbl-icon    { background:#bbf7d0; }
    .ctrl-budidaya   { background:#fefce8; border-color:#fde68a; color:#a16207; }
    .ctrl-budidaya .ctrl-lbl   { color:#a16207; } .ctrl-budidaya .ctrl-lbl-icon   { background:#fde68a; }

    /* ─── Kemungkinan ─── */
    .kemung-item { display:flex; align-items:center; gap:.7rem; padding:.7rem; border-radius:12px; margin-bottom:.45rem; }
    .kemung-item.r1    { background:#f0fdf4; border:1.5px solid #bbf7d0; }
    .kemung-item.rother{ background:#f9fafb; border:1px solid #f3f4f6; }
    .rank-circle { width:26px; height:26px; border-radius:50%; font-size:.72rem; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .rc-1    { background:#16a34a; color:#fff; }
    .rc-other{ background:#e5e7eb; color:#6b7280; }
    .bar-track { flex:1; background:#e5e7eb; border-radius:999px; height:6px; }
    .bar-fill  { border-radius:999px; height:6px; }

    /* ─── Action buttons ─── */
    .btn-main {
        display:flex; align-items:center; justify-content:center; gap:.5rem;
        padding:.7rem 1rem; background:linear-gradient(135deg, #2d7a4f, #16a34a);
        color:#fff; font-weight:700; font-size:.82rem; border-radius:13px;
        text-decoration:none; width:100%;
        box-shadow:0 4px 14px rgba(22,163,74,.3); transition:all .2s;
    }
    .btn-main:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(22,163,74,.4); }
    .btn-sec {
        display:flex; align-items:center; justify-content:center; gap:.5rem;
        padding:.7rem 1rem; background:var(--bg-card); color:var(--text-primary);
        font-weight:600; font-size:.82rem; border-radius:13px;
        text-decoration:none; width:100%; border:1.5px solid rgba(29,77,46,.15); transition:all .2s;
    }
    .btn-sec:hover { background:#f0fdf4; transform:translateY(-1px); }

    /* ─── Relasi table ─── */
    .relasi-wrap { overflow-x:auto; }
    .relasi-table { width:100%; border-collapse:collapse; font-size:.76rem; }
    .relasi-table th { padding:.6rem .8rem; text-align:left; font-weight:700; font-size:.67rem; text-transform:uppercase; letter-spacing:.06em; color:var(--text-muted); background:#f9fafb; border-bottom:1px solid #e5e7eb; }
    .relasi-table th:not(:first-child) { text-align:center; }
    .relasi-table td { padding:.55rem .8rem; border-bottom:1px solid #f3f4f6; color:#374151; }
    .relasi-table td:not(:first-child) { text-align:center; }
    .relasi-table tr:last-child td { border-bottom:none; }
    .relasi-table tr:hover td { background:#f9fafb; }
    .chk-yes { display:inline-flex; align-items:center; justify-content:center; width:24px; height:24px; background:#dcfce7; border-radius:50%; }
    .chk-no  { display:inline-flex; align-items:center; justify-content:center; width:24px; height:24px; background:#f3f4f6; border-radius:50%; }

    .col-stack { display:flex; flex-direction:column; gap:1.25rem; }
</style>
@endpush

@section('content')
<div class="hasil-root">

    {{-- Disease banner --}}
    <div class="banner a1">
        <div class="banner-in">
            <div class="banner-toprow">
                <div>
                    <div style="display:flex;gap:.45rem;flex-wrap:wrap;margin-bottom:.7rem;">
                        <span class="pill pill-detected">
                            <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Penyakit Terdeteksi
                        </span>
                        @if($riwayat->penyakit?->tingkat_bahaya)
                            @php
                                $pc = match($riwayat->penyakit->tingkat_bahaya) {
                                    'Sangat Tinggi' => 'pill-danger-st',
                                    'Tinggi'        => 'pill-danger-t',
                                    'Sedang'        => 'pill-danger-s',
                                    default         => 'pill-danger-r',
                                };
                            @endphp
                            <span class="pill {{ $pc }}">
                                <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                {{ $riwayat->penyakit->tingkat_bahaya }}
                            </span>
                        @endif
                    </div>
                    <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
                        <div>
                            <div class="disease-name">{{ $riwayat->penyakit->nama_penyakit ?? 'Tidak Teridentifikasi' }}</div>
                            @if($riwayat->penyakit?->nama_latin)
                                <div class="disease-latin">{{ $riwayat->penyakit->nama_latin }}</div>
                            @endif
                        </div>
                        <a href="{{ route('user.riwayat.pdf', $riwayat->id_diagnosis) }}" target="_blank" class="btn-dl" style="flex-shrink:0;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </div>
                <div class="date-meta">
                    <div>{{ $riwayat->tanggal->format('d M Y') }}</div>
                    <div>{{ $riwayat->tanggal->format('H:i') }} WIB</div>
                    <small>ID: {{ $riwayat->id_diagnosis }}</small>
                </div>
            </div>
            <div class="cf-box">
                <div class="cf-row">
                    <span class="cf-lbl">Tingkat Kepercayaan (Certainty Factor)</span>
                    <span class="cf-val">{{ round($riwayat->cf_tertinggi * 100, 1) }}%</span>
                </div>
                <div class="cf-track">
                    <div class="cf-fill" style="width:{{ round($riwayat->cf_tertinggi * 100, 1) }}%;"></div>
                </div>
                <div class="cf-ticks"><span>0%</span><span>50%</span><span>100%</span></div>
            </div>
        </div>
    </div>

    {{-- Main two-column grid --}}
    {{-- LEFT = info & aksi (narrow) | RIGHT = konten detail (wide) --}}
    <div class="main-grid a2">

        {{-- ── LEFT COLUMN ── --}}
        <div class="col-stack">

            {{-- Aksi --}}
            <div class="card">
                <div class="card-body" style="display:flex;flex-direction:column;gap:.65rem;">
                    <a href="{{ route('user.diagnosa.index') }}" class="btn-main">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Diagnosa Ulang
                    </a>
                    <a href="{{ route('user.diagnosa.riwayat') }}" class="btn-sec">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Riwayat
                    </a>
                </div>
            </div>

        </div>

        {{-- ── RIGHT COLUMN (Solusi / Detail) ── --}}
        <div class="col-stack a3">

            {{-- Cara Pengendalian (Solusi) --}}
            @if($riwayat->penyakit?->pengendalian_pencegahan || $riwayat->penyakit?->pengendalian_kimia || $riwayat->penyakit?->pengendalian_organik || $riwayat->penyakit?->pengendalian_budidaya)
                <div class="card">
                    <div class="card-hdr">
                        <div class="card-hdr-icon" style="background:#dcfce7;">
                            <svg width="15" height="15" fill="none" stroke="#16a34a" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <span class="card-hdr-title">Solusi &amp; Cara Pengendalian</span>
                    </div>
                    <div class="card-body">
                        <div class="ctrl-grid">
                            @if($riwayat->penyakit?->pengendalian_pencegahan)
                                <div class="ctrl-card ctrl-pencegahan">
                                    <div class="ctrl-lbl">
                                        <div class="ctrl-lbl-icon">
                                            <svg width="12" height="12" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                        </div>
                                        Pencegahan
                                    </div>
                                    {{ $riwayat->penyakit->pengendalian_pencegahan }}
                                </div>
                            @endif
                            @if($riwayat->penyakit?->pengendalian_kimia)
                                <div class="ctrl-card ctrl-kimia">
                                    <div class="ctrl-lbl">
                                        <div class="ctrl-lbl-icon">
                                            <svg width="12" height="12" fill="none" stroke="#c2410c" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                                        </div>
                                        Pengendalian Kimia
                                    </div>
                                    {{ $riwayat->penyakit->pengendalian_kimia }}
                                </div>
                            @endif
                            @if($riwayat->penyakit?->pengendalian_organik)
                                <div class="ctrl-card ctrl-organik">
                                    <div class="ctrl-lbl">
                                        <div class="ctrl-lbl-icon">
                                            <svg width="12" height="12" fill="none" stroke="#15803d" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                        </div>
                                        Pengendalian Organik
                                    </div>
                                    {{ $riwayat->penyakit->pengendalian_organik }}
                                </div>
                            @endif
                            @if($riwayat->penyakit?->pengendalian_budidaya)
                                <div class="ctrl-card ctrl-budidaya">
                                    <div class="ctrl-lbl">
                                        <div class="ctrl-lbl-icon">
                                            <svg width="12" height="12" fill="none" stroke="#a16207" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        Pengendalian Budidaya
                                    </div>
                                    {{ $riwayat->penyakit->pengendalian_budidaya }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            {{-- Semua kemungkinan --}}
            @if($riwayat->hasil_diagnosa && count($riwayat->hasil_diagnosa) > 1)
                <div class="card">
                    <div class="card-hdr">
                        <div class="card-hdr-icon" style="background:#ede9fe;">
                            <svg width="15" height="15" fill="none" stroke="#7c3aed" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="card-hdr-title">Semua Kemungkinan Penyakit</span>
                    </div>
                    <div class="card-body">
                        @foreach($riwayat->hasil_diagnosa as $i => $hasil)
                            <div class="kemung-item {{ $i === 0 ? 'r1' : 'rother' }}">
                                <span class="rank-circle {{ $i === 0 ? 'rc-1' : 'rc-other' }}">{{ $i+1 }}</span>
                                <span style="flex:1;font-size:.8rem;font-weight:{{ $i===0?'700':'500' }};color:{{ $i===0?'#166534':'#374151' }};overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                    {{ $hasil['nama_penyakit'] }}
                                </span>
                                <div class="bar-track" style="max-width:90px;">
                                    <div class="bar-fill" style="width:{{ $hasil['persentase'] }}%;background:{{ $i===0?'#16a34a':'#d1d5db' }};"></div>
                                </div>
                                <span style="font-size:.8rem;font-weight:800;color:{{ $i===0?'#16a34a':'#9ca3af' }};width:36px;text-align:right;flex-shrink:0;">{{ $hasil['persentase'] }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Relasi gejala --}}
            @if($relasiGejala->count() > 0)
                <div class="card a4">
                    <div class="card-hdr">
                        <div class="card-hdr-icon" style="background:#dbeafe;">
                            <svg width="15" height="15" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                        </div>
                        <span class="card-hdr-title">Relasi Gejala &amp; Penyakit</span>
                    </div>
                    <div class="relasi-wrap">
                        <table class="relasi-table">
                            <thead>
                                <tr>
                                    <th style="padding-left:1.2rem;">Gejala</th>
                                    @foreach($riwayat->hasil_diagnosa as $hasil)
                                        <th>{{ $hasil['nama_penyakit'] }}<br><span style="color:#16a34a;text-transform:none;letter-spacing:0;font-weight:700;">{{ $hasil['persentase'] }}%</span></th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gejalaInput as $gejala)
                                    <tr>
                                        <td style="padding-left:1.2rem;font-weight:500;">{{ $gejala->nama_gejala }}</td>
                                        @foreach($riwayat->hasil_diagnosa as $hasil)
                                            <td>
                                                @if(isset($relasiGejala[$hasil['id_penyakit']]) && $relasiGejala[$hasil['id_penyakit']]->contains('id_gejala', $gejala->id_gejala))
                                                    <span class="chk-yes">
                                                        <svg width="11" height="11" fill="none" stroke="#16a34a" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    </span>
                                                @else
                                                    <span class="chk-no">
                                                        <svg width="10" height="10" fill="none" stroke="#d1d5db" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                                    </span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p style="font-size:.68rem;color:#9ca3af;padding:.65rem 1.2rem;border-top:1px solid #f3f4f6;">
                            Centang = gejala terkait &nbsp;|&nbsp; Silang = tidak terkait
                        </p>
                    </div>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection