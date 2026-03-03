@extends('layouts.superadmin-app')

@section('page-title', 'Management Account')
@section('page-subtitle', 'Kelola semua akun pengguna sistem')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

.users-page * { font-family: 'Plus Jakarta Sans', sans-serif; }

.alert-success {
    display: flex; align-items: center; gap: 12px;
    background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
    border: 1px solid #6ee7b7; color: #065f46;
    padding: 14px 20px; border-radius: 16px; margin-bottom: 20px;
    animation: slideDown 0.4s ease;
}
.alert-error {
    display: flex; align-items: center; gap: 12px;
    background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
    border: 1px solid #f87171; color: #7f1d1d;
    padding: 14px 20px; border-radius: 16px; margin-bottom: 20px;
    animation: slideDown 0.4s ease;
}
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.btn-add {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 22px;
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    color: white; font-weight: 700; font-size: 0.85rem;
    border-radius: 14px; text-decoration: none;
    box-shadow: 0 4px 15px rgba(22, 163, 74, 0.35);
    transition: all 0.3s ease; letter-spacing: 0.2px;
}
.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(22, 163, 74, 0.45);
    color: white;
}
.btn-add svg { width: 16px; height: 16px; }

.table-card {
    background: white; border-radius: 24px;
    border: 1px solid #dcfce7;
    box-shadow: 0 4px 24px rgba(22, 163, 74, 0.08);
    overflow: hidden;
}
.table-card-header {
    padding: 22px 28px; border-bottom: 1px solid #f0fdf4;
    display: flex; align-items: center; justify-content: space-between;
}
.table-card-header-left { display: flex; align-items: center; gap: 12px; }
.table-card-header h3 { font-size: 1rem; font-weight: 700; color: #14532d; }
.header-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
}
.count-badge {
    background: #dcfce7; color: #15803d;
    font-size: 0.72rem; font-weight: 700;
    padding: 3px 10px; border-radius: 20px;
}

table { width: 100%; border-collapse: collapse; }
thead tr { background: #f0fdf4; }
thead th {
    padding: 12px 20px; text-align: left;
    font-size: 0.72rem; font-weight: 700; color: #4ade80;
    text-transform: uppercase; letter-spacing: 0.8px;
    border-bottom: 1px solid #dcfce7;
}
tbody tr { border-bottom: 1px solid #f7fef9; transition: background 0.15s ease; }
tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: #f0fdf4; }
td { padding: 16px 20px; }

.user-cell { display: flex; align-items: center; gap: 12px; }
.avatar {
    width: 40px; height: 40px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.9rem; font-weight: 800; color: white; flex-shrink: 0;
}
.avatar.super { background: linear-gradient(135deg, #fbbf24, #d97706); }
.avatar.admin { background: linear-gradient(135deg, #22c55e, #15803d); }
.avatar.user { background: linear-gradient(135deg, #60a5fa, #2563eb); }
.user-name { font-size: 0.88rem; font-weight: 700; color: #14532d; }
.user-uname { font-size: 0.75rem; color: #86efac; margin-top: 1px; }

.cell-text { font-size: 0.85rem; color: #4b5563; }
.cell-muted { color: #9ca3af; }

.badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 5px 12px; border-radius: 20px;
    font-size: 0.72rem; font-weight: 700; letter-spacing: 0.3px;
}
.badge-super { background: #fef9c3; color: #854d0e; }
.badge-super .dot { background: #ca8a04; }
.badge-admin { background: #dcfce7; color: #15803d; }
.badge-admin .dot { background: #16a34a; }
.badge-user { background: #eff6ff; color: #1d4ed8; }
.badge-user .dot { background: #3b82f6; }
.badge .dot { width: 6px; height: 6px; border-radius: 50%; }

.actions { display: flex; align-items: center; gap: 8px; }
.btn-edit {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 7px 14px; border-radius: 10px;
    font-size: 0.78rem; font-weight: 600;
    background: #dcfce7; color: #15803d;
    text-decoration: none; transition: all 0.2s ease;
    border: none; cursor: pointer;
}
.btn-edit:hover { background: #16a34a; color: white; }
.btn-delete {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 7px 14px; border-radius: 10px;
    font-size: 0.78rem; font-weight: 600;
    background: #fef2f2; color: #dc2626;
    text-decoration: none; transition: all 0.2s ease;
    border: none; cursor: pointer;
}
.btn-delete:hover { background: #dc2626; color: white; }
.btn-edit svg, .btn-delete svg { width: 13px; height: 13px; }

.empty-state { padding: 60px 20px; text-align: center; }
.empty-state svg { width: 56px; height: 56px; color: #bbf7d0; margin: 0 auto 12px; display: block; }
.empty-state p { color: #86efac; font-weight: 600; }

.row-num { font-size: 0.8rem; font-weight: 600; color: #bbf7d0; }

.pagination-wrap { padding: 16px 28px; border-top: 1px solid #dcfce7; }
</style>

<div class="users-page">

    @if (session('success'))
    <div class="alert-success">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <span style="font-weight:600; font-size:0.9rem;">{{ session('success') }}</span>
    </div>
    @endif
    @if (session('error'))
    <div class="alert-error">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
        <span style="font-weight:600; font-size:0.9rem;">{{ session('error') }}</span>
    </div>
    @endif

    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-header-left">
                <div class="header-dot"></div>
                <h3>Daftar Pengguna</h3>
                <span class="count-badge">{{ $users->total() }} total</span>
            </div>
            <a href="{{ route('super-admin.users.create') }}" class="btn-add">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah Pengguna
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td><span class="row-num">{{ $loop->iteration }}</span></td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar {{ $user->role === 'super_admin' ? 'super' : ($user->role === 'admin' ? 'admin' : 'user') }}">
                                    {{ strtoupper(substr($user->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $user->nama }}</div>
                                    <div class="user-uname">{{ $user->username }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="cell-text">{{ $user->email }}</span></td>
                        <td><span class="cell-text {{ !$user->no_hp ? 'cell-muted' : '' }}">{{ $user->no_hp ?? '—' }}</span></td>
                        <td>
                            @if($user->role === 'super_admin')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow-md">
                                    ⭐ Super Admin
                                </span>
                            @elseif($user->role === 'admin')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gradient-to-r from-green-500 to-green-600 text-white shadow-md">
                                    👤 Admin
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gradient-to-r from-blue-400 to-blue-500 text-white shadow-md">
                                    👥 User
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('super-admin.users.edit', $user) }}" class="btn-edit">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('super-admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus {{ $user->nama }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p>Belum ada data pengguna</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div class="pagination-wrap">{{ $users->links() }}</div>
        @endif
    </div>

</div>
@endsection