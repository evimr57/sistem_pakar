<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RiwayatDiagnosis;
use App\Models\MasterPenyakit;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Total diagnosa user
        $totalDiagnosa = RiwayatDiagnosis::where('user_id', $user->id)->count();

        // Diagnosa bulan ini
        $diagnosabulanIni = RiwayatDiagnosis::where('user_id', $user->id)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->count();

        // Riwayat diagnosa terbaru
        $riwayatTerbaru = RiwayatDiagnosis::where('user_id', $user->id)
            ->with('penyakit')
            ->latest('tanggal')
            ->take(5)
            ->get();

        // Data chart per bulan (6 bulan terakhir)
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $chartData[] = [
                'bulan' => $bulan->format('M Y'),
                'total' => RiwayatDiagnosis::where('user_id', $user->id)
                    ->whereMonth('tanggal', $bulan->month)
                    ->whereYear('tanggal', $bulan->year)
                    ->count(),
            ];
        }

        // Statistik penyakit terbanyak didiagnosa user
        $statistikPenyakit = RiwayatDiagnosis::where('user_id', $user->id)
            ->whereNotNull('penyakit_final')
            ->selectRaw('penyakit_final, count(*) as total')
            ->groupBy('penyakit_final')
            ->with('penyakit')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'totalDiagnosa',
            'diagnosabulanIni',
            'riwayatTerbaru',
            'chartData',
            'statistikPenyakit'
        ));
    }
}