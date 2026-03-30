@extends('layouts.admin-app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview statistik sistem pakar')

@section('content')

<!-- Welcome Banner -->
<div style="background: linear-gradient(135deg, #14532d 0%, #166534 50%, #15803d 100%); border-radius: 1.25rem; padding: 2rem; margin-bottom: 1.5rem; color: white; position: relative; overflow: hidden; box-shadow: 0 10px 25px rgba(21,128,61,0.3);">
    <div style="position:absolute; right:-4rem; top:-4rem; width:12rem; height:12rem; background:rgba(255,255,255,0.05); border-radius:50%;"></div>
    <div style="position:absolute; right:3rem; bottom:-3rem; width:8rem; height:8rem; background:rgba(255,255,255,0.05); border-radius:50%;"></div>
    <div style="position:relative; z-index:1;">
        <p style="font-size:0.8rem; font-weight:600; letter-spacing:0.1em; color:rgba(187,247,208,0.8); text-transform:uppercase; margin-bottom:0.5rem;">
            {{ now()->translatedFormat('l, d F Y') }}
        </p>
        <h1 style="font-size:1.75rem; font-weight:800; margin-bottom:0.25rem;">Selamat Datang Kembali</h1>
        <p style="font-size:1.1rem; color:#bbf7d0; font-weight:500;">{{ Auth::user()->nama }}</p>
    </div>
</div>

<!-- Statistics Cards -->
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1rem; margin-bottom:1.5rem;">

    <!-- Total Gejala -->
    <div style="background:white; border-radius:1.25rem; padding:1.5rem; box-shadow:0 1px 4px rgba(0,0,0,0.07); border:1px solid #f0fdf4; display:flex; align-items:center; justify-content:space-between; gap:1rem;">
        <div>
            <p style="font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Total Gejala</p>
            <h3 style="font-size:2.25rem; font-weight:800; color:#14532d; line-height:1;">{{ $totalGejala }}</h3>
        </div>
        <div style="width:3.25rem; height:3.25rem; background:#dcfce7; border-radius:1rem; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <svg style="width:1.5rem; height:1.5rem; color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
        </div>
    </div>

    <!-- Total Penyakit -->
    <div style="background:white; border-radius:1.25rem; padding:1.5rem; box-shadow:0 1px 4px rgba(0,0,0,0.07); border:1px solid #f0fdf4; display:flex; align-items:center; justify-content:space-between; gap:1rem;">
        <div>
            <p style="font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Total Penyakit</p>
            <h3 style="font-size:2.25rem; font-weight:800; color:#14532d; line-height:1;">{{ $totalPenyakit }}</h3>
        </div>
        <div style="width:3.25rem; height:3.25rem; background:#dcfce7; border-radius:1rem; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <svg style="width:1.5rem; height:1.5rem; color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
    </div>

    <!-- Total Diagnosa -->
    <div style="background:white; border-radius:1.25rem; padding:1.5rem; box-shadow:0 1px 4px rgba(0,0,0,0.07); border:1px solid #f0fdf4; display:flex; align-items:center; justify-content:space-between; gap:1rem;">
        <div>
            <p style="font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Total Diagnosa</p>
            <h3 style="font-size:2.25rem; font-weight:800; color:#14532d; line-height:1;">{{ $totalDiagnosa }}</h3>
        </div>
        <div style="width:3.25rem; height:3.25rem; background:#dcfce7; border-radius:1rem; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <svg style="width:1.5rem; height:1.5rem; color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
    </div>

    <!-- Total Artikel -->
    <div style="background:white; border-radius:1.25rem; padding:1.5rem; box-shadow:0 1px 4px rgba(0,0,0,0.07); border:1px solid #f0fdf4; display:flex; align-items:center; justify-content:space-between; gap:1rem;">
        <div>
            <p style="font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Total Artikel</p>
            <h3 style="font-size:2.25rem; font-weight:800; color:#14532d; line-height:1;">{{ $totalArtikel }}</h3>
        </div>
        <div style="width:3.25rem; height:3.25rem; background:#dcfce7; border-radius:1rem; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <svg style="width:1.5rem; height:1.5rem; color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
        </div>
    </div>

</div>

<!-- Charts Section -->
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:1.5rem;">

    <!-- Penyakit Chart -->
    <div style="background:white; border-radius:1.25rem; padding:1.5rem; box-shadow:0 1px 4px rgba(0,0,0,0.07); border:1px solid #f0fdf4;">
        <div style="margin-bottom:1.25rem;">
            <h3 style="font-size:1rem; font-weight:700; color:#111827; margin-bottom:0.25rem;">Penyakit Paling Sering Didiagnosa</h3>
            <p style="font-size:0.75rem; color:#9ca3af;">Berdasarkan total riwayat diagnosa</p>
        </div>
        <div style="height:280px;">
            <canvas id="penyakitChart"></canvas>
        </div>
    </div>

    <!-- Diagnosa Trend Chart -->
    <div style="background:white; border-radius:1.25rem; padding:1.5rem; box-shadow:0 1px 4px rgba(0,0,0,0.07); border:1px solid #f0fdf4;">
        <div style="margin-bottom:1.25rem;">
            <h3 style="font-size:1rem; font-weight:700; color:#111827; margin-bottom:0.25rem;">Trend Diagnosa</h3>
            <p style="font-size:0.75rem; color:#9ca3af;">6 bulan terakhir</p>
        </div>
        <div style="height:280px;">
            <canvas id="diagnosaChart"></canvas>
        </div>
    </div>

</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Penyakit Bar Chart
    const penyakitData = @json($chartPenyakit);
    const penyakitCtx = document.getElementById('penyakitChart').getContext('2d');
    new Chart(penyakitCtx, {
        type: 'bar',
        data: {
            labels: penyakitData.labels,
            datasets: [{
                label: 'Jumlah Diagnosa',
                data: penyakitData.data,
                backgroundColor: [
                    'rgba(20, 83, 45, 0.85)',
                    'rgba(22, 101, 52, 0.85)',
                    'rgba(21, 128, 61, 0.85)',
                    'rgba(22, 163, 74, 0.85)',
                    'rgba(34, 197, 94, 0.85)',
                ],
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#14532d',
                    titleFont: { weight: '600' },
                    padding: 10,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#6b7280' } },
                y: { grid: { color: '#f3f4f6' }, ticks: { font: { size: 11 }, color: '#6b7280' }, beginAtZero: true }
            }
        }
    });

    // Diagnosa Line Chart
    const diagnosaData = @json($chartDiagnosa);
    const diagnosaCtx = document.getElementById('diagnosaChart').getContext('2d');
    new Chart(diagnosaCtx, {
        type: 'line',
        data: {
            labels: diagnosaData.labels,
            datasets: [{
                label: 'Jumlah Diagnosa',
                data: diagnosaData.data,
                borderColor: '#16a34a',
                backgroundColor: 'rgba(22, 163, 74, 0.08)',
                borderWidth: 2.5,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#16a34a',
                pointBorderColor: 'white',
                pointBorderWidth: 2,
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
                    backgroundColor: '#14532d',
                    titleFont: { weight: '600' },
                    padding: 10,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#6b7280' } },
                y: { grid: { color: '#f3f4f6' }, ticks: { font: { size: 11 }, color: '#6b7280' }, beginAtZero: true }
            }
        }
    });
</script>

@endsection