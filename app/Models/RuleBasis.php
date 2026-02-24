<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleBasis extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'rule_basis';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'id_rule';

    /**
     * FIX: Paksa Laravel pakai 'id_rule' sebagai route key.
     * Tanpa ini, Laravel auto-generate nama parameter dari nama class:
     * RuleBasis -> 'rule_basi' (typo otomatis) -> UrlGenerationException.
     */
    public function getRouteKeyName(): string
    {
        return 'id_rule';
    }

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id_penyakit',
        'id_gejala',
        'mb',
        'md',
        'cf_pakar',
        'keterangan',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'mb' => 'decimal:2',
        'md' => 'decimal:2',
        'cf_pakar' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with MasterPenyakit
     */
    public function penyakit()
    {
        return $this->belongsTo(MasterPenyakit::class, 'id_penyakit', 'id_penyakit');
    }

    /**
     * Relationship with MasterGejala
     */
    public function gejala()
    {
        return $this->belongsTo(MasterGejala::class, 'id_gejala', 'id_gejala');
    }

    /**
     * Auto-calculate CF when MB and MD are set
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Auto-calculate CF = MB - MD
            if (!is_null($model->mb) && !is_null($model->md)) {
                $model->cf_pakar = $model->mb - $model->md;
            }
        });
    }
}