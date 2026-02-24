@extends('layouts.admin-app')

@section('page-title', '✏️ Edit Rule Basis')
@section('page-subtitle', 'Edit aturan diagnosa')

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

    <form action="{{ route('admin.rule-basis.update', $ruleBasis) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow-lg">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Form Edit Rule</h3>
                </div>
            </div>

            <!-- Form Body -->
            <div class="p-8 space-y-6">
                
                <!-- Penyakit (Read-only) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Penyakit
                    </label>
                    <div class="px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl">
                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold mr-2">
                            {{ $ruleBasis->id_penyakit }}
                        </span>
                        <span class="text-gray-900 font-semibold">{{ $ruleBasis->penyakit->nama_penyakit ?? '-' }}</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Penyakit tidak dapat diubah setelah rule dibuat</p>
                </div>

                <!-- Gejala (Read-only) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Gejala
                    </label>
                    <div class="px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl">
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold mr-2">
                            {{ $ruleBasis->id_gejala }}
                        </span>
                        <span class="text-gray-900">{{ $ruleBasis->gejala->nama_gejala ?? '-' }}</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Gejala tidak dapat diubah setelah rule dibuat</p>
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
                        value="{{ old('mb', $ruleBasis->mb) }}"
                        step="0.01"
                        min="0"
                        max="1"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('mb') border-red-500 @enderror"
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
                        value="{{ old('md', $ruleBasis->md) }}"
                        step="0.01"
                        min="0"
                        max="1"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('md') border-red-500 @enderror"
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
                    <div class="px-4 py-3 bg-blue-50 border border-blue-200 rounded-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700">CF = MB - MD</span>
                            <span id="cf_preview" class="text-2xl font-bold text-blue-600">{{ number_format($ruleBasis->cf_pakar, 2) }}</span>
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Catatan tambahan tentang rule ini..."
                    >{{ old('keterangan', $ruleBasis->keterangan) }}</textarea>
                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex justify-between items-center rounded-b-2xl">
                <a href="{{ route('admin.rule-basis.index') }}" class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-400 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Update Rule
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
            
            // Change color based on CF value
            const cfPreview = document.getElementById('cf_preview');
            if (cf >= 0.7) {
                cfPreview.className = 'text-2xl font-bold text-green-600';
            } else if (cf >= 0.4) {
                cfPreview.className = 'text-2xl font-bold text-yellow-600';
            } else if (cf >= 0) {
                cfPreview.className = 'text-2xl font-bold text-orange-600';
            } else {
                cfPreview.className = 'text-2xl font-bold text-red-600';
            }
        }

        // Calculate on page load
        window.addEventListener('DOMContentLoaded', calculateCF);
    </script>
@endsection