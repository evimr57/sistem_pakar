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
        $gejalas = MasterGejala::latest()->paginate(10);
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
            'kode_gejala' => ['required', 'string', 'max:10', 'unique:gejala,kode_gejala'],
            'nama_gejala' => ['required', 'string', 'max:255'],
        ], [
            'kode_gejala.unique' => 'Kode gejala sudah digunakan',
            'kode_gejala.required' => 'Kode gejala wajib diisi',
            'nama_gejala.required' => 'Nama gejala wajib diisi',
        ]);

        MasterGejala::create($validated);

        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala berhasil ditambahkan!');
    }

    /**
     * Display the specified gejala.
     */
    public function show(MasterGejala $gejala)
    {
        return view('admin.gejala.show', compact('gejala'));
    }

    /**
     * Show the form for editing gejala.
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
            'kode_gejala' => ['required', 'string', 'max:10', 'unique:gejala,kode_gejala,' . $gejala->id],
            'nama_gejala' => ['required', 'string', 'max:255'],
        ], [
            'kode_gejala.unique' => 'Kode gejala sudah digunakan',
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