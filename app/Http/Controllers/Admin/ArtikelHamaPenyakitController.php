<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiHamaPenyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelHamaPenyakitController extends Controller
{
    public function index()
    {
        $artikels = InformasiHamaPenyakit::latest()->paginate(10);
        return view('admin.artikel-hama-penyakit.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel-hama-penyakit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:200',
            'jenis'            => 'required|in:Hama,Penyakit',
            'deskripsi_singkat'=> 'nullable|string',
            'konten'           => 'required|string',
            'gejala_visual'    => 'nullable|string',
            'cara_identifikasi'=> 'nullable|string',
            'pencegahan'       => 'nullable|string',
            'pengendalian'     => 'nullable|string',
            'gambar_utama'     => 'nullable|image|max:2048',
            'galeri_gambar.*'  => 'nullable|image|max:2048',
            'file_pdf'         => 'nullable|mimes:pdf|max:5120',
            'tags'             => 'nullable|string',
            'is_published'     => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->judul);
        $validated['created_by'] = auth()->id();
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('hama-penyakit/gambar', 'public');
        }

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('hama-penyakit/pdf', 'public');
        }

        // Handle galeri gambar
        if ($request->hasFile('galeri_gambar')) {
            $galeri = [];
            foreach ($request->file('galeri_gambar') as $foto) {
                $galeri[] = $foto->store('hama-penyakit/galeri', 'public');
            }
            $validated['galeri_gambar'] = $galeri;
        }

        // Handle tags
        $tagsDecoded = json_decode($request->tags, true);
        $validated['tags'] = (!empty($tagsDecoded)) ? $tagsDecoded : null;

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        InformasiHamaPenyakit::create($validated);

        return redirect()->route('admin.artikel-hama-penyakit.index')
            ->with('success', 'Artikel hama & penyakit berhasil ditambahkan!');
    }

    public function edit(InformasiHamaPenyakit $artikelHamaPenyakit)
    {
        return view('admin.artikel-hama-penyakit.edit', compact('artikelHamaPenyakit'));
    }

    public function update(Request $request, InformasiHamaPenyakit $artikelHamaPenyakit)
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:200',
            'jenis'            => 'required|in:Hama,Penyakit',
            'deskripsi_singkat'=> 'nullable|string',
            'konten'           => 'required|string',
            'gejala_visual'    => 'nullable|string',
            'cara_identifikasi'=> 'nullable|string',
            'pencegahan'       => 'nullable|string',
            'pengendalian'     => 'nullable|string',
            'gambar_utama'     => 'nullable|image|max:2048',
            'galeri_gambar.*'  => 'nullable|image|max:2048',
            'file_pdf'         => 'nullable|mimes:pdf|max:5120',
            'tags'             => 'nullable|string',
            'is_published'     => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->judul);
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('hama-penyakit/gambar', 'public');
        }

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('hama-penyakit/pdf', 'public');
        }

        // Handle galeri gambar
        if ($request->hasFile('galeri_gambar')) {
            $galeri = [];
            foreach ($request->file('galeri_gambar') as $foto) {
                $galeri[] = $foto->store('hama-penyakit/galeri', 'public');
            }
            $validated['galeri_gambar'] = $galeri;
        }

        // Handle tags
        $tagsDecoded = json_decode($request->tags, true);
        $validated['tags'] = (!empty($tagsDecoded)) ? $tagsDecoded : null;

        if ($validated['is_published'] && !$artikelHamaPenyakit->published_at) {
            $validated['published_at'] = now();
        }

        $artikelHamaPenyakit->update($validated);

        return redirect()->route('admin.artikel-hama-penyakit.index')
            ->with('success', 'Artikel hama & penyakit berhasil diupdate!');
    }

    public function destroy(InformasiHamaPenyakit $artikelHamaPenyakit)
    {
        $artikelHamaPenyakit->delete();
        return redirect()->route('admin.artikel-hama-penyakit.index')
            ->with('success', 'Artikel hama & penyakit berhasil dihapus!');
    }
}