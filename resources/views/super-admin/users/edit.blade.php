@extends('layouts.superadmin-app')

@section('page-title', 'Edit Pengguna')
@section('page-subtitle', 'Ubah data akun: ' . $user->nama)

@section('content')
<style>
.form-page { font-family: 'Sora', sans-serif; }

.form-wrapper { max-width: 640px; margin: 0 auto; }

.form-card {
    background: #fff; border-radius: 14px;
    border: 1px solid rgba(29,77,46,.09);
    box-shadow: 0 1px 6px rgba(29,77,46,.06);
    overflow: hidden;
}

.form-hdr {
    padding: 1.1rem 1.4rem;
    background: linear-gradient(130deg, #1a4d2e 0%, #2d7a4f 60%, #38a169 100%);
    display: flex; align-items: center; justify-content: space-between; gap: 1rem;
    position: relative; overflow: hidden;
}
.form-hdr::before {
    content: ''; position: absolute; top: -30px; right: -30px;
    width: 120px; height: 120px; border-radius: 50%;
    background: rgba(255,255,255,.06); pointer-events: none;
}
.form-hdr-left { display: flex; align-items: center; gap: .75rem; position: relative; z-index: 1; }
.form-hdr-icon {
    width: 36px; height: 36px; border-radius: 9px; flex-shrink: 0;
    background: rgba(255,255,255,.15);
    display: flex; align-items: center; justify-content: center;
}
.form-hdr-title { font-size: .95rem; font-weight: 700; color: #fff; }
.form-hdr-sub   { font-size: .72rem; color: rgba(255,255,255,.6); margin-top: 1px; }

.user-chip {
    display: flex; align-items: center; gap: .55rem;
    background: rgba(0,0,0,.18); border-radius: 999px;
    padding: .35rem .75rem .35rem .45rem;
    position: relative; z-index: 1; flex-shrink: 0;
}
.chip-avatar {
    width: 26px; height: 26px; border-radius: 50%; flex-shrink: 0;
    background: rgba(255,255,255,.25);
    display: flex; align-items: center; justify-content: center;
    font-size: .7rem; font-weight: 800; color: #fff;
}
.chip-name  { font-size: .78rem; font-weight: 600; color: #fff; }
.chip-uname { font-size: .68rem; color: rgba(255,255,255,.55); }

.form-body { padding: 1.4rem; }

.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.form-group { display: flex; flex-direction: column; gap: 5px; }
.form-group.full { grid-column: 1 / -1; }

.form-label {
    font-size: .72rem; font-weight: 700; color: #374151;
    text-transform: uppercase; letter-spacing: .05em;
}
.label-opt { font-size: .7rem; font-weight: 400; color: #9ca3af; text-transform: none; letter-spacing: 0; }

.form-input, .form-select {
    width: 100%; padding: .6rem .85rem;
    border: 1.5px solid #e5e7eb; border-radius: 9px;
    font-size: .82rem; color: #111827; background: #fafafa;
    transition: all .2s; outline: none;
    font-family: 'Sora', sans-serif;
}
.form-input:focus, .form-select:focus {
    border-color: #16a34a; background: #fff;
    box-shadow: 0 0 0 3px rgba(22,163,74,.08);
}
.form-input.is-error, .form-select.is-error { border-color: #ef4444; background: #fff5f5; }
.form-input::placeholder { color: #c4c4cc; }

.form-select {
    appearance: none; cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2316a34a'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 10px center;
    background-size: 14px; padding-right: 36px;
}

.error-msg { font-size: .72rem; color: #ef4444; font-weight: 500; }

.password-box {
    background: #f9fafb; border: 1.5px solid #e5e7eb; border-radius: 10px;
    padding: 1rem; margin-top: 1rem;
}
.password-box-label {
    display: flex; align-items: center; gap: .4rem;
    font-size: .72rem; font-weight: 700; color: #6b7280;
    text-transform: uppercase; letter-spacing: .05em; margin-bottom: .75rem;
}
.password-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

.divider { height: 1px; background: #f0fdf4; margin: 1.2rem 0; }

.form-actions { display: flex; align-items: center; justify-content: space-between; }
.btn-cancel {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .55rem 1rem; border-radius: 8px; font-size: .8rem; font-weight: 600;
    color: #6b7280; background: #f9fafb; border: 1.5px solid #e5e7eb;
    text-decoration: none; transition: all .15s;
}
.btn-cancel:hover { background: #f3f4f6; color: #374151; }
.btn-submit {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .6rem 1.2rem; border-radius: 8px; font-size: .82rem; font-weight: 700;
    background: linear-gradient(135deg, #2d7a4f, #16a34a);
    color: #fff; border: none; cursor: pointer;
    box-shadow: 0 2px 8px rgba(22,163,74,.3); transition: all .2s;
    font-family: 'Sora', sans-serif;
}
.btn-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(22,163,74,.4); }
</style>

<div class="form-page">
<div class="form-wrapper">
<div class="form-card">

    <div class="form-hdr">
        <div class="form-hdr-left">
            <div class="form-hdr-icon">
                <svg width="16" height="16" fill="none" stroke="#fff" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <div>
                <div class="form-hdr-title">Edit Pengguna</div>
                <div class="form-hdr-sub">ID #{{ $user->id }}</div>
            </div>
        </div>
        <div class="user-chip">
            <div class="chip-avatar">{{ strtoupper(substr($user->nama, 0, 1)) }}</div>
            <div>
                <div class="chip-name">{{ $user->nama }}</div>
                <div class="chip-uname">{{ $user->username }}</div>
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
                    class="form-input @error('username') is-error @enderror"
                    required autofocus />
                @error('username')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input id="nama" name="nama" type="text"
                    value="{{ old('nama', $user->nama) }}"
                    class="form-input @error('nama') is-error @enderror" required />
                @error('nama')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
            <div class="form-group full">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="email"
                    value="{{ old('email', $user->email) }}"
                    class="form-input @error('email') is-error @enderror" required />
                @error('email')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="password-box">
            <div class="password-box-label">
                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                Kosongkan jika tidak ingin mengubah password
            </div>
            <div class="password-grid">
                <div class="form-group">
                    <label for="password" class="form-label">Password Baru</label>
                    <input id="password" name="password" type="password"
                        placeholder="Min. 8 karakter"
                        class="form-input @error('password') is-error @enderror" />
                    @error('password')<p class="error-msg">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Ulangi password baru" class="form-input" />
                </div>
            </div>
        </div>

        <div class="form-grid" style="margin-top:1rem;">
            <div class="form-group">
                <label for="no_hp" class="form-label">No HP <span class="label-opt">(opsional)</span></label>
                <input id="no_hp" name="no_hp" type="text"
                    value="{{ old('no_hp', $user->no_hp) }}" placeholder="08xxxxxxxxxx"
                    class="form-input @error('no_hp') is-error @enderror" />
                @error('no_hp')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label for="role" class="form-label">Role</label>
                <select id="role" name="role" class="form-select @error('role') is-error @enderror" required>
                    <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="divider"></div>

        <div class="form-actions">
            <a href="{{ route('super-admin.users.index') }}" class="btn-cancel">
                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Batal
            </a>
            <button type="submit" class="btn-submit">
                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Update Pengguna
            </button>
        </div>
    </form>

</div>
</div>
</div>
@endsection