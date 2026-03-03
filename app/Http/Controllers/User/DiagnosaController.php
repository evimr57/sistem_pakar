<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MasterGejala;
use App\Models\MasterPenyakit;
use App\Models\RuleBasis;
use App\Models\RiwayatDiagnosis;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DiagnosaController extends Controller
{
    public function index()
    {
        $gejalas = MasterGejala::orderBy('id_gejala')->get();
        return view('user.diagnosa.index', compact('gejalas'));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'gejala' => 'required|array|min:1',
        ], [
            'gejala.required' => 'Pilih minimal 1 gejala!',
            'gejala.min' => 'Pilih minimal 1 gejala!',
        ]);

        $gejalaInput = $request->gejala; // array of id_gejala

        // Ambil semua rule yang relevan
        $rules = RuleBasis::whereIn('id_gejala', $gejalaInput)->get();

        // Hitung MB dan MD per penyakit dulu
        $mbPenyakit = [];
        $mdPenyakit = [];

        foreach ($rules as $rule) {
            $idPenyakit = $rule->id_penyakit;

            if (!isset($mbPenyakit[$idPenyakit])) {
                // Gejala pertama
                $mbPenyakit[$idPenyakit] = $rule->mb;
                $mdPenyakit[$idPenyakit] = $rule->md;
            } else {
                // Kombinasi gejala berikutnya (rumus 2 & 3)
                $mbPenyakit[$idPenyakit] = $mbPenyakit[$idPenyakit] * $rule->mb;
                $mdPenyakit[$idPenyakit] = $mdPenyakit[$idPenyakit] + $rule->md * (1 - $mdPenyakit[$idPenyakit]);
            }
        }

        // Hitung CF = MB - MD
        $cfPenyakit = [];
        foreach ($mbPenyakit as $idPenyakit => $mb) {
            $cfPenyakit[$idPenyakit] = $mb - $mdPenyakit[$idPenyakit];
        }

        if (empty($cfPenyakit)) {
            return redirect()->route('user.diagnosa.index')
                ->with('error', 'Tidak ditemukan penyakit yang cocok dengan gejala yang dipilih.');
        }

        // Urutkan dari CF tertinggi
        arsort($cfPenyakit);

        // Ambil data penyakit
        $hasilDiagnosa = [];
        foreach ($cfPenyakit as $idPenyakit => $cf) {
            $penyakit = MasterPenyakit::find($idPenyakit);
            if ($penyakit) {
                $hasilDiagnosa[] = [
                    'id_penyakit' => $idPenyakit,
                    'nama_penyakit' => $penyakit->nama_penyakit,
                    'cf' => round($cf, 2),
                    'persentase' => round($cf * 100, 1),
                ];
            }
        }

        $penyakitFinal = $hasilDiagnosa[0]['id_penyakit'];
        $cfTertinggi = $hasilDiagnosa[0]['cf'];

        // Simpan ke riwayat
        $riwayat = RiwayatDiagnosis::create([
            'user_id'       => auth()->id(),
            'tanggal'       => now(),
            'gejala_input'  => $gejalaInput,
            'hasil_diagnosa'=> $hasilDiagnosa,
            'cf_tertinggi'  => $cfTertinggi,
            'penyakit_final'=> $penyakitFinal,
        ]);

        return redirect()->route('user.diagnosa.hasil', $riwayat->id_diagnosis);
    }

    public function hasil($id)
    {
        $riwayat = RiwayatDiagnosis::with('penyakit')->findOrFail($id);

        if ($riwayat->user_id !== auth()->id()) {
            abort(403);
        }

        $gejalaInput = MasterGejala::whereIn('id_gejala', $riwayat->gejala_input)->get();

        // Ambil relasi gejala-penyakit dari rule_basis
        $relasiGejala = RuleBasis::whereIn('id_gejala', $riwayat->gejala_input)
            ->whereIn('id_penyakit', collect($riwayat->hasil_diagnosa)->pluck('id_penyakit'))
            ->with(['penyakit', 'gejala'])
            ->get()
            ->groupBy('id_penyakit');

        return view('user.diagnosa.hasil', compact('riwayat', 'gejalaInput', 'relasiGejala'));
    }

    public function riwayat()
    {
        $riwayats = RiwayatDiagnosis::where('user_id', auth()->id())
            ->with('penyakit')
            ->latest('tanggal')
            ->paginate(10);

        return view('user.diagnosa.riwayat', compact('riwayats'));
    }

    public function destroy($id)
    {
        $riwayat = RiwayatDiagnosis::findOrFail($id);
        
        if ($riwayat->user_id !== auth()->id()) {
            abort(403);
        }
        
        $riwayat->delete();
        
        return redirect()->route('user.diagnosa.riwayat')
            ->with('success', 'Riwayat diagnosa berhasil dihapus!');
    }

    public function downloadPdf($id)
    {
        $riwayat = RiwayatDiagnosis::with('penyakit')->findOrFail($id);

        if ($riwayat->user_id !== auth()->id()) {
            abort(403);
        }

        $gejalaInput = MasterGejala::whereIn('id_gejala', $riwayat->gejala_input)->get();

        $relasiGejala = RuleBasis::whereIn('id_gejala', $riwayat->gejala_input)
            ->whereIn('id_penyakit', collect($riwayat->hasil_diagnosa)->pluck('id_penyakit'))
            ->get()
            ->groupBy('id_penyakit');

        $pdf = Pdf::loadView('user.diagnosa.pdf', compact('riwayat', 'gejalaInput', 'relasiGejala'));

        return $pdf->download('hasil-diagnosa-' . $riwayat->id_diagnosis . '.pdf');
    }
}