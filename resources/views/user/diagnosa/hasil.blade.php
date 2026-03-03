@extends('layouts.user-app')

@section('page-title', 'Hasil Diagnosa')
@section('page-subtitle', 'Hasil analisis penyakit tanaman kopi kamu')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Kolom Kiri -->
    <div class="lg:col-span-2 space-y-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
             <div style="background: linear-gradient(135deg, #16a34a, #4ade80);" class="p-6 text-white">
                <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full" style="background:rgba(0,0,0,0.2);">
                            Penyakit Terdeteksi
                        </span>
                        @if($riwayat->penyakit?->tingkat_bahaya)
                            <span class="px-3 py-1 text-xs font-bold rounded-full
                                {{ $riwayat->penyakit->tingkat_bahaya === 'Sangat Tinggi' ? 'bg-red-600 text-white' :
                                ($riwayat->penyakit->tingkat_bahaya === 'Tinggi' ? 'bg-orange-500 text-white' :
                                ($riwayat->penyakit->tingkat_bahaya === 'Sedang' ? 'bg-yellow-400 text-yellow-900' : 'bg-green-200 text-green-900')) }}">
                                ⚠️ {{ $riwayat->penyakit->tingkat_bahaya }}
                            </span>
                        @endif
                    </div>

                    {{-- Tombol Download PDF --}}
                    <a href="{{ route('user.riwayat.pdf', $riwayat->id_diagnosis) }}"
                    target="_blank"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 hover:scale-105 active:scale-95"
                    style="background:rgba(0,0,0,0.2); color:white; border: 1px solid rgba(255,255,255,0.3); backdrop-filter: blur(4px);"
                    onmouseover="this.style.background='rgba(0,0,0,0.35)'"
                    onmouseout="this.style.background='rgba(0,0,0,0.2)'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        Download PDF
                    </a>
                </div>

                <h1 class="text-2xl font-bold mb-1">{{ $riwayat->penyakit->nama_penyakit ?? 'Tidak Teridentifikasi' }}</h1>
                @if($riwayat->penyakit?->nama_latin)
                    <p class="italic text-sm mb-4" style="color:rgba(255,255,255,0.8);">{{ $riwayat->penyakit->nama_latin }}</p>
                @endif

                <!-- CF Progress -->
                <div class="rounded-xl p-4" style="background:rgba(0,0,0,0.15);">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm font-semibold" style="color:rgba(255,255,255,0.9);">Tingkat Kepercayaan</span>
                        <span class="text-3xl font-bold text-white">{{ round($riwayat->cf_tertinggi * 100, 1) }}%</span>
                    </div>
                    <div class="w-full rounded-full h-4" style="background:rgba(0,0,0,0.25);">
                        <div class="h-4 rounded-full bg-white" style="width: {{ round($riwayat->cf_tertinggi * 100, 1) }}%;"></div>
                    </div>
                    <div class="flex justify-between text-xs mt-1" style="color:rgba(255,255,255,0.6);">
                        <span>0%</span><span>50%</span><span>100%</span>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="p-6">
                @if($riwayat->penyakit?->deskripsi_singkat)
                    <div class="mb-6">
                        <h4 class="font-bold text-gray-800 mb-2 flex items-center">
                            <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-2 text-sm">📝</span>
                            Deskripsi Penyakit
                        </h4>
                        <p class="text-sm text-gray-600 leading-relaxed bg-gray-50 rounded-xl p-4">{{ $riwayat->penyakit->deskripsi_singkat }}</p>
                    </div>
                @endif

                <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                    <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-2 text-sm">💊</span>
                    Cara Pengendalian
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($riwayat->penyakit?->pengendalian_pencegahan)
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 hover:shadow-md transition">
                            <div class="flex items-center mb-2"><span class="text-lg mr-2">🛡️</span><h5 class="font-bold text-blue-700 text-sm">Pencegahan</h5></div>
                            <p class="text-xs text-blue-600 leading-relaxed">{{ $riwayat->penyakit->pengendalian_pencegahan }}</p>
                        </div>
                    @endif
                    @if($riwayat->penyakit?->pengendalian_kimia)
                        <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 hover:shadow-md transition">
                            <div class="flex items-center mb-2"><span class="text-lg mr-2">⚗️</span><h5 class="font-bold text-orange-700 text-sm">Pengendalian Kimia</h5></div>
                            <p class="text-xs text-orange-600 leading-relaxed">{{ $riwayat->penyakit->pengendalian_kimia }}</p>
                        </div>
                    @endif
                    @if($riwayat->penyakit?->pengendalian_organik)
                        <div class="bg-green-50 border border-green-100 rounded-xl p-4 hover:shadow-md transition">
                            <div class="flex items-center mb-2"><span class="text-lg mr-2">🌿</span><h5 class="font-bold text-green-700 text-sm">Pengendalian Organik</h5></div>
                            <p class="text-xs text-green-600 leading-relaxed">{{ $riwayat->penyakit->pengendalian_organik }}</p>
                        </div>
                    @endif
                    @if($riwayat->penyakit?->pengendalian_budidaya)
                        <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4 hover:shadow-md transition">
                            <div class="flex items-center mb-2"><span class="text-lg mr-2">🌱</span><h5 class="font-bold text-yellow-700 text-sm">Pengendalian Budidaya</h5></div>
                            <p class="text-xs text-yellow-600 leading-relaxed">{{ $riwayat->penyakit->pengendalian_budidaya }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Semua Kemungkinan -->
        @if($riwayat->hasil_diagnosa && count($riwayat->hasil_diagnosa) > 1)
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-2 text-sm">📊</span>
                    Semua Kemungkinan Penyakit
                </h3>
                <div class="space-y-3">
                    @foreach($riwayat->hasil_diagnosa as $index => $hasil)
                        <div class="flex items-center gap-3 p-3 rounded-xl {{ $index === 0 ? 'bg-green-50 border-2 border-green-200' : 'bg-gray-50 border border-gray-100' }}">
                            <span class="w-7 h-7 rounded-full {{ $index === 0 ? 'bg-green-500' : 'bg-gray-300' }} text-white text-xs flex items-center justify-center font-bold flex-shrink-0">{{ $index + 1 }}</span>
                            <span class="text-sm font-semibold {{ $index === 0 ? 'text-green-800' : 'text-gray-600' }} flex-1 min-w-0 truncate">
                                {{ $hasil['nama_penyakit'] }}
                                @if($index === 0)<span class="ml-2 px-2 py-0.5 bg-green-500 text-white text-xs rounded-full">Terpilih</span>@endif
                            </span>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <div class="w-24 bg-gray-200 rounded-full h-2">
                                    <div class="{{ $index === 0 ? 'bg-green-500' : 'bg-gray-400' }} h-2 rounded-full" style="width: {{ $hasil['persentase'] }}%"></div>
                                </div>
                                <span class="text-sm font-bold {{ $index === 0 ? 'text-green-700' : 'text-gray-500' }} w-10 text-right">{{ $hasil['persentase'] }}%</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Tabel Relasi Gejala per Penyakit -->
    @if($relasiGejala->count() > 0)
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-2 text-sm">🔗</span>
                Relasi Gejala & Penyakit
            </h3>
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Gejala</th>
                            @foreach($riwayat->hasil_diagnosa as $hasil)
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase">
                                    {{ $hasil['nama_penyakit'] }}
                                    <div class="text-green-600 font-bold normal-case">{{ $hasil['persentase'] }}%</div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($gejalaInput as $gejala)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-xs text-gray-700 font-medium max-w-xs">{{ $gejala->nama_gejala }}</td>
                                @foreach($riwayat->hasil_diagnosa as $hasil)
                                    <td class="px-4 py-3 text-center">
                                        @if(isset($relasiGejala[$hasil['id_penyakit']]) &&
                                            $relasiGejala[$hasil['id_penyakit']]->contains('id_gejala', $gejala->id_gejala))
                                            <span class="inline-flex items-center justify-center w-7 h-7 bg-green-100 rounded-full">
                                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center justify-center w-7 h-7 bg-gray-100 rounded-full">
                                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            </span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="text-xs text-gray-400 mt-3">✅ = gejala terkait penyakit tersebut &nbsp;|&nbsp; ❌ = tidak terkait</p>
        </div>
    @endif

    <!-- Kolom Kanan -->
    <div class="space-y-6">

        <!-- Info Diagnosa -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-2 text-sm">ℹ️</span>
                Info Diagnosa
            </h3>
            <div class="space-y-2">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-xs text-gray-500">Tanggal</span>
                    <span class="text-xs font-semibold text-gray-800">{{ $riwayat->tanggal->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-xs text-gray-500">Waktu</span>
                    <span class="text-xs font-semibold text-gray-800">{{ $riwayat->tanggal->format('H:i') }} WIB</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-xs text-gray-500">Jumlah Gejala</span>
                    <span class="text-xs font-bold text-blue-600">{{ count($riwayat->gejala_input) }} gejala</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-xs text-gray-500">CF Tertinggi</span>
                    <span class="text-xs font-bold text-green-600">{{ round($riwayat->cf_tertinggi * 100, 1) }}%</span>
                </div>
            </div>
        </div>

        <!-- Gejala -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-2 text-sm">🩺</span>
                Gejala Dipilih
            </h3>
            <div class="space-y-2 max-h-64 overflow-y-auto">
                @foreach($gejalaInput as $gejala)
                    <div class="flex items-start space-x-2 p-2 bg-green-50 rounded-lg">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-xs text-gray-700 leading-relaxed">{{ $gejala->nama_gejala }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Aksi -->
        <div class="bg-white rounded-2xl shadow-lg p-6 space-y-3">
            <a href="{{ route('user.diagnosa.index') }}" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-xl hover:from-green-600 hover:to-green-700 transition shadow text-sm">
                Diagnosa Ulang
            </a>
            <a href="{{ route('user.diagnosa.riwayat') }}" class="w-full flex items-center justify-center gap-2 px-4 py-3 border-2 border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition text-sm">
                Kembali ke Riwayat
            </a>
           
        </div>
    </div>
</div>

@endsection