<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $peserta = Peserta::with('jurusan')
            ->when($search, function ($query) use ($search) {
                $query->where('nm_peserta', 'LIKE', "%{$search}%");
            })
            ->orderBy('id_peserta', 'desc')
            ->paginate(10);

        $totalPeserta = Peserta::count();
        $totalJurusan = Jurusan::count();
        $totalPendaftaran = Pendaftaran::count();
        $totalAktif = Pendaftaran::where('status', 'Aktif')->count();

        return view('dashboard', compact('peserta', 'search', 'totalPeserta', 'totalJurusan', 'totalPendaftaran', 'totalAktif'));
    }
}
