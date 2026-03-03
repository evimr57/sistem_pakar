@extends('layouts.superadmin-app')

@section('page-title', 'Tambah Pengguna')
@section('page-subtitle', 'Buat akun pengguna baru')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

.create-page * { font-family: 'Plus Jakarta Sans', sans-serif; }

.form-wrapper { max-width: 680px; margin: 0 auto; }

.form-card {
    background: white; border-radius: 28px;
    border: 1px solid #dcfce7;
    box-shadow: 0 8px 40px rgba(22, 163, 74, 0.1);
    overflow: hidden;
}

.form-hero {
    padding: 32px 36px 28px;
    background: linear-gradient(135deg, #14532d 0%, #166534 50%, #16a34a 100%);
    position: relative; overflow: hidden;
}
.form-hero::before {
    content: ''; position: absolute; top: -40px; right: -40px;
    width: 160px; height: 160px;
    background: rgba(255,255,255,0.07); border-radius: 50%;
}
.form-hero::after {
    content: ''; position: absolute; bottom: -30px; right: 80px;
    width: 100px; height: 100px;
    background: rgba(255,255,255,0.05); border-radius: 50%;
}
.hero-icon {
    width: 52px; height: 52px; border-radius: 16px;
    background: rgba(255,255,255,0.18);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 16px; backdrop-filter: blur(10px);
}
.hero-icon svg { width: 26px; height: 26px; color: white; }
.form-hero h2 { font-size: 1.4rem; font-weight: 800; color: white; letter-spacing: -0.3px; }
.form-hero p { color: rgba(255,255,255,0.65); font-size: 0.85rem; margin-top: 4px; }

.form-body { padding: 32px 36px; }

.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group.full { grid-column: 1 / -1; }

.form-label {
    font-size: 0.78rem; font-weight: 700; color: #374151;
    text-transform: uppercase; letter-spacing: 0.5px;
}
.label-optional { font-size: 0.72rem; font-weight: 500; color: #9ca3af; text-transform: none; letter-spacing: 0; }

.form-input {
    width: 100%; padding: 12px 16px;
    border: 1.5px solid #e5e7eb; border-radius: 14px;
    font-size: 0.88rem; color: #1a1a2e; background: #fafafa;
    transition: all 0.2s ease; outline: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.form-input:focus {
    border-color: #16a34a; background: white;
    box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.08);
}
.form-input.error { border-color: #ef4444; background: #fff5f5; }
.form-input::placeholder { color: #c4c4cc; }

.form-select {
    width: 100%; padding: 12px 16px;
    border: 1.5px solid #e5e7eb; border-radius: 14px;
    font-size: 0.88rem; color: #1a1a2e; background: #fafafa;
    transition: all 0.2s ease; outline: none; cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif; appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2316a34a'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 14px center;
    background-size: 16px; padding-right: 44px;
}
.form-select:focus {
    border-color: #16a34a; background-color: white;
    box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.08);
}

.error-msg { font-size: 0.75rem; color: #ef4444; font-weight: 500; }

.password-box {
    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    border: 1.5px solid #fde68a; border-radius: 18px;
    padding: 20px; margin: 4px 0;
}
.password-box-label {
    display: flex; align-items: center; gap: 7px;
    font-size: 0.78rem; font-weight: 700; color: #92400e;
    margin-bottom: 16px; text-transform: uppercase; letter-spacing: 0.5px;
}
.password-box-label svg { width: 14px; height: 14px; }
.password-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.password-input {
    width: 100%; padding: 12px 16px;
    border: 1.5px solid #fde68a; border-radius: 12px;
    font-size: 0.88rem; color: #1a1a2e; background: white;
    transition: all 0.2s ease; outline: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.password-input:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.08);
}
.password-input.error { border-color: #ef4444; }
.password-input::placeholder { color: #c4c4cc; }

.divider { height: 1px; background: linear-gradient(to right, transparent, #dcfce7, transparent); margin: 8px 0; }

.form-actions { display: flex; align-items: center; justify-content: space-between; padding-top: 8px; margin-top: 8px; }
.btn-cancel {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 11px 20px; color: #6b7280; font-weight: 600; font-size: 0.85rem;
    border-radius: 14px; text-decoration: none;
    background: #f9fafb; border: 1.5px solid #e5e7eb; transition: all 0.2s ease;
}
.btn-cancel:hover { background: #f3f4f6; color: #374151; }
.btn-cancel svg { width: 15px; height: 15px; }
.btn-submit {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 13px 28px;
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    color: white; font-weight: 700; font-size: 0.88rem;
    border-radius: 14px; border: none; cursor: pointer;
    box-shadow: 0 4px 15px rgba(22, 163, 74, 0.35);
    transition: all 0.3s ease;
    font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: 0.2px;
}
.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(22, 163, 74, 0.45);
}
.btn-submit svg { width: 16px; height: 16px; }
</style>

<div class="create-page">
<div class="form-wrapper">
<div class="form-card">

    <div class="form-hero">
        <div class="hero-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
        </div>
        <h2>Form Pengguna Baru</h2>
        <p>Lengkapi semua informasi untuk membuat akun baru</p>
    </div>

    <form method="POST" action="{{ route('super-admin.users.store') }}" class="form-body">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input id="username" name="username" type="text"
                    value="{{ old('username') }}" placeholder="contoh: johndoe"
                    class="form-input @error('username') error @enderror"
                    required autofocus />
                @error('username')<p class="error-msg">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input id="nama" name="nama" type="text"
                    value="{{ old('nama') }}" placeholder="Nama lengkap"
                    class="form-input @error('nama') error @enderror" required />
                @error('nama')<p class="error-msg">{{ $message }}</p>@enderror
            </div>

            <div class="form-group full">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="email"
                    value="{{ old('email') }}" placeholder="contoh@email.com"
                    class="form-input @error('email') error @enderror" required />
                @error('email')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="password-box" style="margin-top:20px;">
            <div class="password-box-label">
                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                Keamanan Akun
            </div>
            <div class="password-grid">
                <div class="form-group">
                    <label for="password" class="form-label" style="color:#92400e;">Password</label>
                    <input id="password" name="password" type="password"
                        placeholder="Min. 8 karakter"
                        class="password-input @error('password') error @enderror" required />
                    @error('password')<p class="error-msg">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label" style="color:#92400e;">Konfirmasi</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Ulangi password" class="password-input" required />
                </div>
            </div>
        </div>

        <div class="form-grid" style="margin-top:20px;">
            <div class="form-group">
                <label for="no_hp" class="form-label">No HP <span class="label-optional">(opsional)</span></label>
                <input id="no_hp" name="no_hp" type="text"
                    value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx"
                    class="form-input @error('no_hp') error @enderror" />
                @error('no_hp')<p class="error-msg">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Role</label>
                <select id="role" name="role" class="form-select @error('role') error @enderror" required>
                    <option value="">Pilih Role</option>
                    <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="divider" style="margin-top:28px;"></div>

        <div class="form-actions">
            <a href="{{ route('super-admin.users.index') }}" class="btn-cancel">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Batal
            </a>
            <button type="submit" class="btn-submit">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                Simpan Pengguna
            </button>
        </div>
    </form>

</div>
</div>
</div>
@endsection