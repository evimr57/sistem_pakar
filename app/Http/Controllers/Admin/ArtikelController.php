<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiBudidaya;
use App\Models\InformasiHamaPenyakit;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of artikel.
     * Gabungan dari InformasiBudidaya dan InformasiHamaPenyakit
     */
    public function index()
    {
        // Ambil artikel dari kedua tabel
        $budidaya = InformasiBudidaya::latest()->get()->map(function($item) {
            $item->kategori = 'Budidaya';
            return $item;
        });

        $hamaPenyakit = InformasiHamaPenyakit::latest()->get()->map(function($item) {
            $item->kategori = 'Hama & Penyakit';
            return $item;
        });

        // Gabungkan dan paginate manual
        $artikels = $budidaya->merge($hamaPenyakit)->sortByDesc('created_at');
        
        // Convert ke paginator
        $page = request()->get('page', 1);
        $perPage = 10;
        $artikels = new \Illuminate\Pagination\LengthAwarePaginator(
            $artikels->forPage($page, $perPage),
            $artikels->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.artikel.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new artikel.
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * Store a newly created artikel.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => ['required', 'in:budidaya,hama_penyakit'],
            'judul' => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'max:2048'],
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $validated['created_by'] = auth()->id();

        // Simpan ke tabel yang sesuai
        if ($validated['kategori'] === 'budidaya') {
            InformasiBudidaya::create($validated);
        } else {
            InformasiHamaPenyakit::create($validated);
        }

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    /**
     * Show the form for editing artikel.
     */
    public function edit($id)
    {
        // Cari di kedua tabel
        $artikel = InformasiBudidaya::find($id);
        $kategori = 'budidaya';
        
        if (!$artikel) {
            $artikel = InformasiHamaPenyakit::findOrFail($id);
            $kategori = 'hama_penyakit';
        }

        return view('admin.artikel.edit', compact('artikel', 'kategori'));
    }

    /**
     * Update the specified artikel.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kategori' => ['required', 'in:budidaya,hama_penyakit'],
            'judul' => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'max:2048'],
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        // Update di tabel yang sesuai
        if ($validated['kategori'] === 'budidaya') {
            $artikel = InformasiBudidaya::findOrFail($id);
        } else {
            $artikel = InformasiHamaPenyakit::findOrFail($id);
        }

        $artikel->update($validated);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diupdate!');
    }

    /**
     * Remove the specified artikel.
     */
    public function destroy($id)
    {
        // Coba hapus dari kedua tabel
        $deleted = InformasiBudidaya::where('id', $id)->delete();
        
        if (!$deleted) {
            InformasiHamaPenyakit::where('id', $id)->delete();
        }

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}