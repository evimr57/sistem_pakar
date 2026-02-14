<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterGejala extends Model
{
    protected $table = 'master_gejala';
    protected $primaryKey = 'id_gejala';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_gejala',
        'nama_gejala',
    ];

    // Relationships
    public function ruleBasis()
    {
        return $this->hasMany(RuleBasis::class, 'id_gejala', 'id_gejala');
    }
}