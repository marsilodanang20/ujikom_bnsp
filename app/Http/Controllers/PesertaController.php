<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        $peserta = Peserta::with('jurusan')->orderBy('id_peserta', 'desc')->paginate(10);
        return view('peserta.index', compact('peserta'));
    }

    public function create()
    {
        $jurusan = Jurusan::orderBy('kd_jurusan')->get();
        return view('peserta.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_jurusan' => 'required|exists:jurusan,kd_jurusan',
            'nm_peserta' => 'required|string|max:100',
            'jekel' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
        ], [
            'kd_jurusan.required' => 'Jurusan wajib dipilih.',
            'kd_jurusan.exists' => 'Jurusan tidak valid.',
            'nm_peserta.required' => 'Nama peserta wajib diisi.',
            'jekel.required' => 'Jenis kelamin wajib dipilih.',
            'jekel.in' => 'Jenis kelamin tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
            'no_hp.max' => 'Nomor HP maksimal 15 digit.',
        ]);

        Peserta::create($request->all());

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil ditambahkan!');
    }

    public function edit(int $id)
    {
        $peserta = Peserta::findOrFail($id);
        $jurusan = Jurusan::orderBy('kd_jurusan')->get();
        return view('peserta.edit', compact('peserta', 'jurusan'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'kd_jurusan' => 'required|exists:jurusan,kd_jurusan',
            'nm_peserta' => 'required|string|max:100',
            'jekel' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
        ], [
            'kd_jurusan.required' => 'Jurusan wajib dipilih.',
            'kd_jurusan.exists' => 'Jurusan tidak valid.',
            'nm_peserta.required' => 'Nama peserta wajib diisi.',
            'jekel.required' => 'Jenis kelamin wajib dipilih.',
            'jekel.in' => 'Jenis kelamin tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
            'no_hp.max' => 'Nomor HP maksimal 15 digit.',
        ]);

        $peserta = Peserta::findOrFail($id);
        $peserta->update($request->all());

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil dihapus!');
    }
}
