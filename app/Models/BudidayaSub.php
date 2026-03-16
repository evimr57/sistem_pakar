<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudidayaSub extends Model
{
    protected $table = 'budidaya_sub';

    protected $fillable = [
        'id_artikel',
        'judul_sub',
        'konten',
        'gambar',
        'urutan',
    ];

    public function artikel()
    {
        return $this->belongsTo(InformasiBudidaya::class, 'id_artikel', 'id');
    }
}