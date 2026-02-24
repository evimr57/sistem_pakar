<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterGejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    /**
     * Display a listing of gejala.
     */
    public function index()
    {
        $gejalas = MasterGejala::orderByRaw('LENGTH(id_gejala) ASC, id_gejala ASC')->paginate(10);
        return view('admin.gejala.index', compact('gejalas'));
    }

    /**
     * Show the form for creating a new gejala.
     */
    public function create()
    {
        return view('admin.gejala.create');
    }

    /**
     * Store a newly created gejala.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_gejala' => ['required', 'string', 'max:10', 'unique:master_gejala,id_gejala'],
            'nama_gejala' => ['required', 'string', 'max:255'],
        ], [
            'id_gejala.required' => 'Kode gejala wajib diisi',
            'id_gejala.unique' => 'Kode gejala sudah digunakan',
            'nama_gejala.required' => 'Nama gejala wajib diisi',
        ]);

        MasterGejala::create($validated);

        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified gejala.
     */
    public function edit(MasterGejala $gejala)
    {
        return view('admin.gejala.edit', compact('gejala'));
    }

    /**
     * Update the specified gejala.
     */
    public function update(Request $request, MasterGejala $gejala)
    {
        $validated = $request->validate([
            'nama_gejala' => ['required', 'string', 'max:255'],
        ], [
            'nama_gejala.required' => 'Nama gejala wajib diisi',
        ]);

        $gejala->update($validated);

        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala berhasil diupdate!');
    }

    /**
     * Remove the specified gejala.
     */
    public function destroy(MasterGejala $gejala)
    {
        $gejala->delete();

        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala berhasil dihapus!');
    }
}