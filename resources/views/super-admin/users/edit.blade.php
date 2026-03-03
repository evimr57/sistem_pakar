@extends('layouts.superadmin-app')

@section('page-title', 'Edit Pengguna')
@section('page-subtitle', 'Ubah data akun: ' . $user->nama)

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

.edit-page * { font-family: 'Plus Jakarta Sans', sans-serif; }

.form-wrapper { max-width: 720px; margin: 0 auto; }

.form-card {
    background: white; border-radius: 28px;
    border: 1px solid #dcfce7;
    box-shadow: 0 8px 40px rgba(22, 163, 74, 0.1);
    overflow: hidden;
}

.form-hero {
    padding: 28px 36px;
    background: linear-gradient(135deg, #14532d 0%, #166534 40%, #22c55e 100%);
    position: relative; overflow: hidden;
}
.form-hero::before {
    content: ''; position: absolute; top: -50px; right: -30px;
    width: 180px; height: 180px;
    background: rgba(255,255,255,0.07); border-radius: 50%;
}
.form-hero::after {
    content: ''; position: absolute; bottom: -20px; left: 200px;
    width: 80px; height: 80px;
    background: rgba(255,255,255,0.05); border-radius: 50%;
}

.hero-top { display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1; }
.hero-left { display: flex; align-items: center; gap: 14px; }
.hero-icon {
    width: 48px; height: 48px; border-radius: 14px;
    background: rgba(255,255,255,0.18);
    display: flex; align-items: center; justify-content: center;
    backdrop-filter: blur(10px);
}
.hero-icon svg { width: 24px; height: 24px; color: white; }
.hero-title { font-size: 1.3rem; font-weight: 800; color: white; letter-spacing: -0.3px; }
.hero-id { color: rgba(255,255,255,0.6); font-size: 0.8rem; margin-top: 2px; }

.user-badge {
    display: flex; align-items: center; gap: 10px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 14px; padding: 10px 16px;
}
.badge-avatar {
    width: 36px; height: 36px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem; font-weight: 800; color: white;
}
.badge-avatar.super { background: linear-gradient(135deg, #f59e0b, #d97706); }
.badge-avatar.admin { background: linear-gradient(135deg, #22c55e, #15803d); }
.badge-avatar.user { background: linear-gradient(135deg, #4ade80, #16a34a); }
.badge-name { font-size: 0.85rem; font-weight: 700; color: white; }
.badge-uname { font-size: 0.72rem; color: rgba(255,255,255,0.6); margin-top: 1px; }

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
    background: linear-gradient(135deg, #fffbeb 0%, #fef9c3 100%);
    border: 1.5px solid #fde68a; border-radius: 18px;
    padding: 20px; margin: 4px 0;
}
.password-box-label {
    display: flex; align-items: center; gap: 7px;
    font-size: 0.78rem; font-weight: 700; color: #92400e;
    margin-bottom: 16px; text-transform: uppercase; letter-spacing: 0.5px;
}
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

<div class="edit-page">
<div class="form-wrapper">
<div class="form-card">

    <div class="form-hero">
        <div class="hero-top">
            <div class="hero-left">
                <div class="hero-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <div class="hero-title">Edit Pengguna</div>
                    <div class="hero-id">ID #{{ $user->id }}</div>
                </div>
            </div>
            <div class="user-badge">
                <div class="badge-avatar {{ $user->role === 'super_admin' ? 'super' : ($user->role === 'admin' ? 'admin' : 'user') }}">
                    {{ strtoupper(substr($user->nama, 0, 1)) }}
                </div>
                <div>
                    <div class="badge-name">{{ $user->nama }}</div>
                    <div class="badge-uname">{{ $user->username }}</div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('super-admin.users.update', $user) }}" class="form-body">
        @csrf @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input id="username" name="username" type="text"
                    value="{{ old('username', $user->username) }}"
                    class="form-input @error('username') error @enderror"
                    required autofocus />
                @error('username')<p class="error-msg">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input id="nama" name="nama" type="text"
                    value="{{ old('nama', $user->nama) }}"
                    class="form-input @error('nama') error @enderror" required />
                @error('nama')<p class="error-msg">{{ $message }}</p>@enderror
            </div>

            <div class="form-group full">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="email"
                    value="{{ old('email', $user->email) }}"
                    class="form-input @error('email') error @enderror" required />
                @error('email')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="password-box" style="margin-top:20px;">
            <div class="password-box-label">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                Kosongkan jika tidak ingin mengubah password
            </div>
            <div class="password-grid">
                <div class="form-group">
                    <label for="password" class="form-label" style="color:#92400e;">Password Baru</label>
                    <input id="password" name="password" type="password"
                        placeholder="Min. 8 karakter"
                        class="password-input @error('password') error @enderror" />
                    @error('password')<p class="error-msg">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label" style="color:#92400e;">Konfirmasi</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Ulangi password baru" class="password-input" />
                </div>
            </div>
        </div>

        <div class="form-grid" style="margin-top:20px;">
            <div class="form-group">
                <label for="no_hp" class="form-label">No HP <span class="label-optional">(opsional)</span></label>
                <input id="no_hp" name="no_hp" type="text"
                    value="{{ old('no_hp', $user->no_hp) }}" placeholder="08xxxxxxxxxx"
                    class="form-input @error('no_hp') error @enderror" />
                @error('no_hp')<p class="error-msg">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Role</label>
                <select id="role" name="role" class="form-select @error('role') error @enderror" required>
                    <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
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
                Update Pengguna
            </button>
        </div>
    </form>

</div>
</div>
</div>
@endsection