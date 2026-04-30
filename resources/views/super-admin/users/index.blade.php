@extends('layouts.superadmin-app')

@section('page-title', 'Management Account')
@section('page-subtitle', 'Kelola semua akun pengguna sistem')

@section('content')
<style>
.users-page { font-family: 'Sora', sans-serif; }

.alert {
    display: flex; align-items: center; gap: 10px;
    padding: 11px 16px; border-radius: 10px; margin-bottom: 1rem;
    font-size: .82rem; font-weight: 600;
}
.alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
.alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }

.table-card {
    background: #fff; border-radius: 14px;
    border: 1px solid rgba(29,77,46,.09);
    box-shadow: 0 1px 6px rgba(29,77,46,.06);
    overflow: hidden;
}
.table-card-hdr {
    display: flex; align-items: center; justify-content: space-between;
    padding: .85rem 1.2rem; border-bottom: 1px solid #f0fdf4;
}
.table-card-hdr-left { display: flex; align-items: center; gap: .6rem; }
.table-card-title { font-size: .9rem; font-weight: 700; color: #1a4d2e; }
.count-badge {
    background: #f0fdf4; color: #2d7a4f; border: 1px solid #d1fae5;
    font-size: .68rem; font-weight: 700; padding: 2px 9px; border-radius: 999px;
}
.btn-add {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .45rem 1rem; border-radius: 8px; font-size: .78rem; font-weight: 700;
    background: linear-gradient(135deg, #2d7a4f, #16a34a);
    color: #fff; text-decoration: none;
    box-shadow: 0 2px 8px rgba(22,163,74,.25); transition: all .2s;
}
.btn-add:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(22,163,74,.35); color: #fff; }

.dash-table { width: 100%; border-collapse: collapse; font-size: .8rem; }
.dash-table th {
    padding: .6rem 1rem; text-align: left;
    font-size: .67rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: .06em; color: #6b7f72;
    background: #f9fafb; border-bottom: 1px solid #f0fdf4;
}
.dash-table td { padding: .65rem 1rem; border-bottom: 1px solid #f9fafb; color: #374151; vertical-align: middle; }
.dash-table tr:last-child td { border-bottom: none; }
.dash-table tr:hover td { background: #fafffe; }

.user-cell { display: flex; align-items: center; gap: .6rem; }
.user-avatar {
    width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg, #2d7a4f, #38a169);
    display: flex; align-items: center; justify-content: center;
    font-size: .72rem; font-weight: 800; color: #fff;
}
.user-name  { font-weight: 600; color: #111827; font-size: .82rem; }
.user-uname { font-size: .7rem; color: #9aada0; }

.badge {
    display: inline-flex; align-items: center;
    padding: .2rem .65rem; border-radius: 999px;
    font-size: .68rem; font-weight: 700;
}
.badge-sa    { background: #1a4d2e; color: #fff; }
.badge-admin { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
.badge-user  { background: #f0fdf4; color: #4d7c5a; border: 1px solid #d1fae5; }

.btn-edit {
    display: inline-flex; align-items: center; gap: 4px;
    padding: .3rem .7rem; border-radius: 7px; font-size: .74rem; font-weight: 600;
    background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0;
    text-decoration: none; transition: all .15s; cursor: pointer;
}
.btn-edit:hover { background: #16a34a; color: #fff; border-color: #16a34a; }
.btn-delete {
    display: inline-flex; align-items: center; gap: 4px;
    padding: .3rem .7rem; border-radius: 7px; font-size: .74rem; font-weight: 600;
    background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;
    transition: all .15s; cursor: pointer;
}
.btn-delete:hover { background: #dc2626; color: #fff; border-color: #dc2626; }

.row-num { font-size: .75rem; color: #c4d6c8; font-weight: 600; }
.cell-muted { color: #c4d6c8; }

.empty-state { padding: 2.5rem; text-align: center; }
.empty-state svg { margin: 0 auto .6rem; display: block; }
.empty-state p { color: #9aada0; font-size: .82rem; }

.pagination-wrap { padding: .85rem 1.2rem; border-top: 1px solid #f0fdf4; }
</style>

<div class="users-page">

    @if(session('success'))
    <div class="alert alert-success">
        <svg width="15" height="15" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-error">
        <svg width="15" height="15" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
        {{ session('error') }}
    </div>
    @endif

    <div class="table-card">
        <div class="table-card-hdr">
            <div class="table-card-hdr-left">
                <span class="table-card-title">Daftar Pengguna</span>
                <span class="count-badge">{{ $users->total() }} total</span>
            </div>
            <a href="{{ route('super-admin.users.create') }}" class="btn-add">
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Pengguna
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table class="dash-table">
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
                    @forelse($users as $user)
                    <tr>
                        <td><span class="row-num">{{ $loop->iteration }}</span></td>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar">{{ strtoupper(substr($user->nama, 0, 1)) }}</div>
                                <div>
                                    <div class="user-name">{{ $user->nama }}</div>
                                    <div class="user-uname">{{ $user->username }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="color:#6b7280;">{{ $user->email }}</td>
                        <td><span class="{{ !$user->no_hp ? 'cell-muted' : '' }}">{{ $user->no_hp ?? '—' }}</span></td>
                        <td>
                            @if($user->role === 'super_admin')
                                <span class="badge badge-sa">Super Admin</span>
                            @elseif($user->role === 'admin')
                                <span class="badge badge-admin">Admin</span>
                            @else
                                <span class="badge badge-user">User</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.4rem;">
                                <a href="{{ route('super-admin.users.edit', $user) }}" class="btn-edit">
                                    <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('super-admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus {{ $user->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
                                <svg width="36" height="36" fill="none" stroke="#c4d6c8" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
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