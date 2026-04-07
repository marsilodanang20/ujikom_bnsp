@extends('layouts.app')

@section('title', 'Edit Peserta - Sistem Pendaftaran Kursus')

@section('content')
<div class="page-header animate-in">
    <div class="page-header-actions">
        <div>
            <h2>Edit Peserta</h2>
            <p>Perbarui data peserta: <strong>{{ $peserta->nm_peserta }}</strong></p>
        </div>
        <a href="{{ route('peserta.index') }}" class="btn btn-outline" id="back-peserta-edit-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="form-card animate-in">
    <form action="{{ route('peserta.update', $peserta->id_peserta) }}" method="POST" id="peserta-edit-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kd_jurusan">Jurusan <span class="required">*</span></label>
            <select name="kd_jurusan" id="kd_jurusan" class="form-control">
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusan as $j)
                    <option value="{{ $j->kd_jurusan }}" {{ old('kd_jurusan', $peserta->kd_jurusan) == $j->kd_jurusan ? 'selected' : '' }}>
                        {{ $j->kd_jurusan }} - {{ $j->nm_jurusan }} ({{ $j->durasi }})
                    </option>
                @endforeach
            </select>
            @error('kd_jurusan') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="nm_peserta">Nama Peserta <span class="required">*</span></label>
            <input type="text" name="nm_peserta" id="nm_peserta" class="form-control" value="{{ old('nm_peserta', $peserta->nm_peserta) }}">
            @error('nm_peserta') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="jekel">Jenis Kelamin <span class="required">*</span></label>
            <select name="jekel" id="jekel" class="form-control">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki" {{ old('jekel', $peserta->jekel) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jekel', $peserta->jekel) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jekel') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="alamat">Alamat <span class="required">*</span></label>
            <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat', $peserta->alamat) }}</textarea>
            @error('alamat') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="no_hp">Nomor HP <span class="required">*</span></label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp', $peserta->no_hp) }}">
            @error('no_hp') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="update-peserta-btn">
                <i class="fas fa-save"></i> Perbarui Data
            </button>
            <a href="{{ route('peserta.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
