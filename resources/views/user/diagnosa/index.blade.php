@extends('layouts.user-app')

@section('page-title', 'Diagnosa Penyakit')
@section('page-subtitle', 'Pilih gejala yang dialami tanaman kopi kamu')

@section('content')

@if(session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl flex items-center gap-3">
        <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <span class="font-semibold text-sm">{{ session('error') }}</span>
    </div>
@endif

<form action="{{ route('user.diagnosa.proses') }}" method="POST" id="form-diagnosa">
    @csrf

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <!-- Header Bar -->
        <div class="px-6 py-4 border-b border-gray-100" style="display:flex; align-items:center; justify-content:space-between; gap:1rem;">
            <div style="display:flex; align-items:center; gap:0.75rem;">
                <div class="bg-green-100 rounded-xl p-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <div>
                    <div class="text-base font-bold text-gray-800">Daftar Gejala</div>
                    <div class="text-xs text-gray-400">Centang semua gejala yang sesuai kondisi tanaman</div>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:0.5rem; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:0.75rem; padding:0.4rem 0.9rem; white-space:nowrap;">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span id="selected-count" class="text-sm font-bold text-green-700">0</span>
                <span class="text-xs text-green-600">terpilih</span>
            </div>
        </div>

        <!-- Search -->
        <div class="px-6 py-4 border-b border-gray-100">
            <div style="position:relative;">
                <svg style="position:absolute; left:0.875rem; top:50%; transform:translateY(-50%); width:1rem; height:1rem; color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
                <input type="text" id="search-gejala"
                    placeholder="Cari gejala yang dialami tanaman kopi..."
                    class="w-full py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent"
                    style="padding-left:2.5rem; padding-right:1rem;">
            </div>
        </div>

        <!-- Gejala List -->
        <div class="p-6">
            <div id="gejala-list" style="display:flex; flex-direction:column; gap:0.5rem; max-height:520px; overflow-y:auto; padding-right:0.25rem;">
                @foreach($gejalas as $gejala)
                    <label for="gejala_{{ $gejala->id_gejala }}"
                        class="gejala-item"
                        data-nama="{{ strtolower($gejala->nama_gejala) }}"
                        style="display:flex; align-items:center; gap:0.75rem; padding:0.875rem 1rem; border:2px solid #e5e7eb; border-radius:0.75rem; cursor:pointer; transition:all 0.15s;">

                        <input type="checkbox" name="gejala[]" value="{{ $gejala->id_gejala }}"
                            id="gejala_{{ $gejala->id_gejala }}"
                            class="gejala-checkbox"
                            style="width:1rem; height:1rem; accent-color:#16a34a; flex-shrink:0;"
                            onchange="updateSelected()">

                        <span class="gejala-label" style="font-size:0.875rem; font-weight:500; color:#374151; line-height:1.4;">
                            {{ $gejala->nama_gejala }}
                        </span>
                    </label>
                @endforeach
            </div>

            @error('gejala')
                <p style="color:#ef4444; font-size:0.875rem; margin-top:0.75rem; display:flex; align-items:center; gap:0.375rem;">
                    <svg style="width:1rem; height:1rem; flex-shrink:0;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Footer Action Bar -->
        <div style="padding:1rem 1.5rem; background:#f9fafb; border-top:1px solid #f3f4f6; display:flex; align-items:center; justify-content:space-between; gap:0.75rem; flex-wrap:wrap;">
            <div style="display:flex; align-items:center; gap:0.5rem; font-size:0.75rem; color:#6b7280;">
                <svg style="width:1rem; height:1rem; color:#22c55e; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Pilih semua gejala yang terlihat untuk hasil yang lebih akurat
            </div>

            <div style="display:flex; align-items:center; gap:0.75rem;">
                <button type="button" onclick="resetGejala()"
                    style="display:flex; align-items:center; gap:0.5rem; padding:0.625rem 1rem; border:1px solid #d1d5db; color:#4b5563; font-weight:600; border-radius:0.75rem; background:white; cursor:pointer; font-size:0.875rem; transition:all 0.15s;">
                    <svg style="width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Reset
                </button>

                <button type="submit"
                    style="display:flex; align-items:center; gap:0.5rem; padding:0.625rem 1.5rem; background:#16a34a; color:white; font-weight:700; border-radius:0.75rem; border:none; cursor:pointer; font-size:0.875rem; transition:background 0.15s; box-shadow:0 1px 3px rgba(0,0,0,0.12);">
                    <svg style="width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-3 7l2 2 4-4"/>
                    </svg>
                    Diagnosa Sekarang
                </button>
            </div>
        </div>

    </div>
</form>

@endsection

@push('scripts')
<script>
    function updateSelected() {
        const checkboxes = document.querySelectorAll('.gejala-checkbox:checked');
        const count = checkboxes.length;
        document.getElementById('selected-count').textContent = count;

        document.querySelectorAll('.gejala-item').forEach(label => {
            const cb = label.querySelector('.gejala-checkbox');
            if (cb.checked) {
                label.style.borderColor = '#16a34a';
                label.style.backgroundColor = '#f0fdf4';
            } else {
                label.style.borderColor = '#e5e7eb';
                label.style.backgroundColor = '';
            }
        });
    }

    function resetGejala() {
        document.querySelectorAll('.gejala-checkbox').forEach(cb => cb.checked = false);
        updateSelected();
    }

    document.getElementById('search-gejala').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll('.gejala-item').forEach(item => {
            const nama = item.getAttribute('data-nama');
            item.style.display = nama.includes(keyword) ? '' : 'none';
        });
    });
</script>
@endpush