@extends('layouts.admin-app')

@section('page-title', '📊 Dashboard')
@section('page-subtitle', 'Overview statistik sistem pakar')

@section('content')
<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-green-600 via-green-700 to-green-800 rounded-2xl p-8 mb-6 text-white relative overflow-hidden shadow-xl">
    <div class="absolute right-0 top-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
    <div class="absolute right-10 bottom-0 w-48 h-48 bg-white opacity-5 rounded-full -mb-24"></div>
    <div class="relative z-10">
        <h1 class="text-3xl font-bold mb-2">Selamat Datang Kembali! 👋</h1>
        <p class="text-green-100 text-lg">{{ Auth::user()->nama }}</p>
        <p class="text-green-50 mt-4">{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Total Gejala -->
    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-500 uppercase">Total Gejala</p>
                <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $totalGejala }}</h3>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Penyakit -->
    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-500 uppercase">Total Penyakit</p>
                <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $totalPenyakit }}</h3>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-red-400 to-red-600 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Diagnosa -->
    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-500 uppercase">Total Diagnosa</p>
                <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $totalDiagnosa }}</h3>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Artikel -->
    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-500 uppercase">Total Artikel</p>
                <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $totalArtikel }}</h3>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Penyakit Chart -->
    <div class="bg-white rounded-2xl p-6 shadow-lg">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Penyakit Paling Sering Didiagnosa</h3>
        <div style="height: 300px;">
            <canvas id="penyakitChart"></canvas>
        </div>
    </div>

    <!-- Diagnosa Trend Chart -->
    <div class="bg-white rounded-2xl p-6 shadow-lg">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Trend Diagnosa (6 Bulan Terakhir)</h3>
        <div style="height: 300px;">
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
                backgroundColor: ['rgba(239, 68, 68, 0.8)', 'rgba(249, 115, 22, 0.8)', 'rgba(234, 179, 8, 0.8)', 'rgba(34, 197, 94, 0.8)', 'rgba(59, 130, 246, 0.8)'],
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
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
                borderColor: 'rgb(95, 163, 87)',
                backgroundColor: 'rgba(95, 163, 87, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });
</script>
@endsection