@extends('layouts.admin-app')

@section('page-title', 'Artikel Hama & Penyakit')
@section('page-subtitle', 'Kelola informasi hama dan penyakit kopi')

@section('content')

@if(session('success'))
    <div style="margin-bottom:1.5rem; background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; padding:1rem 1.25rem; border-radius:0.75rem; display:flex; align-items:center; gap:0.75rem;">
        <svg style="width:1.25rem; height:1.25rem; flex-shrink:0;" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span style="font-weight:600; font-size:0.875rem;">{{ session('success') }}</span>
    </div>
@endif

<div style="background:white; border-radius:1.25rem; box-shadow:0 1px 4px rgba(0,0,0,0.07); border:1px solid #f0fdf4; overflow:hidden;">

    {{-- Header --}}
    <div style="padding:1.25rem 1.5rem; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
        <div style="display:flex; align-items:center; gap:0.75rem;">
            <div style="width:2.5rem; height:2.5rem; background:#dcfce7; border-radius:0.75rem; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <svg style="width:1.25rem; height:1.25rem; color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <div>
                <div style="font-size:0.9rem; font-weight:700; color:#111827;">Daftar Artikel Hama & Penyakit</div>
                <div style="font-size:0.75rem; color:#9ca3af;">Kelola artikel informasi hama dan penyakit tanaman kopi</div>
            </div>
        </div>
        <a href="{{ route('admin.artikel-hama-penyakit.create') }}"
            style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.625rem 1.25rem; background:#16a34a; color:white; font-weight:700; font-size:0.875rem; border-radius:0.75rem; text-decoration:none; transition:background 0.15s; white-space:nowrap;">
            <svg style="width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Artikel
        </a>
    </div>

    {{-- Table --}}
    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
            <thead>
                <tr style="background:#f9fafb;">
                    <th style="padding:0.875rem 1.25rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">No</th>
                    <th style="padding:0.875rem 1.25rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">Judul</th>
                    <th style="padding:0.875rem 1.25rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">Jenis</th>
                    <th style="padding:0.875rem 1.25rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">Status</th>
                    <th style="padding:0.875rem 1.25rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">Tanggal</th>
                    <th style="padding:0.875rem 1.25rem; text-align:center; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($artikels as $index => $artikel)
                    <tr style="border-bottom:1px solid #f9fafb; transition:background 0.1s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">
                        <td style="padding:1rem 1.25rem; color:#6b7280;">{{ $artikels->firstItem() + $index }}</td>
                        <td style="padding:1rem 1.25rem;">
                            <div style="font-weight:600; color:#111827;">{{ $artikel->judul }}</div>
                            @if($artikel->deskripsi_singkat)
                                <div style="font-size:0.75rem; color:#9ca3af; margin-top:0.2rem;">{{ Str::limit($artikel->deskripsi_singkat, 60) }}</div>
                            @endif
                        </td>
                        <td style="padding:1rem 1.25rem;">
                            @if($artikel->jenis === 'Hama')
                                <span style="padding:0.25rem 0.75rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#dcfce7; color:#14532d; border:1px solid #bbf7d0;">Hama</span>
                            @else
                                <span style="padding:0.25rem 0.75rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#f0fdf4; color:#166534; border:1px solid #bbf7d0;">Penyakit</span>
                            @endif
                        </td>
                        <td style="padding:1rem 1.25rem;">
                            @if($artikel->is_published)
                                <span style="padding:0.25rem 0.75rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#16a34a; color:white;">Published</span>
                            @else
                                <span style="padding:0.25rem 0.75rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#f3f4f6; color:#6b7280;">Draft</span>
                            @endif
                        </td>
                        <td style="padding:1rem 1.25rem; color:#6b7280;">{{ $artikel->created_at->format('d M Y') }}</td>
                        <td style="padding:1rem 1.25rem; text-align:center;">
                            <div style="display:inline-flex; align-items:center; gap:0.5rem;">
                                <a href="{{ route('admin.artikel-hama-penyakit.edit', $artikel) }}"
                                    style="display:inline-flex; align-items:center; gap:0.375rem; padding:0.4rem 0.875rem; background:#f0fdf4; color:#16a34a; font-size:0.75rem; font-weight:600; border-radius:0.5rem; border:1px solid #bbf7d0; text-decoration:none; transition:background 0.15s;">
                                    <svg style="width:0.875rem; height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.artikel-hama-penyakit.destroy', $artikel) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="display:inline-flex; align-items:center; gap:0.375rem; padding:0.4rem 0.875rem; background:#fef2f2; color:#dc2626; font-size:0.75rem; font-weight:600; border-radius:0.5rem; border:1px solid #fecaca; cursor:pointer; transition:background 0.15s;">
                                        <svg style="width:0.875rem; height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:3rem; text-align:center; color:#9ca3af;">
                            <svg style="width:3rem; height:3rem; margin:0 auto 1rem; color:#d1fae5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 006.586 13H4"/>
                            </svg>
                            <p style="font-size:1rem; font-weight:600; color:#374151; margin-bottom:0.25rem;">Belum ada artikel hama & penyakit</p>
                            <p style="font-size:0.8rem;">Mulai tambahkan artikel baru</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding:1rem 1.5rem; border-top:1px solid #f3f4f6;">
        {{ $artikels->links() }}
    </div>

</div>
@endsection