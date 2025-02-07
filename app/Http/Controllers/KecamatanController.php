<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\KabKota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kecamatan::with(['kabKota', 'provinsi']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_kecamatan', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('provinsi', function ($q) use ($search) {
                      $q->where('nama_provinsi', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('kabKota', function ($q) use ($search) {
                      $q->where('nama_kab_kota', 'LIKE', '%' . $search . '%');
                  });
        }

        $kecamatans = $query->orderBy('kode_prov', 'asc')
                            ->orderBy('kode_kab_kota', 'asc')
                            ->paginate(15)
                            ->onEachSide(2);

        return view('adminpus.kecamatan.index', compact('kecamatans'));
    }

    public function create()
    {
        $provinces = Provinsi::orderBy('kode_prov', 'asc')->get();
        return view('adminpus.kecamatan.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kec' => 'required|numeric|unique:kecamatans,kode_kec',
            'kode_prov' => 'required|exists:provinsis,kode_prov',
            'kode_kab_kota' => 'required|exists:kab_kotas,kode_kab_kota',
            'nama_kecamatan' => 'required|string|max:255|unique:kecamatans,nama_kecamatan',
        ], [
            'kode_kec.required' => 'Kode kecamatan wajib diisi',
            'kode_kec.numeric' => 'Kode kecamatan harus berupa angka',
            'kode_kec.unique' => 'Kode kecamatan sudah digunakan',
            'kode_prov.required' => 'Provinsi wajib dipilih',
            'kode_prov.exists' => 'Provinsi tidak valid',
            'kode_kab_kota.required' => 'Kabupaten/Kota wajib dipilih',
            'kode_kab_kota.exists' => 'Kabupaten/Kota tidak valid',
            'nama_kecamatan.required' => 'Nama kecamatan wajib diisi',
            'nama_kecamatan.unique' => 'Nama kecamatan sudah ada',
        ]);

        Kecamatan::create($validated);

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil ditambahkan.');
    }

    public function edit($kode_kec)
    {
        $kecamatan = Kecamatan::with(['kabKota', 'provinsi'])
                              ->where('kode_kec', $kode_kec)
                              ->firstOrFail();
        $provinces = Provinsi::orderBy('kode_prov', 'asc')->get();
        $kabKotas = KabKota::where('kode_prov', $kecamatan->provinsi->kode_prov)
                           ->orderBy('nama_kab_kota', 'asc')
                           ->get();

        return view('adminpus.kecamatan.edit', compact('kecamatan', 'provinces', 'kabKotas'));
    }

    public function update(Request $request, $kode_kec)
    {
        $kecamatan = Kecamatan::where('kode_kec', $kode_kec)->firstOrFail();

        $validated = $request->validate([
            'kode_prov' => 'required|exists:provinsis,kode_prov',
            'kode_kab_kota' => 'required|exists:kab_kotas,kode_kab_kota',
            'nama_kecamatan' => 'required|string|max:255|unique:kecamatans,nama_kecamatan,' . $kecamatan->id,
        ], [
            'kode_prov.required' => 'Provinsi wajib dipilih',
            'kode_prov.exists' => 'Provinsi tidak valid',
            'kode_kab_kota.required' => 'Kabupaten/Kota wajib dipilih',
            'kode_kab_kota.exists' => 'Kabupaten/Kota tidak valid',
            'nama_kecamatan.required' => 'Nama kecamatan wajib diisi',
            'nama_kecamatan.unique' => 'Nama kecamatan sudah ada',
        ]);

        $kecamatan->update($validated);

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil diperbarui.');
    }

    public function destroy($kode_kec)
    {
        $kecamatan = Kecamatan::where('kode_kec', $kode_kec)->firstOrFail();
        $kecamatan->delete();

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil dihapus.');
    }

    public function getKecamatanByKabupaten($kode_kab_kota)
    {
        $kecamatan = Kecamatan::where('kode_kab_kota', $kode_kab_kota)->orderBy('nama_kecamatan', 'asc')->get();
        return response()->json($kecamatan);
    }
}
