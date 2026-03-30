@extends('layouts.user-app')

@section('page-title', 'Artikel Budidaya')
@section('page-subtitle', $artikel->judul)

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');

    .budidaya-wrap {
        font-family: 'DM Sans', sans-serif;
    }

    /* ── Hero Card ── */
    .hero-card {
        border-radius: 24px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 24px rgba(34,80,34,.08);
        position: relative;
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

    .hero-card:hover .hero-img-wrap img {
        transform: scale(1.03);
    }

    .hero-img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15,40,15,.55) 0%, transparent 55%);
    }

    .hero-placeholder {
        width: 100%;
        height: 280px;
        background: linear-gradient(135deg, #a8d5a2 0%, #3a8f4a 60%, #1d5c2a 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-placeholder span {
        font-size: 5rem;
        filter: drop-shadow(0 4px 12px rgba(0,0,0,.2));
    }

    /* ── Tag Pills ── */
    .tag-pill {
        display: inline-flex;
        align-items: center;
        padding: 4px 14px;
        background: #e8f5e9;
        color: #2e7d32;
        border: 1.5px solid #a5d6a7;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .4px;
        text-transform: uppercase;
    }

    /* ── Article Title ── */
    .article-title {
        font-family: 'Lora', serif;
        font-size: 1.65rem;
        font-weight: 700;
        color: #1a2e1a;
        line-height: 1.35;
        letter-spacing: -.3px;
    }

    .article-meta span {
        font-size: 12px;
        color: #8a9e8a;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .article-excerpt {
        background: linear-gradient(135deg, #f1f8f1 0%, #e8f5e9 100%);
        border-left: 4px solid #4caf50;
        border-radius: 0 12px 12px 0;
        padding: 16px 20px;
        color: #3d5c3d;
        font-style: italic;
        font-size: 13.5px;
        line-height: 1.7;
    }

    /* ── Accordion Section ── */
    .section-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(34,80,34,.08);
        overflow: hidden;
    }

    .section-header {
        padding: 22px 28px;
        border-bottom: 1px solid #f0f5f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-header-icon {
        width: 36px;
        height: 36px;
        background: #e8f5e9;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .section-header h3 {
        font-family: 'Lora', serif;
        font-weight: 600;
        font-size: 1rem;
        color: #1a2e1a;
        margin: 0;
    }

    /* Accordion Item */
    .accordion-item {
        border-bottom: 1px solid #f3f7f3;
        transition: background .2s;
    }

    .accordion-item:last-child {
        border-bottom: none;
    }

    .accordion-trigger {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 28px;
        background: none;
        border: none;
        cursor: pointer;
        text-align: left;
        gap: 14px;
        transition: background .2s;
    }

    .accordion-trigger:hover {
        background: #f7fbf7;
    }

    .accordion-trigger:hover .acc-num {
        background: #2e7d32;
        color: #fff;
    }

    .acc-num {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e8f5e9;
        color: #2e7d32;
        font-size: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background .2s, color .2s;
    }

    .acc-title {
        font-weight: 600;
        font-size: 14px;
        color: #1a2e1a;
        flex: 1;
    }

    .acc-arrow {
        width: 20px;
        height: 20px;
        color: #8a9e8a;
        flex-shrink: 0;
        transition: transform .3s ease;
    }

    .accordion-body {
        padding: 0 28px 24px 74px;
        display: none;
    }

    .accordion-body.open {
        display: block;
        animation: fadeSlideIn .25s ease;
    }

    @keyframes fadeSlideIn {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .accordion-body img {
        width: 100%;
        max-height: 260px;
        object-fit: cover;
        border-radius: 14px;
        margin-bottom: 14px;
        box-shadow: 0 4px 16px rgba(0,0,0,.08);
    }

    .accordion-body .konten-text {
        font-size: 13.5px;
        color: #4a5e4a;
        line-height: 1.8;
        white-space: pre-line;
    }

    .acc-empty {
        font-size: 13px;
        color: #9e9e9e;
        font-style: italic;
    }

    /* ── Empty State ── */
    .empty-state {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(34,80,34,.08);
        padding: 64px 24px;
        text-align: center;
        color: #9e9e9e;
    }

    .empty-state .empty-icon {
        font-size: 3.5rem;
        display: block;
        margin-bottom: 12px;
        opacity: .6;
    }

    .empty-state p {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
    }

    /* ── Sidebar ── */
    .sidebar-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(34,80,34,.08);
        padding: 24px;
    }

    .sidebar-card h3 {
        font-family: 'Lora', serif;
        font-size: .95rem;
        font-weight: 600;
        color: #1a2e1a;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
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

    /* TOC */
    .toc-btn {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 10px;
        border-radius: 10px;
        background: none;
        border: none;
        cursor: pointer;
        text-align: left;
        transition: background .2s;
    }

    .toc-btn:hover {
        background: #f1f8f1;
    }

    .toc-num {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #e8f5e9;
        color: #2e7d32;
        font-size: 10px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background .2s, color .2s;
    }

    .toc-btn:hover .toc-num {
        background: #4caf50;
        color: #fff;
    }

    .toc-label {
        font-size: 12.5px;
        color: #4a5e4a;
        line-height: 1.4;
    }

    .toc-btn:hover .toc-label {
        color: #2e7d32;
    }

    /* Info rows */
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f3f7f3;
        font-size: 12.5px;
    }

    .info-row:last-of-type {
        border-bottom: none;
    }

    .info-row .lbl { color: #8a9e8a; }
    .info-row .val { font-weight: 600; color: #1a2e1a; }
    .info-row .val.green { color: #2e7d32; }
    .info-row .val.blue  { color: #1565c0; }

    /* PDF Button */
    .btn-pdf {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        background: linear-gradient(135deg, #e53935, #b71c1c);
        color: #fff;
        font-weight: 600;
        font-size: 13px;
        border-radius: 12px;
        text-decoration: none;
        margin-top: 14px;
        transition: opacity .2s, transform .15s;
        box-shadow: 0 4px 12px rgba(183,28,28,.25);
    }

    .btn-pdf:hover {
        opacity: .9;
        transform: translateY(-1px);
    }

    /* Nav Buttons */
    .btn-nav {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        border: 2px solid #e0ece0;
        color: #3d5c3d;
        font-weight: 600;
        font-size: 13px;
        border-radius: 12px;
        text-decoration: none;
        transition: background .2s, border-color .2s, transform .15s;
        background: #fff;
    }

    .btn-nav:hover {
        background: #f1f8f1;
        border-color: #a5d6a7;
        transform: translateY(-1px);
    }

    /* Sticky sidebar on desktop */
    @media (min-width: 1024px) {
        .sidebar-sticky {
            position: sticky;
            top: 24px;
        }
    }
</style>
@endpush

@section('content')

<div class="budidaya-wrap grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ══════════════════════════════════
         KONTEN UTAMA
    ══════════════════════════════════ --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Header Artikel --}}
        <div class="hero-card">

            {{-- Gambar --}}
            @if($artikel->gambar_utama)
                <div class="hero-img-wrap">
                    <img src="{{ Storage::url($artikel->gambar_utama) }}" alt="{{ $artikel->judul }}">
                    <div class="hero-img-overlay"></div>
                </div>
            @else
                <div class="hero-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="rgba(255,255,255,0.7)" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                    </svg>
                </div>
            @endif

            <div class="p-8">
                {{-- Tags --}}
                @if($artikel->tags)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($artikel->tags as $tag)
                            <span class="tag-pill">{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif

                {{-- Judul --}}
                <h1 class="article-title mb-3">{{ $artikel->judul }}</h1>

                {{-- Meta --}}
                <div class="article-meta flex items-center gap-5 mb-5">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                        </svg>
                        {{ $artikel->published_at?->format('d M Y') ?? '-' }}
                    </span>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                        </svg>
                        {{ $artikel->subBab->count() }} sub-bab
                    </span>
                </div>

                {{-- Deskripsi --}}
                @if($artikel->deskripsi_singkat)
                    <p class="article-excerpt">{{ $artikel->deskripsi_singkat }}</p>
                @endif
            </div>
        </div>

        {{-- Sub-bab Accordion --}}
        @if($artikel->subBab->count() > 0)
            <div class="section-card">

                <div class="section-header">
                    <div class="section-header-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#2e7d32" viewBox="0 0 16 16">
                            <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                        </svg>
                    </div>
                    <h3>Isi Artikel</h3>
                </div>

                <div>
                    @foreach($artikel->subBab as $index => $sub)
                        <div class="accordion-item">

                            {{-- Trigger --}}
                            <button type="button" onclick="toggleAccordion({{ $index }})" class="accordion-trigger">
                                <span class="acc-num">{{ $index + 1 }}</span>
                                <span class="acc-title">{{ $sub->judul_sub }}</span>
                                <svg id="arrow-{{ $index }}" class="acc-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            {{-- Body --}}
                            <div id="accordion-{{ $index }}" class="accordion-body">
                                @if($sub->gambar)
                                    <img src="{{ Storage::url($sub->gambar) }}" alt="{{ $sub->judul_sub }}">
                                @endif
                                @if($sub->konten)
                                    <div class="konten-text">{{ $sub->konten }}</div>
                                @else
                                    <p class="acc-empty">Konten belum tersedia.</p>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#9e9e9e" viewBox="0 0 16 16" style="margin:0 auto 12px;display:block;opacity:.6">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                </svg>
                <p>Belum ada sub-bab</p>
            </div>
        @endif

    </div>

    {{-- ══════════════════════════════════
         SIDEBAR
    ══════════════════════════════════ --}}
    <div class="space-y-5 sidebar-sticky">

        {{-- Info Artikel --}}
        <!-- <div class="sidebar-card">
            <h3>
                <span class="sidebar-icon" style="background:#e3f2fd">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#1565c0" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                </span>
                Info Artikel
            </h3>

            <div class="info-row">
                <span class="lbl">Kategori</span>
                <span class="val green">Budidaya</span>
            </div>
            <div class="info-row">
                <span class="lbl">Tanggal</span>
                <span class="val">{{ $artikel->published_at?->format('d M Y') ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="lbl">Sub-bab</span>
                <span class="val blue">{{ $artikel->subBab->count() }} sub-bab</span>
            </div> -->

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
            <a href="{{ route('user.artikel.budidaya') }}" class="btn-nav">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    function toggleAccordion(index) {
        const content = document.getElementById(`accordion-${index}`);
        const arrow   = document.getElementById(`arrow-${index}`);

        if (content.classList.contains('open')) {
            content.classList.remove('open');
            arrow.style.transform = 'rotate(0deg)';
        } else {
            content.classList.add('open');
            arrow.style.transform = 'rotate(180deg)';
        }
    }

    function bukaAccordion(index) {
        const content = document.getElementById(`accordion-${index}`);
        const arrow   = document.getElementById(`arrow-${index}`);

        content.classList.add('open');
        arrow.style.transform = 'rotate(180deg)';

        // Scroll ke accordion
        content.closest('.accordion-item').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
</script>
@endpush