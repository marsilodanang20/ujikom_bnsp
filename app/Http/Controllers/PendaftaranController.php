<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftaran::with(['peserta', 'jurusan'])
            ->orderBy('id_daftar', 'desc')
            ->paginate(10);
        return view('pendaftaran.index', compact('pendaftaran'));
    }

    public function create()
    {
        $peserta = Peserta::orderBy('nm_peserta')->get();
        $jurusan = Jurusan::orderBy('kd_jurusan')->get();
        return view('pendaftaran.create', compact('peserta', 'jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_peserta' => 'required|exists:peserta,id_peserta',
            'kd_jurusan' => 'required|exists:jurusan,kd_jurusan',
            'tgl_daftar' => 'required|date',
            'status' => 'required|in:Aktif,Selesai,Batal',
        ], [
            'id_peserta.required' => 'Peserta wajib dipilih.',
            'id_peserta.exists' => 'Peserta tidak valid.',
            'kd_jurusan.required' => 'Jurusan wajib dipilih.',
            'kd_jurusan.exists' => 'Jurusan tidak valid.',
            'tgl_daftar.required' => 'Tanggal daftar wajib diisi.',
            'tgl_daftar.date' => 'Format tanggal tidak valid.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);

        Pendaftaran::create($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil ditambahkan!');
    }

    public function edit(int $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $peserta = Peserta::orderBy('nm_peserta')->get();
        $jurusan = Jurusan::orderBy('kd_jurusan')->get();
        return view('pendaftaran.edit', compact('pendaftaran', 'peserta', 'jurusan'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'id_peserta' => 'required|exists:peserta,id_peserta',
            'kd_jurusan' => 'required|exists:jurusan,kd_jurusan',
            'tgl_daftar' => 'required|date',
            'status' => 'required|in:Aktif,Selesai,Batal',
        ], [
            'id_peserta.required' => 'Peserta wajib dipilih.',
            'id_peserta.exists' => 'Peserta tidak valid.',
            'kd_jurusan.required' => 'Jurusan wajib dipilih.',
            'kd_jurusan.exists' => 'Jurusan tidak valid.',
            'tgl_daftar.required' => 'Tanggal daftar wajib diisi.',
            'tgl_daftar.date' => 'Format tanggal tidak valid.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil diperbarui!');
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:Aktif,Selesai,Batal',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => $request->status]);

        return redirect()->route('pendaftaran.index')->with('success', 'Status pendaftaran berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus!');
    }
}
