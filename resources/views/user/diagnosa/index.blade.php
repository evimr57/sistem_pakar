@extends('layouts.user-app')

@section('page-title', 'Diagnosa Penyakit')
@section('page-subtitle', 'Pilih gejala yang dialami tanaman kopi kamu')

@section('content')

@if(session('error'))
    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg flex items-center">
        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <span class="font-semibold">{{ session('error') }}</span>
    </div>
@endif

<form action="{{ route('user.diagnosa.proses') }}" method="POST" id="form-diagnosa">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Daftar Gejala -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-3 mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Pilih Gejala</h3>
                            <p class="text-sm text-gray-500">Centang gejala yang sesuai dengan kondisi tanaman</p>
                        </div>
                    </div>
                    <!-- Search -->
                    <input type="text" id="search-gejala" placeholder="🔍 Cari gejala yang dialami tanaman kopi kamu..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>

                <!-- Gejala List -->
                <div class="space-y-3 max-h-[500px] overflow-y-auto pr-2" id="gejala-list">
                    @foreach($gejalas as $index => $gejala)
                        <label for="gejala_{{ $gejala->id_gejala }}"
                            class="gejala-item flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all group"
                            data-nama="{{ strtolower($gejala->nama_gejala) }}">
                            <input type="checkbox" name="gejala[]" value="{{ $gejala->id_gejala }}"
                                id="gejala_{{ $gejala->id_gejala }}"
                                class="gejala-checkbox w-5 h-5 text-green-600 rounded focus:ring-green-500 mr-4"
                                onchange="updateSelected()">
                            <div class="flex-1">
                                <span class="text-sm font-semibold text-gray-700 group-hover:text-green-700">
                                    {{ $gejala->nama_gejala }}
                                </span>
                            </div>
                            <div class="w-6 h-6 rounded-full border-2 border-gray-300 group-hover:border-green-400 flex items-center justify-center checkmark hidden">
                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </label>
                    @endforeach
                </div>

                @error('gejala')
                    <p class="text-red-500 text-sm mt-3">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Panel Kanan -->
        <div class="space-y-6">

            <!-- Gejala Terpilih -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-28">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Gejala Terpilih</h3>

                <div id="selected-count" class="text-3xl font-bold text-green-600 mb-1">0</div>
                <p class="text-sm text-gray-500 mb-4">gejala dipilih</p>

                <div id="selected-list" class="space-y-2 max-h-64 overflow-y-auto mb-6">
                    <p class="text-sm text-gray-400 italic" id="empty-msg">Belum ada gejala dipilih</p>
                </div>

                <button type="button" onclick="resetGejala()"
                    class="w-full mb-3 px-4 py-2 border border-gray-300 text-gray-600 font-semibold rounded-xl hover:bg-gray-50 transition text-sm">
                    Reset Pilihan
                </button>

                <button type="submit"
                    class="w-full px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-xl hover:from-green-600 hover:to-green-700 transition shadow-lg text-sm">
                    Diagnosa Sekarang
                </button>

                <!-- Info -->
                <div class="mt-4 p-3 bg-green-50 rounded-xl">
                    <p class="text-xs text-green-700">
                        💡 Pilih semua gejala yang kamu amati pada tanaman untuk hasil diagnosa yang lebih akurat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    const gejalaData = {};

    function updateSelected() {
        const checkboxes = document.querySelectorAll('.gejala-checkbox:checked');
        const count = checkboxes.length;
        document.getElementById('selected-count').textContent = count;

        const list = document.getElementById('selected-list');
        const emptyMsg = document.getElementById('empty-msg');

        if (count === 0) {
            list.innerHTML = '<p class="text-sm text-gray-400 italic" id="empty-msg">Belum ada gejala dipilih</p>';
            return;
        }

        list.innerHTML = '';
        checkboxes.forEach(cb => {
            const label = document.querySelector(`label[for="${cb.id}"] .flex-1 span`);
            const nama = label ? label.textContent.trim() : cb.value;
            list.innerHTML += `
                <div class="flex items-center justify-between bg-green-50 px-3 py-2 rounded-lg">
                    <span class="text-xs font-medium text-green-800">${nama}</span>
                    <button type="button" onclick="removeGejala('${cb.id}')" class="text-green-500 hover:text-red-500 ml-2">✕</button>
                </div>`;
        });

        // Update label styling
        document.querySelectorAll('.gejala-item').forEach(label => {
            const cb = label.querySelector('.gejala-checkbox');
            if (cb.checked) {
                label.classList.add('border-green-500', 'bg-green-50');
                label.classList.remove('border-gray-200');
            } else {
                label.classList.remove('border-green-500', 'bg-green-50');
                label.classList.add('border-gray-200');
            }
        });
    }

    function removeGejala(id) {
        const cb = document.getElementById(id);
        if (cb) {
            cb.checked = false;
            updateSelected();
        }
    }

    function resetGejala() {
        document.querySelectorAll('.gejala-checkbox').forEach(cb => cb.checked = false);
        updateSelected();
    }

    // Search gejala
    document.getElementById('search-gejala').addEventListener('input', function() {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll('.gejala-item').forEach(item => {
            const nama = item.getAttribute('data-nama');
            item.style.display = nama.includes(keyword) ? '' : 'none';
        });
    });
</script>
@endpush