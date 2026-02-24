@extends('layouts.admin-app')

@section('page-title', 'Tambah Gejala')
@section('page-subtitle', 'Tambah data gejala penyakit baru')

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

    <form action="{{ route('admin.gejala.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-2xl shadow-lg">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Form Tambah Gejala Baru</h3>
                </div>
            </div>

            <!-- Form Body -->
            <div class="p-8 space-y-6">
                
                <!-- Kode Gejala -->
                <div>
                    <label for="id_gejala" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kode Gejala <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="id_gejala" 
                        id="id_gejala" 
                        value="{{ old('id_gejala') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition @error('id_gejala') border-red-500 @enderror"
                        placeholder="Contoh: G001"
                        required
                        maxlength="10"
                    >
                    <p class="mt-1 text-sm text-gray-500">Format: G001, G002, dst. Maksimal 10 karakter.</p>
                    @error('id_gejala')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Gejala -->
                <div>
                    <label for="nama_gejala" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Gejala <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_gejala" 
                        id="nama_gejala" 
                        value="{{ old('nama_gejala') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition @error('nama_gejala') border-red-500 @enderror"
                        placeholder="Contoh: Daun menguning"
                        required
                    >
                    @error('nama_gejala')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex justify-between items-center rounded-b-2xl">
                <a href="{{ route('admin.gejala.index') }}" class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-400 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-xl hover:from-green-600 hover:to-green-700 transition-all shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Simpan Data
                </button>
            </div>
        </div>
    </form>
@endsection