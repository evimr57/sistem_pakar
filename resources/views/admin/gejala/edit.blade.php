@extends('layouts.admin-app')

@section('page-title', 'Edit Gejala')
@section('page-subtitle', 'Edit data gejala penyakit')

@section('content')

@if($errors->any())
    <div style="margin-bottom:1.5rem; background:#fef2f2; border:1px solid #fecaca; color:#dc2626; padding:1rem 1.25rem; border-radius:0.75rem; display:flex; align-items:flex-start; gap:0.75rem;">
        <svg style="width:1.25rem; height:1.25rem; flex-shrink:0; margin-top:0.1rem;" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
            <p style="font-weight:600; font-size:0.875rem; margin-bottom:0.375rem;">Terdapat kesalahan:</p>
            <ul style="font-size:0.8rem; padding-left:1rem; display:flex; flex-direction:column; gap:0.2rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<form action="{{ route('admin.gejala.update', $gejala) }}" method="POST">
    @csrf
    @method('PUT')

    <div style="background:white; border-radius:1.25rem; box-shadow:0 1px 4px rgba(0,0,0,0.07); border:1px solid #f0fdf4; overflow:hidden;">

        {{-- Header --}}
        <div style="padding:1.25rem 1.5rem; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; gap:0.75rem;">
            <div style="width:2.5rem; height:2.5rem; background:#dcfce7; border-radius:0.75rem; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <svg style="width:1.25rem; height:1.25rem; color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <div style="font-size:0.9rem; font-weight:700; color:#111827;">Form Edit Gejala</div>
                <div style="font-size:0.75rem; color:#9ca3af;">Perbarui data gejala penyakit tanaman kopi</div>
            </div>
        </div>

        {{-- Form Body --}}
        <div style="padding:2rem; display:flex; flex-direction:column; gap:1.5rem;">

            {{-- Kode Gejala (readonly) --}}
            <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">Kode Gejala</label>
                <input type="text" name="id_gejala" id="id_gejala" value="{{ $gejala->id_gejala }}"
                    style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#6b7280; background:#f9fafb; font-family:monospace; box-sizing:border-box; cursor:not-allowed;"
                    readonly disabled>
                <p style="font-size:0.75rem; color:#9ca3af; margin-top:0.375rem;">Kode gejala tidak dapat diubah setelah dibuat.</p>
            </div>

            {{-- Nama Gejala --}}
            <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">
                    Nama Gejala <span style="color:#dc2626;">*</span>
                </label>
                <input type="text" name="nama_gejala" id="nama_gejala"
                    value="{{ old('nama_gejala', $gejala->nama_gejala) }}"
                    style="width:100%; padding:0.75rem 1rem; border:1px solid #e5e7eb; border-radius:0.75rem; font-size:0.875rem; color:#111827; outline:none; box-sizing:border-box;"
                    placeholder="Contoh: Daun menguning" required>
                @error('nama_gejala')
                    <p style="color:#dc2626; font-size:0.75rem; margin-top:0.375rem;">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Footer --}}
        <div style="padding:1rem 1.5rem; background:#f9fafb; border-top:1px solid #f3f4f6; display:flex; align-items:center; justify-content:space-between;">
            <a href="{{ route('admin.gejala.index') }}"
                style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.625rem 1.25rem; border:1px solid #e5e7eb; color:#6b7280; font-size:0.875rem; font-weight:600; border-radius:0.75rem; text-decoration:none; background:white;">
                <svg style="width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Batal
            </a>
            <button type="submit"
                style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.625rem 1.5rem; background:#16a34a; color:white; font-size:0.875rem; font-weight:700; border-radius:0.75rem; border:none; cursor:pointer;">
                <svg style="width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Update Data
            </button>
        </div>

    </div>
</form>

@endsection