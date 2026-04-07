@extends('layouts.app')

@section('title', 'Tambah Peserta - Sistem Pendaftaran Kursus')

@section('content')
<div class="page-header animate-in">
    <div class="page-header-actions">
        <div>
            <h2>Tambah Peserta</h2>
            <p>Masukkan data peserta baru</p>
        </div>
        <a href="{{ route('peserta.index') }}" class="btn btn-outline" id="back-peserta-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="form-card animate-in">
    <form action="{{ route('peserta.store') }}" method="POST" id="peserta-create-form">
        @csrf

        <div class="form-group">
            <label for="kd_jurusan">Jurusan <span class="required">*</span></label>
            <select name="kd_jurusan" id="kd_jurusan" class="form-control">
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusan as $j)
                    <option value="{{ $j->kd_jurusan }}" {{ old('kd_jurusan') == $j->kd_jurusan ? 'selected' : '' }}>
                        {{ $j->kd_jurusan }} - {{ $j->nm_jurusan }} ({{ $j->durasi }})
                    </option>
                @endforeach
            </select>
            @error('kd_jurusan') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="nm_peserta">Nama Peserta <span class="required">*</span></label>
            <input type="text" name="nm_peserta" id="nm_peserta" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('nm_peserta') }}">
            @error('nm_peserta') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="jekel">Jenis Kelamin <span class="required">*</span></label>
            <select name="jekel" id="jekel" class="form-control">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki" {{ old('jekel') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jekel') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jekel') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="alamat">Alamat <span class="required">*</span></label>
            <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
            @error('alamat') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="no_hp">Nomor HP <span class="required">*</span></label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Contoh: 08123456789" value="{{ old('no_hp') }}">
            @error('no_hp') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="submit-peserta-btn">
                <i class="fas fa-save"></i> Simpan Data
            </button>
            <a href="{{ route('peserta.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
