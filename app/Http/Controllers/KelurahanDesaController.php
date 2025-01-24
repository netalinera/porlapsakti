<?php

namespace App\Http\Controllers;

use App\Models\KelDesa;
use App\Models\Kecamatan;
use App\Models\KabKota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KelurahanDesaController extends Controller
{
    public function index(Request $request)
    {
        $query = KelDesa::with(['kecamatan', 'kabKota', 'provinsi']);
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_kel_desa', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('kecamatan', function ($q) use ($search) {
                      $q->where('nama_kecamatan', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('kabKota', function ($q) use ($search) {
                      $q->where('nama_kab_kota', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('provinsi', function ($q) use ($search) {
                      $q->where('nama_provinsi', 'LIKE', '%' . $search . '%');
                  });
        }
    
        $kelDesas = $query->orderBy('kode_prov', 'asc')
                          ->orderBy('kode_kab_kota', 'asc')
                          ->orderBy('kode_kec', 'asc')
                          ->orderBy('kode_kel_desa', 'asc')
                          ->paginate(15)
                          ->onEachSide(2);
    
        return view('adminpus.kel_desa.index', compact('kelDesas'));
    }

    public function create()
    {
        $provinces = Provinsi::orderBy('kode_prov', 'asc')->get();
        return view('adminpus.kel_desa.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kel_desa' => 'required|string|unique:kel_desas,kode_kel_desa',
            'kode_prov' => 'required|exists:provinsis,kode_prov',
            'kode_kab_kota' => 'required|exists:kab_kotas,kode_kab_kota',
            'kode_kec' => 'required|exists:kecamatans,kode_kec',
            'nama_kel_desa' => 'required|string|max:255',
        ]);

        KelDesa::create($validated);

        return redirect()->route('kel_desa.index')->with('success', 'Kelurahan/Desa berhasil ditambahkan!');
    }

    public function edit($kode_kel_desa)
    {
        $kelDesa = KelDesa::with(['kecamatan', 'kabKota', 'provinsi'])->findOrFail($kode_kel_desa);
        $provinces = Provinsi::orderBy('kode_prov', 'asc')->get();
        $kabKotas = KabKota::where('kode_prov', $kelDesa->provinsi->kode_prov)->orderBy('nama_kab_kota', 'asc')->get();
        $kecamatans = Kecamatan::where('kode_kab_kota', $kelDesa->kabKota->kode_kab_kota)->orderBy('nama_kecamatan', 'asc')->get();

        return view('adminpus.kel_desa.edit', compact('kelDesa', 'provinces', 'kabKotas', 'kecamatans'));
    }

    public function update(Request $request, $kode_kel_desa)
    {
        $kelDesa = KelDesa::findOrFail($kode_kel_desa);

        $validated = $request->validate([
            'kode_prov' => 'required|exists:provinsis,kode_prov',
            'kode_kab_kota' => 'required|exists:kab_kotas,kode_kab_kota',
            'kode_kec' => 'required|exists:kecamatans,kode_kec',
            'nama_kel_desa' => 'required|string|max:255',
        ]);

        $kelDesa->update($validated);

        return redirect()->route('kel_desa.index')->with('success', 'Kelurahan/Desa berhasil diperbarui!');
    }

    public function destroy($kode_kel_desa)
    {
        $kelDesa = KelDesa::findOrFail($kode_kel_desa);
        $kelDesa->delete();

        return redirect()->route('kel_desa.index')->with('success', 'Kelurahan/Desa berhasil dihapus!');
    }

    public function getKelDesaByKecamatan($kode_kec)
    {
        $kelDesa = KelDesa::where('kode_kec', $kode_kec)->orderBy('kode_kel_desa', 'asc')->get();
        return response()->json($kelDesa);
    }
}
