@extends('layouts.app')

@section('title', 'Edit Jurusan - Sistem Pendaftaran Kursus')

@section('content')
<div class="page-header animate-in">
    <div class="page-header-actions">
        <div>
            <h2>Edit Jurusan</h2>
            <p>Perbarui data jurusan: <strong>{{ $jurusan->nm_jurusan }}</strong></p>
        </div>
        <a href="{{ route('jurusan.index') }}" class="btn btn-outline" id="back-jurusan-edit-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="form-card animate-in">
    <form action="{{ route('jurusan.update', $jurusan->kd_jurusan) }}" method="POST" id="jurusan-edit-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kd_jurusan">Kode Jurusan</label>
            <input type="text" id="kd_jurusan" class="form-control" value="{{ $jurusan->kd_jurusan }}" disabled style="opacity: 0.6;">
            <small style="color: var(--text-muted); font-size: 0.75rem;">Kode jurusan tidak dapat diubah</small>
        </div>

        <div class="form-group">
            <label for="nm_jurusan">Nama Jurusan <span class="required">*</span></label>
            <input type="text" name="nm_jurusan" id="nm_jurusan" class="form-control" value="{{ old('nm_jurusan', $jurusan->nm_jurusan) }}">
            @error('nm_jurusan') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="durasi">Durasi <span class="required">*</span></label>
            <input type="text" name="durasi" id="durasi" class="form-control" value="{{ old('durasi', $jurusan->durasi) }}">
            @error('durasi') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="biaya">Biaya (Rp) <span class="required">*</span></label>
            <input type="number" name="biaya" id="biaya" class="form-control" value="{{ old('biaya', $jurusan->biaya) }}" min="0">
            @error('biaya') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="update-jurusan-btn">
                <i class="fas fa-save"></i> Perbarui Data
            </button>
            <a href="{{ route('jurusan.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
