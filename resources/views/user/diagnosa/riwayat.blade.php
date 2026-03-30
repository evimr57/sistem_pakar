@extends('layouts.user-app')

@section('page-title', 'Riwayat Diagnosa')
@section('page-subtitle', 'Histori diagnosa penyakit tanaman kopi kamu')

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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <div style="font-size:0.9rem; font-weight:700; color:#111827;">Riwayat Diagnosa</div>
                <div style="font-size:0.75rem; color:#9ca3af;">Histori diagnosa penyakit tanaman kopi kamu</div>
            </div>
        </div>
        <a href="{{ route('user.diagnosa.index') }}"
            style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.625rem 1.25rem; background:#16a34a; color:white; font-weight:700; font-size:0.875rem; border-radius:0.75rem; text-decoration:none; white-space:nowrap;">
            <svg style="width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Diagnosa Baru
        </a>
    </div>

    {{-- Table --}}
    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
            <thead>
                <tr style="background:#f9fafb;">
                    <th style="padding:0.875rem 1.25rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">No</th>
                    <th style="padding:0.875rem 1.25rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">Tanggal</th>
                    <th style="padding:0.875rem 1.25rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">Penyakit</th>
                    <th style="padding:0.875rem 1.25rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">Gejala</th>
                    <th style="padding:0.875rem 1.25rem; text-align:left; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">CF</th>
                    <th style="padding:0.875rem 1.25rem; text-align:center; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #f3f4f6;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayats as $index => $riwayat)
                    <tr style="border-bottom:1px solid #f9fafb;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">
                        <td style="padding:1rem 1.25rem; color:#6b7280;">{{ $riwayats->firstItem() + $index }}</td>
                        <td style="padding:1rem 1.25rem; color:#6b7280;">{{ $riwayat->tanggal->format('d M Y, H:i') }}</td>
                        <td style="padding:1rem 1.25rem; font-weight:600; color:#111827;">
                            {{ $riwayat->penyakit->nama_penyakit ?? '-' }}
                        </td>
                        <td style="padding:1rem 1.25rem;">
                            <span style="padding:0.25rem 0.75rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#f0fdf4; color:#166534; border:1px solid #bbf7d0;">
                                {{ count($riwayat->gejala_input) }} gejala
                            </span>
                        </td>
                        <td style="padding:1rem 1.25rem;">
                            @php $cf = $riwayat->cf_tertinggi; @endphp
                            @if($cf >= 0.8)
                                <span style="padding:0.25rem 0.75rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#14532d; color:white;">
                                    {{ round($cf * 100, 1) }}%
                                </span>
                            @elseif($cf >= 0.5)
                                <span style="padding:0.25rem 0.75rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#dcfce7; color:#15803d; border:1px solid #bbf7d0;">
                                    {{ round($cf * 100, 1) }}%
                                </span>
                            @else
                                <span style="padding:0.25rem 0.75rem; font-size:0.7rem; font-weight:700; border-radius:9999px; background:#f3f4f6; color:#6b7280;">
                                    {{ round($cf * 100, 1) }}%
                                </span>
                            @endif
                        </td>
                        <td style="padding:1rem 1.25rem; text-align:center;">
                            <div style="display:inline-flex; align-items:center; gap:0.5rem;">
                                {{-- Lihat Detail --}}
                                <a href="{{ route('user.diagnosa.hasil', $riwayat->id_diagnosis) }}"
                                    style="display:inline-flex; align-items:center; gap:0.375rem; padding:0.4rem 0.875rem; background:#f0fdf4; color:#16a34a; font-size:0.75rem; font-weight:600; border-radius:0.5rem; border:1px solid #bbf7d0; text-decoration:none;">
                                    <svg style="width:0.875rem; height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </a>

                                {{-- Download PDF --}}
                                <a href="{{ route('user.riwayat.pdf', $riwayat->id_diagnosis) }}" target="_blank"
                                    style="display:inline-flex; align-items:center; gap:0.375rem; padding:0.4rem 0.875rem; background:#f9fafb; color:#374151; font-size:0.75rem; font-weight:600; border-radius:0.5rem; border:1px solid #e5e7eb; text-decoration:none;">
                                    <svg style="width:0.875rem; height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                    </svg>
                                    PDF
                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('user.diagnosa.destroy', $riwayat->id_diagnosis) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')" style="display:inline;">
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
                        <td colspan="6" style="padding:3rem; text-align:center; color:#9ca3af;">
                            <svg style="width:3rem; height:3rem; margin:0 auto 1rem; color:#d1fae5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p style="font-size:1rem; font-weight:600; color:#374151; margin-bottom:0.5rem;">Belum ada riwayat diagnosa</p>
                            <a href="{{ route('user.diagnosa.index') }}" style="font-size:0.875rem; color:#16a34a; font-weight:600; text-decoration:none;">
                                Mulai diagnosa sekarang
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding:1rem 1.5rem; border-top:1px solid #f3f4f6;">
        {{ $riwayats->links() }}
    </div>

</div>

@endsection