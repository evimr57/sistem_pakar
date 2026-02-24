@extends('layouts.admin-app')

@section('page-title', '➕ Tambah Rule Basis')
@section('page-subtitle', 'Tambah aturan diagnosa baru')

@section('content')
    @if ($errors->any())
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
            <div class="flex items-start">
                <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.rule-basis.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-2xl shadow-lg">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Form Tambah Rule Baru</h3>
                </div>
            </div>

            <!-- Form Body -->
            <div class="p-8 space-y-6">
                
                <!-- Pilih Penyakit -->
                <div>
                    <label for="id_penyakit" class="block text-sm font-semibold text-gray-700 mb-2">
                        Penyakit <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="id_penyakit" 
                        id="id_penyakit" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition @error('id_penyakit') border-red-500 @enderror"
                        required
                    >
                        <option value="">-- Pilih Penyakit --</option>
                        @foreach($penyakits as $penyakit)
                            <option value="{{ $penyakit->id_penyakit }}" {{ old('id_penyakit') == $penyakit->id_penyakit ? 'selected' : '' }}>
                                {{ $penyakit->id_penyakit }} - {{ $penyakit->nama_penyakit }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_penyakit')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pilih Gejala -->
                <div>
                    <label for="id_gejala" class="block text-sm font-semibold text-gray-700 mb-2">
                        Gejala <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="id_gejala" 
                        id="id_gejala" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition @error('id_gejala') border-red-500 @enderror"
                        required
                    >
                        <option value="">-- Pilih Gejala --</option>
                        @foreach($gejalas as $gejala)
                            <option value="{{ $gejala->id_gejala }}" {{ old('id_gejala') == $gejala->id_gejala ? 'selected' : '' }}>
                                {{ $gejala->id_gejala }} - {{ $gejala->nama_gejala }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_gejala')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- MB (Measure of Belief) -->
                <div>
                    <label for="mb" class="block text-sm font-semibold text-gray-700 mb-2">
                        MB (Measure of Belief) <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        name="mb" 
                        id="mb" 
                        value="{{ old('mb') }}"
                        step="0.01"
                        min="0"
                        max="1"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition @error('mb') border-red-500 @enderror"
                        placeholder="0.00 - 1.00"
                        required
                        oninput="calculateCF()"
                    >
                    <p class="mt-1 text-sm text-gray-500">Tingkat kepercayaan gejala menunjukkan penyakit (0.00 - 1.00)</p>
                    @error('mb')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- MD (Measure of Disbelief) -->
                <div>
                    <label for="md" class="block text-sm font-semibold text-gray-700 mb-2">
                        MD (Measure of Disbelief) <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        name="md" 
                        id="md" 
                        value="{{ old('md') }}"
                        step="0.01"
                        min="0"
                        max="1"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition @error('md') border-red-500 @enderror"
                        placeholder="0.00 - 1.00"
                        required
                        oninput="calculateCF()"
                    >
                    <p class="mt-1 text-sm text-gray-500">Tingkat ketidakyakinan gejala menunjukkan penyakit (0.00 - 1.00)</p>
                    @error('md')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- CF Preview (Auto-calculated) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        CF (Certainty Factor) - Otomatis Dihitung
                    </label>
                    <div class="px-4 py-3 bg-purple-50 border border-purple-200 rounded-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700">CF = MB - MD</span>
                            <span id="cf_preview" class="text-2xl font-bold text-purple-600">0.00</span>
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Nilai CF akan otomatis dihitung dari MB - MD</p>
                </div>

                <!-- Keterangan -->
                <div>
                    <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Keterangan (Opsional)
                    </label>
                    <textarea 
                        name="keterangan" 
                        id="keterangan" 
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                        placeholder="Catatan tambahan tentang rule ini..."
                    >{{ old('keterangan') }}</textarea>
                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex justify-between items-center rounded-b-2xl">
                <a href="{{ route('admin.rule-basis.index') }}" 
                   class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-400 transition">
                    Batal
                </a>
                {{-- FIX: Tombol Simpan pakai inline style agar warna tidak transparan --}}
                <button type="submit" 
                        style="background: linear-gradient(to right, #8b5cf6, #7c3aed); color: white;"
                        class="px-6 py-3 font-bold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Simpan Rule
                </button>
            </div>
        </div>
    </form>

    <!-- JavaScript for Auto-calculate CF -->
    <script>
        function calculateCF() {
            const mb = parseFloat(document.getElementById('mb').value) || 0;
            const md = parseFloat(document.getElementById('md').value) || 0;
            const cf = mb - md;
            
            document.getElementById('cf_preview').textContent = cf.toFixed(2);
            
            const cfPreview = document.getElementById('cf_preview');
            if (cf >= 0.7) {
                cfPreview.style.color = '#16a34a';
            } else if (cf >= 0.4) {
                cfPreview.style.color = '#ca8a04';
            } else if (cf >= 0) {
                cfPreview.style.color = '#ea580c';
            } else {
                cfPreview.style.color = '#dc2626';
            }
        }
    </script>
@endsection