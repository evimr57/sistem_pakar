<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\UserManagementController;
use App\Http\Controllers\Admin\AdminDashboardController;  // ← TAMBAHKAN INI
use App\Http\Controllers\Admin\PenyakitController;        // ← DAN INI
use App\Http\Controllers\Admin\GejalaController;
use App\Http\Controllers\Admin\RuleBasisController;          // ← DAN INI
use App\Http\Controllers\Admin\ArtikelController;         // ← DAN INI

Route::get('/', function () {
    return view('welcome');
});

// Dashboard untuk user biasa
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        // Redirect berdasarkan role
        if (auth()->user()->role === 'super_admin') {
            return redirect()->route('super-admin.dashboard');
        } elseif (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');
});

// Super Admin Routes
Route::middleware(['auth', App\Http\Middleware\IsSuperAdmin::class])->prefix('super-admin')->name('super-admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('super-admin.dashboard');
    })->name('dashboard');
    
    Route::resource('users', App\Http\Controllers\SuperAdmin\UserManagementController::class);
});

// Admin Routes (kalau ada)
Route::middleware(['auth', App\Http\Middleware\IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard Admin (dengan chart)
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Penyakit Management
        Route::resource('penyakit', PenyakitController::class);
        
        // Gejala Management
        Route::resource('gejala', GejalaController::class);

        //Rule Basis Management
        Route::resource('rule-basis', RuleBasisController::class)->parameters([
            'rule-basis' => 'ruleBasis'
        ]);
        
        // Artikel Management
        Route::resource('artikel', ArtikelController::class);
        
        // Bisa tambah route lain di sini:
        // Route::resource('diagnosa', DiagnosaController::class);
        // Route::resource('aturan', AturanController::class);
    });

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';