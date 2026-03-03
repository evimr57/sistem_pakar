@extends('layouts.user-app')

@section('page-title', 'Riwayat Diagnosa')
@section('page-subtitle', 'Histori diagnosa penyakit tanaman kopi kamu')

@section('content')

<div class="bg-white rounded-2xl shadow-lg">
    <div class="p-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-3 mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Riwayat Diagnosa</h3>
            </div>
            <a href="{{ route('user.diagnosa.index') }}"
                class="flex items-center px-5 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-xl hover:from-green-600 hover:to-green-700 transition shadow-lg text-sm">
                + Diagnosa Baru
            </a>
        </div>

        <div class="overflow-x-auto rounded-xl border border-gray-200">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Penyakit</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Gejala</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">CF</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($riwayats as $index => $riwayat)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm">{{ $riwayats->firstItem() + $index }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $riwayat->tanggal->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-gray-800">
                                    {{ $riwayat->penyakit->nama_penyakit ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-700">
                                    {{ count($riwayat->gejala_input) }} gejala
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-bold rounded-full
                                    {{ $riwayat->cf_tertinggi >= 0.8 ? 'bg-red-100 text-red-700' :
                                       ($riwayat->cf_tertinggi >= 0.5 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                                    {{ round($riwayat->cf_tertinggi * 100, 1) }}%
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    {{-- Lihat Detail --}}
                                    <a href="{{ route('user.diagnosa.hasil', $riwayat->id_diagnosis) }}"
                                        class="inline-flex items-center px-3 py-2 bg-green-500 text-white text-xs font-semibold rounded-lg hover:bg-green-600 transition">
                                        Lihat Detail
                                    </a>

                                    {{-- Download PDF --}}
                                    <a href="{{ route('user.riwayat.pdf', $riwayat->id_diagnosis) }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-1 px-3 py-2 bg-blue-500 text-white text-xs font-semibold rounded-lg hover:bg-blue-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                        </svg>
                                        PDF
                                    </a>

                                    {{-- Hapus --}}
                                    <form action="{{ route('user.diagnosa.destroy', $riwayat->id_diagnosis) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-2 bg-red-500 text-white text-xs font-semibold rounded-lg hover:bg-red-600 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <p class="text-xl font-semibold mb-2">Belum ada riwayat diagnosa</p>
                                <a href="{{ route('user.diagnosa.index') }}" class="text-green-600 font-semibold hover:underline">
                                    Mulai diagnosa sekarang
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $riwayats->links() }}</div>
    </div>
</div>

@endsection