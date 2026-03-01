<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiBudidaya;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelBudidayaController extends Controller
{
    public function index()
    {
        $artikels = InformasiBudidaya::latest()->paginate(10);
        return view('admin.artikel-budidaya.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel-budidaya.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'             => 'required|string|max:200',
            'deskripsi_singkat' => 'nullable|string',
            'konten'            => 'required|string',
            'gambar_utama'      => 'nullable|image|max:2048',
            'galeri_gambar.*'   => 'nullable|image|max:2048',
            'file_pdf'          => 'nullable|mimes:pdf|max:5120',
            'tags'              => 'nullable|string',
            'is_published'      => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->judul);
        $validated['created_by'] = auth()->id();
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('budidaya/gambar', 'public');
        }

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('budidaya/pdf', 'public');
        }

        // Handle galeri gambar
        if ($request->hasFile('galeri_gambar')) {
            $galeri = [];
            foreach ($request->file('galeri_gambar') as $foto) {
                $galeri[] = $foto->store('budidaya/galeri', 'public');
            }
            $validated['galeri_gambar'] = $galeri; // otomatis di-cast ke JSON oleh model
        }

            // Handle tags
        $tagsDecoded = json_decode($request->tags, true);
        $validated['tags'] = (!empty($tagsDecoded)) ? $tagsDecoded : null;

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }
    
        InformasiBudidaya::create($validated);

        return redirect()->route('admin.artikel-budidaya.index')
            ->with('success', 'Artikel budidaya berhasil ditambahkan!');
}

    public function edit(InformasiBudidaya $artikelBudidaya)
    {
        return view('admin.artikel-budidaya.edit', compact('artikelBudidaya'));
    }

    public function update(Request $request, InformasiBudidaya $artikelBudidaya)
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:200',
            'deskripsi_singkat'=> 'nullable|string',
            'konten'           => 'required|string',
            'gambar_utama'     => 'nullable|image|max:2048',
            'galeri_gambar.*'  => 'nullable|image|max:2048',
            'file_pdf'         => 'nullable|mimes:pdf|max:5120',
            'tags'             => 'nullable|string',
            'is_published'     => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->judul);
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('budidaya/gambar', 'public');
        }

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('budidaya/pdf', 'public');
        }

        // Handle galeri gambar
        if ($request->hasFile('galeri_gambar')) {
            $galeri = [];
            foreach ($request->file('galeri_gambar') as $foto) {
                $galeri[] = $foto->store('budidaya/galeri', 'public');
            }
            $validated['galeri_gambar'] = $galeri;
        }

        // Handle tags
        $tagsDecoded = json_decode($request->tags, true);
        $validated['tags'] = (!empty($tagsDecoded)) ? $tagsDecoded : null;

        if ($validated['is_published'] && !$artikelBudidaya->published_at) {
            $validated['published_at'] = now();
        }

        $artikelBudidaya->update($validated);

        return redirect()->route('admin.artikel-budidaya.index')
            ->with('success', 'Artikel budidaya berhasil diupdate!');
    }

    public function destroy(InformasiBudidaya $artikelBudidaya)
    {
        $artikelBudidaya->delete();
        return redirect()->route('admin.artikel-budidaya.index')
            ->with('success', 'Artikel budidaya berhasil dihapus!');
    }
}