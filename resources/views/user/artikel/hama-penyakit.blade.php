@extends('layouts.user-app')

@section('page-title', '🦠 Artikel Hama & Penyakit')
@section('page-subtitle', 'Informasi seputar hama dan penyakit tanaman kopi')

@section('content')

<!-- Tab -->
<div class="bg-white rounded-2xl shadow-lg p-2 mb-6 flex gap-2">
    <button onclick="switchTab('hama')" id="tab-hama"
        class="flex-1 py-3 px-4 rounded-xl font-bold text-sm transition tab-btn active-tab">
        🐛 Hama ({{ $hama->count() }})
    </button>
    <button onclick="switchTab('penyakit')" id="tab-penyakit"
        class="flex-1 py-3 px-4 rounded-xl font-bold text-sm transition tab-btn">
        🦠 Penyakit ({{ $penyakit->count() }})
    </button>
</div>

<!-- Hama -->
<div id="content-hama">
    @if($hama->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($hama as $artikel)
                <a href="{{ route('user.artikel.hama-penyakit.detail', $artikel->slug) }}"
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div class="h-48 bg-gradient-to-br from-orange-400 to-orange-600 overflow-hidden relative">
                        @if($artikel->gambar_utama)
                            <img src="{{ Storage::url($artikel->gambar_utama) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $artikel->judul }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="text-6xl">🐛</span>
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 px-2 py-1 bg-orange-500 text-white text-xs font-bold rounded-full">Hama</span>
                    </div>
                    <div class="p-5">
                        @if($artikel->tags)
                            <div class="flex flex-wrap gap-1 mb-3">
                                @foreach(array_slice($artikel->tags, 0, 2) as $tag)
                                    <span class="px-2 py-0.5 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full">{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif
                        <h3 class="font-bold text-gray-800 mb-2 group-hover:text-orange-600 transition-colors line-clamp-2">{{ $artikel->judul }}</h3>
                        @if($artikel->deskripsi_singkat)
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-3 mb-4">{{ $artikel->deskripsi_singkat }}</p>
                        @endif
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <span class="text-xs text-gray-400">{{ $artikel->published_at?->format('d M Y') ?? '-' }}</span>
                            <span class="text-xs font-semibold text-orange-600 group-hover:underline">Baca →</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-16 text-center text-gray-400">
            <span class="text-6xl block mb-4">🐛</span>
            <p class="text-xl font-semibold">Belum ada artikel hama</p>
        </div>
    @endif
</div>

<!-- Penyakit -->
<div id="content-penyakit" class="hidden">
    @if($penyakit->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($penyakit as $artikel)
                <a href="{{ route('user.artikel.hama-penyakit.detail', $artikel->slug) }}"
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div class="h-48 bg-gradient-to-br from-red-400 to-red-600 overflow-hidden relative">
                        @if($artikel->gambar_utama)
                            <img src="{{ Storage::url($artikel->gambar_utama) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $artikel->judul }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="text-6xl">🦠</span>
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 px-2 py-1 bg-red-500 text-white text-xs font-bold rounded-full">Penyakit</span>
                    </div>
                    <div class="p-5">
                        @if($artikel->tags)
                            <div class="flex flex-wrap gap-1 mb-3">
                                @foreach(array_slice($artikel->tags, 0, 2) as $tag)
                                    <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs font-semibold rounded-full">{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif
                        <h3 class="font-bold text-gray-800 mb-2 group-hover:text-red-600 transition-colors line-clamp-2">{{ $artikel->judul }}</h3>
                        @if($artikel->deskripsi_singkat)
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-3 mb-4">{{ $artikel->deskripsi_singkat }}</p>
                        @endif
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <span class="text-xs text-gray-400">{{ $artikel->published_at?->format('d M Y') ?? '-' }}</span>
                            <span class="text-xs font-semibold text-red-600 group-hover:underline">Baca →</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-16 text-center text-gray-400">
            <span class="text-6xl block mb-4">🦠</span>
            <p class="text-xl font-semibold">Belum ada artikel penyakit</p>
        </div>
    @endif
</div>

@endsection

@push('styles')
<style>
    .active-tab { background: #16a34a; color: white; }
    .tab-btn:not(.active-tab) { color: #6b7280; }
    .tab-btn:not(.active-tab):hover { background: #f3f4f6; }
</style>
@endpush

@push('scripts')
<script>
    function switchTab(tab) {
        document.getElementById('content-hama').classList.add('hidden');
        document.getElementById('content-penyakit').classList.add('hidden');
        document.getElementById('tab-hama').classList.remove('active-tab');
        document.getElementById('tab-penyakit').classList.remove('active-tab');

        document.getElementById('content-' + tab).classList.remove('hidden');
        document.getElementById('tab-' + tab).classList.add('active-tab');
    }
</script>
@endpush