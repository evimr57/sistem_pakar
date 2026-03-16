@extends('layouts.user-app')

@section('page-title', 'Artikel Budidaya')
@section('page-subtitle', 'Informasi seputar budidaya tanaman kopi')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');

    .budidaya-page {
        font-family: 'DM Sans', sans-serif;
    }

    /* ── Search Bar ── */
    .search-wrap {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(34,80,34,.08);
        padding: 20px 24px;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .search-inner {
        flex: 1;
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9eb89e;
        display: flex;
        align-items: center;
        pointer-events: none;
    }

    .search-input {
        width: 100%;
        padding: 12px 16px 12px 44px;
        border: 1.5px solid #e0ece0;
        border-radius: 12px;
        font-size: 13.5px;
        font-family: 'DM Sans', sans-serif;
        color: #1a2e1a;
        background: #f7fbf7;
        transition: border-color .2s, box-shadow .2s;
        outline: none;
    }

    .search-input:focus {
        border-color: #4caf50;
        box-shadow: 0 0 0 3px rgba(76,175,80,.12);
        background: #fff;
    }

    .search-input::placeholder { color: #9eb89e; }

    .search-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        border: 1.5px solid #a5d6a7;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 600;
        color: #2e7d32;
        white-space: nowrap;
    }

    /* ── Grid ── */
    .artikel-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 24px;
    }

    @media (min-width: 768px) {
        .artikel-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (min-width: 1024px) {
        .artikel-grid { grid-template-columns: repeat(3, 1fr); }
    }

    /* ── Card ── */
    .artikel-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(34,80,34,.07);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        transition: transform .25s ease, box-shadow .25s ease;
        border: 1.5px solid #f0f7f0;
    }

    .artikel-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(34,80,34,.14);
        border-color: #c8e6c9;
    }

    /* Image */
    .card-img-wrap {
        height: 200px;
        overflow: hidden;
        position: relative;
        background: linear-gradient(135deg, #a8d5a2, #2e7d32);
    }

    .card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .45s ease;
    }

    .artikel-card:hover .card-img-wrap img {
        transform: scale(1.07);
    }

    .card-img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15,40,15,.45) 0%, transparent 55%);
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

    /* Body */
    .card-body {
        padding: 20px 22px 22px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Tags */
    .card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 12px;
    }

    .card-tag {
        padding: 3px 10px;
        background: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
        border-radius: 100px;
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    /* Title */
    .card-title {
        font-family: 'Lora', serif;
        font-weight: 700;
        font-size: 1rem;
        color: #1a2e1a;
        line-height: 1.4;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color .2s;
    }

    .artikel-card:hover .card-title {
        color: #2e7d32;
    }

    /* Excerpt */
    .card-excerpt {
        font-size: 12.5px;
        color: #6a826a;
        line-height: 1.75;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
        margin-bottom: 16px;
    }

    /* Footer */
    .card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 14px;
        border-top: 1px solid #f0f7f0;
        margin-top: auto;
    }

    .card-date {
        font-size: 11.5px;
        color: #9eb89e;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .card-cta {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 700;
        color: #2e7d32;
        padding: 6px 14px;
        background: #e8f5e9;
        border-radius: 100px;
        transition: background .2s, color .2s;
    }

    .artikel-card:hover .card-cta {
        background: #2e7d32;
        color: #fff;
    }

    /* ── Empty State ── */
    .empty-state {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(34,80,34,.08);
        padding: 80px 24px;
        text-align: center;
    }

    .empty-state .empty-icon {
        font-size: 4rem;
        display: block;
        margin-bottom: 16px;
        opacity: .5;
    }

    .empty-state h3 {
        font-family: 'Lora', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #1a2e1a;
        margin-bottom: 6px;
    }

    .empty-state p {
        font-size: 13px;
        color: #9eb89e;
    }

    /* ── Pagination ── */
    .pagination-wrap {
        margin-top: 36px;
        display: flex;
        justify-content: center;
    }

    /* ── No result (search) ── */
    .no-result-msg {
        display: none;
        text-align: center;
        padding: 48px 24px;
        color: #9eb89e;
        font-size: 14px;
    }

    .no-result-msg .nr-icon {
        font-size: 3rem;
        display: block;
        margin-bottom: 10px;
        opacity: .5;
    }
</style>
@endpush

@section('content')

<div class="budidaya-page">

    {{-- ── Search Bar ── --}}
    <div class="search-wrap">
        <div class="search-inner">
            <span class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.099zm-5.242 1.656a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11"/>
                </svg>
            </span>
            <input
                type="text"
                id="search-artikel"
                class="search-input"
                placeholder="Cari artikel budidaya...">
        </div>
        <div class="search-badge">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
            </svg>
            {{ $artikels->total() }} Artikel
        </div>
    </div>

    {{-- ── Grid Artikel ── --}}
    @if($artikels->count() > 0)

        <div class="artikel-grid" id="artikel-grid">
            @foreach($artikels as $artikel)
                <a href="{{ route('user.artikel.budidaya.detail', $artikel->slug) }}" class="artikel-card">

                    {{-- Gambar --}}
                    <div class="card-img-wrap">
                        @if($artikel->gambar_utama)
                            <img src="{{ Storage::url($artikel->gambar_utama) }}" alt="{{ $artikel->judul }}">
                            <div class="card-img-overlay"></div>
                        @else
                            <div class="card-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="rgba(255,255,255,0.6)" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="card-body">

                        {{-- Tags --}}
                        @if($artikel->tags)
                            <div class="card-tags">
                                @foreach(array_slice($artikel->tags, 0, 2) as $tag)
                                    <span class="card-tag">{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Judul --}}
                        <h3 class="card-title">{{ $artikel->judul }}</h3>

                        {{-- Excerpt --}}
                        @if($artikel->deskripsi_singkat)
                            <p class="card-excerpt">{{ $artikel->deskripsi_singkat }}</p>
                        @endif

                        {{-- Footer --}}
                        <div class="card-footer">
                            <span class="card-date">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                </svg>
                                {{ $artikel->published_at?->format('d M Y') ?? '-' }}
                            </span>
                            <span class="card-cta">Baca &rarr;</span>
                        </div>

                    </div>
                </a>
            @endforeach
        </div>

        {{-- No result pesan --}}
        <div id="no-result" class="no-result-msg">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#9eb89e" viewBox="0 0 16 16" style="margin:0 auto 10px;display:block;opacity:.5">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.099zm-5.242 1.656a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11"/>
            </svg>
            Artikel tidak ditemukan
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrap">
            {{ $artikels->links() }}
        </div>

    @else
        <div class="empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="#9eb89e" viewBox="0 0 16 16" style="margin:0 auto 16px;display:block;opacity:.5">
                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
            </svg>
            <h3>Belum ada artikel budidaya</h3>
            <p>Artikel akan segera tersedia</p>
        </div>
    @endif

</div>

@endsection

@push('scripts')
<script>
    document.getElementById('search-artikel').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        const cards   = document.querySelectorAll('.artikel-card');
        let visible   = 0;

        cards.forEach(card => {
            const judul = card.querySelector('.card-title').textContent.toLowerCase();
            const show  = judul.includes(keyword);
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        const noResult = document.getElementById('no-result');
        if (noResult) noResult.style.display = visible === 0 ? 'block' : 'none';
    });
</script>
@endpush