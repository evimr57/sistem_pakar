<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleBasis extends Model
{
    protected $table = 'rule_basis';
    protected $primaryKey = 'id_rule';

    protected $fillable = [
        'id_penyakit',
        'id_gejala',
        'mb',         // ← TAMBAH
        'md',         // ← TAMBAH
        'cf_pakar',
        'keterangan',
    ];

    // Relationships
    public function penyakit()
    {
        return $this->belongsTo(MasterPenyakit::class, 'id_penyakit', 'id_penyakit');
    }

    public function gejala()
    {
        return $this->belongsTo(MasterGejala::class, 'id_gejala', 'id_gejala');
    }

    // ============================================
    // AUTO-CALCULATE CF dari MB & MD
    // ============================================
    
    /**
     * Otomatis hitung CF sebelum save
     */
    protected static function boot()
    {
        parent::boot();
        
        // Event: Sebelum create
        static::creating(function ($rule) {
            $rule->cf_pakar = $rule->mb - $rule->md;
        });
        
        // Event: Sebelum update
        static::updating(function ($rule) {
            if ($rule->isDirty(['mb', 'md'])) {
                $rule->cf_pakar = $rule->mb - $rule->md;
            }
        });
    }

    /**
     * Accessor: Hitung CF on-the-fly (alternatif)
     */
    public function getCfAttribute()
    {
        return $this->mb - $this->md;
    }
}