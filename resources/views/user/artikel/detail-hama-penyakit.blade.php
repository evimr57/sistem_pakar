@extends('layouts.user-app')

@section('page-title', 'Artikel Hama & Penyakit')
@section('page-subtitle', $artikel->judul)

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');

    .detail-hp { font-family: 'DM Sans', sans-serif; }

    /* ── Hero Card ── */
    .hero-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .hero-img-wrap {
        position: relative;
        height: 320px;
        overflow: hidden;
    }

    .hero-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .6s ease;
    }

    .hero-card:hover .hero-img-wrap img { transform: scale(1.03); }

    .hero-img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(20,5,0,.5) 0%, transparent 55%);
    }

    .hero-placeholder {
        width: 100%;
        height: 280px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-placeholder span {
        font-size: 5rem;
        filter: drop-shadow(0 4px 12px rgba(0,0,0,.2));
    }

    /* ── Badges & Tags ── */
    .jenis-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 14px;
        border-radius: 100px;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .badge-hama    { background: #fff7ed; color: #c2410c; border: 1.5px solid #fdba74; }
    .badge-penyakit { background: #fef2f2; color: #b91c1c; border: 1.5px solid #fca5a5; }

    .tag-pill {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 600;
        background: #f3f4f6;
        color: #374151;
        border: 1.5px solid #e5e7eb;
    }

    /* ── Article Title ── */
    .article-title {
        font-family: 'Lora', serif;
        font-size: 1.65rem;
        font-weight: 700;
        color: #1a0a00;
        line-height: 1.35;
        letter-spacing: -.3px;
    }

    .article-meta span {
        font-size: 12px;
        color: #9ca3af;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* Excerpt */
    .article-excerpt {
        border-radius: 0 12px 12px 0;
        padding: 16px 20px;
        font-style: italic;
        font-size: 13.5px;
        line-height: 1.75;
        border-left: 4px solid;
    }

    .excerpt-hama    { background: linear-gradient(135deg,#fff7ed,#ffedd5); border-color: #f97316; color: #7c2d12; }
    .excerpt-penyakit { background: linear-gradient(135deg,#fef2f2,#fee2e2); border-color: #ef4444; color: #7f1d1d; }

    /* Main content */
    .konten-text {
        font-size: 14px;
        color: #374151;
        line-height: 1.85;
    }

    /* ── Info Teknis Grid ── */
    .teknis-section {
        border-top: 1px solid #f3f4f6;
        padding-top: 28px;
        margin-top: 8px;
    }

    .teknis-title {
        font-family: 'Lora', serif;
        font-weight: 600;
        font-size: 1rem;
        color: #1a0a00;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }

    .teknis-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .teknis-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 14px;
    }

    @media (min-width: 768px) { .teknis-grid { grid-template-columns: repeat(2,1fr); } }

    .teknis-card {
        border-radius: 14px;
        padding: 16px 18px;
        border: 1.5px solid;
    }

    .teknis-card h4 {
        font-weight: 700;
        font-size: 12.5px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .teknis-card p {
        font-size: 12.5px;
        line-height: 1.7;
    }

    .tc-yellow { background: #fefce8; border-color: #fde68a; }
    .tc-yellow h4 { color: #92400e; }
    .tc-yellow p  { color: #78350f; }

    .tc-blue { background: #eff6ff; border-color: #bfdbfe; }
    .tc-blue h4 { color: #1e40af; }
    .tc-blue p  { color: #1e3a8a; }

    .tc-green { background: #f0fdf4; border-color: #bbf7d0; }
    .tc-green h4 { color: #15803d; }
    .tc-green p  { color: #14532d; }

    .tc-red { background: #fef2f2; border-color: #fecaca; }
    .tc-red h4 { color: #b91c1c; }
    .tc-red p  { color: #7f1d1d; }

    /* ── Galeri ── */
    .galeri-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(0,0,0,.07);
        padding: 24px 28px;
    }

    .galeri-title {
        font-family: 'Lora', serif;
        font-weight: 600;
        font-size: 1rem;
        color: #1a0a00;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }

    .galeri-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    @media (min-width: 768px) { .galeri-grid { grid-template-columns: repeat(3, 1fr); } }

    .galeri-grid img {
        width: 100%;
        height: 130px;
        object-fit: cover;
        border-radius: 12px;
        transition: transform .3s ease, opacity .2s;
        box-shadow: 0 2px 10px rgba(0,0,0,.07);
    }

    .galeri-grid img:hover { transform: scale(1.03); opacity: .9; }

    /* ── Section Card (generic) ── */
    .section-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(0,0,0,.07);
        padding: 24px 28px;
    }

    /* ── Sidebar ── */
    .sidebar-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,.07);
        padding: 22px;
    }

    .sidebar-card h3 {
        font-family: 'Lora', serif;
        font-size: .95rem;
        font-weight: 600;
        color: #1a0a00;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
    }

    .sidebar-icon {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f3f4f6;
        font-size: 12.5px;
    }

    .info-row:last-of-type { border-bottom: none; }
    .info-row .lbl { color: #9ca3af; }
    .info-row .val { font-weight: 600; color: #111827; }
    .val-hama    { color: #c2410c !important; }
    .val-penyakit { color: #b91c1c !important; }

    .btn-pdf {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        background: linear-gradient(135deg,#e53935,#b71c1c);
        color: #fff;
        font-weight: 600;
        font-size: 13px;
        border-radius: 12px;
        text-decoration: none;
        margin-top: 14px;
        transition: opacity .2s, transform .15s;
        box-shadow: 0 4px 12px rgba(183,28,28,.25);
    }

    .btn-pdf:hover { opacity: .9; transform: translateY(-1px); }

    .btn-nav {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        border: 2px solid #e5e7eb;
        color: #374151;
        font-weight: 600;
        font-size: 13px;
        border-radius: 12px;
        text-decoration: none;
        background: #fff;
        transition: background .2s, border-color .2s, transform .15s;
    }

    .btn-nav:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        transform: translateY(-1px);
    }

    @media (min-width: 1024px) { .sidebar-sticky { position: sticky; top: 24px; } }
</style>
@endpush

@section('content')

<div class="detail-hp grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ══════════════════════════════
         KONTEN UTAMA
    ══════════════════════════════ --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Hero --}}
        <div class="hero-card">

            @if($artikel->gambar_utama)
                <div class="hero-img-wrap">
                    <img src="{{ Storage::url($artikel->gambar_utama) }}" alt="{{ $artikel->judul }}">
                    <div class="hero-img-overlay"></div>
                </div>
            @else
                <div class="hero-placeholder {{ $artikel->jenis === 'Hama' ? 'bg-gradient-to-br from-orange-300 to-orange-600' : 'bg-gradient-to-br from-red-300 to-red-700' }}">
                    @if($artikel->jenis === 'Hama')
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="rgba(255,255,255,0.7)" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="rgba(255,255,255,0.7)" viewBox="0 0 16 16">
                            <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 7.5a4.002 4.002 0 0 1-3.512 3.96A1 1 0 0 1 7 12.5V14h1a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1h.5V12.5a1 1 0 0 1-.988-.04A4.002 4.002 0 0 1 5 7.5H1.5a.5.5 0 0 1 0-1H5a4 4 0 0 1 6 0h3.5a.5.5 0 0 1 0 1z"/>
                        </svg>
                    @endif
                </div>
            @endif

            <div class="p-8">

                {{-- Badge jenis + tags --}}
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="jenis-badge {{ $artikel->jenis === 'Hama' ? 'badge-hama' : 'badge-penyakit' }}">
                        @if($artikel->jenis === 'Hama')
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 7.5a4.002 4.002 0 0 1-3.512 3.96A1 1 0 0 1 7 12.5V14h1a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1h.5V12.5a1 1 0 0 1-.988-.04A4.002 4.002 0 0 1 5 7.5H1.5a.5.5 0 0 1 0-1H5a4 4 0 0 1 6 0h3.5a.5.5 0 0 1 0 1z"/>
                            </svg>
                        @endif
                        {{ $artikel->jenis }}
                    </span>
                    @if($artikel->tags)
                        @foreach($artikel->tags as $tag)
                            <span class="tag-pill">{{ $tag }}</span>
                        @endforeach
                    @endif
                </div>

                {{-- Judul --}}
                <h1 class="article-title mb-3">{{ $artikel->judul }}</h1>

                {{-- Meta --}}
                <div class="flex items-center gap-5 mb-6 pb-6 border-b border-gray-100">
                    <span class="article-meta">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                        </svg>
                        {{ $artikel->published_at?->format('d M Y') ?? '-' }}
                    </span>
                </div>

                {{-- Excerpt --}}
                @if($artikel->deskripsi_singkat)
                    <p class="article-excerpt mb-6 {{ $artikel->jenis === 'Hama' ? 'excerpt-hama' : 'excerpt-penyakit' }}">
                        {{ $artikel->deskripsi_singkat }}
                    </p>
                @endif

                {{-- Konten utama --}}
                <div class="konten-text mb-6">
                    {!! nl2br(e($artikel->konten)) !!}
                </div>

                {{-- Info Teknis --}}
                @if($artikel->gejala_visual || $artikel->cara_identifikasi || $artikel->pencegahan || $artikel->pengendalian)
                    <div class="teknis-section">
                        <h3 class="teknis-title">
                            <span class="teknis-icon" style="background:#fef2f2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#b91c1c" viewBox="0 0 16 16">
                                    <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                </svg>
                            </span>
                            Informasi Teknis
                        </h3>
                        <div class="teknis-grid">
                            @if($artikel->gejala_visual)
                                <div class="teknis-card tc-yellow">
                                    <h4>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                        Gejala Visual
                                    </h4>
                                    <p>{{ $artikel->gejala_visual }}</p>
                                </div>
                            @endif
                            @if($artikel->cara_identifikasi)
                                <div class="teknis-card tc-blue">
                                    <h4>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.099zm-5.242 1.656a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11"/>
                                        </svg>
                                        Cara Identifikasi
                                    </h4>
                                    <p>{{ $artikel->cara_identifikasi }}</p>
                                </div>
                            @endif
                            @if($artikel->pencegahan)
                                <div class="teknis-card tc-green">
                                    <h4>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/>
                                        </svg>
                                        Pencegahan
                                    </h4>
                                    <p>{{ $artikel->pencegahan }}</p>
                                </div>
                            @endif
                            @if($artikel->pengendalian)
                                <div class="teknis-card tc-red">
                                    <h4>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                        </svg>
                                        Pengendalian
                                    </h4>
                                    <p>{{ $artikel->pengendalian }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>

        {{-- Galeri --}}
        @if($artikel->galeri_gambar && count($artikel->galeri_gambar) > 0)
            <div class="galeri-card">
                <h3 class="galeri-title">
                    <span class="teknis-icon" style="background:#f3f4f6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#374151" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                    </span>
                    Galeri Foto
                </h3>
                <div class="galeri-grid">
                    @foreach($artikel->galeri_gambar as $foto)
                        <img src="{{ Storage::url($foto) }}" alt="Galeri">
                    @endforeach
                </div>
            </div>
        @endif

    </div>

    {{-- ══════════════════════════════
         SIDEBAR
    ══════════════════════════════ --}}
    <div class="space-y-5 sidebar-sticky">

        {{-- Info Artikel --}}
        <div class="sidebar-card">
            <h3>
                <span class="sidebar-icon" style="background:#eff6ff">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#1565c0" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                </span>
                Info Artikel
            </h3>

            <div class="info-row">
                <span class="lbl">Jenis</span>
                <span class="val {{ $artikel->jenis === 'Hama' ? 'val-hama' : 'val-penyakit' }}">{{ $artikel->jenis }}</span>
            </div>
            <div class="info-row">
                <span class="lbl">Tanggal</span>
                <span class="val">{{ $artikel->published_at?->format('d M Y') ?? '-' }}</span>
            </div>

            @if($artikel->file_pdf)
                <a href="{{ Storage::url($artikel->file_pdf) }}" target="_blank" class="btn-pdf">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                        <path d="M4.603 14.087a.8.8 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.7 7.7 0 0 1 1.482-.645 20 20 0 0 0 1.062-2.227 7.3 7.3 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a11 11 0 0 0 .98 1.686 5.8 5.8 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.86.86 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.7 5.7 0 0 1-.911-.95 11.7 11.7 0 0 0-1.997.406 11.3 11.3 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.8.8 0 0 1-.58.029"/>
                    </svg>
                    Download PDF
                </a>
            @endif
        </div>

        {{-- Navigasi --}}
        <div class="sidebar-card space-y-3">
            <a href="{{ route('user.artikel.hama-penyakit') }}" class="btn-nav">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

    </div>

</div>

@endsection