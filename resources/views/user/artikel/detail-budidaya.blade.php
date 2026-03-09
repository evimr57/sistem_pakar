@extends('layouts.user-app')

@section('page-title', '🌱 Artikel Budidaya')
@section('page-subtitle', '{{ $artikel->judul }}')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Konten Utama -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Gambar -->
            @if($artikel->gambar_utama)
                <img src="{{ Storage::url($artikel->gambar_utama) }}" class="w-full h-64 object-cover" alt="{{ $artikel->judul }}">
            @else
                <div class="w-full h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                    <span class="text-7xl">🌱</span>
                </div>
            @endif

            <div class="p-8">
                <!-- Tags -->
                @if($artikel->tags)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($artikel->tags as $tag)
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif

                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $artikel->judul }}</h1>

                <div class="flex items-center gap-4 text-xs text-gray-400 mb-6 pb-6 border-b border-gray-100">
                    <span>📅 {{ $artikel->published_at?->format('d M Y') ?? '-' }}</span>
                    @if($artikel->author)
                        <span>✍️ {{ $artikel->author->nama }}</span>
                    @endif
                </div>

                @if($artikel->deskripsi_singkat)
                    <p class="text-gray-600 leading-relaxed mb-6 bg-green-50 rounded-xl p-4 italic border-l-4 border-green-400">
                        {{ $artikel->deskripsi_singkat }}
                    </p>
                @endif

                <div class="prose max-w-none text-gray-700 leading-relaxed text-sm">
                    {!! nl2br(e($artikel->konten)) !!}
                </div>
            </div>
        </div>

        <!-- Galeri -->
        @if($artikel->galeri_gambar && count($artikel->galeri_gambar) > 0)
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-2 text-sm">🖼️</span>
                    Galeri Foto
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($artikel->galeri_gambar as $foto)
                        <img src="{{ Storage::url($foto) }}" class="w-full h-32 object-cover rounded-xl hover:opacity-90 transition cursor-pointer" alt="Galeri">
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Info Artikel -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-2 text-sm">ℹ️</span>
                Info Artikel
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="text-xs text-gray-500">Kategori</span>
                    <span class="text-xs font-bold text-green-600">Budidaya</span>
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

        <!-- Tombol Aksi -->
        <div class="bg-white rounded-2xl shadow-lg p-6 space-y-3">
            <a href="{{ route('user.artikel.budidaya') }}"
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