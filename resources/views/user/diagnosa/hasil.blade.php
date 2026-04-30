@extends('layouts.user-app')

@section('page-title', 'Hasil Diagnosa')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
    :root {
        --green-deep:   #1a4d2e;
        --green-mid:    #2d7a4f;
        --green-bright: #4ade80;
        --bg-base:      #f0f5f1;
        --bg-card:      #ffffff;
        --text-primary: #0f1f14;
        --text-muted:   #6b7f72;
        --shadow:       0 4px 24px rgba(29,77,46,.08), 0 1px 4px rgba(29,77,46,.05);
        --shadow-deep:  0 8px 40px rgba(29,77,46,.16), 0 2px 8px rgba(29,77,46,.08);
        --radius:       20px;
        --r-sm:  10px;
        --r-md:  16px;
        --r-lg:  20px;
        --r-xl:  20px;
        --white:    #ffffff;
        --ink:      #0f1f14;
        --smoke:    #6b7f72;
        --fog:      #9aada0;
        --parchment:#f0f5f1;
        --mist:     #dcfce7;
        --leaf:     #16a34a;
        --leaf-mid: #2d7a4f;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body, .hasil-root { font-family: 'Sora', sans-serif; background: var(--bg-base); color: var(--text-primary); }

    /* ── Animations ── */
    @keyframes slideUp   { from { opacity:0; transform:translateY(18px); } to { opacity:1; transform:translateY(0); } }
    @keyframes scaleIn   { from { opacity:0; transform:scale(.97); } to { opacity:1; transform:scale(1); } }
    @keyframes fillBar   { from { width:0%; } to { width:var(--w); } }
    @keyframes pulse-glow { 0%,100% { box-shadow:0 0 0 0 rgba(106,173,94,.35); } 50% { box-shadow:0 0 0 8px rgba(106,173,94,0); } }

    .a1 { animation: scaleIn  .55s cubic-bezier(.16,1,.3,1) .05s both; }
    .a2 { animation: slideUp  .5s  cubic-bezier(.16,1,.3,1) .15s both; }
    .a3 { animation: slideUp  .5s  cubic-bezier(.16,1,.3,1) .25s both; }
    .a4 { animation: slideUp  .5s  cubic-bezier(.16,1,.3,1) .35s both; }

    /* ── Hero Banner ── */
    .banner {
        position: relative; overflow: hidden;
        border-radius: var(--r-xl);
        margin-bottom: 1.5rem;
        background: linear-gradient(130deg, #1a4d2e 0%, #2d7a4f 58%, #38a169 100%);
        box-shadow: 0 8px 32px rgba(26,77,46,.28);
    }
    .banner-texture {
        position: absolute; inset: 0; pointer-events: none;
        background-image:
            linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
        background-size: 28px 28px;
    }
    .banner-stripe {
        position: absolute; top: -80px; right: -60px;
        width: 240px; height: 240px; border-radius: 50%;
        background: radial-gradient(circle, rgba(74,222,128,.18) 0%, transparent 70%);
        pointer-events: none;
    }
    .banner-inner { position: relative; z-index: 1; padding: 2rem 2.25rem; }

    /* Banner top row */
    .banner-toprow { display: flex; align-items: flex-start; justify-content: space-between; gap: 1.25rem; flex-wrap: wrap; margin-bottom: 1.25rem; }

    /* Pills */
    .pill-row { display: flex; gap: .5rem; flex-wrap: wrap; margin-bottom: .85rem; }
    .pill {
        display: inline-flex; align-items: center; gap: .3rem;
        padding: .3rem .85rem; border-radius: 999px;
        font-size: .68rem; font-weight: 600; letter-spacing: .07em; text-transform: uppercase;
    }
    .pill-detected { background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2); color: rgba(255,255,255,.9); }
    .pill-st { background: #dc2626; color: #fff; }
    .pill-t  { background: #ea580c; color: #fff; }
    .pill-s  { background: #ca8a04; color: #fff; }
    .pill-r  { background: rgba(106,173,94,.25); border: 1px solid rgba(106,173,94,.4); color: #a3e09a; }

    /* Disease name */
    .disease-block {}
    .disease-name  { font-family: 'Instrument Serif', serif; font-size: 2.1rem; line-height: 1.15; color: #fff; letter-spacing: -.01em; }
    .disease-latin { font-family: 'Instrument Serif', serif; font-style: italic; font-size: .95rem; color: rgba(255,255,255,.45); margin-top: .3rem; }

    /* Date meta */
    .date-meta { text-align: right; flex-shrink: 0; }
    .date-meta .date-big { font-size: .85rem; color: rgba(255,255,255,.7); font-weight: 500; }
    .date-meta .date-time { font-size: .75rem; color: rgba(255,255,255,.4); margin-top: .2rem; }
    .date-meta .date-id { font-family: 'JetBrains Mono', monospace; font-size: .65rem; color: rgba(255,255,255,.25); margin-top: .5rem; }

    /* CF bar */
    .cf-panel {
        background: rgba(0,0,0,.25); border-radius: var(--r-md);
        padding: 1.1rem 1.4rem; backdrop-filter: blur(4px);
        border: 1px solid rgba(255,255,255,.07);
    }
    .cf-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: .75rem; }
    .cf-label { font-size: .72rem; font-weight: 600; color: rgba(255,255,255,.55); letter-spacing: .05em; text-transform: uppercase; }
    .cf-value { font-family: 'Instrument Serif', serif; font-size: 2.4rem; color: #fff; line-height: 1; }
    .cf-track { background: rgba(0,0,0,.3); border-radius: 999px; height: 8px; overflow: hidden; }
    .cf-fill { height: 8px; border-radius: 999px; background: #ffffff; }
    .cf-ticks { display: flex; justify-content: space-between; font-size: .62rem; color: rgba(255,255,255,.3); margin-top: .4rem; font-family: 'JetBrains Mono', monospace; }

    /* Disease image inside banner */
    .banner-img-wrap {
        margin-top: 1.1rem; border-radius: var(--r-md); overflow: hidden;
        aspect-ratio: 21/7; background: rgba(0,0,0,.2);
        border: 1px solid rgba(255,255,255,.1);
    }
    .banner-img-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; opacity: .85; }

    /* Download button */
    .btn-dl {
        display: inline-flex; align-items: center; gap: .5rem;
        padding: .55rem 1.2rem; border-radius: 50px;
        background: rgba(255,255,255,.15); border: 1.5px solid rgba(255,255,255,.35);
        color: #fff; font-size: .8rem; font-weight: 700; text-decoration: none;
        margin-top: .85rem; transition: all .2s;
    }
    .btn-dl:hover { background: rgba(255,255,255,.25); border-color: rgba(255,255,255,.6); transform: translateY(-1px); }

    /* ── Layout ── */
    .main-grid { display: grid; grid-template-columns: 230px 1fr; gap: 1.25rem; align-items: start; }
    @media (max-width: 860px) { .main-grid { grid-template-columns: 1fr; } }
    .col-stack { display: flex; flex-direction: column; gap: 1.25rem; }

    /* ── Card ── */
    .card {
        background: var(--bg-card); border-radius: var(--radius);
        border: 1.5px solid rgba(29,77,46,.07);
        box-shadow: var(--shadow); overflow: hidden;
        transition: transform .2s, box-shadow .2s;
    }
    .card:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(29,77,46,.12); }

    .card-hdr {
        display: flex; align-items: center; gap: .6rem;
        padding: .9rem 1.2rem; border-bottom: 1px solid rgba(29,77,46,.07);
    }
    .card-hdr-icon {
        width: 30px; height: 30px; border-radius: 8px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
    }
    .card-hdr-title { font-size: .85rem; font-weight: 700; color: var(--text-primary); letter-spacing: -.01em; }
    .card-body { padding: 1.1rem 1.2rem; }

    /* ── Info rows ── */
    .info-row { display: flex; justify-content: space-between; align-items: center; padding: .55rem 0; border-bottom: 1px solid rgba(29,77,46,.06); font-size: .78rem; }
    .info-row:last-child { border-bottom: none; }
    .info-k { color: var(--text-muted); font-weight: 500; }
    .info-v { font-weight: 700; color: var(--text-primary); }
    .info-v.leaf { color: #16a34a; }
    .info-v.blue { color: #2563eb; }

    /* ── Gejala chips ── */
    .gejala-wrap { display: flex; flex-direction: column; gap: .38rem; }
    .gejala-chip {
        display: flex; align-items: flex-start; gap: .45rem;
        padding: .45rem .6rem; background: #f0fdf4;
        border-radius: 8px; font-size: .76rem; color: #166534;
        font-weight: 500; line-height: 1.45;
    }
    .gejala-chip svg { flex-shrink: 0; margin-top: 1px; }

    /* ── Description ── */
    .desc-box { background: #f9fafb; border-radius: 12px; padding: .9rem 1rem; font-size: .8rem; color: #4b5563; line-height: 1.65; }

    /* ── Pengendalian grid ── */
    .ctrl-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .65rem; }
    @media (max-width: 560px) { .ctrl-grid { grid-template-columns: 1fr; } }
    .ctrl-card { border-radius: 13px; padding: .9rem; font-size: .76rem; line-height: 1.6; border: 1.5px solid transparent; }
    .ctrl-lbl { display: flex; align-items: center; gap: .4rem; font-size: .73rem; font-weight: 700; margin-bottom: .45rem; }
    .ctrl-lbl-icon { width: 24px; height: 24px; border-radius: 6px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }

    .ctrl-pencegahan { background: #eff6ff; border-color: #dbeafe; color: #1e40af; }
    .ctrl-pencegahan .ctrl-lbl { color: #1e40af; } .ctrl-pencegahan .ctrl-lbl-icon { background: #dbeafe; }
    .ctrl-kimia      { background: #fff7ed; border-color: #fed7aa; color: #c2410c; }
    .ctrl-kimia .ctrl-lbl      { color: #c2410c; } .ctrl-kimia .ctrl-lbl-icon      { background: #fed7aa; }
    .ctrl-organik    { background: #f0fdf4; border-color: #bbf7d0; color: #15803d; }
    .ctrl-organik .ctrl-lbl    { color: #15803d; } .ctrl-organik .ctrl-lbl-icon    { background: #bbf7d0; }
    .ctrl-budidaya   { background: #fefce8; border-color: #fde68a; color: #a16207; }
    .ctrl-budidaya .ctrl-lbl   { color: #a16207; } .ctrl-budidaya .ctrl-lbl-icon   { background: #fde68a; }

    /* ── Kemungkinan list ── */
    .kemung-list { display: flex; flex-direction: column; gap: .45rem; }
    .kemung-item { display: flex; align-items: center; gap: .7rem; padding: .7rem; border-radius: 12px; }
    .kemung-item.top  { background: #f0fdf4; border: 1.5px solid #bbf7d0; }
    .kemung-item.rest { background: #f9fafb; border: 1px solid #f3f4f6; }
    .rank-num { width: 26px; height: 26px; border-radius: 50%; font-size: .72rem; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .rank-num.r1 { background: #16a34a; color: #fff; }
    .rank-num.ro { background: #e5e7eb; color: #6b7280; }
    .kemung-name { font-size: .8rem; font-weight: 500; color: #374151; }
    .kemung-name.top { font-weight: 700; color: #166534; }
    .bar-wrap { flex-shrink: 0; width: 80px; height: 6px; background: #e5e7eb; border-radius: 999px; overflow: hidden; }
    .bar-fill-k { height: 6px; border-radius: 999px; }
    .kemung-pct { font-size: .8rem; font-weight: 800; flex-shrink: 0; width: 38px; text-align: right; }

    /* ── Action buttons ── */
    .btn-primary {
        display: flex; align-items: center; justify-content: center; gap: .5rem;
        padding: .7rem 1rem; border-radius: 13px; width: 100%; text-decoration: none;
        background: linear-gradient(135deg, #2d7a4f, #16a34a);
        color: #fff; font-weight: 700; font-size: .82rem;
        box-shadow: 0 4px 14px rgba(22,163,74,.3); transition: all .2s;
    }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(22,163,74,.4); }
    .btn-secondary {
        display: flex; align-items: center; justify-content: center; gap: .5rem;
        padding: .7rem 1rem; border-radius: 13px; width: 100%; text-decoration: none;
        background: var(--bg-card); color: var(--text-primary);
        font-weight: 600; font-size: .82rem;
        border: 1.5px solid rgba(29,77,46,.15); transition: all .2s;
    }
    .btn-secondary:hover { background: #f0fdf4; transform: translateY(-1px); }

    /* ── Relasi table ── */
    .relasi-outer { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .relasi-table { width: 100%; border-collapse: collapse; font-size: .76rem; }
    .relasi-table th { padding: .6rem .8rem; text-align: left; font-weight: 700; font-size: .67rem; text-transform: uppercase; letter-spacing: .06em; color: var(--text-muted); background: #f9fafb; border-bottom: 1px solid #e5e7eb; }
    .relasi-table th:not(:first-child) { text-align: center; }
    .relasi-table td { padding: .55rem .8rem; border-bottom: 1px solid #f3f4f6; color: #374151; }
    .relasi-table td:not(:first-child) { text-align: center; }
    .relasi-table tr:last-child td { border-bottom: none; }
    .relasi-table tr:hover td { background: #f9fafb; }
    .chk-yes { display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #dcfce7; border-radius: 50%; }
    .chk-no  { display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #f3f4f6; border-radius: 50%; }
    .relasi-legend { font-size: .68px; color: #9ca3af; padding: .65rem 1.2rem; border-top: 1px solid #f3f4f6; }

    /* ── Image card ── */
    .img-card-img { width: 100%; aspect-ratio: 4/3; object-fit: cover; display: block; border-radius: 12px 12px 0 0; }
    .img-card-caption { font-size: .68rem; color: var(--text-muted); text-align: center; padding: .5rem; font-style: italic; border-top: 1px solid rgba(29,77,46,.07); }
</style>
@endpush

@section('content')
<div class="hasil-root">

    {{-- ── Hero Banner ── --}}
    <div class="banner a1">
        <div class="banner-texture"></div>
        <div class="banner-stripe"></div>
        <div class="banner-inner">

            <div class="banner-toprow">
                <div class="disease-block" style="flex:1; min-width:0;">
                    <div class="pill-row">
                        <span class="pill pill-detected">
                            <svg width="9" height="9" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ ($riwayat->penyakit?->kategori === 'Hama') ? 'Hama Terdeteksi' : 'Penyakit Terdeteksi' }}
                        </span>
                        @if($riwayat->penyakit?->tingkat_bahaya)
                            @php
                                $pc = match($riwayat->penyakit->tingkat_bahaya) {
                                    'Sangat Tinggi' => 'pill-st',
                                    'Tinggi'        => 'pill-t',
                                    'Sedang'        => 'pill-s',
                                    default         => 'pill-r',
                                };
                            @endphp
                            <span class="pill {{ $pc }}">
                                <svg width="9" height="9" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                {{ $riwayat->penyakit->tingkat_bahaya }}
                            </span>
                        @endif
                    </div>
                    <div class="disease-name">{{ $riwayat->penyakit->nama_penyakit ?? 'Tidak Teridentifikasi' }}</div>
                    @if($riwayat->penyakit?->nama_latin)
                        <div class="disease-latin">{{ $riwayat->penyakit->nama_latin }}</div>
                    @endif
                    <a href="{{ route('user.riwayat.pdf', $riwayat->id_diagnosis) }}" target="_blank" class="btn-dl">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh Laporan PDF
                    </a>
                </div>
                <div class="date-meta">
                    <div class="date-big">{{ $riwayat->tanggal->format('d M Y') }}</div>
                    <div class="date-time">{{ $riwayat->tanggal->format('H:i') }} WIB</div>
                    <div class="date-id">{{ $riwayat->id_diagnosis }}</div>
                </div>
            </div>

            <div class="cf-panel" style="margin-top:1.1rem;">
                <div class="cf-header">
                    <span class="cf-label">Certainty Factor</span>
                    <span class="cf-value">{{ round($riwayat->cf_tertinggi * 100, 1) }}<span style="font-size:1.2rem; opacity:.6;">%</span></span>
                </div>
                <div class="cf-track">
                    <div class="cf-fill" style="width:{{ round($riwayat->cf_tertinggi * 100, 1) }}%;"></div>
                </div>
                <div class="cf-ticks"><span>0%</span><span>50%</span><span>100%</span></div>
            </div>

        </div>
    </div>

    {{-- ── Main Grid ── --}}
    <div class="main-grid a2">

        {{-- LEFT: image + actions --}}
        <div class="col-stack">

            @if($riwayat->penyakit?->gambar_url)
                <div class="card" style="overflow:hidden;">
                    <img src="{{ $riwayat->penyakit->gambar_url }}"
                         alt="{{ $riwayat->penyakit->nama_penyakit }}"
                         class="img-card-img"
                         onerror="this.style.display='none';">
                    <div class="img-card-caption">{{ $riwayat->penyakit->nama_penyakit }}</div>
                </div>
            @endif

            {{-- Actions --}}
            <div class="card">
                <div class="card-body" style="display:flex; flex-direction:column; gap:.65rem;">
                    <a href="{{ route('user.diagnosa.index') }}" class="btn-primary">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Diagnosa Ulang
                    </a>
                    <a href="{{ route('user.diagnosa.riwayat') }}" class="btn-secondary">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Riwayat
                    </a>
                </div>
            </div>

        </div>

        {{-- RIGHT: detail cards --}}
        <div class="col-stack a3">

            {{-- Deskripsi penyakit --}}
            @if($riwayat->penyakit?->deskripsi_singkat)
                <div class="card">
                    <div class="card-hdr">
                        <div class="card-hdr-icon" style="background:#fef3c7;">
                            <svg width="15" height="15" fill="none" stroke="#b45309" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <span class="card-hdr-title">Tentang {{ ($riwayat->penyakit?->kategori === 'Hama') ? 'Hama' : 'Penyakit' }}</span>
                    </div>
                    <div class="card-body">
                        <div class="desc-box">{{ $riwayat->penyakit->deskripsi_singkat }}</div>

                        @if($riwayat->penyakit?->deskripsi_lengkap)
                            <div style="margin-top:.75rem;">
                                <button onclick="toggleDetail(this)"
                                    style="display:inline-flex;align-items:center;gap:.4rem;font-size:.75rem;font-weight:700;color:#b45309;background:#fef9c3;border:1.5px solid #fde68a;border-radius:8px;padding:.4rem .85rem;cursor:pointer;transition:all .2s;"
                                    onmouseover="this.style.background='#fef08a'" onmouseout="this.style.background='#fef9c3'">
                                    <svg class="detail-icon" width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" style="transition:transform .3s;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                    Lihat Detail
                                </button>
                                <div class="detail-content" style="display:none; margin-top:.65rem;">
                                    <div style="background:#fffbeb;border:1.5px solid #fde68a;border-radius:12px;padding:.9rem 1rem;font-size:.8rem;color:#78350f;line-height:1.7;">
                                        {{ $riwayat->penyakit->deskripsi_lengkap }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Pengendalian --}}
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
                @php
                    $kategoriList = collect($riwayat->hasil_diagnosa)
                        ->map(fn($h) => \App\Models\MasterPenyakit::find($h['id_penyakit'])?->kategori)
                        ->filter()
                        ->unique()
                        ->values();
                    $labelKemung = $kategoriList->count() > 1
                        ? 'Semua Kemungkinan Hama & Penyakit'
                        : 'Semua Kemungkinan ' . ($kategoriList->first() ?? 'Penyakit');
                @endphp
                <div class="card">
                    <div class="card-hdr">
                        <div class="card-hdr-icon" style="background:#ede9fe;">
                            <svg width="15" height="15" fill="none" stroke="#7c3aed" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="card-hdr-title">{{ $labelKemung }}</span>
                    </div>
                    <div class="card-body">
                        <div class="kemung-list">
                            @foreach($riwayat->hasil_diagnosa as $i => $hasil)
                                @php $penyakitItem = \App\Models\MasterPenyakit::find($hasil['id_penyakit']); @endphp
                                <div class="kemung-item {{ $i === 0 ? 'top' : 'rest' }}">
                                    <span class="rank-num {{ $i === 0 ? 'r1' : 'ro' }}">{{ $i + 1 }}</span>
                                    <div style="flex:1; min-width:0;">
                                        <span class="kemung-name {{ $i === 0 ? 'top' : '' }}">{{ $hasil['nama_penyakit'] }}</span>
                                        @if($penyakitItem?->nama_latin)
                                            <div style="font-size:.7rem; color:#9ca3af; font-style:italic; margin-top:.1rem;">{{ $penyakitItem->nama_latin }}</div>
                                        @endif
                                    </div>
                                    <div class="bar-wrap">
                                        <div class="bar-fill-k" style="width:{{ $hasil['persentase'] }}%; background:{{ $i===0 ? '#16a34a' : '#d1d5db' }};"></div>
                                    </div>
                                    <span class="kemung-pct" style="color:{{ $i===0?'#16a34a':'#9ca3af' }};">{{ $hasil['persentase'] }}%</span>
                                </div>
                            @endforeach
                        </div>
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
                    <div class="relasi-outer">
                        <table class="relasi-table">
                            <thead>
                                <tr>
                                    <th style="padding-left:1.35rem;">Gejala</th>
                                    @foreach($riwayat->hasil_diagnosa as $hasil)
                                        <th>{{ $hasil['nama_penyakit'] }}<br><span style="color:var(--leaf-mid);text-transform:none;letter-spacing:0;font-weight:700;">{{ $hasil['persentase'] }}%</span></th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gejalaInput as $gejala)
                                    <tr>
                                        <td style="padding-left:1.35rem;font-weight:500;">{{ $gejala->nama_gejala }}</td>
                                        @foreach($riwayat->hasil_diagnosa as $hasil)
                                            <td>
                                                @if(isset($relasiGejala[$hasil['id_penyakit']]) && $relasiGejala[$hasil['id_penyakit']]->contains('id_gejala', $gejala->id_gejala))
                                                    <span class="chk-yes">
                                                        <svg width="11" height="11" fill="none" stroke="var(--leaf)" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    </span>
                                                @else
                                                    <span class="chk-no">
                                                        <svg width="10" height="10" fill="none" stroke="var(--fog)" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                                    </span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="relasi-legend">&#x2713; gejala terkait &nbsp;&middot;&nbsp; &#x2717; tidak terkait</p>
                    </div>
                </div>
            @endif

        </div>
    </div>

</div>

<script>
    function toggleDetail(btn) {
        const content = btn.nextElementSibling;
        const icon    = btn.querySelector('.detail-icon');
        const isOpen  = content.style.display !== 'none';

        if (isOpen) {
            content.style.display = 'none';
            icon.style.transform  = 'rotate(0deg)';
            btn.innerHTML = btn.innerHTML.replace('Sembunyikan', 'Lihat Detail');
        } else {
            content.style.display = 'block';
            icon.style.transform  = 'rotate(180deg)';
            btn.innerHTML = btn.innerHTML.replace('Lihat Detail', 'Sembunyikan');
        }
    }
</script>
@endsection