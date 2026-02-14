<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi mass assignment
     */
    protected $fillable = [
        'username',
        'nama',
        'email',
        'no_hp',
        'role',
        'password',
    ];

    /**
     * Kolom yang di-hidden saat serialization (JSON)
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'password' => 'hashed', // Laravel 10+ auto hash
    ];

    // ============================================
    // RELATIONSHIPS
    // ============================================

    /**
     * User punya banyak riwayat diagnosis
     */
    public function riwayatDiagnosis()
    {
        return $this->hasMany(RiwayatDiagnosis::class, 'user_id');
    }

    /**
     * Admin upload banyak artikel budidaya
     */
    public function artikelBudidaya()
    {
        return $this->hasMany(InformasiBudidaya::class, 'created_by');
    }

    /**
     * Admin upload banyak artikel hama/penyakit
     */
    public function artikelHamaPenyakit()
    {
        return $this->hasMany(InformasiHamaPenyakit::class, 'created_by');
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    /**
     * Cek apakah user adalah admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user biasa
     */
    public function isUser()
    {
        return $this->role === 'user';
    }

    /**
     * Get display name
     * (Karena Laravel default cari 'name', kita redirect ke 'nama')
     */
    public function getNameAttribute()
    {
        return $this->nama;
    }
}