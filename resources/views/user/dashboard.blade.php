@extends('layouts.user-app')

@section('page-title', 'Dashboard')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
    :root {
        --green-deep:   #1a4d2e;
        --green-mid:    #2d7a4f;
        --green-bright: #4ade80;
        --green-light:  #bbf7d0;
        --bg-base:      #f0f5f1;
        --bg-card:      #ffffff;
        --text-primary: #0f1f14;
        --text-muted:   #6b7f72;
        --shadow-card:  0 4px 24px rgba(29,77,46,0.08), 0 1px 4px rgba(29,77,46,0.05);
    }

    body, .dashboard-root {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg-base);
    }

    /* ── Animations ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .anim { animation: fadeUp .6s cubic-bezier(.22,1,.36,1) both; }
    .anim-1 { animation-delay: .04s; }
    .anim-2 { animation-delay: .13s; }
    .anim-3 { animation-delay: .22s; }
    .anim-4 { animation-delay: .31s; }

    /* ── Welcome Banner ── */
    .banner {
        position: relative;
        background: linear-gradient(130deg, #1a4d2e 0%, #2d7a4f 60%, #38a169 100%);
        border-radius: 24px;
        padding: 2rem 2.25rem 1.9rem;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(26,77,46,.32);
        color: #fff;
    }
    /* subtle grid texture */
    .banner::before {
        content: '';
        position: absolute; inset: 0;
        background-image: linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
        background-size: 32px 32px;
        pointer-events: none;
    }
    /* glow orb */
    .banner::after {
        content: '';
        position: absolute;
        top: -80px; right: -60px;
        width: 280px; height: 280px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(74,222,128,.20) 0%, transparent 70%);
        pointer-events: none;
    }
    .banner-inner { position: relative; z-index: 1; }
    .banner-clock {
        font-family: 'DM Mono', monospace;
        font-size: .7rem;
        letter-spacing: .06em;
        color: rgba(255,255,255,.5);
        margin-bottom: .6rem;
    }
    .banner-title {
        font-size: 1.75rem;
        font-weight: 800;
        letter-spacing: -.03em;
        line-height: 1.15;
    }
    .banner-sub {
        font-size: .82rem;
        color: #a7f3d0;
        margin-top: .4rem;
        font-weight: 500;
        line-height: 1.5;
    }
    .banner-actions { display: flex; gap: .75rem; margin-top: 1.4rem; flex-wrap: wrap; }
    .btn-white {
        display: inline-flex; align-items: center; gap: .45rem;
        padding: .6rem 1.3rem;
        background: #fff;
        color: var(--green-deep);
        font-weight: 700; font-size: .8rem;
        border-radius: 50px;
        text-decoration: none;
        transition: all .2s;
        box-shadow: 0 2px 10px rgba(0,0,0,.14);
    }
    .btn-white:hover { background: #dcfce7; transform: translateY(-2px); }
    .btn-ghost {
        display: inline-flex; align-items: center; gap: .45rem;
        padding: .6rem 1.3rem;
        background: rgba(255,255,255,.13);
        border: 1.5px solid rgba(255,255,255,.28);
        color: #fff;
        font-weight: 700; font-size: .8rem;
        border-radius: 50px;
        text-decoration: none;
        transition: all .2s;
    }
    .btn-ghost:hover { background: rgba(255,255,255,.22); transform: translateY(-2px); }

    /* ── Stat Card ── */
    .stat-card {
        background: var(--bg-card);
        border-radius: 24px;
        padding: 1.75rem 1.75rem 1.5rem;
        box-shadow: var(--shadow-card);
        border: 1.5px solid rgba(29,77,46,.07);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        transition: transform .2s, box-shadow .2s;
        min-width: 195px;
    }
    .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 36px rgba(29,77,46,.14); }
    /* bottom accent line */
    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--green-mid), var(--green-bright));
        border-radius: 0 0 24px 24px;
    }
    .stat-label {
        font-size: .68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .1em;
        color: var(--text-muted);
    }
    .stat-value {
        font-size: 3.2rem;
        font-weight: 800;
        color: var(--text-primary);
        letter-spacing: -.05em;
        line-height: 1;
        margin-top: .55rem;
    }
    .stat-sub {
        font-size: .72rem;
        color: var(--text-muted);
        margin-top: .35rem;
        font-weight: 500;
    }
    .stat-icon-wrap {
        width: 50px; height: 50px;
        border-radius: 14px;
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        display: flex; align-items: center; justify-content: center;
        align-self: flex-end;
        margin-top: 1rem;
        flex-shrink: 0;
    }

    /* ── Chart Cards ── */
    .chart-card {
        background: var(--bg-card);
        border-radius: 24px;
        padding: 1.75rem;
        box-shadow: var(--shadow-card);
        border: 1.5px solid rgba(29,77,46,.07);
        transition: transform .2s, box-shadow .2s;
    }
    .chart-card:hover { transform: translateY(-3px); box-shadow: 0 10px 32px rgba(29,77,46,.12); }
    .chart-heading {
        display: flex; align-items: center; gap: .6rem;
        font-size: .92rem; font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -.01em;
        margin-bottom: 1.25rem;
    }
    .chart-heading-bar {
        width: 4px; height: 18px; border-radius: 4px; flex-shrink: 0;
        background: linear-gradient(180deg, var(--green-mid), var(--green-bright));
    }

    /* ── Layout Grids ── */
    .top-row {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 1.25rem;
        align-items: stretch;
        margin-bottom: 1.25rem;
    }
    .charts-row {
        display: grid;
        grid-template-columns: 3fr 2fr;
        gap: 1.25rem;
    }
    @media (max-width: 767px) {
        .top-row { grid-template-columns: 1fr; }
    }
    @media (max-width: 1023px) {
        .charts-row { grid-template-columns: 1fr; }
    }

    /* ── Empty State ── */
    .empty-state {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        height: 200px; color: var(--text-muted); gap: .75rem;
    }
    .empty-state svg { opacity: .3; }
    .empty-state p { font-size: .82rem; font-weight: 500; }
