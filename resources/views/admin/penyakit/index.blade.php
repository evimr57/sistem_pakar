@extends('layouts.admin-app')

@section('page-title', 'Manajemen Penyakit')
@section('page-subtitle', 'Kelola data penyakit tanaman kopi')

@section('content')

@if(session('success'))
    <div style="margin-bottom:1.5rem; background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; padding:1rem 1.25rem; border-radius:0.75rem; display:flex; align-items:center; gap:0.75rem;">
        <svg style="width:1.25rem; height:1.25rem; flex-shrink:0;" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span style="font-weight:600; font-size:0.875rem;">{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div style="margin-bottom:1.5rem; background:#fef2f2; border:1px solid #fecaca; color:#dc2626; padding:1rem 1.25rem; border-radius:0.75rem; display:flex; align-items:center; gap:0.75rem;">
        <svg style="width:1.25rem; height:1.25rem; flex-shrink:0;" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <span style="font-weight:600; font-size:0.875rem;">{{ session('error') }}</span>
    </div>
@endif

<div style="background:white; border-radius:1.25rem; box-shadow:0 1px 4px rgba(0,0,0,0.07); border:1px solid #f0fdf4; overflow:hidden;">

    {{-- Header --}}
    <div style="padding:1.25rem 1.5rem; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
        <div style="display:flex; align-items:center; gap:0.75rem;">
            <div style="width:2.5rem; height:2.5rem; background:#dcfce7; border-radius:0.75rem; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <svg style="width:1.25rem; height:1.25rem; color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <div style="font-size:0.9rem; font-weight:700; color:#111827;">Daftar Penyakit & Hama Tanaman Kopi</div>
                <div style="font-size:0.75rem; color:#9ca3af;">Kelola data penyakit dan hama tanaman kopi</div>
            </div>
        </div>
        <a href="{{ route('admin.penyakit.create') }}"
            style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.625rem 1.25rem; background:#16a34a; color:white; font-weight:700; font-size:0.875rem; border-radius:0.75rem; text-decoration:none; white-space:nowrap;">
            <svg style="width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Data
        </a>
    </div>

    {{-- Table --}}
    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
            <thead>
                <tr style="background:#f9fafb;">
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">No</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Kode</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Gambar</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Nama Penyakit</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Nama Latin</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Kategori</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Deskripsi Singkat</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Deskripsi Lengkap</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Pencegahan</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Kimia</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Organik</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Budidaya</th>
                    <th style="padding:0.75rem 1rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Bahaya</th>
                    <th style="padding:0.75rem 1rem; text-align:center; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6; white-space:nowrap;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penyakits as $index => $penyakit)
                    <tr style="border-bottom:1px solid #f9fafb;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">

                        {{-- No --}}
                        <td style="padding:0.875rem 1rem; color:#6b7280; white-space:nowrap;">{{ $penyakits->firstItem() + $index }}</td>

                        {{-- Kode --}}
                        <td style="padding:0.875rem 1rem; white-space:nowrap;">
                            <span style="padding:0.2rem 0.6rem; font-size:0.7rem; font-weight:700; border-radius:0.375rem; background:#111827; color:white; font-family:monospace;">
                                {{ $penyakit->id_penyakit }}
                            </span>
                        </td>

                        {{-- Gambar --}}
                        <td style="padding:0.875rem 1rem;">
                            @if($penyakit->gambar_url)
                                <img src="{{ $penyakit->gambar_url }}"
                                    alt="{{ $penyakit->nama_penyakit }}"
                                    style="width:3.5rem; height:3.5rem; object-fit:cover; border-radius:0.5rem; border:1px solid #e5e7eb; cursor:pointer; transition:transform 0.15s;"
                                    onclick="openModal('{{ $penyakit->gambar_url }}', '{{ $penyakit->nama_penyakit }}')"
                                    onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                            @else
                                <div style="width:3.5rem; height:3.5rem; background:#f3f4f6; border-radius:0.5rem; display:flex; align-items:center; justify-content:center; border:1px solid #e5e7eb;">
                                    <svg style="width:1.5rem; height:1.5rem; color:#d1d5db;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>

                        {{-- Nama Penyakit --}}
                        <td style="padding:0.875rem 1rem; min-width:10rem;">
                            <div style="font-weight:700; color:#111827; font-size:0.875rem;">{{ $penyakit->nama_penyakit }}</div>
                        </td>

                        {{-- Nama Latin --}}
                        <td style="padding:0.875rem 1rem; min-width:8rem;">
                            <div style="font-size:0.8rem; color:#6b7280; font-style:italic;">{{ $penyakit->nama_latin ?? '-' }}</div>
                        </td>

                        {{-- Kategori --}}
                        <td style="padding:0.875rem 1rem; white-space:nowrap;">
                            @if($penyakit->kategori === 'Penyakit')
                                <span style="padding:0.2rem 0.65rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#14532d; color:white;">Penyakit</span>
                            @elseif($penyakit->kategori === 'Hama')
                                <span style="padding:0.2rem 0.65rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#dcfce7; color:#14532d; border:1px solid #bbf7d0;">Hama</span>
                            @else
                                <span style="padding:0.2rem 0.65rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#f3f4f6; color:#6b7280;">{{ $penyakit->kategori ?? '-' }}</span>
                            @endif
                        </td>

                        {{-- Deskripsi Singkat --}}
                        <td style="padding:0.875rem 1rem; max-width:10rem;">
                            <div style="font-size:0.8rem; color:#6b7280; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">{{ $penyakit->deskripsi_singkat ?? '-' }}</div>
                        </td>

                        {{-- Deskripsi Lengkap --}}
                        <td style="padding:0.875rem 1rem; max-width:10rem;">
                            <div style="font-size:0.8rem; color:#6b7280; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">{{ Str::limit($penyakit->deskripsi_lengkap ?? '-', 60) }}</div>
                        </td>

                        {{-- Pencegahan --}}
                        <td style="padding:0.875rem 1rem; max-width:9rem;">
                            <div style="font-size:0.8rem; color:#6b7280; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">{{ Str::limit($penyakit->pengendalian_pencegahan ?? '-', 60) }}</div>
                        </td>

                        {{-- Kimia --}}
                        <td style="padding:0.875rem 1rem; max-width:9rem;">
                            <div style="font-size:0.8rem; color:#6b7280; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">{{ Str::limit($penyakit->pengendalian_kimia ?? '-', 60) }}</div>
                        </td>

                        {{-- Organik --}}
                        <td style="padding:0.875rem 1rem; max-width:9rem;">
                            <div style="font-size:0.8rem; color:#6b7280; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">{{ Str::limit($penyakit->pengendalian_organik ?? '-', 60) }}</div>
                        </td>

                        {{-- Budidaya --}}
                        <td style="padding:0.875rem 1rem; max-width:9rem;">
                            <div style="font-size:0.8rem; color:#6b7280; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">{{ Str::limit($penyakit->pengendalian_budidaya ?? '-', 60) }}</div>
                        </td>

                        {{-- Tingkat Bahaya --}}
                        <td style="padding:0.875rem 1rem; white-space:nowrap;">
                            @if($penyakit->tingkat_bahaya === 'Sangat Tinggi')
                                <span style="padding:0.2rem 0.65rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#14532d; color:white;">Sangat Tinggi</span>
                            @elseif($penyakit->tingkat_bahaya === 'Tinggi')
                                <span style="padding:0.2rem 0.65rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#166534; color:white;">Tinggi</span>
                            @elseif($penyakit->tingkat_bahaya === 'Sedang')
                                <span style="padding:0.2rem 0.65rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#dcfce7; color:#15803d; border:1px solid #bbf7d0;">Sedang</span>
                            @elseif($penyakit->tingkat_bahaya === 'Rendah')
                                <span style="padding:0.2rem 0.65rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#f0fdf4; color:#166534; border:1px solid #bbf7d0;">Rendah</span>
                            @else
                                <span style="font-size:0.8rem; color:#9ca3af;">{{ $penyakit->tingkat_bahaya ?? '-' }}</span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td style="padding:0.875rem 1rem; text-align:center; white-space:nowrap;">
                            <div style="display:inline-flex; align-items:center; gap:0.5rem;">
                                <a href="{{ route('admin.penyakit.edit', $penyakit) }}"
                                    style="display:inline-flex; align-items:center; gap:0.375rem; padding:0.4rem 0.875rem; background:#f0fdf4; color:#16a34a; font-size:0.75rem; font-weight:600; border-radius:0.5rem; border:1px solid #bbf7d0; text-decoration:none;">
                                    <svg style="width:0.875rem; height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.penyakit.destroy', $penyakit) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="display:inline-flex; align-items:center; gap:0.375rem; padding:0.4rem 0.875rem; background:#fef2f2; color:#dc2626; font-size:0.75rem; font-weight:600; border-radius:0.5rem; border:1px solid #fecaca; cursor:pointer;">
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
                        <td colspan="14" style="padding:3rem; text-align:center; color:#9ca3af;">
                            <svg style="width:3rem; height:3rem; margin:0 auto 1rem; color:#d1fae5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 006.586 13H4"/>
                            </svg>
                            <p style="font-size:1rem; font-weight:600; color:#374151; margin-bottom:0.25rem;">Belum ada data</p>
                            <p style="font-size:0.8rem;">Klik tombol "Tambah Data" untuk menambahkan penyakit atau hama</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div style="padding:1rem 1.5rem; border-top:1px solid #f3f4f6;">
        {{ $penyakits->links() }}
    </div>

</div>

{{-- Image Modal --}}
<div id="imageModal"
    style="display:none; position:fixed; inset:0; z-index:50; background:rgba(0,0,0,0.75); align-items:center; justify-content:center; padding:1rem;"
    onclick="closeModal()">
    <div style="position:relative; max-width:56rem; max-height:100%;" onclick="event.stopPropagation()">
        <button onclick="closeModal()"
            style="position:absolute; top:-3rem; right:0; background:none; border:none; color:white; cursor:pointer;">
            <svg style="width:2.5rem; height:2.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="modalImage" src="" alt=""
            style="max-width:100%; max-height:80vh; object-fit:contain; border-radius:0.75rem; box-shadow:0 25px 50px rgba(0,0,0,0.5);">
        <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding:1rem; border-radius:0 0 0.75rem 0.75rem;">
            <p id="modalTitle" style="color:white; font-size:1rem; font-weight:600;"></p>
        </div>
    </div>
</div>

<script>
    function openModal(imageUrl, title) {
        document.getElementById('modalImage').src = imageUrl;
        document.getElementById('modalTitle').textContent = title;
        const modal = document.getElementById('imageModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
</script>

@endsection