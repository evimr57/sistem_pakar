@extends(
    auth()->user()->role === 'super_admin' ? 'layouts.superadmin-app' :
    (auth()->user()->role === 'admin' ? 'layouts.admin-app' : 'layouts.user-app')
)

@section('page-title', 'Profile Settings')
@section('page-subtitle', 'Kelola informasi profil Anda')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --green-deep:  #1a4d2e;
        --green-mid:   #2d7a4f;
        --green-bright:#4ade80;
        --bg-base:     #f0f5f1;
        --bg-card:     #ffffff;
        --text-primary:#0f1f14;
        --text-muted:  #6b7f72;
        --shadow:      0 4px 24px rgba(29,77,46,.08), 0 1px 4px rgba(29,77,46,.05);
        --radius:      20px;
        --input-border:#d1d5db;
        --input-focus: #2d7a4f;
    }
    body, .profile-root { font-family: 'Plus Jakarta Sans', sans-serif; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(12px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .anim { animation: fadeUp .5s cubic-bezier(.22,1,.36,1) both; }
    .a1 { animation-delay:.04s; }
    .a2 { animation-delay:.12s; }
    .a3 { animation-delay:.20s; }

    /* ── card ── */
    .profile-card {
        background: var(--bg-card);
        border-radius: var(--radius);
        border: 1.5px solid rgba(29,77,46,.07);
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }
    .profile-card.danger {
        border-color: #fecaca;
    }

    /* ── card header ── */
    .card-hdr {
        display: flex; align-items: center; gap: .65rem;
        padding: 1.1rem 1.75rem;
        border-bottom: 1.5px solid rgba(29,77,46,.07);
    }
    .card-hdr.danger-hdr { border-bottom-color: #fecaca; }
    .card-hdr-icon {
        width: 34px; height: 34px; border-radius: 10px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
    }
    .icon-green { background: #dcfce7; }
    .icon-slate { background: #f1f5f9; }
    .icon-red   { background: #fee2e2; }
    .card-hdr-title { font-size: .92rem; font-weight: 700; color: var(--text-primary); letter-spacing: -.01em; }
    .card-hdr-sub   { font-size: .73rem; color: var(--text-muted); margin-top: 1px; }

    /* ── form body ── */
    .card-body { padding: 1.5rem 1.75rem; }

    /* ── section title ── */
    .form-section-title {
        display: flex; align-items: center; gap: .5rem;
        font-size: .72rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: .08em; color: var(--text-muted);
        margin-bottom: 1.1rem; padding-bottom: .55rem;
        border-bottom: 1.5px solid rgba(29,77,46,.07);
    }
    .section-bar { width: 3px; height: 13px; border-radius: 2px; flex-shrink: 0; background: linear-gradient(180deg, var(--green-mid), var(--green-bright)); }
    .section-bar.red { background: linear-gradient(180deg, #ef4444, #f87171); }

    /* ── alert ── */
    .alert {
        display: flex; align-items: center; gap: .65rem;
        padding: .8rem 1rem; margin-bottom: 1.25rem;
        border-radius: 12px; font-size: .82rem; font-weight: 600;
    }
    .alert-success { background: #f0fdf4; border: 1.5px solid #bbf7d0; color: #166534; }
    .alert svg { flex-shrink: 0; }

    /* ── form fields ── */
    .field { margin-bottom: 1.1rem; }
    .field:last-of-type { margin-bottom: 0; }
    .form-label { display: block; font-size: .8rem; font-weight: 700; color: var(--text-primary); margin-bottom: .4rem; }
    .form-input {
        width: 100%; padding: .68rem 1rem;
        border: 1.5px solid var(--input-border); border-radius: 12px;
        font-size: .85rem; font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-primary); background: #fafafa; outline: none;
        transition: border-color .18s, box-shadow .18s, background .18s;
    }
    .form-input:focus {
        border-color: var(--input-focus); background: #fff;
        box-shadow: 0 0 0 3px rgba(45,122,79,.1);
    }
    .form-input.input-slate:focus {
        border-color: #64748b;
        box-shadow: 0 0 0 3px rgba(100,116,139,.1);
    }
    .form-error { font-size: .72rem; color: #ef4444; margin-top: .3rem; }
    .form-hint  { font-size: .72rem; color: var(--text-muted); margin-top: .3rem; }

    /* ── verify email notice ── */
    .verify-notice {
        margin-top: .55rem; padding: .65rem .9rem;
        background: #fefce8; border: 1px solid #fde68a; border-radius: 10px;
        font-size: .75rem; color: #a16207;
    }
    .verify-notice button { background: none; border: none; cursor: pointer; color: #ca8a04; font-weight: 700; text-decoration: underline; font-size: .75rem; font-family: 'Plus Jakarta Sans', sans-serif; }

    /* ── buttons ── */
    .btn-submit {
        display: inline-flex; align-items: center; gap: .45rem;
        padding: .65rem 1.35rem;
        background: linear-gradient(135deg, #2d7a4f, #16a34a);
        color: #fff; font-size: .83rem; font-weight: 700;
        border-radius: 12px; border: none; cursor: pointer;
        box-shadow: 0 4px 14px rgba(22,163,74,.25);
        transition: all .18s; font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(22,163,74,.35); }

    .btn-submit-slate {
        display: inline-flex; align-items: center; gap: .45rem;
        padding: .65rem 1.35rem;
        background: #0f172a;
        color: #fff; font-size: .83rem; font-weight: 700;
        border-radius: 12px; border: none; cursor: pointer;
        box-shadow: 0 4px 14px rgba(15,23,42,.15);
        transition: all .18s; font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-submit-slate:hover { background: #1e293b; transform: translateY(-1px); }

    .btn-danger {
        display: inline-flex; align-items: center; gap: .45rem;
        padding: .65rem 1.35rem;
        background: #fff5f5; color: #dc2626;
        border: 1.5px solid #fecaca;
        font-size: .83rem; font-weight: 700;
        border-radius: 12px; cursor: pointer;
        transition: all .18s; font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-danger:hover { background: #fee2e2; border-color: #dc2626; }

    /* ── danger section ── */
    .danger-desc {
        font-size: .82rem; color: var(--text-muted);
        line-height: 1.6; margin-bottom: 1.25rem;
        padding: .8rem 1rem; background: #fff5f5;
        border-radius: 10px; border: 1px solid #fecaca;
    }
</style>
@endpush

@section('content')
<div class="profile-root">

    {{-- ── Profile Information ── --}}
    <div class="profile-card anim a1">
        <div class="card-hdr">
            <div class="card-hdr-icon icon-green">
                <svg width="16" height="16" fill="none" stroke="#2d7a4f" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <div class="card-hdr-title">Profile Information</div>
                <div class="card-hdr-sub">Perbarui informasi profil dan alamat email akun Anda</div>
            </div>
        </div>
        <div class="card-body">

            @if(session('status') === 'profile-updated')
                <div class="alert alert-success">
                    <svg width="15" height="15" fill="none" stroke="#16a34a" viewBox="0 0 24 24" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Profile berhasil diperbarui!
                </div>
            @endif

            <div class="form-section-title">
                <div class="section-bar"></div>
                Informasi Akun
            </div>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="field">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" class="form-input" required>
                    @error('username') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" class="form-input" required>
                    @error('nama') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" required>
                    @error('email') <p class="form-error">{{ $message }}</p> @enderror
                    @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div class="verify-notice">
                            Alamat email Anda belum diverifikasi.
                            <button form="send-verification">Kirim ulang email verifikasi.</button>
                        </div>
                    @endif
                </div>

                <div class="field" style="margin-bottom:1.5rem;">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="form-input" placeholder="08123456789">
                    @error('no_hp') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn-submit">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

    {{-- ── Update Password ── --}}
    <div class="profile-card anim a2">
        <div class="card-hdr">
            <div class="card-hdr-icon icon-slate">
                <svg width="16" height="16" fill="none" stroke="#475569" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <div>
                <div class="card-hdr-title">Update Password</div>
                <div class="card-hdr-sub">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak</div>
            </div>
        </div>
        <div class="card-body">

            @if(session('status') === 'password-updated')
                <div class="alert alert-success">
                    <svg width="15" height="15" fill="none" stroke="#16a34a" viewBox="0 0 24 24" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Password berhasil diperbarui!
                </div>
            @endif

            <div class="form-section-title">
                <div class="section-bar" style="background:linear-gradient(180deg,#475569,#94a3b8);"></div>
                Ganti Password
            </div>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="field">
                    <label for="current_password" class="form-label">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" class="form-input input-slate" autocomplete="current-password">
                    @error('current_password', 'updatePassword') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" id="password" name="password" class="form-input input-slate" autocomplete="new-password">
                    @error('password', 'updatePassword') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="field" style="margin-bottom:1.5rem;">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input input-slate" autocomplete="new-password">
                    @error('password_confirmation', 'updatePassword') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn-submit-slate">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Update Password
                </button>
            </form>
        </div>
    </div>

    {{-- ── Delete Account ── --}}
    <div class="profile-card danger anim a3">
        <div class="card-hdr danger-hdr">
            <div class="card-hdr-icon icon-red">
                <svg width="16" height="16" fill="none" stroke="#dc2626" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <div class="card-hdr-title" style="color:#dc2626;">Hapus Akun</div>
                <div class="card-hdr-sub">Tindakan ini tidak dapat dibatalkan</div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-section-title">
                <div class="section-bar red"></div>
                Zona Berbahaya
            </div>
            <div class="danger-desc">
                Setelah akun dihapus, semua data dan resource yang terkait akan dihapus secara permanen. Pastikan Anda telah mengunduh semua data yang diperlukan sebelum melanjutkan.
            </div>
            <button type="button" class="btn-danger"
                onclick="if(confirm('Yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.')) { document.getElementById('delete-account-form').submit(); }">
                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Hapus Akun
            </button>
            <form id="delete-account-form" method="post" action="{{ route('profile.destroy') }}" class="hidden">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>

</div>
@endsection