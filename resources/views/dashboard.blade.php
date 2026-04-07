@extends('layouts.app')

@section('title', 'Dashboard - Sistem Pendaftaran Kursus')

@section('content')
    <div class="page-header animate-in">
        <h2>Home</h2>
        <p>Selamat datang di Sistem Pendaftaran Kursus</p>
    </div>

    <!-- Statistics -->
    <div class="stat-grid animate-in">
        <div class="stat-card">
            <div class="stat-icon purple"><i class="fas fa-users"></i></div>
            <div class="stat-value">{{ $totalPeserta }}</div>
            <div class="stat-label">Total Peserta</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-book-open"></i></div>
            <div class="stat-value">{{ $totalJurusan }}</div>
            <div class="stat-label">Total Jurusan</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-file-signature"></i></div>
            <div class="stat-value">{{ $totalPendaftaran }}</div>
            <div class="stat-label">Total Pendaftaran</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon yellow"><i class="fas fa-user-check"></i></div>
            <div class="stat-value">{{ $totalAktif }}</div>
            <div class="stat-label">Peserta Aktif</div>
        </div>
    </div>

    <!-- Peserta Table with Search -->
    <div class="table-container animate-in">
        <div class="table-header">
            <h3><i class="fas fa-list"></i> Data Seluruh Peserta Kursus</h3>
            <form action="{{ route('dashboard') }}" method="GET" class="search-box" id="search-form">
                <input type="text" name="search" placeholder="Cari nama peserta..." value="{{ $search }}" id="search-input">
                <button type="submit" id="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>

        @if($search)
            <div
                style="padding: 12px 24px; background: rgba(99, 102, 241, 0.06); border-bottom: 1px solid var(--border-color);">
                <span style="font-size: 0.85rem; color: var(--text-secondary);">
                    Hasil pencarian untuk: <strong style="color: var(--accent-primary);">"{{ $search }}"</strong>
                    — {{ $peserta->total() }} data ditemukan
                    <a href="{{ route('dashboard') }}"
                        style="color: var(--danger); margin-left: 8px; text-decoration: none; font-size: 0.8rem;">
                        <i class="fas fa-times"></i> Reset
                    </a>
                </span>
            </div>
        @endif

        @if($peserta->count() > 0)
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Peserta</th>
                            <th>Nama Peserta</th>
                            <th>Jenis Kelamin</th>
                            <th>Jurusan</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peserta as $index => $p)
                            <tr>
                                <td>{{ $peserta->firstItem() + $index }}</td>
                                <td><span class="fw-600 text-white">{{ $p->id_peserta }}</span></td>
                                <td><span class="fw-600 text-white">{{ $p->nm_peserta }}</span></td>
                                <td>{{ $p->jekel }}</td>
                                <td>
                                    @if($p->jurusan)
                                        <span class="badge badge-aktif">{{ $p->jurusan->nm_jurusan }}</span>
                                    @else
                                        <span class="badge badge-batal">-</span>
                                    @endif
                                </td>
                                <td>{{ $p->no_hp }}</td>
                                <td>{{ Str::limit($p->alamat, 30) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-footer">
                {{ $peserta->appends(['search' => $search])->links('pagination.custom') }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>{{ $search ? 'Tidak ada peserta ditemukan dengan kata kunci tersebut.' : 'Belum ada data peserta. Silahkan tambahkan data peserta terlebih dahulu.' }}
                </p>
            </div>
        @endif
    </div>
@endsection