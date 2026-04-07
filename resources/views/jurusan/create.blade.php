@extends('layouts.app')

@section('title', 'Tambah Jurusan - Sistem Pendaftaran Kursus')

@section('content')
<div class="page-header animate-in">
    <div class="page-header-actions">
        <div>
            <h2>Tambah Jurusan</h2>
            <p>Masukkan data jurusan baru</p>
        </div>
        <a href="{{ route('jurusan.index') }}" class="btn btn-outline" id="back-jurusan-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="form-card animate-in">
    <form action="{{ route('jurusan.store') }}" method="POST" id="jurusan-create-form">
        @csrf

        <div class="form-group">
            <label for="kd_jurusan">Kode Jurusan <span class="required">*</span></label>
            <input type="text" name="kd_jurusan" id="kd_jurusan" class="form-control" placeholder="Contoh: JRS-004" value="{{ old('kd_jurusan') }}">
            @error('kd_jurusan') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="nm_jurusan">Nama Jurusan <span class="required">*</span></label>
            <input type="text" name="nm_jurusan" id="nm_jurusan" class="form-control" placeholder="Masukkan nama jurusan" value="{{ old('nm_jurusan') }}">
            @error('nm_jurusan') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="durasi">Durasi <span class="required">*</span></label>
            <input type="text" name="durasi" id="durasi" class="form-control" placeholder="Contoh: 3 Bulan" value="{{ old('durasi') }}">
            @error('durasi') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="biaya">Biaya (Rp) <span class="required">*</span></label>
            <input type="number" name="biaya" id="biaya" class="form-control" placeholder="Contoh: 1000000" value="{{ old('biaya') }}" min="0">
            @error('biaya') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="submit-jurusan-btn">
                <i class="fas fa-save"></i> Simpan Data
            </button>
            <a href="{{ route('jurusan.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
