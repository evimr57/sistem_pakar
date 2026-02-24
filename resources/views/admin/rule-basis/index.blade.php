@extends('layouts.admin-app')

@section('page-title', '🧠 Manajemen Rule Basis')
@section('page-subtitle', 'Kelola aturan diagnosa sistem pakar')

@section('content')
    @if (session('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg flex items-center">
            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Total Rule</p>
                    <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $totalRules }}</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Rata-rata CF</p>
                    <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ number_format($avgCF ?? 0, 2) }}</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-500 uppercase">CF Tinggi (≥0.7)</p>
                    <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $highConfidenceRules }}</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Penyakit Terintegrasi</p>
                    <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $totalPenyakitWithRules }}</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-red-400 to-red-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Daftar Rule Basis</h3>
                </div>
                {{-- FIX: Tombol Tambah Rule - warna solid purple --}}
                <a href="{{ route('admin.rule-basis.create') }}" 
                   style="background: linear-gradient(to right, #8b5cf6, #7c3aed); color: white;"
                   class="flex items-center px-5 py-3 font-bold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Rule
                </a>
            </div>
        </div>

        <!-- Filter -->
        <div class="p-6 bg-gray-50 border-b border-gray-200">
            <form method="GET" action="{{ route('admin.rule-basis.index') }}" class="flex gap-4">
                <div class="flex-1">
                    <label for="penyakit" class="block text-sm font-semibold text-gray-700 mb-2">Filter Penyakit</label>
                    <select name="penyakit" id="penyakit" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Semua Penyakit</option>
                        @foreach($penyakits as $penyakit)
                            <option value="{{ $penyakit->id_penyakit }}" {{ request('penyakit') == $penyakit->id_penyakit ? 'selected' : '' }}>
                                {{ $penyakit->id_penyakit }} - {{ $penyakit->nama_penyakit }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label for="gejala" class="block text-sm font-semibold text-gray-700 mb-2">Filter Gejala</label>
                    <select name="gejala" id="gejala" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Semua Gejala</option>
                        @foreach($gejalas as $gejala)
                            <option value="{{ $gejala->id_gejala }}" {{ request('gejala') == $gejala->id_gejala ? 'selected' : '' }}>
                                {{ $gejala->id_gejala }} - {{ $gejala->nama_gejala }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" style="background-color: #8b5cf6; color: white;" class="px-6 py-2 font-semibold rounded-xl hover:opacity-90 transition">
                        Filter
                    </button>
                    @if(request('penyakit') || request('gejala'))
                        <a href="{{ route('admin.rule-basis.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-400 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Penyakit</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Gejala</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase">MB</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase">MD</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase">CF</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Keterangan</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($rules as $index => $rule)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $rules->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">
                                        {{ $rule->id_penyakit }}
                                    </span>
                                    <p class="mt-1 font-semibold text-gray-900">{{ $rule->penyakit->nama_penyakit ?? '-' }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                        {{ $rule->id_gejala }}
                                    </span>
                                    <p class="mt-1 text-gray-700">{{ $rule->gejala->nama_gejala ?? '-' }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-lg text-sm font-bold">
                                    {{ number_format($rule->mb, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-lg text-sm font-bold">
                                    {{ number_format($rule->md, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-lg text-sm font-bold">
                                    {{ number_format($rule->cf_pakar, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                {{ $rule->keterangan ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    {{-- FIX: Gunakan id_rule eksplisit untuk route model binding --}}
                                    <a href="{{ route('admin.rule-basis.edit', $rule->id_rule) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-500 text-white text-xs font-semibold rounded-lg hover:bg-blue-600 transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    {{-- FIX: Form delete dengan id_rule eksplisit --}}
                                    <form action="{{ route('admin.rule-basis.destroy', $rule->id_rule) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus rule ini?')"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-500 text-white text-xs font-semibold rounded-lg hover:bg-red-600 transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-xl font-semibold mb-2">Belum ada rule basis</p>
                                    <p class="text-sm">Klik "Tambah Rule" untuk menambahkan aturan diagnosa</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $rules->links() }}
        </div>
    </div>
@endsection