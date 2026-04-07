@extends('layouts.app')

@section('title', 'Data Pendaftaran - Sistem Pendaftaran Kursus')

@section('content')
    <div class="page-header animate-in">
        <div class="page-header-actions">
            <div>
                <h2>Data Pendaftaran</h2>
                <p>Kelola pendaftaran peserta kursus</p>
            </div>
            <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary" id="add-pendaftaran-btn">
                <i class="fas fa-plus"></i> Pendaftaran Baru
            </a>
        </div>
    </div>

    <div class="table-container animate-in">
        <div class="table-header">
            <h3><i class="fas fa-file-signature"></i> Daftar Pendaftaran</h3>
            <span style="font-size: 0.82rem; color: var(--text-muted);">Total: {{ $pendaftaran->total() }}
                pendaftaran</span>
        </div>

        @if($pendaftaran->count() > 0)
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Daftar</th>
                            <th>Nama Peserta</th>
                            <th>Jurusan</th>
                            <th>Tgl Daftar</th>
                            <th>Status</th>
                            <th>Ubah Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftaran as $index => $d)
                            <tr>
                                <td>{{ $pendaftaran->firstItem() + $index }}</td>
                                <td><span class="fw-600 text-white">{{ $d->id_daftar }}</span></td>
                                <td><span class="fw-600 text-white">{{ $d->peserta->nm_peserta ?? '-' }}</span></td>
                                <td>{{ $d->jurusan->nm_jurusan ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($d->tgl_daftar)->format('d M Y') }}</td>
                                <td>
                                    @if($d->status == 'Aktif')
                                        <span class="badge badge-aktif"><i class="fas fa-circle"
                                                style="font-size: 6px; margin-right: 4px;"></i> Aktif</span>
                                    @elseif($d->status == 'Selesai')
                                        <span class="badge badge-selesai"><i class="fas fa-circle"
                                                style="font-size: 6px; margin-right: 4px;"></i> Selesai</span>
                                    @else
                                        <span class="badge badge-batal"><i class="fas fa-circle"
                                                style="font-size: 6px; margin-right: 4px;"></i> Batal</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('pendaftaran.updateStatus', $d->id_daftar) }}" method="POST"
                                        class="status-form" id="status-form-{{ $d->id_daftar }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="status-select" onchange="this.form.submit()">
                                            <option value="Aktif" {{ $d->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Selesai" {{ $d->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="Batal" {{ $d->status == 'Batal' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div class="btn-group" style="justify-content: center;">
                                        <a href="{{ route('pendaftaran.edit', $d->id_daftar) }}"
                                            class="btn btn-warning btn-icon btn-sm" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <button class="btn btn-danger btn-icon btn-sm"
                                            onclick="confirmDelete('{{ route('pendaftaran.destroy', $d->id_daftar) }}')"
                                            title="Hapus">
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
                {{ $pendaftaran->links('pagination.custom') }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <p>Belum ada data pendaftaran. Klik tombol "Pendaftaran Baru" untuk menambahkan.</p>
            </div>
        @endif
    </div>
@endsection