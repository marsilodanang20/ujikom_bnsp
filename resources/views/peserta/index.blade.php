@extends('layouts.app')

@section('title', 'Data Peserta - Sistem Pendaftaran Kursus')

@section('content')
<div class="page-header animate-in">
    <div class="page-header-actions">
        <div>
            <h2>Data Peserta</h2>
            <p>Kelola data peserta kursus</p>
        </div>
        <a href="{{ route('peserta.create') }}" class="btn btn-primary" id="add-peserta-btn">
            <i class="fas fa-plus"></i> Tambah Peserta
        </a>
    </div>
</div>

<div class="table-container animate-in">
    <div class="table-header">
        <h3><i class="fas fa-users"></i> Daftar Peserta</h3>
        <span style="font-size: 0.82rem; color: var(--text-muted);">Total: {{ $peserta->total() }} peserta</span>
    </div>

    @if($peserta->count() > 0)
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Peserta</th>
                        <th>Jenis Kelamin</th>
                        <th>Jurusan</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peserta as $index => $p)
                    <tr>
                        <td>{{ $peserta->firstItem() + $index }}</td>
                        <td><span class="fw-600 text-white">{{ $p->id_peserta }}</span></td>
                        <td><span class="fw-600 text-white">{{ $p->nm_peserta }}</span></td>
                        <td>
                            <span class="badge {{ $p->jekel == 'Laki-laki' ? 'badge-aktif' : 'badge-selesai' }}">
                                {{ $p->jekel }}
                            </span>
                        </td>
                        <td>{{ $p->jurusan->nm_jurusan ?? '-' }}</td>
                        <td>{{ $p->no_hp }}</td>
                        <td>{{ Str::limit($p->alamat, 25) }}</td>
                        <td>
                            <div class="btn-group" style="justify-content: center;">
                                <a href="{{ route('peserta.edit', $p->id_peserta) }}" class="btn btn-warning btn-icon btn-sm" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button class="btn btn-danger btn-icon btn-sm" onclick="confirmDelete('{{ route('peserta.destroy', $p->id_peserta) }}')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="table-footer">
            {{ $peserta->links('pagination.custom') }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-user-slash"></i>
            <p>Belum ada data peserta. Klik tombol "Tambah Peserta" untuk menambahkan.</p>
        </div>
    @endif
</div>
@endsection
