<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RuleBasis;
use App\Models\MasterPenyakit;
use App\Models\MasterGejala;
use Illuminate\Http\Request;

class RuleBasisController extends Controller
{
    /**
     * Display a listing of rule basis.
     */
    public function index(Request $request)
    {
        $query = RuleBasis::with(['penyakit', 'gejala']);

        // Filter by penyakit
        if ($request->filled('penyakit')) {
            $query->where('id_penyakit', $request->penyakit);
        }

        // Filter by gejala
        if ($request->filled('gejala')) {
            $query->where('id_gejala', $request->gejala);
        }

        // Search by keterangan
        if ($request->filled('search')) {
            $query->where('keterangan', 'like', '%' . $request->search . '%');
        }

        $rules = $query->orderBy('id_penyakit', 'asc')
                       ->orderBy('id_gejala', 'asc')
                       ->paginate(15);

        // Statistics
        $totalRules = RuleBasis::count();
        $avgCF = RuleBasis::avg('cf_pakar');
        $highConfidenceRules = RuleBasis::where('cf_pakar', '>=', 0.7)->count();
        $totalPenyakitWithRules = RuleBasis::distinct('id_penyakit')->count('id_penyakit');

        // Data for filter dropdowns
        $penyakits = MasterPenyakit::orderByRaw('LENGTH(id_penyakit) ASC, id_penyakit ASC')->get();
        $gejalas = MasterGejala::orderByRaw('LENGTH(id_gejala) ASC, id_gejala ASC')->get();

        return view('admin.rule-basis.index', compact(
            'rules', 
            'penyakits', 
            'gejalas',
            'totalRules',
            'avgCF',
            'highConfidenceRules',
            'totalPenyakitWithRules'
        ));
    }

    /**
     * Show the form for creating a new rule.
     */
    public function create()
    {
        $penyakits = MasterPenyakit::orderByRaw('LENGTH(id_penyakit) ASC, id_penyakit ASC')->get();
        $gejalas = MasterGejala::orderByRaw('LENGTH(id_gejala) ASC, id_gejala ASC')->get();

        return view('admin.rule-basis.create', compact('penyakits', 'gejalas'));
    }

    /**
     * Store a newly created rule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_penyakit' => ['required', 'exists:master_penyakit,id_penyakit'],
            'id_gejala' => ['required', 'exists:master_gejala,id_gejala'],
            'mb' => ['required', 'numeric', 'min:0', 'max:1'],
            'md' => ['required', 'numeric', 'min:0', 'max:1'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'id_penyakit.required' => 'Penyakit wajib dipilih',
            'id_penyakit.exists' => 'Penyakit tidak valid',
            'id_gejala.required' => 'Gejala wajib dipilih',
            'id_gejala.exists' => 'Gejala tidak valid',
            'mb.required' => 'Nilai MB wajib diisi',
            'mb.min' => 'Nilai MB minimal 0',
            'mb.max' => 'Nilai MB maksimal 1',
            'md.required' => 'Nilai MD wajib diisi',
            'md.min' => 'Nilai MD minimal 0',
            'md.max' => 'Nilai MD maksimal 1',
        ]);

        // Check if rule already exists
        $exists = RuleBasis::where('id_penyakit', $validated['id_penyakit'])
                           ->where('id_gejala', $validated['id_gejala'])
                           ->exists();

        if ($exists) {
            return back()->withInput()->withErrors([
                'id_gejala' => 'Rule untuk penyakit dan gejala ini sudah ada!'
            ]);
        }

        RuleBasis::create($validated);

        return redirect()->route('admin.rule-basis.index')
            ->with('success', 'Rule basis berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified rule.
     */
    public function edit(RuleBasis $ruleBasis)
    {
        $penyakits = MasterPenyakit::orderByRaw('LENGTH(id_penyakit) ASC, id_penyakit ASC')->get();
        $gejalas = MasterGejala::orderByRaw('LENGTH(id_gejala) ASC, id_gejala ASC')->get();

        return view('admin.rule-basis.edit', compact('ruleBasis', 'penyakits', 'gejalas'));
    }

    /**
     * Update the specified rule.
     */
    public function update(Request $request, RuleBasis $ruleBasis)
    {
        $validated = $request->validate([
            'mb' => ['required', 'numeric', 'min:0', 'max:1'],
            'md' => ['required', 'numeric', 'min:0', 'max:1'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'mb.required' => 'Nilai MB wajib diisi',
            'mb.min' => 'Nilai MB minimal 0',
            'mb.max' => 'Nilai MB maksimal 1',
            'md.required' => 'Nilai MD wajib diisi',
            'md.min' => 'Nilai MD minimal 0',
            'md.max' => 'Nilai MD maksimal 1',
        ]);

        $ruleBasis->update($validated);

        return redirect()->route('admin.rule-basis.index')
            ->with('success', 'Rule basis berhasil diupdate!');
    }

    /**
     * Remove the specified rule.
     */
    public function destroy(RuleBasis $ruleBasis)
    {
        $ruleBasis->delete();

        return redirect()->route('admin.rule-basis.index')
            ->with('success', 'Rule basis berhasil dihapus!');
    }
}