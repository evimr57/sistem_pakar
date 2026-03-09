@extends('layouts.user-app')

@section('page-title', '🌱 Artikel Budidaya')
@section('page-subtitle', 'Informasi seputar budidaya tanaman kopi')

@section('content')

<!-- Search & Filter -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
    <div class="flex items-center gap-4">
        <div class="flex-1 relative">
            <span class="absolute left-4 top-3 text-gray-400">🔍</span>
            <input type="text" id="search-artikel" placeholder="Cari artikel budidaya..."
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>
    </div>
</div>

<!-- Grid Artikel -->
@if($artikels->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="artikel-grid">
        @foreach($artikels as $artikel)
            <a href="{{ route('user.artikel.budidaya.detail', $artikel->slug) }}"
                class="artikel-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all hover:-translate-y-1 group">
                <!-- Gambar -->
                <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 overflow-hidden relative">
                    @if($artikel->gambar_utama)
                        <img src="{{ Storage::url($artikel->gambar_utama) }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            alt="{{ $artikel->judul }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-6xl">🌱</span>
                        </div>
                    @endif
                </div>

                <!-- Konten -->
                <div class="p-5">
                    <!-- Tags -->
                    @if($artikel->tags)
                        <div class="flex flex-wrap gap-1 mb-3">
                            @foreach(array_slice($artikel->tags, 0, 2) as $tag)
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs font-semibold rounded-full">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif

                    <h3 class="font-bold text-gray-800 mb-2 group-hover:text-green-600 transition-colors line-clamp-2">
                        {{ $artikel->judul }}
                    </h3>

                    @if($artikel->deskripsi_singkat)
                        <p class="text-xs text-gray-500 leading-relaxed line-clamp-3 mb-4">{{ $artikel->deskripsi_singkat }}</p>
                    @endif

                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <span class="text-xs text-gray-400">{{ $artikel->published_at?->format('d M Y') ?? '-' }}</span>
                        <span class="text-xs font-semibold text-green-600 group-hover:underline">Baca Selengkapnya →</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">{{ $artikels->links() }}</div>

@else
    <div class="bg-white rounded-2xl shadow-lg p-16 text-center text-gray-400">
        <span class="text-6xl block mb-4">🌱</span>
        <p class="text-xl font-semibold mb-2">Belum ada artikel budidaya</p>
        <p class="text-sm">Artikel akan segera tersedia</p>
    </div>
@endif

@endsection

@push('scripts')
<script>
    document.getElementById('search-artikel').addEventListener('input', function() {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll('.artikel-card').forEach(card => {
            const judul = card.querySelector('h3').textContent.toLowerCase();
            card.style.display = judul.includes(keyword) ? '' : 'none';
        });
    });
</script>
@endpush