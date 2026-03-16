@extends('layouts.user-app')

@section('page-title', 'Artikel Hama & Penyakit')
@section('page-subtitle', 'Informasi seputar hama dan penyakit tanaman kopi')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');

    .hp-page { font-family: 'DM Sans', sans-serif; }

    /* ── Tab Switcher ── */
    .tab-wrap {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,.07);
        padding: 8px;
        display: flex;
        gap: 8px;
        margin-bottom: 28px;
    }

    .tab-btn {
        flex: 1;
        padding: 13px 20px;
        border-radius: 14px;
        border: none;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 13.5px;
        cursor: pointer;
        transition: background .22s, color .22s, box-shadow .22s, transform .15s;
        color: #6b7280;
        background: transparent;
    }

    .tab-btn:hover:not(.active-tab) {
        background: #f9fafb;
        color: #374151;
    }

    /* Hama active */
    #tab-hama.active-tab {
        background: linear-gradient(135deg, #f97316, #ea580c);
        color: #fff;
        box-shadow: 0 6px 20px rgba(234,88,12,.28);
        transform: translateY(-1px);
    }

    /* Penyakit active */
    #tab-penyakit.active-tab {
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        color: #fff;
        box-shadow: 0 6px 20px rgba(185,28,28,.28);
        transform: translateY(-1px);
    }

    /* ── Grid ── */
    .artikel-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }

    @media (min-width: 768px)  { .artikel-grid { grid-template-columns: repeat(2,1fr); } }
    @media (min-width: 1024px) { .artikel-grid { grid-template-columns: repeat(3,1fr); } }

    /* ── Card ── */
    .artikel-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,.07);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        border: 1.5px solid #f5f5f5;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s;
    }

    .artikel-card.hama:hover  { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(234,88,12,.13);  border-color: #fed7aa; }
    .artikel-card.penyakit:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(185,28,28,.13); border-color: #fecaca; }

    /* Image */
    .card-img-wrap {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .45s ease;
    }

    .artikel-card:hover .card-img-wrap img { transform: scale(1.07); }

    .card-img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(20,10,0,.45) 0%, transparent 55%);
    }

    .card-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-placeholder span {
        font-size: 4rem;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,.15));
    }

    /* Badge */
    .card-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
        backdrop-filter: blur(6px);
    }

    .badge-hama    { background: rgba(234,88,12,.85);  color: #fff; }
    .badge-penyakit { background: rgba(185,28,28,.85); color: #fff; }

    /* Body */
    .card-body {
        padding: 18px 20px 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Tags */
    .card-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 11px; }

    .card-tag {
        padding: 3px 10px;
        border-radius: 100px;
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .3px;
        border: 1px solid;
    }

    .tag-hama    { background: #fff7ed; color: #c2410c; border-color: #fdba74; }
    .tag-penyakit { background: #fef2f2; color: #b91c1c; border-color: #fca5a5; }

    /* Title */
    .card-title {
        font-family: 'Lora', serif;
        font-weight: 700;
        font-size: .98rem;
        line-height: 1.4;
        margin-bottom: 9px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color .2s;
    }

    .card-title.hama    { color: #1c0a00; }
    .card-title.penyakit { color: #1c0000; }
    .artikel-card.hama:hover    .card-title { color: #c2410c; }
    .artikel-card.penyakit:hover .card-title { color: #b91c1c; }

    /* Excerpt */
    .card-excerpt {
        font-size: 12.5px;
        color: #6b7280;
        line-height: 1.75;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
        margin-bottom: 14px;
    }

    /* Footer */
    .card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 12px;
        border-top: 1px solid #f5f5f5;
        margin-top: auto;
    }

    .card-date { font-size: 11.5px; color: #9ca3af; }

    .card-cta {
        font-size: 12px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 100px;
        transition: background .2s, color .2s;
    }

    .cta-hama    { color: #c2410c; background: #fff7ed; }
    .cta-penyakit { color: #b91c1c; background: #fef2f2; }
    .artikel-card.hama:hover    .card-cta { background: #ea580c; color: #fff; }
    .artikel-card.penyakit:hover .card-cta { background: #ef4444; color: #fff; }

    /* ── Empty State ── */
    .empty-state {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,.07);
        padding: 80px 24px;
        text-align: center;
    }

    .empty-state .empty-icon { font-size: 3.5rem; display: block; margin-bottom: 14px; opacity: .5; }

    .empty-state h3 {
        font-family: 'Lora', serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: #374151;
        margin-bottom: 4px;
    }

    .empty-state p { font-size: 13px; color: #9ca3af; }

    /* ── Tab content transition ── */
    .tab-content { animation: fadeIn .25s ease; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush

@section('content')

<div class="hp-page">

    {{-- ── Tab Switcher ── --}}
    <div class="tab-wrap">
        <button onclick="switchTab('hama')" id="tab-hama" class="tab-btn active-tab">
            Hama
            <span style="opacity:.75;font-weight:400;font-size:12px">({{ $hama->count() }})</span>
        </button>
        <button onclick="switchTab('penyakit')" id="tab-penyakit" class="tab-btn">
            Penyakit
            <span style="opacity:.75;font-weight:400;font-size:12px">({{ $penyakit->count() }})</span>
        </button>
    </div>

    {{-- ── Konten Hama ── --}}
    <div id="content-hama" class="tab-content">
        @if($hama->count() > 0)
            <div class="artikel-grid">
                @foreach($hama as $artikel)
                    <a href="{{ route('user.artikel.hama-penyakit.detail', $artikel->slug) }}" class="artikel-card hama">

                        <div class="card-img-wrap" style="background: linear-gradient(135deg,#fdba74,#ea580c)">
                            @if($artikel->gambar_utama)
                                <img src="{{ Storage::url($artikel->gambar_utama) }}" alt="{{ $artikel->judul }}">
                                <div class="card-img-overlay"></div>
                            @else
                                <div class="card-placeholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="rgba(255,255,255,0.6)" viewBox="0 0 16 16">
                                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                    </svg>
                                </div>
                            @endif
                            <span class="card-badge badge-hama">Hama</span>
                        </div>

                        <div class="card-body">
                            @if($artikel->tags)
                                <div class="card-tags">
                                    @foreach(array_slice($artikel->tags, 0, 2) as $tag)
                                        <span class="card-tag tag-hama">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <h3 class="card-title hama">{{ $artikel->judul }}</h3>

                            @if($artikel->deskripsi_singkat)
                                <p class="card-excerpt">{{ $artikel->deskripsi_singkat }}</p>
                            @endif

                            <div class="card-footer">
                                <span class="card-date" style="display:flex;align-items:center;gap:4px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                    </svg>
                                    {{ $artikel->published_at?->format('d M Y') ?? '-' }}
                                </span>
                                <span class="card-cta cta-hama">Baca &rarr;</span>
                            </div>
                        </div>

                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="#9ca3af" viewBox="0 0 16 16" style="margin:0 auto 14px;display:block;opacity:.5">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                </svg>
                <h3>Belum ada artikel hama</h3>
                <p>Artikel akan segera tersedia</p>
            </div>
        @endif
    </div>

    {{-- ── Konten Penyakit ── --}}
    <div id="content-penyakit" class="tab-content hidden">
        @if($penyakit->count() > 0)
            <div class="artikel-grid">
                @foreach($penyakit as $artikel)
                    <a href="{{ route('user.artikel.hama-penyakit.detail', $artikel->slug) }}" class="artikel-card penyakit">

                        <div class="card-img-wrap" style="background: linear-gradient(135deg,#fca5a5,#b91c1c)">
                            @if($artikel->gambar_utama)
                                <img src="{{ Storage::url($artikel->gambar_utama) }}" alt="{{ $artikel->judul }}">
                                <div class="card-img-overlay"></div>
                            @else
                                <div class="card-placeholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="rgba(255,255,255,0.6)" viewBox="0 0 16 16">
                                        <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 7.5a4.002 4.002 0 0 1-3.512 3.96A1 1 0 0 1 7 12.5V14h1a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1h.5V12.5a1 1 0 0 1-.988-.04A4.002 4.002 0 0 1 5 7.5H1.5a.5.5 0 0 1 0-1H5a4 4 0 0 1 6 0h3.5a.5.5 0 0 1 0 1z"/>
                                    </svg>
                                </div>
                            @endif
                            <span class="card-badge badge-penyakit">Penyakit</span>
                        </div>

                        <div class="card-body">
                            @if($artikel->tags)
                                <div class="card-tags">
                                    @foreach(array_slice($artikel->tags, 0, 2) as $tag)
                                        <span class="card-tag tag-penyakit">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <h3 class="card-title penyakit">{{ $artikel->judul }}</h3>

                            @if($artikel->deskripsi_singkat)
                                <p class="card-excerpt">{{ $artikel->deskripsi_singkat }}</p>
                            @endif

                            <div class="card-footer">
                                <span class="card-date" style="display:flex;align-items:center;gap:4px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                    </svg>
                                    {{ $artikel->published_at?->format('d M Y') ?? '-' }}
                                </span>
                                <span class="card-cta cta-penyakit">Baca &rarr;</span>
                            </div>
                        </div>

                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="#9ca3af" viewBox="0 0 16 16" style="margin:0 auto 14px;display:block;opacity:.5">
                    <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 7.5a4.002 4.002 0 0 1-3.512 3.96A1 1 0 0 1 7 12.5V14h1a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1h.5V12.5a1 1 0 0 1-.988-.04A4.002 4.002 0 0 1 5 7.5H1.5a.5.5 0 0 1 0-1H5a4 4 0 0 1 6 0h3.5a.5.5 0 0 1 0 1z"/>
                </svg>
                <h3>Belum ada artikel penyakit</h3>
                <p>Artikel akan segera tersedia</p>
            </div>
        @endif
    </div>

</div>

@endsection

@push('scripts')
<script>
    function switchTab(tab) {
        document.getElementById('content-hama').classList.add('hidden');
        document.getElementById('content-penyakit').classList.add('hidden');
        document.getElementById('tab-hama').classList.remove('active-tab');
        document.getElementById('tab-penyakit').classList.remove('active-tab');

        document.getElementById('content-' + tab).classList.remove('hidden');
        document.getElementById('tab-' + tab).classList.add('active-tab');
    }
</script>
@endpush