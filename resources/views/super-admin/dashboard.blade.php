@extends('layouts.superadmin-app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang kembali, ' . Auth::user()->nama)

@push('styles')
<style>
    .dash-root { font-family: 'Sora', sans-serif; }

    /* ── Welcome Banner ── */
    .dash-banner {
        background: linear-gradient(130deg, #1a4d2e 0%, #2d7a4f 60%, #38a169 100%);
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        display: flex; align-items: center; justify-content: space-between;
        gap: 1rem; flex-wrap: wrap;
        position: relative; overflow: hidden;
        margin-bottom: 1.25rem;
    }
    .dash-banner::before {
        content: '';
        position: absolute; top: -40px; right: -40px;
        width: 160px; height: 160px; border-radius: 50%;
        background: rgba(255,255,255,.06); pointer-events: none;
    }
    .dash-banner::after {
        content: '';
        position: absolute; bottom: -30px; right: 60px;
        width: 100px; height: 100px; border-radius: 50%;
        background: rgba(255,255,255,.04); pointer-events: none;
    }
    .banner-left { display: flex; align-items: center; gap: .85rem; position: relative; z-index: 1; }
    .banner-avatar {
        width: 40px; height: 40px; border-radius: 50%;
        background: rgba(255,255,255,.15); border: 1.5px solid rgba(255,255,255,.25);
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .banner-title { font-size: 1rem; font-weight: 700; color: #fff; line-height: 1.3; }
    .banner-sub   { font-size: .78rem; color: rgba(255,255,255,.65); margin-top: 1px; }
    .banner-clock {
        position: relative; z-index: 1;
        display: flex; align-items: center; gap: .4rem;
        background: rgba(0,0,0,.18); border-radius: 999px;
        padding: .35rem .85rem; font-size: .75rem; color: rgba(255,255,255,.8);
    }

    /* ── Stat Cards ── */
    .stat-grid {
        display: grid; grid-template-columns: repeat(4, 1fr);
        gap: .85rem; margin-bottom: 1.25rem;
    }
    @media (max-width: 900px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 500px) { .stat-grid { grid-template-columns: 1fr; } }

    .stat-card {
        background: #fff; border-radius: 12px;
        border: 1px solid rgba(29,77,46,.09);
        padding: 1rem 1.1rem;
        box-shadow: 0 1px 6px rgba(29,77,46,.06);
        display: flex; align-items: center; gap: .9rem;
        transition: box-shadow .2s, transform .2s;
    }
    .stat-card:hover { box-shadow: 0 4px 18px rgba(29,77,46,.12); transform: translateY(-1px); }

    .stat-icon {
        width: 38px; height: 38px; border-radius: 9px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        background: #f0fdf4;
    }
    .stat-body { flex: 1; min-width: 0; }
    .stat-label { font-size: .68rem; font-weight: 600; color: #6b7f72; text-transform: uppercase; letter-spacing: .05em; }
    .stat-value { font-size: 1.55rem; font-weight: 800; color: #1a4d2e; line-height: 1.2; margin-top: 1px; }
    .stat-desc  { font-size: .68rem; color: #9aada0; margin-top: 2px; }

    /* ── Table Card ── */
    .table-card {
        background: #fff; border-radius: 14px;
        border: 1px solid rgba(29,77,46,.08);
        box-shadow: 0 1px 6px rgba(29,77,46,.06);
        overflow: hidden;
    }
    .table-hdr {
        display: flex; align-items: center; justify-content: space-between;
        padding: .9rem 1.2rem; border-bottom: 1px solid #f0fdf4;
    }
    .table-hdr-left { display: flex; align-items: center; gap: .6rem; }
    .table-hdr-icon {
        width: 30px; height: 30px; border-radius: 8px;
        background: #f0fdf4; display: flex; align-items: center; justify-content: center;
    }
    .table-hdr-title { font-size: .9rem; font-weight: 700; color: #1a4d2e; }
    .btn-view-all {
        display: inline-flex; align-items: center; gap: .3rem;
        padding: .4rem .9rem; border-radius: 8px; font-size: .75rem; font-weight: 600;
        background: #f0fdf4; color: #2d7a4f; text-decoration: none;
        border: 1px solid #d1fae5; transition: all .15s;
    }
    .btn-view-all:hover { background: #dcfce7; color: #1a4d2e; }

    /* Table */
    .dash-table { width: 100%; border-collapse: collapse; font-size: .8rem; }
    .dash-table th {
        padding: .6rem 1rem; text-align: left;
        font-size: .68rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: .06em; color: #6b7f72;
        background: #f9fafb; border-bottom: 1px solid #f0fdf4;
    }
    .dash-table td { padding: .65rem 1rem; border-bottom: 1px solid #f9fafb; color: #374151; }
    .dash-table tr:last-child td { border-bottom: none; }
    .dash-table tr:hover td { background: #fafffe; }

    .user-avatar {
        width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0;
        background: linear-gradient(135deg, #2d7a4f, #38a169);
        display: flex; align-items: center; justify-content: center;
        font-size: .72rem; font-weight: 800; color: #fff;
    }
    .user-cell { display: flex; align-items: center; gap: .6rem; }
    .user-name { font-weight: 600; color: #111827; }

    /* Role badges — all green tones */
    .badge {
        display: inline-flex; align-items: center; gap: .25rem;
        padding: .2rem .65rem; border-radius: 999px;
        font-size: .68rem; font-weight: 700;
    }
    .badge-sa { background: #1a4d2e; color: #fff; }
    .badge-admin { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .badge-user  { background: #f0fdf4; color: #4d7c5a; border: 1px solid #d1fae5; }

    .empty-state { padding: 2.5rem; text-align: center; color: #9aada0; }
    .empty-state svg { margin: 0 auto .75rem; display: block; }
</style>
@endpush

@section('content')
<div class="dash-root">

    {{-- Banner --}}
    <div class="dash-banner">
        <div class="banner-left">
            <div class="banner-avatar">
                <svg width="18" height="18" fill="none" stroke="#fff" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <div class="banner-title">Selamat Datang, {{ Auth::user()->nama }}</div>
                <div class="banner-sub">Super Administrator &mdash; Sistem Pakar Kopi</div>
            </div>
        </div>
        <div class="banner-clock">
            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 6v6l4 2"/></svg>
            <span id="realtime-clock"></span>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <svg width="18" height="18" fill="none" stroke="#2d7a4f" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20H7m10 0v-2a3 3 0 00-3-3H10a3 3 0 00-3 3v2m0 0H2v-2a3 3 0 015.356-1.857M7 20v-2m5-10a4 4 0 110-8 4 4 0 010 8z"/></svg>
            </div>
            <div class="stat-body">
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ \App\Models\User::count() }}</div>
                <div class="stat-desc">Semua pengguna</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg width="18" height="18" fill="none" stroke="#2d7a4f" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div class="stat-body">
                <div class="stat-label">Super Admin</div>
                <div class="stat-value">{{ \App\Models\User::where('role', 'super_admin')->count() }}</div>
                <div class="stat-desc">Full access</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg width="18" height="18" fill="none" stroke="#2d7a4f" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="stat-body">
                <div class="stat-label">Admin</div>
                <div class="stat-value">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
                <div class="stat-desc">Administrator</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg width="18" height="18" fill="none" stroke="#2d7a4f" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="stat-body">
                <div class="stat-label">Regular Users</div>
                <div class="stat-value">{{ \App\Models\User::where('role', 'user')->count() }}</div>
                <div class="stat-desc">Pengguna biasa</div>
            </div>
        </div>
    </div>

    {{-- Recent Users --}}
    <div class="table-card">
        <div class="table-hdr">
            <div class="table-hdr-left">
                <div class="table-hdr-icon">
                    <svg width="14" height="14" fill="none" stroke="#2d7a4f" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="table-hdr-title">Recent Users</span>
            </div>
            <a href="{{ route('super-admin.users.index') }}" class="btn-view-all">
                Lihat Semua
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Bergabung</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\User::latest()->take(5)->get() as $user)
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar">{{ strtoupper(substr($user->username, 0, 1)) }}</div>
                                <span class="user-name">{{ $user->username }}</span>
                            </div>
                        </td>
                        <td>{{ $user->nama }}</td>
                        <td style="color:#6b7280;">{{ $user->email }}</td>
                        <td>
                            @if($user->role === 'super_admin')
                                <span class="badge badge-sa">Super Admin</span>
                            @elseif($user->role === 'admin')
                                <span class="badge badge-admin">Admin</span>
                            @else
                                <span class="badge badge-user">User</span>
                            @endif
                        </td>
                        <td style="color:#6b7280; font-size:.75rem;">{{ $user->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <svg width="36" height="36" fill="none" stroke="#c4d6c8" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                Belum ada data user
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
function updateClock() {
    const now = new Date();
    const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
    document.getElementById('realtime-clock').textContent = now.toLocaleDateString('id-ID', options);
}
updateClock();
setInterval(updateClock, 1000);
</script>
@endsection