</style>
@endpush

@section('content')
<div class="dashboard-root">

    <!-- ── Row 1: Banner + Stat Card ── -->
    <div class="top-row anim anim-1">

        <!-- Welcome Banner -->
        <div class="banner">
            <div class="banner-inner">
                <p class="banner-clock" id="realtime-clock"></p>
                <h2 class="banner-title">Halo, {{ Auth::user()->nama }}! 👋</h2>
                <p class="banner-sub">Selamat datang kembali di Cek Kopi.<br>Apa yang ingin kamu lakukan hari ini?</p>
                <div class="banner-actions">
                    <a href="{{ route('user.diagnosa.index') }}" class="btn-white">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Mulai Diagnosa
                    </a>
                    <a href="{{ route('user.artikel.budidaya') }}" class="btn-ghost">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Baca Artikel
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Diagnosa Card -->
        <div class="stat-card anim anim-2">
            <div>
                <p class="stat-label">Total Diagnosa</p>
                <p class="stat-value">{{ $totalDiagnosa }}</p>
                <p class="stat-sub">Sepanjang waktu</p>
            </div>
        </div>

    </div>

    <!-- ── Row 2: Charts side by side ── -->
    <div class="charts-row">

        <!-- Line Chart -->
        <div class="chart-card anim anim-3">
            <div class="chart-heading">
                <div class="chart-heading-bar"></div>
                Aktivitas Diagnosa <span style="color:var(--text-muted);font-weight:500;">(6 Bulan Terakhir)</span>
            </div>
            <div style="height: 240px;">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="chart-card anim anim-4">
            <div class="chart-heading">
                <div class="chart-heading-bar"></div>
                Distribusi Penyakit
            </div>
            @if($statistikPenyakit->count() > 0)
                <div style="height: 240px;">
                    <canvas id="pieChart"></canvas>
                </div>
            @else
                <div class="empty-state">
                    <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <p>Belum ada data diagnosa</p>
                </div>
            @endif
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    /* ── Line Chart ── */
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    const lineGrad = lineCtx.createLinearGradient(0, 0, 0, 240);
    lineGrad.addColorStop(0, 'rgba(45,122,79,.20)');
    lineGrad.addColorStop(1, 'rgba(45,122,79,0)');

    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($chartData, 'bulan')) !!},
            datasets: [{
                label: 'Diagnosa',
                data: {!! json_encode(array_column($chartData, 'total')) !!},
                borderColor: '#2d7a4f',
                backgroundColor: lineGrad,
                borderWidth: 2.5,
                fill: true,
                tension: 0.42,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#2d7a4f',
                pointBorderWidth: 2.5,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1a4d2e',
                    titleFont: { family: 'Plus Jakarta Sans', weight: '700', size: 12 },
                    bodyFont:  { family: 'Plus Jakarta Sans', size: 12 },
                    padding: 12, cornerRadius: 10,
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Plus Jakarta Sans', size: 11 }, color: '#6b7f72' },
                    border: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, font: { family: 'Plus Jakarta Sans', size: 11 }, color: '#6b7f72' },
                    grid: { color: 'rgba(0,0,0,.05)' },
                    border: { display: false }
                }
            }
        }
    });

    /* ── Doughnut Chart ── */
    @if($statistikPenyakit->count() > 0)
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($statistikPenyakit->map(fn($s) => $s->penyakit->nama_penyakit ?? $s->penyakit_final)) !!},
            datasets: [{
                data: {!! json_encode($statistikPenyakit->pluck('total')) !!},
                backgroundColor: ['#2d7a4f', '#4ade80', '#0d9488', '#f0b429', '#f87171'],
                hoverBackgroundColor: ['#1a4d2e', '#22c55e', '#0f766e', '#d97706', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { family: 'Plus Jakarta Sans', size: 11, weight: '600' },
                        color: '#0f1f14',
                        padding: 14,
                        usePointStyle: true,
                        pointStyleWidth: 8,
                    }
                },
                tooltip: {
                    backgroundColor: '#1a4d2e',
                    titleFont: { family: 'Plus Jakarta Sans', weight: '700', size: 12 },
                    bodyFont:  { family: 'Plus Jakarta Sans', size: 12 },
                    padding: 12, cornerRadius: 10,
                }
            }
        }
    });
    @endif

    /* ── Real-time clock ── */
    function updateClock() {
        const now = new Date();
        const opts = { weekday:'long', year:'numeric', month:'long', day:'numeric', hour:'2-digit', minute:'2-digit', second:'2-digit' };
        document.getElementById('realtime-clock').textContent = now.toLocaleDateString('id-ID', opts);
    }
    updateClock();
    setInterval(updateClock, 1000);
</script>
@endpush