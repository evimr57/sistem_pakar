@extends('layouts.user-app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang di Coffee Expert System')

@section('content')

    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-green-600 to-green-400 rounded-2xl p-6 mb-8 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-1">Halo, {{ Auth::user()->nama }}!</h2>
                <p class="text-green-100 text-sm">Selamat datang kembali di sistem pakar kopi. Apa yang ingin kamu lakukan hari ini?</p>
                <p id="realtime-clock" class="text-green-200 text-xs mt-2 font-medium"></p>
            </div>
            <div class="hidden md:block">
                <svg class="w-20 h-20 text-green-200 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
        </div>
        <div class="flex space-x-3 mt-4">
            <a href="{{ route('user.diagnosa.index') }}" class="px-4 py-2 bg-white text-green-700 font-bold rounded-xl text-sm hover:bg-green-50 transition shadow">
                Mulai Diagnosa
            </a>
            <a href="{{ route('user.artikel.budidaya') }}" class="px-4 py-2 bg-green-700 text-white font-bold rounded-xl text-sm hover:bg-green-800 transition">
                Baca Artikel
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Diagnosa -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Diagnosa</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalDiagnosa }}</p>
                    <p class="text-xs text-gray-400 mt-1">Sepanjang waktu</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Diagnosa Bulan Ini -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Diagnosa Bulan Ini</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $diagnosabulanIni }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ now()->format('F Y') }}</p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Diagnosa Terakhir -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Diagnosa Terakhir</p>
                    @if($riwayatTerbaru->first())
                        <p class="text-sm font-bold text-gray-800 mt-1">{{ $riwayatTerbaru->first()->penyakit->nama_penyakit ?? '-' }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $riwayatTerbaru->first()->tanggal->format('d M Y') }}</p>
                    @else
                        <p class="text-sm font-bold text-gray-800 mt-1">Belum ada</p>
                        <p class="text-xs text-gray-400 mt-1">-</p>
                    @endif
                </div>
                <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart & Statistik -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Line Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Aktivitas Diagnosa (6 Bulan Terakhir)</h3>
            <div style="height: 250px;">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Distribusi Penyakit</h3>
            @if($statistikPenyakit->count() > 0)
                <div style="height: 250px;">
                    <canvas id="pieChart"></canvas>
                </div>
            @else
                <div class="flex flex-col items-center justify-center h-40 text-gray-400">
                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <p class="text-sm">Belum ada data</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Tabel Statistik & Riwayat Terbaru -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Statistik Penyakit -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Statistik Penyakit Terdiagnosa</h3>
            @if($statistikPenyakit->count() > 0)
                <div class="space-y-3">
                    @foreach($statistikPenyakit as $stat)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                <span class="text-sm font-medium text-gray-700">{{ $stat->penyakit->nama_penyakit ?? $stat->penyakit_final }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-24 bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $totalDiagnosa > 0 ? ($stat->total / $totalDiagnosa * 100) : 0 }}%"></div>
                                </div>
                                <span class="text-sm font-bold text-gray-800">{{ $stat->total }}x</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-400 py-8">
                    <p class="text-sm">Belum ada data statistik</p>
                </div>
            @endif
        </div>

        <!-- Riwayat Terbaru -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Riwayat Terbaru</h3>
                <a href="{{ route('user.diagnosa.riwayat') }}" class="text-xs text-green-600 font-semibold hover:underline">Lihat Semua</a>
            </div>
            @forelse($riwayatTerbaru as $riwayat)
                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $riwayat->penyakit->nama_penyakit ?? '-' }}</p>
                        <p class="text-xs text-gray-400">{{ $riwayat->tanggal->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-1 text-xs font-bold rounded-full
                            {{ $riwayat->cf_tertinggi >= 0.8 ? 'bg-red-100 text-red-700' : ($riwayat->cf_tertinggi >= 0.5 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                            {{ round($riwayat->cf_tertinggi * 100, 1) }}%
                        </span>
                        <a href="{{ route('user.diagnosa.hasil', $riwayat->id_diagnosis) }}" class="block text-xs text-blue-500 hover:underline mt-1">Detail</a>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-400 py-8">
                    <p class="text-sm">Belum ada riwayat diagnosa</p>
                    <a href="{{ route('user.diagnosa.index') }}" class="text-green-600 text-sm font-semibold hover:underline">Mulai diagnosa sekarang</a>
                </div>
            @endforelse
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line Chart
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($chartData, 'bulan')) !!},
            datasets: [{
                label: 'Jumlah Diagnosa',
                data: {!! json_encode(array_column($chartData, 'total')) !!},
                borderColor: '#5FA357',
                backgroundColor: 'rgba(95, 163, 87, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#5FA357',
                pointRadius: 5,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // Pie Chart
    @if($statistikPenyakit->count() > 0)
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($statistikPenyakit->map(fn($s) => $s->penyakit->nama_penyakit ?? $s->penyakit_final)) !!},
            datasets: [{
                data: {!! json_encode($statistikPenyakit->pluck('total')) !!},
                backgroundColor: ['#5FA357', '#C1FA70', '#3B82F6', '#F59E0B', '#EF4444'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { font: { size: 11 } } }
            }
        }
    });
    @endif
    // Real time clock
    function updateClock() {
        const now = new Date();
        const options = {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
            hour: '2-digit', minute: '2-digit', second: '2-digit'
        };
        document.getElementById('realtime-clock').textContent = now.toLocaleDateString('id-ID', options);
    }
    updateClock();
    setInterval(updateClock, 1000);
</script>
@endpush