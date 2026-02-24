<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nama',
        'email',
        'password',
        'no_hp',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function riwayatDiagnosis()
    {
        return $this->hasMany(RiwayatDiagnosis::class, 'user_id');
    }

    public function artikelBudidaya()
    {
        return $this->hasMany(InformasiBudidaya::class, 'created_by');
    }

    public function artikelHamaPenyakit()
    {
        return $this->hasMany(InformasiHamaPenyakit::class, 'created_by');
    }

    // ============================================
    // ROLE CHECKER HELPER METHODS
    // ============================================

    /**
     * Cek apakah user adalah Super Admin
     * 
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    /**
     * Cek apakah user adalah Admin (TETAP SEPERTI SEBELUMNYA)
     * 
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user biasa (TETAP SEPERTI SEBELUMNYA)
     * 
     * @return bool
     */
    public function isUser()
    {
        return $this->role === 'user';
    }

    /**
     * Cek apakah user punya akses admin (Super Admin ATAU Admin)
     * Helper baru untuk middleware yang butuh cek "apakah user ini admin atau super admin"
     * 
     * @return bool
     */
    public function hasAdminAccess()
    {
        return in_array($this->role, ['super_admin', 'admin']);
    }

    /**
     * Cek apakah user punya akses super admin (alias dari isSuperAdmin)
     * 
     * @return bool
     */
    public function hasSuperAdminAccess()
    {
        return $this->isSuperAdmin();
    }

    /**
     * Get role display name (untuk tampilan)
     * 
     * @return string
     */
    public function getRoleDisplayName()
    {
        return match($this->role) {
            'super_admin' => 'Super Administrator',
            'admin' => 'Administrator',
            'user' => 'User',
            default => 'Unknown',
        };
    }

    /**
     * Get role badge color (untuk UI)
     * 
     * @return string
     */
    public function getRoleBadgeColor()
    {
        return match($this->role) {
            'super_admin' => 'red',
            'admin' => 'blue',
            'user' => 'gray',
            default => 'gray',
        };
    }
}