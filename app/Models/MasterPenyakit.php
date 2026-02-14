<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPenyakit extends Model
{
    protected $table = 'master_penyakit';
    protected $primaryKey = 'id_penyakit';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_penyakit',
        'nama_penyakit',
        'nama_latin',
        'kategori',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'pengendalian_pencegahan',
        'pengendalian_kimia',
        'pengendalian_organik',
        'pengendalian_budidaya',
        'tingkat_bahaya',
        'gambar_url',
    ];

    // Relationships
    public function ruleBasis()
    {
        return $this->hasMany(RuleBasis::class, 'id_penyakit', 'id_penyakit');
    }

    public function riwayatDiagnosis()
    {
        return $this->hasMany(RiwayatDiagnosis::class, 'penyakit_final', 'id_penyakit');
    }

    public function informasiHamaPenyakit()
    {
        return $this->hasMany(InformasiHamaPenyakit::class, 'id_penyakit', 'id_penyakit');
    }
}