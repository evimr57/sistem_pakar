<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiBudidaya extends Model
{
    protected $table = 'informasi_budidaya';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi_singkat',
        'konten',
        'gambar_utama',
        'galeri_gambar',
        'file_pdf',
        'kategori',
        'tags',
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

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}