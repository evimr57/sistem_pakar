<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterGejala;
use App\Models\MasterPenyakit;
use App\Models\RiwayatDiagnosis;
use App\Models\InformasiBudidaya;
use App\Models\InformasiHamaPenyakit;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total Statistics
        $totalGejala = MasterGejala::count();
        $totalPenyakit = MasterPenyakit::count();
        $totalDiagnosa = RiwayatDiagnosis::count();
        $totalArtikel = InformasiBudidaya::count() + InformasiHamaPenyakit::count();

        // Chart: Penyakit Paling Banyak Didiagnosa (Top 5)
        $penyakitTerbanyak = RiwayatDiagnosis::select('penyakit_final', DB::raw('count(*) as total'))
            ->whereNotNull('penyakit_final')
            ->groupBy('penyakit_final')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Join dengan MasterPenyakit untuk ambil nama lengkap
        $chartPenyakit = [
            'labels' => $penyakitTerbanyak->map(function($item) {
                // Cari nama penyakit berdasarkan kode
                $penyakit = MasterPenyakit::where('kode_penyakit', $item->penyakit_final)->first();
                return $penyakit ? $penyakit->nama_penyakit : $item->penyakit_final;
            })->toArray(),
            'data' => $penyakitTerbanyak->pluck('total')->toArray(),
        ];

        // Chart: Trend Diagnosa Per Bulan (6 bulan terakhir)
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        
        $diagnosaTrend = RiwayatDiagnosis::where('created_at', '>=', $sixMonthsAgo)
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('count(*) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Generate all months for the last 6 months
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i));
        }

        $chartDiagnosa = [
            'labels' => $months->map(function($month) {
                return $month->translatedFormat('M Y');
            })->toArray(),
            'data' => $months->map(function($month) use ($diagnosaTrend) {
                $bulan = $month->format('Y-m');
                $found = $diagnosaTrend->firstWhere('bulan', $bulan);
                return $found ? $found->total : 0;
            })->toArray(),
        ];

        return view('admin.dashboard', compact(
            'totalGejala',
            'totalPenyakit',
            'totalDiagnosa',
            'totalArtikel',
            'chartPenyakit',
            'chartDiagnosa'
        ));
    }
}