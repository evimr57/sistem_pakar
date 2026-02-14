<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatDiagnosis extends Model
{
    protected $table = 'riwayat_diagnosis';
    protected $primaryKey = 'id_diagnosis';

    protected $fillable = [
        'user_id',
        'tanggal',
        'gejala_input',
        'hasil_diagnosa',
        'cf_tertinggi',
        'penyakit_final',
        'user_info',
        'lokasi',
    ];

    protected $casts = [
        'gejala_input' => 'array',
        'hasil_diagnosa' => 'array',
        'tanggal' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penyakit()
    {
        return $this->belongsTo(MasterPenyakit::class, 'penyakit_final', 'id_penyakit');
    }
}