<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGejala extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'master_gejala';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'id_gejala';

    /**
     * Indicates if the model's ID is auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id_gejala',
        'nama_gejala',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}