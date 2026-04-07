@extends('layouts.app')

@section('title', 'Form Pendaftaran - Sistem Pendaftaran Kursus')

@section('content')
<div class="page-header animate-in">
    <div class="page-header-actions">
        <div>
            <h2>Form Pendaftaran</h2>
            <p>Daftarkan peserta ke jurusan kursus</p>
        </div>
        <a href="{{ route('pendaftaran.index') }}" class="btn btn-outline" id="back-pendaftaran-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="form-card animate-in">
    <form action="{{ route('pendaftaran.store') }}" method="POST" id="pendaftaran-create-form">
        @csrf

        <div class="form-group">
            <label for="id_peserta">Peserta <span class="required">*</span></label>
            <select name="id_peserta" id="id_peserta" class="form-control">
                <option value="">-- Pilih Peserta --</option>
                @foreach($peserta as $p)
                    <option value="{{ $p->id_peserta }}" {{ old('id_peserta') == $p->id_peserta ? 'selected' : '' }}>
                        {{ $p->id_peserta }} - {{ $p->nm_peserta }} ({{ $p->jekel }})
                    </option>
                @endforeach
            </select>
            @error('id_peserta') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="kd_jurusan">Jurusan <span class="required">*</span></label>
            <select name="kd_jurusan" id="kd_jurusan" class="form-control">
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusan as $j)
                    <option value="{{ $j->kd_jurusan }}" {{ old('kd_jurusan') == $j->kd_jurusan ? 'selected' : '' }}>
                        {{ $j->kd_jurusan }} - {{ $j->nm_jurusan }} ({{ $j->durasi }} | Rp {{ number_format($j->biaya, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>
            @error('kd_jurusan') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="tgl_daftar">Tanggal Daftar <span class="required">*</span></label>
            <input type="date" name="tgl_daftar" id="tgl_daftar" class="form-control" value="{{ old('tgl_daftar', date('Y-m-d')) }}">
            @error('tgl_daftar') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="status">Status <span class="required">*</span></label>
            <select name="status" id="status" class="form-control">
                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Batal" {{ old('status') == 'Batal' ? 'selected' : '' }}>Batal</option>
            </select>
            @error('status') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="submit-pendaftaran-btn">
                <i class="fas fa-save"></i> Simpan Pendaftaran
            </button>
            <a href="{{ route('pendaftaran.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
