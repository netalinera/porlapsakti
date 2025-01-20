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
    
        // Filter pencarian berdasarkan input pengguna
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'LIKE', '%' . $search . '%')
                  ->orWhere('nama_kel_desa', 'LIKE', '%' . $search . '%')
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
    
        // Sorting dan pagination
        $kelDesas = $query->orderBy('id_prov', 'asc')
                          ->orderBy('id_kab_kota', 'asc')
                          ->orderBy('id_kecamatan', 'asc')
                          ->paginate(15)
                          ->onEachSide(2);
    
        return view('adminpus.kel_desa.index', compact('kelDesas'));
    }    

    public function create()
    {
        // Memuat data provinsi untuk dropdown
        $provinces = Provinsi::orderBy('id', 'asc')->get();
        return view('adminpus.kel_desa.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|numeric|unique:kel_desas,id',
            'id_prov' => 'required|exists:provinsis,id',
            'id_kab_kota' => 'required|exists:kab_kotas,id',
            'id_kecamatan' => 'required|exists:kecamatans,id',
            'nama_kel_desa' => 'required|string|max:255',
        ]);
    // Validasi tambahan: Pastikan nama_kel_desa unik dalam kecamatan yang sama
    $existingName = KelDesa::where('id_kecamatan', $request->id_kecamatan)
                           ->where('nama_kel_desa', $request->nama_kel_desa)
                           ->exists();

    if ($existingName) {
        return redirect()->back()->withErrors(['nama_kel_desa' => 'Nama kelurahan/desa sudah digunakan dalam kecamatan ini.']);
    }                           
        KelDesa::create($validated);

        return redirect()->route('kel_desa.index')->with('success', 'Kelurahan/Desa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelDesa = KelDesa::with(['kecamatan', 'kabKota', 'provinsi'])->findOrFail($id);
        $provinces = Provinsi::orderBy('id', 'asc')->get();
        $kabKotas = KabKota::where('id_prov', $kelDesa->provinsi->id)->orderBy('nama_kab_kota', 'asc')->get();
        $kecamatans = Kecamatan::where('id_kab_kota', $kelDesa->kabKota->id)->orderBy('nama_kecamatan', 'asc')->get();

        return view('adminpus.kel_desa.edit', compact('kelDesa', 'provinces', 'kabKotas', 'kecamatans'));
    }

    public function update(Request $request, $id)
    {
        $kelDesa = KelDesa::findOrFail($id);

        $validated = $request->validate([
            'id_prov' => 'required|exists:provinsis,id',
            'id_kab_kota' => 'required|exists:kab_kotas,id',
            'id_kecamatan' => 'required|exists:kecamatans,id',
            'nama_kel_desa' => 'required|string|max:255',
        ]);

        //
        $existingName = KelDesa::where('id_kecamatan', $request->id_kecamatan)
                        ->where('nama_kel_desa', $request->nama_kel_desa)
                        ->where('id', '!=', $id) // Abaikan data yang sedang diperbarui
                        ->exists();

        if ($existingName) {
            return redirect()->back()->withErrors(['nama_kel_desa' => 'Nama kelurahan/desa sudah digunakan dalam kecamatan ini.']);
        }        

        $kelDesa->update($validated);

        return redirect()->route('kel_desa.index')->with('success', 'Kelurahan/Desa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kelDesa = KelDesa::findOrFail($id);
        $kelDesa->delete();

        return redirect()->route('kel_desa.index')->with('success', 'Kelurahan/Desa berhasil dihapus.');
    }
    public function getKelDesaByKecamatan($id_kecamatan)
    {
        $kel_desa = KelDesa::where('id_kecamatan', $id_kecamatan)->get();
        return response()->json($kel_desa);
    }
}
