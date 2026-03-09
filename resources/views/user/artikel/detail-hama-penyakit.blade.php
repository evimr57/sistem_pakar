@extends('layouts.user-app')

@section('page-title', '🦠 Artikel Hama & Penyakit')
@section('page-subtitle', '{{ $artikel->judul }}')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Konten Utama -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            @if($artikel->gambar_utama)
                <img src="{{ Storage::url($artikel->gambar_utama) }}" class="w-full h-64 object-cover" alt="{{ $artikel->judul }}">
            @else
                <div class="w-full h-48 flex items-center justify-center {{ $artikel->jenis === 'Hama' ? 'bg-gradient-to-br from-orange-400 to-orange-600' : 'bg-gradient-to-br from-red-400 to-red-600' }}">
                    <span class="text-7xl">{{ $artikel->jenis === 'Hama' ? '🐛' : '🦠' }}</span>
                </div>
            @endif

            <div class="p-8">
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $artikel->jenis === 'Hama' ? 'bg-orange-100 text-orange-700' : 'bg-red-100 text-red-700' }}">
                        {{ $artikel->jenis === 'Hama' ? '🐛' : '🦠' }} {{ $artikel->jenis }}
                    </span>
                    @if($artikel->tags)
                        @foreach($artikel->tags as $tag)
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full">{{ $tag }}</span>
                        @endforeach
                    @endif
                </div>

                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $artikel->judul }}</h1>
                <div class="flex items-center gap-4 text-xs text-gray-400 mb-6 pb-6 border-b border-gray-100">
                    <span>📅 {{ $artikel->published_at?->format('d M Y') ?? '-' }}</span>
                </div>

                @if($artikel->deskripsi_singkat)
                    <p class="text-gray-600 leading-relaxed mb-6 bg-gray-50 rounded-xl p-4 italic border-l-4 {{ $artikel->jenis === 'Hama' ? 'border-orange-400' : 'border-red-400' }}">
                        {{ $artikel->deskripsi_singkat }}
                    </p>
                @endif

                <div class="text-sm text-gray-700 leading-relaxed mb-6">
                    {!! nl2br(e($artikel->konten)) !!}
                </div>

                <!-- Info Teknis -->
                @if($artikel->gejala_visual || $artikel->cara_identifikasi || $artikel->pencegahan || $artikel->pengendalian)
                    <div class="border-t border-gray-100 pt-6">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-2 text-sm">📋</span>
                            Informasi Teknis
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($artikel->gejala_visual)
                                <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4">
                                    <h4 class="font-bold text-yellow-700 text-sm mb-2">👁️ Gejala Visual</h4>
                                    <p class="text-xs text-yellow-600 leading-relaxed">{{ $artikel->gejala_visual }}</p>
                                </div>
                            @endif
                            @if($artikel->cara_identifikasi)
                                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                                    <h4 class="font-bold text-blue-700 text-sm mb-2">🔍 Cara Identifikasi</h4>
                                    <p class="text-xs text-blue-600 leading-relaxed">{{ $artikel->cara_identifikasi }}</p>
                                </div>
                            @endif
                            @if($artikel->pencegahan)
                                <div class="bg-green-50 border border-green-100 rounded-xl p-4">
                                    <h4 class="font-bold text-green-700 text-sm mb-2">🛡️ Pencegahan</h4>
                                    <p class="text-xs text-green-600 leading-relaxed">{{ $artikel->pencegahan }}</p>
                                </div>
                            @endif
                            @if($artikel->pengendalian)
                                <div class="bg-red-50 border border-red-100 rounded-xl p-4">
                                    <h4 class="font-bold text-red-700 text-sm mb-2">⚗️ Pengendalian</h4>
                                    <p class="text-xs text-red-600 leading-relaxed">{{ $artikel->pengendalian }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Galeri -->
        @if($artikel->galeri_gambar && count($artikel->galeri_gambar) > 0)
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-2 text-sm">🖼️</span>
                    Galeri Foto
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($artikel->galeri_gambar as $foto)
                        <img src="{{ Storage::url($foto) }}" class="w-full h-32 object-cover rounded-xl hover:opacity-90 transition" alt="Galeri">
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-2 text-sm">ℹ️</span>
                Info Artikel
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="text-xs text-gray-500">Jenis</span>
                    <span class="text-xs font-bold {{ $artikel->jenis === 'Hama' ? 'text-orange-600' : 'text-red-600' }}">{{ $artikel->jenis }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="text-xs text-gray-500">Tanggal</span>
                    <span class="text-xs font-semibold text-gray-800">{{ $artikel->published_at?->format('d M Y') ?? '-' }}</span>
                </div>
                @if($artikel->file_pdf)
                    <div class="pt-2">
                        <a href="{{ Storage::url($artikel->file_pdf) }}" target="_blank"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-500 text-white font-bold rounded-xl hover:bg-red-600 transition text-sm">
                            📄 Download PDF
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 space-y-3">
            <a href="{{ route('user.artikel.hama-penyakit') }}"
                class="w-full flex items-center justify-center gap-2 px-4 py-3 border-2 border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition text-sm">
                ← Kembali ke Daftar
            </a>
            <a href="{{ route('user.dashboard') }}"
                class="w-full flex items-center justify-center gap-2 px-4 py-3 border-2 border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition text-sm">
                🏠 Dashboard
            </a>
        </div>
    </div>
</div>

@endsection