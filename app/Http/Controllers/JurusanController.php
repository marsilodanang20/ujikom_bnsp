<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::withCount('peserta')->orderBy('kd_jurusan')->get();
        return view('jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_jurusan' => 'required|string|max:10|unique:jurusan,kd_jurusan',
            'nm_jurusan' => 'required|string|max:100',
            'durasi' => 'required|string|max:20',
            'biaya' => 'required|numeric|min:0',
        ], [
            'kd_jurusan.required' => 'Kode jurusan wajib diisi.',
            'kd_jurusan.unique' => 'Kode jurusan sudah digunakan.',
            'nm_jurusan.required' => 'Nama jurusan wajib diisi.',
            'durasi.required' => 'Durasi wajib diisi.',
            'biaya.required' => 'Biaya wajib diisi.',
            'biaya.numeric' => 'Biaya harus berupa angka.',
            'biaya.min' => 'Biaya tidak boleh negatif.',
        ]);

        Jurusan::create($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil ditambahkan!');
    }

    public function edit(string $kd_jurusan)
    {
        $jurusan = Jurusan::findOrFail($kd_jurusan);
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, string $kd_jurusan)
    {
        $request->validate([
            'nm_jurusan' => 'required|string|max:100',
            'durasi' => 'required|string|max:20',
            'biaya' => 'required|numeric|min:0',
        ], [
            'nm_jurusan.required' => 'Nama jurusan wajib diisi.',
            'durasi.required' => 'Durasi wajib diisi.',
            'biaya.required' => 'Biaya wajib diisi.',
            'biaya.numeric' => 'Biaya harus berupa angka.',
            'biaya.min' => 'Biaya tidak boleh negatif.',
        ]);

        $jurusan = Jurusan::findOrFail($kd_jurusan);
        $jurusan->update($request->only(['nm_jurusan', 'durasi', 'biaya']));

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil diperbarui!');
    }

    public function destroy(string $kd_jurusan)
    {
        $jurusan = Jurusan::findOrFail($kd_jurusan);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil dihapus!');
    }
}
