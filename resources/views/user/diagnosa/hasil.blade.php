@extends('layouts.user-app')

@section('page-title', '📋 Hasil Diagnosa')
@section('page-subtitle', 'Hasil analisis penyakit tanaman kopi kamu')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Hasil Utama -->
    <div class="lg:col-span-2 space-y-6">

        <!-- Penyakit Final -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-3 mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Hasil Diagnosa</h3>
            </div>

            @if($riwayat->penyakit)
                <!-- Penyakit Terdeteksi -->
                <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-xl p-5 mb-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs text-green-600 font-semibold uppercase mb-1">Penyakit Terdeteksi</p>
                            <h2 class="text-2xl font-bold text-green-800">{{ $riwayat->penyakit->nama_penyakit }}</h2>
                            @if($riwayat->penyakit->nama_latin)
                                <p class="text-sm text-green-600 italic mt-1">{{ $riwayat->penyakit->nama_latin }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-green-600 font-semibold mb-1">Tingkat Kepercayaan</p>
                            <p class="text-3xl font-bold text-green-700">{{ round($riwayat->cf_tertinggi * 100, 1) }}%</p>
                        </div>
                    </div>

                    <!-- Progress Bar CF -->
                    <div class="mt-4">
                        <div class="w-full bg-green-200 rounded-full h-3">
                            <div class="bg-green-600 h-3 rounded-full transition-all duration-1000"
                                style="width: {{ round($riwayat->cf_tertinggi * 100, 1) }}%"></div>
                        </div>
                    </div>

                    <!-- Badge tingkat bahaya -->
                    @if($riwayat->penyakit->tingkat_bahaya)
                        <div class="mt-3">
                            <span class="px-3 py-1 text-xs font-bold rounded-full
                                {{ $riwayat->penyakit->tingkat_bahaya === 'Sangat Tinggi' ? 'bg-red-100 text-red-700' :
                                   ($riwayat->penyakit->tingkat_bahaya === 'Tinggi' ? 'bg-orange-100 text-orange-700' :
                                   ($riwayat->penyakit->tingkat_bahaya === 'Sedang' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700')) }}">
                                ⚠️ Tingkat Bahaya: {{ $riwayat->penyakit->tingkat_bahaya }}
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Detail Penyakit -->
                @if($riwayat->penyakit->deskripsi_singkat)
                    <div class="mb-4">
                        <h4 class="font-bold text-gray-700 mb-2">📝 Deskripsi</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $riwayat->penyakit->deskripsi_singkat }}</p>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($riwayat->penyakit->pengendalian_pencegahan)
                        <div class="bg-blue-50 rounded-xl p-4">
                            <h4 class="font-bold text-blue-700 mb-2 text-sm">🛡️ Pencegahan</h4>
                            <p class="text-xs text-blue-600 leading-relaxed">{{ $riwayat->penyakit->pengendalian_pencegahan }}</p>
                        </div>
                    @endif
                    @if($riwayat->penyakit->pengendalian_kimia)
                        <div class="bg-orange-50 rounded-xl p-4">
                            <h4 class="font-bold text-orange-700 mb-2 text-sm">⚗️ Pengendalian Kimia</h4>
                            <p class="text-xs text-orange-600 leading-relaxed">{{ $riwayat->penyakit->pengendalian_kimia }}</p>
                        </div>
                    @endif
                    @if($riwayat->penyakit->pengendalian_organik)
                        <div class="bg-green-50 rounded-xl p-4">
                            <h4 class="font-bold text-green-700 mb-2 text-sm">🌿 Pengendalian Organik</h4>
                            <p class="text-xs text-green-600 leading-relaxed">{{ $riwayat->penyakit->pengendalian_organik }}</p>
                        </div>
                    @endif
                    @if($riwayat->penyakit->pengendalian_budidaya)
                        <div class="bg-yellow-50 rounded-xl p-4">
                            <h4 class="font-bold text-yellow-700 mb-2 text-sm">🌱 Pengendalian Budidaya</h4>
                            <p class="text-xs text-yellow-600 leading-relaxed">{{ $riwayat->penyakit->pengendalian_budidaya }}</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <p>Tidak ditemukan data penyakit</p>
                </div>
            @endif
        </div>

        <!-- Semua Hasil CF -->
        @if($riwayat->hasil_diagnosa && count($riwayat->hasil_diagnosa) > 1)
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">📊 Semua Kemungkinan Penyakit</h3>
                <div class="space-y-3">
                    @foreach($riwayat->hasil_diagnosa as $index => $hasil)
                        <div class="flex items-center justify-between p-3 rounded-xl {{ $index === 0 ? 'bg-green-50 border border-green-200' : 'bg-gray-50' }}">
                            <div class="flex items-center space-x-3">
                                <span class="w-6 h-6 rounded-full {{ $index === 0 ? 'bg-green-500' : 'bg-gray-300' }} text-white text-xs flex items-center justify-center font-bold">
                                    {{ $index + 1 }}
                                </span>
                                <span class="text-sm font-semibold {{ $index === 0 ? 'text-green-800' : 'text-gray-700' }}">
                                    {{ $hasil['nama_penyakit'] }}
                                </span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-24 bg-gray-200 rounded-full h-2">
                                    <div class="{{ $index === 0 ? 'bg-green-500' : 'bg-gray-400' }} h-2 rounded-full"
                                        style="width: {{ $hasil['persentase'] }}%"></div>
                                </div>
                                <span class="text-sm font-bold {{ $index === 0 ? 'text-green-700' : 'text-gray-600' }}">
                                    {{ $hasil['persentase'] }}%
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Panel Kanan -->
    <div class="space-y-6">

        <!-- Info Diagnosa -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">ℹ️ Info Diagnosa</h3>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Tanggal</span>
                    <span class="font-semibold text-gray-800">{{ $riwayat->tanggal->format('d M Y, H:i') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Jumlah Gejala</span>
                    <span class="font-semibold text-gray-800">{{ count($riwayat->gejala_input) }} gejala</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">CF Tertinggi</span>
                    <span class="font-semibold text-green-600">{{ round($riwayat->cf_tertinggi * 100, 1) }}%</span>
                </div>
            </div>
        </div>

        <!-- Gejala yang Dipilih -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">🩺 Gejala yang Dipilih</h3>
            <div class="space-y-2">
                @foreach($gejalaInput as $gejala)
                    <div class="flex items-center space-x-2 text-sm">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700">{{ $gejala->nama_gejala }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Aksi -->
        <div class="bg-white rounded-2xl shadow-lg p-6 space-y-3">
            <a href="{{ route('user.diagnosa.index') }}"
                class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-xl hover:from-green-600 hover:to-green-700 transition shadow text-sm">
                🔍 Diagnosa Ulang
            </a>
            <a href="{{ route('user.diagnosa.riwayat') }}"
                class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition text-sm">
                📋 Lihat Riwayat
            </a>
        </div>
    </div>
</div>

@endsection