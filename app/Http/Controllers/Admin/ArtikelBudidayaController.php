<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiBudidaya;
use App\Models\BudidayaSub;
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
            'konten'            => 'nullable|string',
            'gambar_utama'      => 'nullable|image|max:2048',
            'galeri_gambar.*'   => 'nullable|image|max:2048',
            'file_pdf'          => 'nullable|mimes:pdf|max:5120',
            'tags'              => 'nullable|string',
            'is_published'      => 'boolean',
            'sub_judul.*'       => 'nullable|string|max:200',
            'sub_konten.*'      => 'nullable|string',
            'sub_gambar.*'      => 'nullable|image|max:2048',
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

        if ($request->hasFile('galeri_gambar')) {
            $galeri = [];
            foreach ($request->file('galeri_gambar') as $foto) {
                $galeri[] = $foto->store('budidaya/galeri', 'public');
            }
            $validated['galeri_gambar'] = $galeri;
        }

        $tagsDecoded = json_decode($request->tags, true);
        $validated['tags'] = (!empty($tagsDecoded)) ? $tagsDecoded : null;

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        $artikel = InformasiBudidaya::create($validated);

        // Handle sub-bab
        if ($request->has('sub_judul')) {
            foreach ($request->sub_judul as $index => $judul) {
                if (!empty($judul)) {
                    $subData = [
                        'id_artikel' => $artikel->id,
                        'judul_sub'  => $judul,
                        'konten'     => $request->sub_konten[$index] ?? null,
                        'urutan'     => $index + 1,
                    ];

                    if ($request->hasFile("sub_gambar.$index")) {
                        $path = $request->file("sub_gambar.$index")->store('budidaya/sub', 'public');
                        $subData['gambar'] = $path;
                    }

                    BudidayaSub::create($subData);
                }
            }
        }

        return redirect()->route('admin.artikel-budidaya.index')
            ->with('success', 'Artikel budidaya berhasil ditambahkan!');
    }

    public function edit(InformasiBudidaya $artikelBudidaya)
    {
        $artikelBudidaya->load('subBab');
        return view('admin.artikel-budidaya.edit', compact('artikelBudidaya'));
    }

    public function update(Request $request, InformasiBudidaya $artikelBudidaya)
    {
        $validated = $request->validate([
            'judul'             => 'required|string|max:200',
            'deskripsi_singkat' => 'nullable|string',
            'konten'            => 'nullable|string',
            'gambar_utama'      => 'nullable|image|max:2048',
            'galeri_gambar.*'   => 'nullable|image|max:2048',
            'file_pdf'          => 'nullable|mimes:pdf|max:5120',
            'tags'              => 'nullable|string',
            'is_published'      => 'boolean',
            'sub_judul.*'       => 'nullable|string|max:200',
            'sub_konten.*'      => 'nullable|string',
            'sub_gambar.*'      => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($request->judul);
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('budidaya/gambar', 'public');
        }

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('budidaya/pdf', 'public');
        }

        if ($request->hasFile('galeri_gambar')) {
            $galeri = [];
            foreach ($request->file('galeri_gambar') as $foto) {
                $galeri[] = $foto->store('budidaya/galeri', 'public');
            }
            $validated['galeri_gambar'] = $galeri;
        }

        $tagsDecoded = json_decode($request->tags, true);
        $validated['tags'] = (!empty($tagsDecoded)) ? $tagsDecoded : null;

        if ($validated['is_published'] && !$artikelBudidaya->published_at) {
            $validated['published_at'] = now();
        }

        $artikelBudidaya->update($validated);

        // Hapus sub-bab lama & simpan yang baru
        $artikelBudidaya->subBab()->delete();

        if ($request->has('sub_judul')) {
            foreach ($request->sub_judul as $index => $judul) {
                if (!empty($judul)) {
                    $subData = [
                        'id_artikel' => $artikelBudidaya->id,
                        'judul_sub'  => $judul,
                        'konten'     => $request->sub_konten[$index] ?? null,
                        'urutan'     => $index + 1,
                    ];

                    if ($request->hasFile("sub_gambar.$index")) {
                        $path = $request->file("sub_gambar.$index")->store('budidaya/sub', 'public');
                        $subData['gambar'] = $path;
                    }

                    BudidayaSub::create($subData);
                }
            }
        }

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