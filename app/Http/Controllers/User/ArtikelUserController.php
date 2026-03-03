<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\InformasiBudidaya;
use App\Models\InformasiHamaPenyakit;

class ArtikelUserController extends Controller
{
    public function budidaya()
    {
        $artikels = InformasiBudidaya::published()->latest()->paginate(9);
        return view('user.artikel.budidaya', compact('artikels'));
    }

    public function detailBudidaya($slug)
    {
        $artikel = InformasiBudidaya::where('slug', $slug)->firstOrFail();
        return view('user.artikel.detail-budidaya', compact('artikel'));
    }

    public function hamaPenyakit()
    {
        $hama = InformasiHamaPenyakit::published()->where('jenis', 'Hama')->latest()->get();
        $penyakit = InformasiHamaPenyakit::published()->where('jenis', 'Penyakit')->latest()->get();
        return view('user.artikel.hama-penyakit', compact('hama', 'penyakit'));
    }

    public function detailHamaPenyakit($slug)
    {
        $artikel = InformasiHamaPenyakit::where('slug', $slug)->firstOrFail();
        return view('user.artikel.detail-hama-penyakit', compact('artikel'));
    }
}