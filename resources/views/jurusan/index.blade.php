@extends('layouts.app')

@section('title', 'Data Jurusan - Sistem Pendaftaran Kursus')

@section('content')
<div class="page-header animate-in">
    <div class="page-header-actions">
        <div>
            <h2>Data Jurusan</h2>
            <p>Kelola data jurusan kursus</p>
        </div>
        <a href="{{ route('jurusan.create') }}" class="btn btn-primary" id="add-jurusan-btn">
            <i class="fas fa-plus"></i> Tambah Jurusan
        </a>
    </div>
</div>

<div class="table-container animate-in">
    <div class="table-header">
        <h3><i class="fas fa-book-open"></i> Daftar Jurusan</h3>
        <span style="font-size: 0.82rem; color: var(--text-muted);">Total: {{ $jurusan->count() }} jurusan</span>
    </div>

    @if($jurusan->count() > 0)
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th>Durasi</th>
                        <th>Biaya</th>
                        <th>Jml Peserta</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jurusan as $index => $j)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><span class="fw-600 text-white">{{ $j->kd_jurusan }}</span></td>
                        <td><span class="fw-600 text-white">{{ $j->nm_jurusan }}</span></td>
                        <td>
                            <span class="badge badge-selesai">
                                <i class="fas fa-clock" style="margin-right: 4px;"></i> {{ $j->durasi }}
                            </span>
                        </td>
                        <td><span class="text-money">Rp {{ number_format($j->biaya, 0, ',', '.') }}</span></td>
                        <td>
                            <span class="badge badge-aktif">{{ $j->peserta_count }} peserta</span>
                        </td>
                        <td>
                            <div class="btn-group" style="justify-content: center;">
                                <a href="{{ route('jurusan.edit', $j->kd_jurusan) }}" class="btn btn-warning btn-icon btn-sm" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button class="btn btn-danger btn-icon btn-sm" onclick="confirmDelete('{{ route('jurusan.destroy', $j->kd_jurusan) }}')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-folder-open"></i>
            <p>Belum ada data jurusan. Klik tombol "Tambah Jurusan" untuk menambahkan.</p>
        </div>
    @endif
</div>
@endsection
