<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterPenyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    /**
     * Display a listing of penyakit.
     */
    public function index()
    {
        $penyakits = MasterPenyakit::orderByRaw('LENGTH(id_penyakit) ASC, id_penyakit ASC')->paginate(10);
        return view('admin.penyakit.index', compact('penyakits'));
    }

    /**
     * Show the form for creating a new penyakit.
     */
    public function create()
    {
        return view('admin.penyakit.create');
    }

    /**
     * Store a newly created penyakit.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_penyakit' => ['required', 'string', 'max:10', 'unique:master_penyakit,id_penyakit'],
            'nama_penyakit' => ['required', 'string', 'max:255'],
            'nama_latin' => ['nullable', 'string', 'max:255'],
            'kategori' => ['required', 'in:Hama,Penyakit'],
            'deskripsi_singkat' => ['nullable', 'string'],
            'deskripsi_lengkap' => ['nullable', 'string'],
            'pengendalian_pencegahan' => ['nullable', 'string'],
            'pengendalian_kimia' => ['nullable', 'string'],
            'pengendalian_organik' => ['nullable', 'string'],
            'pengendalian_budidaya' => ['nullable', 'string'],
            'tingkat_bahaya' => ['nullable', 'in:Rendah,Sedang,Tinggi,Sangat Tinggi'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'id_penyakit.required' => 'Kode penyakit wajib diisi',
            'id_penyakit.unique' => 'Kode penyakit sudah digunakan',
            'nama_penyakit.required' => 'Nama penyakit wajib diisi',
            'kategori.required' => 'Kategori wajib dipilih',
            'kategori.in' => 'Kategori harus Hama atau Penyakit',
            'tingkat_bahaya.in' => 'Tingkat bahaya tidak valid',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WebP',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/penyakit'), $filename);
            $validated['gambar_url'] = '/uploads/penyakit/' . $filename;
        }

        MasterPenyakit::create($validated);

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil ditambahkan!');
    }

    /**
     * Display the specified penyakit.
     */
    public function show(MasterPenyakit $penyakit)
    {
        return view('admin.penyakit.show', compact('penyakit'));
    }

    /**
     * Show the form for editing penyakit.
     */
    public function edit(MasterPenyakit $penyakit)
    {
        return view('admin.penyakit.edit', compact('penyakit'));
    }

    /**
     * Update the specified penyakit.
     */
    public function update(Request $request, MasterPenyakit $penyakit)
    {
        $validated = $request->validate([
            'nama_penyakit' => ['required', 'string', 'max:255'],
            'nama_latin' => ['nullable', 'string', 'max:255'],
            'kategori' => ['required', 'in:Hama,Penyakit'],
            'deskripsi_singkat' => ['nullable', 'string'],
            'deskripsi_lengkap' => ['nullable', 'string'],
            'pengendalian_pencegahan' => ['nullable', 'string'],
            'pengendalian_kimia' => ['nullable', 'string'],
            'pengendalian_organik' => ['nullable', 'string'],
            'pengendalian_budidaya' => ['nullable', 'string'],
            'tingkat_bahaya' => ['nullable', 'in:Rendah,Sedang,Tinggi,Sangat Tinggi'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'nama_penyakit.required' => 'Nama penyakit wajib diisi',
            'kategori.required' => 'Kategori wajib dipilih',
            'kategori.in' => 'Kategori harus Hama atau Penyakit',
            'tingkat_bahaya.in' => 'Tingkat bahaya tidak valid',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WebP',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($penyakit->gambar_url && file_exists(public_path($penyakit->gambar_url))) {
                unlink(public_path($penyakit->gambar_url));
            }
            
            // Store new image
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/penyakit'), $filename);
            $validated['gambar_url'] = '/uploads/penyakit/' . $filename;
        }

        $penyakit->update($validated);

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Data penyakit berhasil diupdate!');
    }

    /**
     * Check if kode penyakit already exists (AJAX)
     */
    public function checkKode(Request $request)
    {
        $kode = $request->query('kode');
        $exists = MasterPenyakit::where('id_penyakit', $kode)->exists();
        
        return response()->json(['exists' => $exists]);
    }

    /**
     * Remove the specified penyakit.
     */
    public function destroy(MasterPenyakit $penyakit)
    {
        $penyakit->delete();

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil dihapus!');
    }
}