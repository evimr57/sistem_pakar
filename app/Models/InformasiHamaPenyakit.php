<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiHamaPenyakit extends Model
{
    protected $table = 'informasi_hama_penyakit';

    protected $fillable = [
        'id_penyakit',
        'judul',
        'slug',
        'deskripsi_singkat',
        'konten',
        'gambar_utama',
        'galeri_gambar',
        'file_pdf',
        'jenis',
        'tags',
        'gejala_visual',
        'cara_identifikasi',
        'pencegahan',
        'pengendalian',
        'urutan',
        'is_published',
        'published_at',
        'created_by',
    ];

    protected $casts = [
        'galeri_gambar' => 'array',
        'tags' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function penyakit()
    {
        return $this->belongsTo(MasterPenyakit::class, 'id_penyakit', 'id_penyakit');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}